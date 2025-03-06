<x-app-layout title="Dashboard" is-header-blur="true">
    <!-- Main Content Wrapper -->
    <main class="main-content w-full pb-8">
        <div class="mt-4 grid grid-cols-12 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">
            <div class="card col-span-12 lg:col-span-8 mt-12 bg-gradient-to-br from-indigo-500 to-blue-600 p-5 sm:mt-0 sm:flex-row">
                <div class="flex justify-center sm:order-last">
                    <img class="-mt-16 h-40 sm:mt-0" src="{{ asset('images/illustrations/paper-plane.svg') }}"
                        alt="image" />
                </div>
                <div class="mt-2 flex-1 pt-2 text-center text-white sm:mt-0 sm:text-left">
                    <h3 class="text-xl line-clamp-1 ">
                        {{ $greeting }}, 
                        @if($account) 
                            <span class="font-semibold">{{ ucwords($account['account_data']->name) }}</span>
                        @endif
                    </h3>
                    <p class="mt-2 leading-relaxed">outenix adalah platform pendukung <span class="font-semibold">Telegram</span>, untuk memudahkan kamu dalam berinteraksi dengan telegram, hubungankan akun telegram kamu dengan <span class="font-semibold">outenix</span>.</p>

                    <button
                        class="btn mt-6 space-x-3 bg-slate-50 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80">
                        <img class="h-5.5 w-5.5" src="{{ asset('images/socials/telegram.png') }}" alt="logo" />
                        <span>Hubungkan Telegram</span>
                    </button>
                </div>
            </div>
            <div class="card col-span-12 lg:col-span-4 mt-4 bg-gradient-to-br from-blue-500 to-indigo-600 px-4 pb-5 sm:px-5 lg:mt-0">
                <div class="mt-3 flex items-center justify-between text-white">
                    <h2 class="text-sm+ font-medium tracking-wide">Dompet Saya</h2>
                    <div x-data="usePopper({ placement: 'bottom-end', offset: 4 })" @click.outside="if(isShowPopper) isShowPopper = false"
                        class="inline-flex">
                        <button x-ref="popperRef" @click="isShowPopper = !isShowPopper"
                            class="btn -mr-1.5 h-8 w-8 rounded-full p-0 hover:bg-white/20 focus:bg-white/20 active:bg-white/25">
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
                <div class="flex w-9/12 items-center space-x-1 mt-2">
                    <p class="text-xs text-indigo-100 line-clamp-1">
                        @if($wallet)
                            {{ $wallet->wallet_id }}
                        @endif
                    </p>
                    <button
                        class="btn h-5 w-5 shrink-0 rounded-full p-0 text-white hover:bg-white/20 focus:bg-white/20 active:bg-white/25">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path d="M7 9a2 2 0 012-2h6a2 2 0 012 2v6a2 2 0 01-2 2H9a2 2 0 01-2-2V9z" />
                            <path d="M5 3a2 2 0 00-2 2v6a2 2 0 002 2V5h8a2 2 0 00-2-2H5z" />
                        </svg>
                    </button>
                </div>
                <div class="mt-4 text-3xl font-semibold text-white">
                    @if($wallet)
                        Rp {{ number_format($wallet->balance, 0, ',', '.') }}
                    @endif
                </div>
                <div class="flex items-center justify-between mt-6 space-x-4">
                    <button class="btn space-x-2 w-full border border-white/10 bg-white/20 text-white hover:bg-white/30 focus:bg-white/30">
                        <span>Topup</span>
                        
                        <i class="fa-duotone fa-solid fa-plus"></i>
                    </button>
                    <button class="btn space-x-2 w-full border border-white/10 bg-white/20 text-white hover:bg-white/30 focus:bg-white/30">
                        <span>Kirim</span>
                        <i class="fa-duotone fa-solid fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="mt-4 grid grid-cols-12 gap-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">       
            <div class="col-span-12 sm:col-span-12">
                <div class="grid grid-cols-2 gap-4 sm:order-first sm:grid-cols-4 sm:gap-5 lg:gap-6">
                    <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
                        <div class="flex justify-between space-x-1">
                            <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                                125
                            </p>
                            <i class="fa-duotone fa-solid fa-user-group text-primary"></i>
                        </div>
                        <p class="mt-1 text-xs+">Groups</p>
                    </div>
                    <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
                        <div class="flex justify-between">
                            <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                                64
                            </p>
                            <i class="fa-duotone fa-solid fa-bullhorn text-success"></i>
                        </div>
                        <p class="mt-1 text-xs+">Channels</p>
                    </div>
                    <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
                        <div class="flex justify-between">
                            <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                                42
                            </p>
                            <i class="fa-duotone fa-solid fa-robot text-warning"></i>
                        </div>
                        <p class="mt-1 text-xs+">Bots</p>
                    </div>
                    <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
                        <div class="flex justify-between">
                            <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                                2
                            </p>
                            <i class="fa-duotone fa-solid fa-calendar-days text-info"></i>
                        </div>
                        <p class="mt-1 text-xs+">Events</p>
                    </div>                    
                </div>
            </div>                       
        </div>
        <div class="mt-4 grid grid-cols-12 gap-4 bg-slate-150 py-5 dark:bg-navy-800 sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">
            <div
                class="col-span-12 flex flex-col px-[var(--margin-x)] transition-all duration-[.25s] lg:col-span-3 lg:pr-0">
                <h2
                    class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 lg:text-xl">
                    Top Users #20
                </h2>

                <p class="mt-3 grow">
                    20 Pengguna Telegram teratas
                </p>

                <div class="mt-4">
                    <p>Sales Growth</p>
                    <div class="mt-1.5 flex items-center space-x-2">
                        <div class="flex h-7 w-7 items-center justify-center rounded-full bg-success/15 text-success">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 11l5-5m0 0l5 5m-5-5v12" />
                            </svg>
                        </div>
                        <p class="text-base font-medium text-slate-700 dark:text-navy-100">
                            $2,225.22
                        </p>
                    </div>
                </div>
            </div>
            <div
                class="is-scrollbar-hidden col-span-12 flex space-x-4 overflow-x-auto px-[var(--margin-x)] transition-all duration-[.25s] lg:col-span-9 lg:pl-0">
                @foreach ($topMessages as $index => $user)
                @php
                    $profilePicture = $user->user_profile_picture ?? 'images/100x100.png';
                    $fullName = trim("{$user->user_firstname} {$user->user_lastname}") ?: 'Tanpa Nama';
                @endphp

                <div class="relative card w-72 shrink-0 space-y-5 rounded-xl p-4 sm:px-5 overflow-hidden">             
                    <!-- Background Gambar dengan Opacity 10 -->
                    <div class="absolute top-0 left-0 w-full h-3/4 rounded-t-xl overflow-hidden">
                        <div class="w-full h-full bg-cover bg-center opacity-10 brightness-75 contrast-100"
                            style="background-image: url('{{ asset($profilePicture) }}');">
                        </div>
                    </div>

                    <!-- Konten Utama -->
                    <div class="relative z-10">
                        <div class="flex items-center justify-between space-x-2">
                            <div class="flex items-center space-x-3">
                                <div class="avatar">
                                    <img class="mask is-squircle" src="{{ asset($profilePicture) }}"
                                        alt="{{ $fullName }}" />
                                </div>
                                <div>
                                    <p class="font-medium text-slate-700 line-clamp-1 dark:text-navy-100">
                                        {{ $fullName }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-3 bg-white/50 backdrop-blur rounded-lg shadow-sm dark:bg-white/10">
                        <div class="grid grid-cols-3 text-center">
                            <div>
                                <p class="text-xs+">Peringkat</p>
                                <p class="text-x font-semibold text-slate-700 dark:text-navy-100">
                                    #{{ $index + 1 }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs+">Group</p>
                                <p class="text-x font-semibold text-slate-700 dark:text-navy-100">
                                    {{ $user->group_count }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs+">Pesan</p>
                                <p class="text-x font-semibold text-slate-700 dark:text-navy-100">
                                    {{ $user->message_count }}     
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @if(isset($topGroups) && $topGroups->isNotEmpty())
        <div class="mt-4 grid grid-cols-12 gap-4 bg-slate-150 py-5 dark:bg-navy-800 sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">
            <div
                class="col-span-12 flex flex-col px-[var(--margin-x)] transition-all duration-[.25s] lg:col-span-3 lg:pr-0">
                <h2
                    class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 lg:text-xl">
                    Top Groups #20
                </h2>

                <p class="mt-3 grow">
                    20 Group Telegram teratas
                </p>

                <div class="mt-4">
                    <p>Sales Growth</p>
                    <div class="mt-1.5 flex items-center space-x-2">
                        <div class="flex h-7 w-7 items-center justify-center rounded-full bg-success/15 text-success">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 11l5-5m0 0l5 5m-5-5v12" />
                            </svg>
                        </div>
                        <p class="text-base font-medium text-slate-700 dark:text-navy-100">
                            $2,225.22
                        </p>
                    </div>
                </div>
            </div>
            <div
                class="is-scrollbar-hidden col-span-12 flex space-x-4 overflow-x-auto px-[var(--margin-x)] transition-all duration-[.25s] lg:col-span-9 lg:pl-0">
                @foreach ($topGroups as $index => $group)
                @php $groupPicture = $group->group_profile_picture ?? 'images/telegram/groups/default.jpg'; @endphp
                <div class="relative card w-72 shrink-0 space-y-5 rounded-xl p-4 sm:px-5 overflow-hidden">
                    <!-- Background Gambar dengan Opacity 10 -->
                    <div class="absolute top-0 left-0 w-full h-2/4 rounded-t-xl overflow-hidden">
                        <div class="w-full h-full bg-cover bg-center opacity-10 brightness-75 contrast-100"
                            style="background-image: url('{{ asset($groupPicture) }}');">
                        </div>
                    </div>

                    <!-- Konten Utama -->
                    <div class="relative z-10">
                        <div class="flex items-center justify-between space-x-2">
                                <div class="flex items-center space-x-3"><div class="avatar">
                                    <img class="mask is-squircle" 
                                        src="{{ asset($groupPicture) }}" 
                                        alt="{{ $group->group_name }}" />
                                </div>
                                <div>
                                    <p class="font-medium text-slate-700 line-clamp-1 dark:text-navy-100">
                                        {{ $group->group_name }}
                                    </p>
                                    <p class="text-xs text-slate-400 dark:text-navy-300">
                                        {{ ucwords($group->group_type) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statistik Grup di Luar Background -->
                    <div class="p-3 bg-white/50 backdrop-blur rounded-lg shadow-sm dark:bg-white/10">
                        <div class="grid grid-cols-3 text-center">
                            <div>
                                <p class="text-xs+">Peringkat</p>
                                <p class="text-x     font-semibold text-slate-700 dark:text-navy-100">
                                    #{{ $index + 1 }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs+">Anggota</p>
                                <p class="text-x font-semibold text-slate-700 dark:text-navy-100">
                                    @number_format_indonesia($group->group_member_count)                               
                                </p>
                            </div>
                            <div>
                                <p class="text-xs+">Pesan</p>
                                <p class="text-x font-semibold text-slate-700 dark:text-navy-100">
                                    @number_format_indonesia($group->group_chat_count)        
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Ikon dan Tombol -->
                    <div class="flex justify-between mt-4">
                        <!-- Award -->
                        <div class="flex space-x-2">
                            @if ($index === 0)
                                <img x-tooltip="'Peringkat #1'" class="h-6 w-6"
                                    src="{{ asset('images/awards/award-1.svg') }}" alt="Peringkat #1" />
                            @elseif ($index === 1)
                                <img x-tooltip="'Peringkat #2'" class="h-6 w-6"
                                    src="{{ asset('images/awards/award-2.svg') }}" alt="Peringkat #2" />
                            @elseif ($index === 2)
                                <img x-tooltip="'Peringkat #3'" class="h-6 w-6"
                                    src="{{ asset('images/awards/award-3.svg') }}" alt="Peringkat #3" />
                            @endif
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex space-x-2">
                            <button class="btn h-7 w-7 bg-primary/10 p-0 text-primary hover:bg-primary/20 dark:text-white dark:bg-white/20">
                                <i class="fa-duotone fa-solid fa-eye"></i>
                            </button>
                            <a href="{{ $group->group_link }}" target="_blank"
                            class="btn h-7 w-7 bg-primary/10 p-0 text-primary hover:bg-primary/20 dark:text-white dark:bg-white/20">
                                <i class="fa-solid fa-share"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        
    </main>
</x-app-layout>
