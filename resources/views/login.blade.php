<x-base-layout title="Login">
    <div class="fixed top-0 hidden p-6 lg:block lg:px-12">
        <a href="#" class="flex items-center space-x-2">
            <img class="h-12 w-12" src="{{ asset('images/app-logo.svg') }}" alt="logo" />
            <p class="text-xl font-semibold uppercase text-slate-700 dark:text-navy-100">
                {{ config('app.name') }}
            </p>
        </a>
    </div>
    <div class="hidden w-full place-items-center lg:grid">
        <div class="w-full max-w-lg p-6">
            <img class="w-full" x-show="!$store.global.isDarkModeEnabled"
                src="{{ asset('images/illustrations/dashboard-check.svg') }}" alt="image" />
            <img class="w-full" x-show="$store.global.isDarkModeEnabled"
                src="{{ asset('images/illustrations/dashboard-check-dark.svg') }}" alt="image" />
        </div>
    </div>
    <main class="flex w-full flex-col items-center bg-white dark:bg-navy-700 lg:max-w-md">
        <div class="flex w-full max-w-sm grow flex-col justify-center p-5">
            <div class="text-center">
                <img class="mx-auto h-16 w-16 lg:hidden" src="{{ asset('images/app-logo.svg') }}" alt="logo" />
                <div class="mt-4">
                    <h2 class="text-2xl font-semibold text-slate-600 dark:text-navy-100">
                        Selamat datang
                    </h2>
                    <p class="text-slate-400 dark:text-navy-300">
                        Harap masuk untuk melanjutkan
                    </p>
                </div>
            </div>
            <form id="loginForm" class="mt-4" action="javascript:void(0);" method="post">
                @csrf
                <!-- Input Email -->
                <div class="relative flex">
                    <input
                        class="form-input peer w-full rounded-lg bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
                        placeholder="Email" type="email" id="email" name="email" />
                    <span
                        class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                        <i class="fa-duotone fa-solid fa-envelope"></i>
                    </span>
                </div>

                <!-- Input Password -->
                <div class="mt-4 relative flex">
                    <input
                        class="form-input peer w-full rounded-lg bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
                        placeholder="Kata Sandi" type="password" id="password" name="password" />
                    <span
                        class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                        <i class="fa-duotone fa-solid fa-key"></i>
                    </span>
                </div>

                <!-- Checkbox Ingat Saya -->
                <div class="mt-4 flex items-center justify-between space-x-2">
                    <label class="inline-flex items-center space-x-2">
                        <input
                            class="form-checkbox is-outline h-5 w-5 rounded border-slate-400/70 bg-slate-100 before:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-500 dark:bg-navy-900 dark:before:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent"
                            type="checkbox" name="remember" id="remember" />
                        <span class="line-clamp-1">Ingat Saya</span>
                    </label>
                    <a href="#"
                        class="text-xs text-slate-400 transition-colors line-clamp-1 hover:text-slate-800 focus:text-slate-800 dark:text-navy-300 dark:hover:text-navy-100 dark:focus:text-navy-100">
                        Lupa Kata Sandi?
                    </a>
                </div>

                <!-- Tombol Submit -->
                <button type="submit"
                    class="btn mt-10 h-10 w-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                    id="loginMail">
                    Masuk
                </button>

                <!-- Link Daftar -->
                <div class="mt-4 text-center text-xs+">
                    <p class="line-clamp-1">
                        <span>Tidak memiliki akun?</span>
                        <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                            href="{{ route('registerView') }}">Daftar Akun</a>
                    </p>
                </div>

                <!-- Garis Pemisah -->
                <div class="my-7 flex items-center space-x-3">
                    <div class="h-px flex-1 bg-slate-200 dark:bg-navy-500"></div>
                    <p class="text-tiny+ uppercase">Masuk Dengan</p>
                    <div class="h-px flex-1 bg-slate-200 dark:bg-navy-500"></div>
                </div>

                <!-- Tombol Masuk dengan Sosial Media -->
                <div class="flex space-x-4">
                    <button
                        id="google-login-button"
                        class="btn w-full space-x-3 border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-50 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90">
                        <img class="h-5.5 w-5.5" src="{{ asset('images/socials/google.png') }}" alt="logo" />
                        <span>Google</span>
                    </button>
                </div>
            </form>
        </div>
        <div class="my-5 flex justify-center text-xs text-slate-400 dark:text-navy-300">
            <a href="#">Pemberitahuan Privasi</a>
            <div class="mx-3 my-1 w-px bg-slate-200 dark:bg-navy-500"></div>
            <a href="#">Syarat dan Ketentuan</a>
        </div>
    </main>
</x-base-layout>
