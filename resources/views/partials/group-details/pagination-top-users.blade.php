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