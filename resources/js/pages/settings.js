import { showNotification } from '../utils/notification.js';

export function handleSettingsNavigation() {
    const settingAccount = document.getElementById('settingAccount');
    const settingDevice = document.getElementById('settingDevice');
    const settingSecurity = document.getElementById('settingSecurity');
    const settingTheme = document.getElementById('settingTheme');
    const settingsContainer = document.getElementById('settingsContainer');
    let isLoading = false;

    if (!window.fetch) {
        showNotification("Browser Anda tidak mendukung fitur ini.", "error");
        return;
    }

    function resetClasses() {
        [
            settingAccount, 
            settingDevice, 
            settingSecurity, 
            settingTheme
        ].forEach((el) => {
            if (el) {
                el.className =
                    'group flex space-x-2 rounded-lg px-4 py-2.5 tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100';
                el.querySelector('svg').classList.add(
                    'text-slate-400',
                    'transition-colors',
                    'group-hover:text-slate-500',
                    'group-focus:text-slate-500',
                    'dark:text-navy-300',
                    'dark:group-hover:text-navy-200',
                    'dark:group-focus:text-navy-200'
                );
            }
        });
    }

    function setActiveButton(activeButton) {
        resetClasses();
        activeButton.className =
            'flex items-center space-x-2 rounded-lg bg-primary px-4 py-2.5 tracking-wide text-white outline-none transition-all dark:bg-accent';
        activeButton.querySelector('svg').classList.remove(
            'text-slate-400',
            'transition-colors',
            'group-hover:text-slate-500',
            'group-focus:text-slate-500',
            'dark:text-navy-300',
            'dark:group-hover:text-navy-200',
            'dark:group-focus:text-navy-200'
        );
    }

    function loadContent(url, activeButton) {
        if (isLoading) return;
        isLoading = true;

        setActiveButton(activeButton);

        const spinner = document.createElement('span');
        spinner.className =
            'ml-auto spinner h-5 w-5 animate-spin rounded-full border-[3px] border-white border-r-transparent';
        activeButton.appendChild(spinner);

        fetch(url, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            },
        })
            .then((response) => {
                if (response.status === 200 && response.url.includes("/login")) {
                    showNotification('Kamu telah keluar dari perangkat', 'error');
                    window.location.href = '/login'; // Arahkan ke halaman login
                    return;
                }

                if (!response.ok) {
                    throw new Error(`Terjadi kesalahan saat memuat konten.`);
                }

                return response.text();
            })
            .then((html) => {
                settingsContainer.innerHTML = html;
            })
            .catch(() => {
                showNotification('Terjadi kesalahan saat memuat konten.', 'error');
            })
            .finally(() => {
                isLoading = false;
                activeButton.removeChild(spinner);
            });
    }

    // Fungsi untuk memperbarui breadcrumb
    function updateBreadcrumb(label) {
        const breadcrumb = document.getElementById('breadcrumb');
        if (breadcrumb) {
            breadcrumb.textContent = label;
        }
    }

    // Event listener untuk settingAccount
    if (settingAccount) {
        settingAccount.addEventListener('click', function (e) {
            e.preventDefault();
            loadContent('/settings/account', settingAccount);
            updateBreadcrumb('Akun'); // Perbarui breadcrumb
        });
    }

    // Event listener untuk settingDevice
    if (settingDevice) {
        settingDevice.addEventListener('click', function (e) {
            e.preventDefault();
            loadContent('/settings/device', settingDevice);
            updateBreadcrumb('Perangkat'); // Perbarui breadcrumb
        });
    }

    // Event listener untuk settingSecurity
    if (settingSecurity) {
        settingSecurity.addEventListener('click', function (e) {
            e.preventDefault();
            loadContent('/settings/security', settingSecurity);
            updateBreadcrumb('Keamanan'); // Perbarui breadcrumb
        });
    }

    // Event listener untuk settingTheme
    if (settingTheme) {
        settingTheme.addEventListener('click', function (e) {
            e.preventDefault();
            loadContent('/settings/theme', settingTheme);
            updateBreadcrumb('Tema'); // Perbarui breadcrumb
        });
    }

    if (settingsContainer) {
        const redirect = settingsContainer.dataset.redirect;
        
        // Periksa apakah ada pesan dalam session untuk ditampilkan
        const message = settingsContainer.dataset.msg;

        // Jika ada pesan, tampilkan notifikasi
        if (message) {
            // Tentukan jenis pesan berdasarkan isi
            let messageType = 'info'; // Default type

            if (settingsContainer.dataset.errorMessage) {
                messageType = 'error';
            } else if (settingsContainer.dataset.warningMessage) {
                messageType = 'warning';
            } else if (settingsContainer.dataset.successMessage) {
                messageType = 'success';
            }

            // Tampilkan notifikasi sesuai jenis pesan
            showNotification(message, messageType);
        }
    
        // Logika redirect berdasarkan nilai 'redirect'
        if (redirect === 'settingDevice' && settingDevice) {
            loadContent('/settings/device', settingDevice);
        } else if (redirect === 'settingSecurity' && settingSecurity) {
            loadContent('/settings/security', settingSecurity);
        } else if (redirect === 'settingTheme' && settingTheme) {
            loadContent('/settings/theme', settingTheme);
        } else if (settingAccount) {
            loadContent('/settings/account', settingAccount);
        }
    }
}

export function handleEditAccount() {
    document.addEventListener('click', function (event) {
        const button = event.target.closest('#btn-editaccount');
        if (!button) return;

        const username = document.getElementById('usernameAccount')?.value || null;
        const name = document.getElementById('nameAccount')?.value || null;
        const phone = document.getElementById('phoneAccount')?.value || null;
        const gender = document.getElementById('genderAccount')?.value || null;
        const birthday = document.getElementById('birthdayAccount')?.value || null;

        if (!window.fetch) {
            showNotification("Browser Anda tidak mendukung fitur ini.", "error");
            return;
        }

        fetch('settings/account/edit', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: JSON.stringify({
                usernameAccount: username,
                nameAccount: name,
                phoneAccount: phone,
                genderAccount: gender,
                birthdayAccount: birthday,
            }),
        })
            .then(response => {
                if (response.status === 200 && response.url.includes("/login")) {
                    showNotification('Kamu telah keluar dari perangkat', 'error');
                    window.location.href = '/login';
                    return;
                }

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                return response.json();
            })
            .then(result => {
                if (result.status === 'redirect') {
                    window.location.href = result.url;
                    return;
                }

                showNotification(result.message, result.status);

                if (result.status === 'success') {
                    reloadAccountSettings(); 
                }
            })
            .catch(error => {
                console.error(error);
                showNotification("Terjadi kesalahan saat mengubah data akun.", "error");
            });
    });
}

export function handleDeleteDevice() {
    document.addEventListener('click', function (event) {
        const button = event.target.closest('#btn-deletedevice');
        if (!button) return;

        if (!window.fetch) {
            showNotification("Browser Anda tidak mendukung fitur ini.", "error");
            return;
        }

        const cookieToken = button.getAttribute("data-device");
        if (!cookieToken) {
            showNotification("Token perangkat tidak ditemukan.", "error");
            return;
        }

        fetch('settings/device/delete', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({ cookie_token: cookieToken }),
        })
            .then(response => {
                if (response.status === 200 && response.url.includes("/login")) {
                    showNotification('Kamu telah keluar dari perangkat', 'error');
                    window.location.href = '/login';
                    return;
                }

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                return response.json();
            })
            .then(result => {
                if (result.status === 'redirect') {
                    window.location.href = result.url;
                    return;
                }

                showNotification(result.message, result.status);

                if (result.status === 'success') {
                    reloadDeviceSettings();
                }
            })
            .catch(() => {
                showNotification("Terjadi kesalahan saat memuat konten.", "error");
            });
    });
}

export function handleClearDevice() {
    document.addEventListener('click', function (event) {
        const button = event.target.closest('#btn-cleardevice');
        if (!button) return;

        if (!window.fetch) {
            showNotification("Browser Anda tidak mendukung fitur ini.", "error");
            return;
        }

        fetch('settings/device/clear', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        })
            .then(response => {
                if (response.status === 200 && response.url.includes("/login")) {
                    showNotification('Kamu telah keluar dari perangkat', 'error');
                    window.location.href = '/login';
                    return;
                }

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                return response.json();
            })
            .then(result => {
                if (result.status === 'redirect') {
                    window.location.href = result.url;
                    return;
                }

                showNotification(result.message, result.status);

                if (result.status === 'success') {
                    reloadDeviceSettings();
                }
            })
            .catch(() => {
                showNotification("Terjadi kesalahan saat memuat konten.", "error");
            });
    });
}

export function handleRedirectToGoogle() {
    document.addEventListener('click', function (event) {
        const button = event.target.closest('#btn-redirecttogoogle');
        if (!button) return;

        if (!window.fetch) {
            showNotification("Browser Anda tidak mendukung fitur ini.", "error");
            return;
        }

        fetch('settings/redirect/google', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-Requested-With': 'XMLHttpRequest',
            },
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                return response.json();
            })
            .then(result => {
                if (result.status === 'redirect') {
                    window.location.href = result.url; 
                } else {
                    showNotification("Terjadi kesalahan saat memuat data.", "error");
                }
            })
            .catch(() => {
                showNotification("Terjadi kesalahan saat memuat data.", "error");
            });
    });
}

function reloadDeviceSettings() {
    const settingDevice = document.getElementById('settingDevice');
    const settingsContainer = document.getElementById('settingsContainer');

    const spinner = document.createElement('span');
    spinner.className = 'ml-auto spinner h-5 w-5 animate-spin rounded-full border-[3px] border-white border-r-transparent';
    settingDevice.appendChild(spinner);

    fetch('/settings/device', {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        },
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error('Terjadi kesalahan saat memuat ulang konten perangkat.');
            }
            return response.text();
        })
        .then((html) => {
            settingsContainer.innerHTML = html;
        })
        .catch(() => {
            showNotification('Terjadi kesalahan saat memuat ulang konten perangkat.', 'error');
        })
        .finally(() => {
            settingDevice.removeChild(spinner);
        });
}

function reloadAccountSettings() {
    const settingAccount = document.getElementById('settingAccount');
    const settingsContainer = document.getElementById('settingsContainer');

    const spinner = document.createElement('span');
    spinner.className = 'ml-auto spinner h-5 w-5 animate-spin rounded-full border-[3px] border-white border-r-transparent';
    settingAccount.appendChild(spinner);

    fetch('/settings/account', {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        },
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error('Terjadi kesalahan saat memuat ulang konten perangkat.');
            }
            return response.text();
        })
        .then((html) => {
            settingsContainer.innerHTML = html;
        })
        .catch(() => {
            showNotification('Terjadi kesalahan saat memuat ulang konten perangkat.', 'error');
        })
        .finally(() => {
            settingAccount.removeChild(spinner);
        });
}