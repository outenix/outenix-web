<x-base-layout title="Mail Application" is-sidebar-open="true" is-header-blur="true" has-min-sidebar="true">
    <!-- Sidebar -->
    <div class="sidebar print:hidden">
        <!-- Main Sidebar -->
        <x-app-partials.main-sidebar></x-app-partials.main-sidebar>

        <!-- Sidebar Panel -->
        <div class="sidebar-panel">
            <div class="flex h-full grow flex-col bg-white pl-[var(--main-sidebar-width)] dark:bg-navy-750">
                <!-- Sidebar Panel Header -->
                <div class="flex h-18 w-full items-center justify-between pl-4 pr-1">
                    <div class="flex items-center">
                        <div class="avatar mr-3 hidden h-9 w-9 lg:flex">
                            <div class="is-initial rounded-full bg-warning/10 text-warning">
                                <i class="fa-solid fa-rectangle-history"></i>
                            </div>
                        </div>
                        <p class="text-lg font-medium tracking-wider text-slate-800 line-clamp-1 dark:text-navy-100">
                            Log Activity
                        </p>
                    </div>
                    <button @click="showModal = true"
                        class="btn h-7 w-7 rounded-full p-0 text-primary hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:text-accent-light/80 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25 xl:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button
            
            class="btn bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90"
            >
            Origin Top
            </button>
                </div>

                
        <div x-data="{showModal:false}">

            <template x-teleport="#x-teleport-target">
            <div
                class="fixed inset-0 z-[100] flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5"
                x-show="showModal"
                role="dialog"
                @keydown.window.escape="showModal = false"
            >
                <div
                class="absolute inset-0 bg-slate-900/60 transition-opacity duration-300"
                @click="showModal = false"
                x-show="showModal"
                x-transition:enter="ease-out"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                ></div>
                <div
                class="relative w-full max-w-lg origin-top rounded-lg bg-white transition-all duration-300 dark:bg-navy-700"
                x-show="showModal"
                x-transition:enter="easy-out"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="easy-in"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                >
                <div
                    class="flex justify-between rounded-t-lg bg-slate-200 px-4 py-3 dark:bg-navy-800 sm:px-5"
                >
                    <h3 class="text-base font-medium text-slate-700 dark:text-navy-100">
                    Edit Pin
                    </h3>
                    <button
                    @click="showModal = !showModal"
                    class="btn -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                    >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-4.5 w-4.5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18L18 6M6 6l12 12"
                        ></path>
                    </svg>
                    </button>
                </div>
                <div class="px-4 py-4 sm:px-5">
                    <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Assumenda incidunt
                    </p>
                    <div class="mt-4 space-y-4">
                    <label class="block">
                        <span>Choose category :</span>
                        <select
                        class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
                        >
                        <option>Laravel</option>
                        <option>Node JS</option>
                        <option>Django</option>
                        <option>Other</option>
                        </select>
                    </label>
                    <label class="block">
                        <span>Description:</span>
                        <textarea
                        rows="4"
                        placeholder=" Enter Text"
                        class="form-textarea mt-1.5 w-full resize-none rounded-lg border border-slate-300 bg-transparent p-2.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                        ></textarea>
                    </label>
                    <label class="block">
                        <span>Website Address:</span>
                        <input
                        class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                        placeholder="URL Address"
                        type="text"
                        />
                    </label>
                    <label class="inline-flex items-center space-x-2">
                        <input
                        class="form-switch is-outline h-5 w-10 rounded-full border border-slate-400/70 bg-transparent before:rounded-full before:bg-slate-300 checked:border-primary checked:before:bg-primary dark:border-navy-400 dark:before:bg-navy-300 dark:checked:border-accent dark:checked:before:bg-accent"
                        type="checkbox"
                        />
                        <span>Public pin</span>
                    </label>
                    <div class="space-x-2 text-right">
                        <button
                        @click="showModal = false"
                        class="btn min-w-[7rem] rounded-full border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-50 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90"
                        >
                        Cancel
                        </button>
                        <button
                        @click="showModal = false"
                        class="btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                        >
                        Apply
                        </button>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </template>
        </div>

                <!-- Sidebar Panel Body -->
                <div class="flex h-[calc(100%-4.5rem)] grow flex-col">
                    <div class="is-scrollbar-hidden grow overflow-y-auto">
                        <ul class="mt-4 space-y-1.5 px-2 font-inter text-xs+ font-medium">
                            <li>
                                <a class="group flex justify-between space-x-2 rounded-lg bg-primary/10 p-2 tracking-wide text-primary outline-none transition-all dark:bg-accent-light/10 dark:text-accent-light"
                                    href="#">
                                    <div class="flex items-center space-x-2">
                                        <i class="fa-duotone fa-solid fa-robot"></i>
                                        <span>Bot Aktif</span>
                                    </div>
                                    <span class="text-primary dark:text-accent-light">2</span>
                                </a>
                            </li>
                            <li>
                                <a class="group flex justify-between space-x-2 rounded-lg p-2 tracking-wide text-slate-800 outline-none transition-all hover:bg-slate-100 focus:bg-slate-100 dark:text-navy-100 dark:hover:bg-navy-600 dark:focus:bg-navy-600"
                                    href="#">
                                    <div class="flex items-center space-x-2">
                                        <i class="fa-duotone fa-solid fa-user-group"></i>
                                        <span class="text-slate-800 dark:text-navy-100">Groups</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="group flex justify-between space-x-2 rounded-lg p-2 tracking-wide text-slate-800 outline-none transition-all hover:bg-slate-100 focus:bg-slate-100 dark:text-navy-100 dark:hover:bg-navy-600 dark:focus:bg-navy-600"
                                    href="#">
                                    <div class="flex items-center space-x-2">
                                        <i class="fa-light fa-user"></i>

                                        <span class="text-slate-800 dark:text-navy-100">Draft</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="group flex justify-between space-x-2 rounded-lg p-2 tracking-wide text-slate-800 outline-none transition-all hover:bg-slate-100 focus:bg-slate-100 dark:text-navy-100 dark:hover:bg-navy-600 dark:focus:bg-navy-600"
                                    href="#">
                                    <div class="flex items-center space-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-4.5 w-4.5 text-slate-400 transition-colors group-hover:text-slate-500 group-focus:text-slate-500 dark:text-navy-300 dark:group-hover:text-navy-200 dark:group-focus:text-navy-200"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                        </svg>

                                        <span class="text-slate-800 dark:text-navy-100">Span</span>
                                    </div>
                                    <span class="text-primary dark:text-accent-light">4</span>
                                </a>
                            </li>
                            <li>
                                <a class="group flex justify-between space-x-2 rounded-lg p-2 tracking-wide text-error outline-none transition-all hover:bg-error/20 focus:bg-error/20"
                                    href="#">
                                    <div class="flex items-center space-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>

                                        <span>Trash</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <div class="my-3 mx-4 h-px bg-slate-200 dark:bg-navy-500"></div>

                        <div class="flex items-center justify-between px-4">
                            <span class="text-xs font-medium uppercase">Labels </span>
                            <div class="-mr-1.5 flex">
                                <button
                                    class="btn h-6 w-6 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </button>

                                <div x-data="usePopper({ placement: 'bottom-end', offset: 4 })" @click.outside="if(isShowPopper) isShowPopper = false"
                                    class="inline-flex">
                                    <button x-ref="popperRef" @click="isShowPopper = !isShowPopper"
                                        class="btn h-6 w-6 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                        </svg>
                                    </button>

                                    <div x-ref="popperRoot" class="popper-root" :class="isShowPopper && 'show'">
                                        <div
                                            class="popper-box rounded-md border border-slate-150 bg-white py-1.5 font-inter dark:border-navy-500 dark:bg-navy-700">
                                            <ul>
                                                <li>
                                                    <a href="#"
                                                        class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">Action</a>
                                                </li>
                                                <li>
                                                    <a href="#"
                                                        class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">Another
                                                        Action</a>
                                                </li>
                                                <li>
                                                    <a href="#"
                                                        class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">Something
                                                        else</a>
                                                </li>
                                            </ul>
                                            <div class="my-1 h-px bg-slate-150 dark:bg-navy-500"></div>
                                            <ul>
                                                <li>
                                                    <a href="#"
                                                        class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">Separated
                                                        Link</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <ul class="mt-1 space-y-1.5 px-2 font-inter text-xs+ font-medium">
                            <li>
                                <a class="group flex space-x-2 rounded-lg p-2 tracking-wide text-slate-800 outline-none transition-all hover:bg-slate-100 focus:bg-slate-100 dark:text-navy-100 dark:hover:bg-navy-600 dark:focus:bg-navy-600"
                                    href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4.5 w-4.5 text-slate-400 transition-colors group-hover:text-slate-500 group-focus:text-slate-500 dark:text-navy-300 dark:group-hover:text-navy-200 dark:group-focus:text-navy-200"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                    <span class="text-slate-800 dark:text-navy-100">Important</span>
                                </a>
                            </li>
                            <li>
                                <a class="group flex space-x-2 rounded-lg p-2 tracking-wide text-slate-800 outline-none transition-all hover:bg-slate-100 focus:bg-slate-100 dark:text-navy-100 dark:hover:bg-navy-600 dark:focus:bg-navy-600"
                                    href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4.5 w-4.5 text-slate-400 transition-colors group-hover:text-slate-500 group-focus:text-slate-500 dark:text-navy-300 dark:group-hover:text-navy-200 dark:group-focus:text-navy-200"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                    </svg>
                                    <span class="text-slate-800 dark:text-navy-100">Saved</span>
                                </a>
                            </li>
                            <li>
                                <a class="group flex space-x-2 rounded-lg p-2 tracking-wide text-slate-800 outline-none transition-all hover:bg-slate-100 focus:bg-slate-100 dark:text-navy-100 dark:hover:bg-navy-600 dark:focus:bg-navy-600"
                                    href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4.5 w-4.5 text-slate-400 transition-colors group-hover:text-slate-500 group-focus:text-slate-500 dark:text-navy-300 dark:group-hover:text-navy-200 dark:group-focus:text-navy-200"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                    </svg>
                                    <span class="text-slate-800 dark:text-navy-100">Archive</span>
                                </a>
                            </li>
                            <li>
                                <a class="group flex space-x-2 rounded-lg p-2 tracking-wide text-slate-800 outline-none transition-all hover:bg-slate-100 focus:bg-slate-100 dark:text-navy-100 dark:hover:bg-navy-600 dark:focus:bg-navy-600"
                                    href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4.5 w-4.5 text-secondary dark:text-secondary-light" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                    <span class="text-slate-800 dark:text-navy-100">Work</span>
                                </a>
                            </li>
                            <li>
                                <a class="group flex space-x-2 rounded-lg p-2 tracking-wide text-slate-800 outline-none transition-all hover:bg-slate-100 focus:bg-slate-100 dark:text-navy-100 dark:hover:bg-navy-600 dark:focus:bg-navy-600"
                                    href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5 text-info"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                    <span class="text-slate-800 dark:text-navy-100">Personal</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="flex flex-col p-4">
                        <div class="progress h-2 bg-slate-150 dark:bg-navy-500">
                            <div class="w-7/12 rounded-full bg-info"></div>
                        </div>
                        <div class="mt-2 flex items-center justify-between">
                            <p>
                                <span class="font-medium text-slate-600 dark:text-navy-100">35GB</span>
                                of 1TB
                            </p>
                            <a href="#"
                                class="text-xs+ font-medium text-primary outline-none transition-colors duration-300 hover:text-primary/70 focus:text-primary/70 dark:text-accent-light dark:hover:text-accent-light/70 dark:focus:text-accent-light/70">Upgrade</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Minimized Sidebar Panel -->
        <div class="sidebar-panel-min">
            <div class="flex h-full flex-col items-center bg-white dark:bg-navy-750">
                <div class="flex h-18 shrink-0 items-center justify-center">
                    <div
                        class="avatar flex h-10 w-10 rounded-full bg-primary/10 text-primary dark:bg-accent-light/10 dark:text-accent-light">
                        <div class="is-initial">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                xmlns="http://www.w3.org/2000/svg" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="flex h-[calc(100%-4.5rem)] grow flex-col">
                    <div class="is-scrollbar-hidden flex grow flex-col overflow-y-auto">
                        <ul class="mt-4 space-y-1">
                            <li>
                                <a href="#"
                                    class="btn h-10 w-10 p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5.5 w-5.5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="btn h-10 w-10 bg-primary/10 p-0 font-medium text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-accent-light/10 dark:text-accent-light dark:hover:bg-accent-light/20 dark:focus:bg-accent-light/20 dark:active:bg-accent-light/25">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5.5 w-5.5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20" />
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="btn h-10 w-10 p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5.5 w-5.5" fill="none"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="m8.625 3.37.353-.661-.353.661Zm10.49 5.602-.354.662.353-.662Zm-.005 6.082.352.662-.352-.662ZM8.626 20.632l-.352-.662.352.662Zm-4.461-4.08-.718-.216.718.216Zm-.007-9.107-.718.215.718-.215Zm4.713 5.323a.75.75 0 0 0 0-1.5v1.5Zm-.6-8.736 10.49 5.602.707-1.323-10.49-5.602-.707 1.323Zm10.487 10.36L8.274 19.97l.704 1.324 10.484-5.578-.704-1.324ZM4.883 16.768l1.364-4.534-1.437-.432-1.363 4.534 1.436.432Zm1.364-4.965-1.37-4.574-1.437.43 1.37 4.574 1.437-.43Zm-.719.965h3.343v-1.5H5.528v1.5Zm2.746 7.202c-.95.505-1.94.289-2.643-.353-.706-.646-1.091-1.708-.748-2.85l-1.436-.431c-.519 1.724.064 3.374 1.172 4.388 1.113 1.017 2.783 1.409 4.36.57l-.705-1.324ZM18.76 9.634c1.82.972 1.818 3.79-.003 4.758l.704 1.325c2.882-1.534 2.884-5.869.006-7.406l-.707 1.323ZM8.978 2.709c-1.575-.841-3.246-.453-4.36.564C3.507 4.285 2.922 5.935 3.44 7.66l1.437-.43c-.343-1.143.044-2.204.751-2.85.703-.64 1.694-.855 2.643-.348l.707-1.323Z" />
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="btn h-10 w-10 p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5.5 w-5.5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="btn h-10 w-10 p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5.5 w-5.5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="btn h-10 w-10 p-0 text-error hover:bg-error/20 focus:bg-error/20 active:bg-error/25">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5.5 w-5.5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </a>
                            </li>
                        </ul>
                        <div class="my-4 h-px bg-slate-200 dark:bg-navy-500"></div>
                        <ul class="space-y-1">
                            <li>
                                <a href="#"
                                    class="btn h-10 w-10 p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5.5 w-5.5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="btn h-10 w-10 p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5.5 w-5.5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="btn h-10 w-10 p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5.5 w-5.5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="btn h-10 w-10 p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5.5 w-5.5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="py-3">
                        <div x-data="usePopper({ placement: 'right-start', offset: 4 })" @click.outside="if(isShowPopper) isShowPopper = false"
                            class="inline-flex">
                            <button x-ref="popperRef" @click="isShowPopper = !isShowPopper"
                                class="btn h-10 w-10 rounded-full border border-slate-200 p-0 font-medium hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-500 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                </svg>
                            </button>

                            <template x-teleport="#x-teleport-target">
                                <div x-ref="popperRoot" class="popper-root" :class="isShowPopper && 'show'">
                                    <div
                                        class="popper-box rounded-md border border-slate-150 bg-white py-1.5 font-inter dark:border-navy-500 dark:bg-navy-700">
                                        <ul>
                                            <li>
                                                <a href="#"
                                                    class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">Action</a>
                                            </li>
                                            <li>
                                                <a href="#"
                                                    class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">Another
                                                    Action</a>
                                            </li>
                                            <li>
                                                <a href="#"
                                                    class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">Something
                                                    else</a>
                                            </li>
                                        </ul>
                                        <div class="my-1 h-px bg-slate-150 dark:bg-navy-500"></div>
                                        <ul>
                                            <li>
                                                <a href="#"
                                                    class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">Separated
                                                    Link</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- App Header -->
    <x-app-partials.header></x-app-partials.header>

    <!-- Mobile Searchbar -->
    <x-app-partials.mobile-searchbar></x-app-partials.mobile-searchbar>

    <!-- Main Content Wrapper -->
    <main class="main-content mail-app w-full px-[var(--margin-x)] pb-6">
    <div
            class="mt-4 grid grid-cols-12 gap-4 transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">
            <div class="card col-span-12 sm:col-span-6">
                <div class="mt-2 flex items-center justify-between space-x-1">
                    <div class="flex items-center px-2.5">
                        <label class="flex h-8 w-8 items-center justify-center" x-tooltip="'Select All'">
                            <input
                                class="form-checkbox is-basic h-5 w-5 rounded border-slate-400/70 checked:border-primary checked:bg-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:border-accent dark:checked:bg-accent dark:hover:border-accent dark:focus:border-accent"
                                type="checkbox" />
                        </label>
                        <div x-data="usePopper({ placement: 'bottom-end', offset: 4 })" @click.outside="if(isShowPopper) isShowPopper = false"
                            class="inline-flex">
                            <button x-ref="popperRef" @click="isShowPopper = !isShowPopper"
                                class="btn -mr-1.5 h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                </svg>
                            </button>

                            <div x-ref="popperRoot" class="popper-root" :class="isShowPopper && 'show'">
                                <div
                                    class="popper-box rounded-md border border-slate-150 bg-white py-1.5 font-inter dark:border-navy-500 dark:bg-navy-700">
                                    <ul>
                                        <li>
                                            <a href="#"
                                                class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">Action</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">Another
                                                Action</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">Something
                                                else</a>
                                        </li>
                                    </ul>
                                    <div class="my-1 h-px bg-slate-150 dark:bg-navy-500"></div>
                                    <ul>
                                        <li>
                                            <a href="#"
                                                class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">Separated
                                                Link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex px-3">
                        <button
                            class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div
                    class="flex cursor-pointer flex-col rounded-t-lg border-b p-2.5 font-semibold text-slate-700 hover:bg-slate-100 dark:border-navy-500 dark:text-navy-100 dark:hover:bg-navy-600 sm:flex-row sm:items-center">
                    <div class="flex items-center justify-between">
                        <div class="flex space-x-2 sm:w-72">
                            <div class="flex">
                                <label class="flex h-8 w-8 items-center justify-center" x-tooltip="'Select'">
                                    <input
                                        class="form-checkbox is-outline h-4.5 w-4.5 rounded border-slate-400/70 before:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:before:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent"
                                        type="checkbox" />
                                </label>
                            </div>
                            <div class="flex items-center space-x-2">
                                <h3 class="line-clamp-1">Konnor Guzman</h3>
                                <span class="h-2 w-2 shrink-0 rounded-full bg-secondary lg:hidden"></span>
                            </div>
                        </div>
                        <div class="shrink-0 px-1 text-xs sm:hidden">20 Des - 24:53</div>
                    </div>
                    <div class="hidden px-2 text-xs+ sm:flex">20 Des - 24:53</div>
                </div>
                <div
                    class="flex cursor-pointer flex-col rounded-b-lg p-2.5 hover:bg-slate-100 dark:hover:bg-navy-600 sm:flex-row sm:items-center">
                    <div class="flex items-center justify-between">
                        <div class="flex space-x-2 sm:w-72">
                            <div class="flex">
                                <label class="flex h-8 w-8 items-center justify-center" x-tooltip="'Select'">
                                    <input
                                        class="form-checkbox is-outline h-4.5 w-4.5 rounded border-slate-400/70 before:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:before:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent"
                                        type="checkbox" />
                                </label>
                            </div>
                            <div class="flex items-center space-x-2">
                                <h3 class="line-clamp-1">Konnor Guzman</h3>
                                <span class="h-2 w-2 shrink-0 rounded-full bg-secondary lg:hidden"></span>
                            </div>
                        </div>
                        <div class="shrink-0 px-1 text-xs sm:hidden">20 Des - 24:53</div>
                    </div>
                    <div class="hidden px-2 text-xs+ sm:flex">20 Des - 24:53</div>
                </div>
            </div>
            <div class="card col-span-12 sm:col-span-6">
            <label class="block">
                <textarea
                rows="4"
                placeholder=" Enter Text"
                class="form-textarea w-full resize-none rounded-lg bg-slate-150 p-2.5 placeholder:text-slate-400 dark:bg-navy-900 dark:placeholder:text-navy-300"
                ></textarea>
            </label>
            </div>
        </div>
        <div class="mt-4 flex flex-col space-y-1 px-5 text-xs sm:flex-row sm:justify-between sm:space-y-0">
            <a href="#" class="hover:text-slate-700 hover:underline dark:hover:text-navy-100">Term &amp;
                Privacy</a>
            <p>Last activity: 3 minute ago</p>
        </div>
    </main>

    <div class="fixed right-3 bottom-3 rounded-full bg-white dark:bg-navy-700">
        <button
            class="btn h-14 w-14 rounded-full bg-warning p-0 font-medium text-white hover:bg-warning-focus focus:bg-warning-focus active:bg-warning-focus/90 sm:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
            </svg>
        </button>
    </div>
</x-base-layout>
