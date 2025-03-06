<div class="pb-3" x-data="{ isSearchbarActive: false }"
    x-effect="$store.breakpoints.smAndUp && (isSearchbarActive = false)">
    <div x-show="!isSearchbarActive" class="flex items-center justify-between">
        <div>
            <div class="flex space-x-2">
                <p class="text-xl font-medium line-clamp-1 text-slate-800 dark:text-navy-50">
                    {{ $groupDetails->group_name }}
                </p>

                <div x-data="usePopper({ placement: 'bottom-start', offset: 4 })" @click.outside="if(isShowPopper) isShowPopper = false"
                    class="inline-flex">
                    <button x-ref="popperRef" @click="isShowPopper = !isShowPopper"
                        class="btn h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none"
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
                                        class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">
                                        Informasi</a>
                                </li>
                            </ul>
                            <div class="my-1 h-px bg-slate-150 dark:bg-navy-500"></div>
                            <ul>
                                <li>
                                    <a href="{{ $groupDetails->group_link }}" target="_blank"
                                        class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">
                                        Lihat Group</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex items-center space-x-2">
            <div class="flex space-x-1">
                <button @click="isSearchbarActive = true" x-tooltip="'Search'"
                    class="btn h-9 w-9 p-0 hover:bg-priamry-300/20 focus:bg-priamry-300/20 active:bg-primary dark:hover:bg-priamry-300/20 dark:focus:bg-priamry-300/20 dark:active:bg-primary">
                    <i class="fa-regular fa-magnifying-glass h-4 w-4"></i>
                </button>
                <button id="filterPage" data-filter="" x-tooltip="'Filter'"
                    class="btn h-9 w-9 p-0 hover:bg-priamry-300/20 focus:bg-priamry-300/20 active:bg-primary dark:hover:bg-priamry-300/20 dark:focus:bg-priamry-300/20 dark:active:bg-primary">
                    <i class="fa-regular fa-filter-list h-5 w-5"></i>
                </button>
                <button id="sortPage" data-sort="ASC" x-tooltip="'Sort'"
                    class="btn h-9 w-9 p-0 hover:bg-priamry-300/20 focus:bg-priamry-300/20 active:bg-primary dark:hover:bg-priamry-300/20 dark:focus:bg-priamry-300/20 dark:active:bg-primary">
                    <i class="fa-regular fa-arrow-up-small-big h-5 w-5"></i>
                </button>
            </div>
        </div>
    </div>

    <div x-show="isSearchbarActive">
        <div class="flex space-x-2">
            <label class="relative flex w-full">
                <input id="searchTopUsersGroup" data-search="all"
                    class="form-input peer h-9 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:z-10 hover:border-slate-400 focus:z-10 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                    placeholder="Pencarian ID / Nama / Username" type="text" />
                <span
                    class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5 transition-colors duration-200"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M3.316 13.781l.73-.171-.73.171zm0-5.457l.73.171-.73-.171zm15.473 0l.73-.171-.73.171zm0 5.457l.73.171-.73-.171zm-5.008 5.008l-.171-.73.171.73zm-5.457 0l-.171.73.171-.73zm0-15.473l-.171-.73.171.73zm5.457 0l.171-.73-.171.73zM20.47 21.53a.75.75 0 101.06-1.06l-1.06 1.06zM4.046 13.61a11.198 11.198 0 010-5.115l-1.46-.342a12.698 12.698 0 000 5.8l1.46-.343zm14.013-5.115a11.196 11.196 0 010 5.115l1.46.342a12.698 12.698 0 000-5.8l-1.46.343zm-4.45 9.564a11.196 11.196 0 01-5.114 0l-.342 1.46c1.907.448 3.892.448 5.8 0l-.343-1.46zM8.496 4.046a11.198 11.198 0 015.115 0l.342-1.46a12.698 12.698 0 00-5.8 0l.343 1.46zm0 14.013a5.97 5.97 0 01-4.45-4.45l-1.46.343a7.47 7.47 0 005.568 5.568l.342-1.46zm5.457 1.46a7.47 7.47 0 005.568-5.567l-1.46-.342a5.97 5.97 0 01-4.45 4.45l.342 1.46zM13.61 4.046a5.97 5.97 0 014.45 4.45l1.46-.343a7.47 7.47 0 00-5.568-5.567l-.342 1.46zm-5.457-1.46a7.47 7.47 0 00-5.567 5.567l1.46.342a5.97 5.97 0 014.45-4.45l-.343-1.46zm8.652 15.28l3.665 3.664 1.06-1.06-3.665-3.665-1.06 1.06z" />
                    </svg>
                </span>
            </label>
            <button @click="isSearchbarActive = false" x-tooltip="'Search'"
                class="btn h-9 w-9 shrink-0 p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
</div>
<div class="card px-4 py-4 p-6 bg-slate-150 dark:bg-navy-800">
    <!-- <div class="text-xs space-y-2 py-4">
        <ul class="list-disc pl-5">
            <li>Pesan dihitung hanya ketika bot @outenixbot berada dalam group tersebut</li>
            <li>Foto profile kamu tidak muncul? Ketikan perintah `/reloadme` di dalam group yang memiliki bot @outenixbot atau langsung ketikan perintah `/start` di dalam bot @outenixbot</li>
        </ul>
    </div> -->
    <div id="paginationContainer">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-5 lg:grid-cols-3 lg:gap-6">
            @foreach($topUsers as $index => $user)
            <div class="card flex-row justify-between space-x-2 p-4 sm:p-5 shadow-ms dark:shadow-ms relative">
                <div>
                    <div class="flex space-x-1 items-center mb-2 space-x-1">
                        <h4 class="text-base font-medium text-slate-700 line-clamp-1 dark:text-navy-100">
                            {{ $user->user_firstname }}{{ $user->user_lastname ? ' ' . $user->user_lastname : '' }}
                        </h4>
                        @if($user->user_is_premium)
                            <i class="fa-solid fa-badge-check fa-shake text-success h-3 w-3"></i>
                        @endif
                    </div>
                    <div class="flex items-center space-x-3 mb-2">
                        <!-- Badge untuk Index dengan ikon trofi emas -->
                        <div class="badge space-x-2 bg-slate-150 text-slate-800 dark:bg-navy-500 dark:text-navy-100">
                            <i class="fa-solid fa-trophy text-yellow-500"></i>
                            <span>#{{ $user->rank }}</span>
                        </div>

                        <!-- Badge untuk Message Count -->
                        <div class="badge space-x-2 bg-slate-150 text-slate-800 dark:bg-navy-500 dark:text-navy-100">
                            <i class="fa-solid fa-message text-slate-500"></i>
                            <span>@number_format_indonesia($user->message_count)</span>
                        </div>

                        <!-- Tombol untuk membuka modal -->
                        <div x-data="{ showModal: false }" class="relative">
                            <button 
                                @click="showModal = true"
                                class="badge space-x-2 bg-slate-150 text-slate-800 dark:bg-navy-500 dark:text-navy-100 cursor-pointer"
                            >
                                <i class="fa-solid fa-square-list text-slate-500"></i>
                            </button>

                            <template x-teleport="#x-teleport-target">
                                <div
                                    class="fixed inset-0 z-[100] flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5"
                                    x-show="showModal"
                                    role="dialog"
                                    @keydown.window.escape="showModal = false"
                                >
                                    <div
                                        class="absolute inset-0 bg-slate-900/60 backdrop-blur transition-opacity duration-300"
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
                                        class="relative max-w-sm rounded-lg bg-white px-4 pb-4 transition-all duration-300 dark:bg-navy-700 sm:px-5"
                                        x-show="showModal"
                                        x-transition:enter="ease-out"
                                        x-transition:enter-start="opacity-0 [transform:translate3d(0,-1rem,0)]"
                                        x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                                        x-transition:leave="ease-in"
                                        x-transition:leave-start="opacity-100 [transform:translate3d(0,0,0)]"
                                        x-transition:leave-end="opacity-0 [transform:translate3d(0,-1rem,0)]"
                                    >
                                        <div class="my-3 flex h-8 items-center justify-between">
                                            <h2 class="font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 lg:text-base">
                                                Detail Pesan
                                            </h2>

                                            <button
                                                @click="showModal = !showModal"
                                                class="btn -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>

                                        <p class="mb-2 text-xs flex flex-col">
                                            Dibawah adalah jenis pesan yang dikirimkan oleh : 
                                            <div class="space-x-1">
                                                {{ $user->user_firstname }}{{ $user->user_lastname ? ' ' . $user->user_lastname : '' }}
                                                @if($user->user_is_premium)
                                                    <i class="fa-solid fa-badge-check fa-shake text-success h-3 w-3"></i>
                                                @endif
                                            </div>
                                        </p>

                                        <div class="mt-4 mb-2 grid grid-cols-2 gap-5">
                                            <!-- Teks Checkbox with Icon -->
                                            <label class="inline-flex items-center space-x-2">
                                                <i class="fa-solid fa-font mr-2"></i>
                                                <span>@number_format_indonesia($user->message_text) Pesan</span>
                                            </label>

                                            <!-- Foto Checkbox with Icon -->
                                            <label class="inline-flex items-center space-x-2">
                                                <i class="fa-solid fa-image mr-2"></i>
                                                <span>@number_format_indonesia($user->message_photo) Pesan</span>
                                            </label>

                                            <!-- Video Checkbox with Icon -->
                                            <label class="inline-flex items-center space-x-2">
                                                <i class="fa-solid fa-video mr-2"></i>
                                                <span>@number_format_indonesia($user->message_video) Pesan</span>
                                            </label>

                                            <!-- Stiker Checkbox with Icon -->
                                            <label class="inline-flex items-center space-x-2">
                                                <i class="fa-solid fa-sticky-note mr-2"></i>
                                                <span>@number_format_indonesia($user->message_sticker) Pesan</span>
                                            </label>

                                            <!-- GIF Checkbox with Icon -->
                                            <label class="inline-flex items-center space-x-2">
                                                <i class="fa-solid fa-gif mr-2"></i>
                                                <span>@number_format_indonesia($user->message_gif) Pesan</span>
                                            </label>

                                            <!-- Lainnya Checkbox with Icon -->
                                            <label class="inline-flex items-center space-x-2">
                                                <i class="fa-solid fa-file-alt mr-2"></i>
                                                <span>@number_format_indonesia($user->message_other) Pesan</span>
                                            </label>
                                        </div>

                                        <div class="mt-4 py-3 text-xs italic">
                                            <i class="fa-light fa-clock"></i> Pesan Terakhir : {{ $user->last_message }}
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
                <div class="avatar h-10 w-10">
                    <img class="mask is-squircle" src="/{{ $user->user_profile_picture }}" alt="avatar" />
                    <div class="absolute right-0 -m-0.5 h-3 w-3 rounded-full border-2 border-white bg-primary dark:border-navy-700 dark:bg-accent"></div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="w-full my-2 mt-5 pt-3 flex justify-end">
            @php
                $currentPage = $topUsers->isNotEmpty() ? $topUsers->first()->page : 1;
                $totalPages = $topUsers->isNotEmpty() ? $topUsers->first()->totalPages : 1;

                // Hitung range halaman yang akan ditampilkan
                $range = 5;
                $startPage = max(1, $currentPage - floor($range / 2));
                $endPage = min($totalPages, $startPage + $range - 1);

                // Pastikan tetap menampilkan 5 halaman jika memungkinkan
                if ($endPage - $startPage + 1 < $range) {
                    $startPage = max(1, $endPage - $range + 1);
                }
            @endphp

            <ol id="btnPaginationContainer" class="pagination space-x-1.5" data-ispage="{{ $currentPage }}">
                <!-- Tombol Previous (disembunyikan di halaman pertama) -->
                @if ($currentPage > 1)
                    <li>
                        <button id="pagination-prev" data-page="{{ $currentPage - 1 }}"
                            class="flex h-8 w-8 items-center justify-center rounded-lg 
                            bg-white hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-300/80 
                            dark:bg-navy-500 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                            <i class="fa-solid fa-arrow-left-long"></i>
                        </button>
                    </li>
                @endif

                <!-- Nomor Halaman -->
                @for ($i = $startPage; $i <= $endPage; $i++)
                    <li>
                        <button id="pagination-page-{{ $i }}" data-page="{{ $i }}"
                            class="flex h-8 min-w-[2rem] items-center justify-center rounded-lg px-3 leading-tight transition-colors
                            {{ $i == $currentPage ? 'bg-primary text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90' : 'bg-white hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-300/80 dark:bg-navy-500 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90' }}"
                            {{ $i == $currentPage ? 'disabled' : '' }}>
                            {{ $i }}
                        </button>
                    </li>
                @endfor

                <!-- Tombol Next (disembunyikan di halaman terakhir) -->
                @if ($currentPage < $totalPages)
                    <li>
                        <button id="pagination-next" data-page="{{ $currentPage + 1 }}"
                            class="flex h-8 w-8 items-center justify-center rounded-lg 
                            bg-white hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-300/80 
                            dark:bg-navy-500 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                            <i class="fa-solid fa-arrow-right-long"></i>
                        </button>
                    </li>
                @endif
            </ol>
        </div>
    </div>
</div>