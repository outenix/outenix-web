<x-app-layout title="Dashboard" is-header-blur="true">
    <!-- Main Content Wrapper -->
    <main class="main-content w-full pb-8">      
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
                    <div class="mt-1.5 flex items-center space-x-2">
                        <p class="text-slate-700 dark:text-navy-100">
                            Lihat Semua
                        </p>
                        <div class="flex h-7 w-7 items-center justify-center rounded-full bg-success/15 text-success">
                            <i class="fa-solid fa-right-long"></i>
                        </div>
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
                                    @if($user->user_is_premium)
                                        <i class="fa-solid fa-badge-check fa-shake text-success mr-1"></i>
                                    @endif
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
                                    @number_format_indonesia($user->group_count)  
                                </p>
                            </div>
                            <div>
                                <p class="text-xs+">Pesan</p>
                                <p class="text-x font-semibold text-slate-700 dark:text-navy-100">
                                    @number_format_indonesia($user->message_count)  
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
                    <div class="mt-1.5 flex items-center space-x-2">
                        <p class="text-slate-700 dark:text-navy-100">
                            Lihat Semua
                        </p>
                        <div class="flex h-7 w-7 items-center justify-center rounded-full bg-success/15 text-success">
                            <i class="fa-solid fa-right-long"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="is-scrollbar-hidden col-span-12 flex space-x-4 overflow-x-auto px-[var(--margin-x)] transition-all duration-[.25s] lg:col-span-9 lg:pl-0">
                @foreach ($topGroups as $index => $group)
                @php $groupPicture = $group->group_profile_picture ?? 'images/telegram/groups/default.jpg'; @endphp
                <div class="relative card w-72 shrink-0 space-y-3 rounded-xl p-4 sm:px-5 overflow-hidden">
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
                                <p class="text-[12px]">Peringkat</p>
                                <p class="text-x font-semibold text-slate-700 dark:text-navy-100">
                                    #{{ $index + 1 }}
                                </p>
                            </div>
                            <div>
                                <p class="text-[12px]">Anggota</p>
                                <p class="text-x font-semibold text-slate-700 dark:text-navy-100">
                                    @number_format_indonesia($group->group_member_count)                               
                                </p>
                            </div>
                            <div>
                                <p class="text-[12px]">Pesan</p>
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
                            <a href="{{ 'group/' . $group->group_id }}" class="btn h-7 w-7 bg-primary/10 p-0 text-primary hover:bg-primary/20 dark:text-white dark:bg-white/20">
                                <i class="fa-duotone fa-solid fa-eye"></i>
                            </a>
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
