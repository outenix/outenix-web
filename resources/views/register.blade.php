<x-base-layout title="Register">
    <div class="fixed top-0 hidden p-6 lg:block lg:px-12">
        <a href="#" class="flex items-center space-x-2">
            <img class="h-12 w-12 " src="{{ asset('images/app-logo.svg') }}" alt="logo" />
            <p class="text-xl font-semibold uppercase text-slate-700 dark:text-navy-100">
                {{ config('app.name') }}
            </p>
        </a>
    </div>
    <div class="hidden w-full place-items-center lg:grid">
        <div class="w-full max-w-lg p-6">
            <img class="w-full" x-show="!$store.global.isDarkModeEnabled"
                src="{{ asset('images/illustrations/dashboard-meet.svg') }}" alt="image" />
            <img class="w-full" x-show="$store.global.isDarkModeEnabled"
                src="{{ asset('images/illustrations/dashboard-meet-dark.svg') }}" alt="image" />
        </div>
    </div>
    <main class="flex w-full flex-col items-center bg-white dark:bg-navy-700 lg:max-w-md">
        <div class="flex w-full max-w-sm grow flex-col justify-center p-5">
            <div class="text-center">
                <img class="mx-auto h-16 w-16 lg:hidden " src="{{ asset('images/app-logo.svg') }}" alt="logo" />
                <div class="mt-4">
                    <h2 class="text-2xl font-semibold text-slate-600 dark:text-navy-100">
                        Daftar {{ config('app.name') }}
                    </h2>
                    <p class="text-slate-400 dark:text-navy-300">
                        Harap daftar untuk melanjutkan
                    </p>
                </div>
            </div>

            <div class="mt-10 flex space-x-4">
                <button
                    class="btn w-full space-x-3 border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-50 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90">
                    <img class="h-5.5 w-5.5 " src="{{ asset('images/socials/google.png') }}" alt="logo" />
                    <span>Google</span>
                </button>
                <button
                    class="btn w-full space-x-3 border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-50 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90">
                    <img class="h-5.5 w-5.5 " src="{{ asset('images/socials/telegram.png') }}" alt="logo" />
                    <span>Telegram</span>
                </button>
            </div>
            <div class="my-7 flex items-center space-x-3">
                <div class="h-px flex-1 bg-slate-200 dark:bg-navy-500"></div>
                <p class="text-tiny+ uppercase">Daftar dengan</p>

                <div class="h-px flex-1 bg-slate-200 dark:bg-navy-500"></div>
            </div>
            <form id="registerForm" class="mt-4" action="javascript:void(0);" method="post">
                @csrf
                <div class="space-y-4">
                    <!-- Input Nama -->
                    <div>
                        <div class="relative flex">
                            <input
                                class="form-input peer w-full rounded-lg bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
                                placeholder="Nama Lengkap" type="text" id="name" name="name" aria-describedby="nameError" />
                            <span
                                class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                <i class="fa-duotone fa-solid fa-user"></i>
                            </span>
                        </div>
                    </div>

                    <!-- Input Email -->
                    <div>
                        <div class="relative flex">
                            <input
                                class="form-input peer w-full rounded-lg bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
                                placeholder="Email" type="email" id="email" name="email" aria-describedby="emailError" />
                            <span
                                class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                <i class="fa-duotone fa-solid fa-envelope"></i>
                            </span>
                        </div>
                    </div>

                    <!-- Input Password -->
                    <div>
                        <div class="relative flex">
                            <input
                                class="form-input peer w-full rounded-lg bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
                                placeholder="Kata Sandi" type="password" id="password" name="password" aria-describedby="passwordError" />
                            <span
                                class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                <i class="fa-duotone fa-solid fa-key"></i>
                            </span>
                        </div>
                    </div>

                    <!-- Input Konfirmasi Password -->
                    <div>
                        <div class="relative flex">
                            <input
                                class="form-input peer w-full rounded-lg bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
                                placeholder="Konfirmasi Kata Sandi" type="password" id="password_confirmation"
                                name="password_confirmation" aria-describedby="passwordConfirmationError" />
                            <span
                                class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                <i class="fa-duotone fa-solid fa-key"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <button type="submit"
                    class="btn mt-10 h-10 w-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                    id="registerMail">
                    Daftar
                </button>
            </form>
            <div class="mt-4 text-center text-xs+">
                <p class="line-clamp-1">
                    <span>Sudah memiliki akun ? </span>
                    <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent-light dark:hover:text-accent"
                        href="{{ route('loginView') }}">Masuk</a>
                </p>
            </div>
        </div>
    </main>
</x-base-layout>
