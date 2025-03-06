import { showNotification } from './notification.js';

export function authRegister() {
    const registerForm = document.getElementById('registerForm');

    if (registerForm) {
        const emailInput = document.getElementById('email');
        const nameInput = document.getElementById('name');
        const passwordInput = document.getElementById('password');
        const passwordConfirmInput = document.getElementById('password_confirmation');
        const registerMail = document.getElementById('registerMail');

        registerMail.addEventListener('click', function (event) {
            event.preventDefault();

            registerMail.innerHTML = '<span class="spinner h-7 w-7 animate-spin rounded-full border-[3px] border-white border-r-transparent"></span>';
            registerMail.disabled = true;

            const name = nameInput.value.trim();
            const email = emailInput.value.trim();
            const password = passwordInput.value;
            const passwordConfirm = passwordConfirmInput.value;

            fetch('/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: JSON.stringify({
                    name,
                    email,
                    password,
                    password_confirmation: passwordConfirm,
                }),
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Terjadi kesalahan pada server');
                    }
                    return response.json();
                })
                .then(data => {
                    showNotification(data.message, data.status === 'error' ? 'error' : (data.status === 'warning' ? 'warning' : 'success'));

                    if (data.status !== 'success') {
                        registerMail.innerHTML = 'Daftar';
                        registerMail.disabled = false;
                    }

                    if (data.status === 'success') {
                        setTimeout(() => {
                            window.location.href = data.redirect;
                        }, 3000);
                    }
                })
                .catch(() => {
                    showNotification('Terjadi kesalahan pada server', 'error');

                    registerMail.innerHTML = 'Daftar';
                    registerMail.disabled = false;
                });
        });
    } else {
        showNotification('Terjadi kesalahan pada form registrasi', 'error');
    }
}

export function authLogin() {
    const loginForm = document.getElementById('loginForm');

    if (loginForm) {
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const loginMail = document.getElementById('loginMail');

        loginMail.addEventListener('click', function (event) {
            event.preventDefault();

            loginMail.innerHTML = '<span class="spinner h-7 w-7 animate-spin rounded-full border-[3px] border-white border-r-transparent"></span>';
            loginMail.disabled = true;

            const email = emailInput.value.trim();
            const password = passwordInput.value;

            fetch('/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: JSON.stringify({
                    email,
                    password,
                }),
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Terjadi kesalahan pada server');
                    }
                    return response.json();
                })
                .then(data => {
                    showNotification(data.message, data.status === 'error' ? 'error' : (data.status === 'warning' ? 'warning' : 'success'));

                    if (data.status !== 'success') {
                        loginMail.innerHTML = 'Masuk';
                        loginMail.disabled = false;
                    }

                    if (data.status === 'success') {
                        setTimeout(() => {
                            window.location.href = data.redirect;
                        }, 3000);
                    }
                })
                .catch(error => {
                    showNotification('Terjadi kesalahan pada server', 'error');

                    loginMail.innerHTML = 'Masuk';
                    loginMail.disabled = false;
                });
        });
    } else {
        showNotification('Terjadi kesalahan pada form masuk', 'error');
    }
}

export function authGoogle() {
    const googleLoginButton = document.getElementById('google-login-button');

    if (googleLoginButton) {
        function handleMessage(event) {
            if (event.origin !== window.location.origin) return;

            const data = event.data;
            if (data.message) showNotification(data.message, data.status);

            if (data.status === 'success' && data.cookieToken) {
                fetch('/auth/set-cookie', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({ cookieToken: data.cookieToken }),
                })
                    .then((response) => response.json())
                    .then((result) => {
                        if (result.status === 'success') {
                            if (result.message) showNotification(result.message, result.status);
                            window.location.href = result.redirect;
                        } else {
                            showNotification(result.message, 'error');
                        }
                    })
                    .catch(() => showNotification('Terjadi kesalahan silahkan coba lagi atau hubungi pihak terkait.', 'error'));
            } else {
                resetGoogleButton();
            }
        }

        window.addEventListener('message', handleMessage);

        googleLoginButton.addEventListener('click', (event) => {
            event.preventDefault();
            showSpinner();

            const screenWidth = window.screen.width;
            const screenHeight = window.screen.height;
            const popupWidth = 500;
            const popupHeight = 600;
            const popupLeft = (screenWidth - popupWidth) / 2;
            const popupTop = (screenHeight - popupHeight) / 2;

            const popup = window.open(
                '/auth/google',
                'googleLogin',
                `width=${popupWidth},height=${popupHeight},left=${popupLeft},top=${popupTop}`
            );

            // Periksa apakah popup telah ditutup
            const popupCheckInterval = setInterval(() => {
                if (popup.closed) {
                    clearInterval(popupCheckInterval);
                    resetGoogleButton(); // Reset tombol setelah popup ditutup
                }
            }, 500);
        });

        function showSpinner() {
            const image = googleLoginButton.querySelector('img');
            const text = googleLoginButton.querySelector('span');

            if (image) image.style.display = 'none';
            if (text) text.style.display = 'none';

            const spinner = document.createElement('span');
            spinner.className = 'spinner h-7 w-7 animate-spin rounded-full border-[3px] border-white border-r-transparent';
            spinner.id = 'google-login-spinner';
            googleLoginButton.appendChild(spinner);

            googleLoginButton.disabled = true;
        }

        function resetGoogleButton() {
            const image = googleLoginButton.querySelector('img');
            const text = googleLoginButton.querySelector('span');
            const spinner = document.getElementById('google-login-spinner');

            if (image) image.style.display = '';
            if (text) text.style.display = '';
            if (spinner) spinner.remove();

            googleLoginButton.disabled = false;
        }
    } else {
        showNotification('Tombol login Google tidak ditemukan', 'error');
    }
}