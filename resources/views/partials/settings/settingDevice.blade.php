<div class="card">
  <div
    class="flex flex-col items-center space-y-4 border-b border-slate-200 p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5"
  >
    <h2
      class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100"
    >
      Perangkat Tertaut
    </h2>
    <div class="flex justify-center space-x-2">
      <div x-data="{showModal:false}">
        <button
            @click="showModal = true"
            class="btn min-w-[7rem] rounded-lg bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
        >
            Hapus Semua Perangkat
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
                class="relative max-w-lg rounded-lg bg-white px-4 py-10 text-center transition-opacity duration-300 dark:bg-navy-700 sm:px-5"
                x-show="showModal"
                x-transition:enter="ease-out"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                >
                <div class="avatar h-20 w-20">
                    <img
                    class="rounded-full"
                    src="{{ asset('images/browser/other.png') }}"
                    alt="avatar"
                    />
                    <div
                    class="absolute right-0 m-1 h-4 w-4 rounded-full border-2 border-white bg-primary dark:border-navy-700 dark:bg-accent"
                    ></div>
                </div>
                <div class="mt-4 px-4 sm:px-12">
                    <h3 class="text-lg text-slate-800 dark:text-navy-50">
                    Hapus Semua Perangkat
                    </h3>
                    <p class="mt-1 text-slate-500 dark:text-navy-200">
                    Apakah kamu yakin ingin menghapus perangkat semua perangkat ? akun kamu akan otomatis di keluarkan dari perangkat semua perangkat tersebut
                    </p>
                </div>
                <div class="my-4 mt-16 h-px bg-slate-200 dark:bg-navy-500"></div>

                <div class="space-x-3">
                    <button
                    @click="showModal = false"
                    class="btn min-w-[7rem] rounded-lg border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-50 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90"
                    >
                    Batalkan
                    </button>
                    <button
                        id="btn-cleardevice"
                        @click="showModal = false"
                        class="btn min-w-[7rem] rounded-lg bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                        Ya, Hapus Semua
                    </button>
                </div>
                </div>
            </div>
        </template>
      </div>
    </div>
  </div>
  <div class="p-4 sm:p-5">
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 sm:gap-5 lg:gap-6">
        @foreach ($devices as $device)
            <div x-data="{showModal:false, modalDeviceDelete:false}">
                <div class="card items-center justify-between lg:flex-row shadow dark:shadow">
                    <div class="flex flex-col items-center p-4 text-center sm:p-5 lg:flex-row lg:space-x-4 lg:text-left">
                        <div class="avatar h-18 w-18 lg:h-12 lg:w-12">
                        <img class="rounded-full" src="{{ asset('images/browser/' . strtolower($device->browser) . '.png') }}" width="100" alt="browser" />
                        </div>
                        <div class="mt-2 lg:mt-0">
                            <div class="flex items-center justify-center space-x-1">
                                <h4 class="text-base font-medium text-slate-700 line-clamp-1 dark:text-navy-100">
                                {{ $device->device_name }}
                                </h4>
                                @if($device->id === $currentDeviceId)
                                <button
                                    class="btn hidden h-6 rounded-lg px-2 text-xs font-medium text-success
                                    hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 
                                    dark:hover:bg-accent-light/20 dark:focus:bg-accent-light/20 dark:active:bg-accent-light/25 lg:inline-flex">
                                    <span class="relative flex h-3 w-3 items-center justify-center mx-auto">
                                        <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-success opacity-80"></span>
                                        <span class="inline-flex h-2 w-2 rounded-full bg-success"></span>
                                    </span>
                                    <span class="sr-only">Online</span>
                                </button>
                                @endif
                            </div>
                            <p class="text-xs+">{{ $device->browser }}</p>
                        </div>
                        @if($device->id === $currentDeviceId)
                            <button
                                class="btn mt-4 rounded-lg border border-slate-200 font-medium text-success 
                                hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 
                                dark:border-navy-500 dark:text-success dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90 lg:hidden">
                                <span class="relative -top-px -right-px flex h-3 w-3 items-center justify-center">
                                    <span
                                        class="absolute inline-flex h-full w-full animate-ping rounded-full bg-success opacity-80"></span>
                                    <span class="inline-flex h-2 w-2 rounded-full bg-success"></span>
                                </span>
                                <span class="px-2">Online</span>
                            </button>
                        @endif
                    </div>
                    <div x-data="usePopper({ placement: 'bottom-end', offset: 4 })" @click.outside="if(isShowPopper) isShowPopper = false"
                        class="absolute top-0 right-0 m-2 lg:static">
                        <button @click="showModal = true"
                            class="btn h-8 w-8 rounded-lg p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                            </svg>
                        </button>
                    </div>
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
                            class="relative max-w-sm rounded-lg bg-white px-4 pb-4 transition-all duration-300 dark:bg-navy-700 sm:px-5"
                            x-show="showModal"
                            x-transition:enter="easy-out"
                            x-transition:enter-start="opacity-0 [transform:translate3d(0,-1rem,0)]"
                            x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                            x-transition:leave="easy-in"
                            x-transition:leave-start="opacity-100 [transform:translate3d(0,0,0)]"
                            x-transition:leave-end="opacity-0 [transform:translate3d(0,-1rem,0)]"
                            >
                            <div class="my-3 flex h-8 items-center justify-between">
                                <h2
                                class="font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 lg:text-base"
                                >
                                {{ $device->device_name }} - {{ $device->ip_address }}
                                </h2>

                                <button
                                @click="showModal = !showModal"
                                class="btn -mr-1.5 h-7 w-7 rounded-lg p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
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
                                    />
                                </svg>
                                </button>
                            </div>
                            <p class="font-bold">
                                Detail Perangkat :
                            </p>
                            <div class="mt-5 space-y-2">
                                <div class="flex justify-between">
                                    <span class="font-semibold">IP Address</span>
                                    <span>{{ $device->ip_address }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-semibold">Nama Perangkat</span>
                                    <span>{{ $device->device_name }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-semibold">Browser</span>
                                    <span>{{ $device->browser }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-semibold">Perangkat</span>
                                    <span>{{ $device->device }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-semibold">Platform</span>
                                    <span>{{ $device->platform }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-semibold">Lokasi</span>
                                    <span>{{ $device->location }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-semibold">Sesi Masuk</span>
                                    <span>{{ $device->updated_at }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-semibold">Sesi Berakhir</span>
                                    <span>{{ $device->expired_at }}</span>
                                </div>
                            </div>
                            @if($device->id === $currentDeviceId)
                                <p class="mt-5 text-xs italic">
                                    Kamu tidak dapat menghapus perangkat yang sedang online
                                </p>
                            @endif
                            @if($device->id != $currentDeviceId)
                                <p class="mt-5 text-xs italic">
                                    Kamu dapat menonaktifkan akun kamu yang berada di perangkat lain untuk menjaga keamanan akun pada perangkat lain
                                </p>
                            @endif
                            @if($device->id != $currentDeviceId)
                                <div class="mt-5 text-right">
                                    <button
                                        @click="showModal = !showModal"
                                        class="btn h-8 rounded-lg text-xs+ font-medium text-slate-700 hover:bg-slate-300/20 active:bg-slate-300/25 dark:text-navy-100 dark:hover:bg-navy-300/20 dark:active:bg-navy-300/25"
                                    >
                                        Batalkan
                                    </button>
                                    <button
                                        @click="modalDeviceDelete = true, showModal = !showModal"
                                        class="btn h-8 rounded-lg bg-primary text-xs+ font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                                    >
                                        Hapus Perangkat
                                    </button>
                                    <template x-teleport="#x-teleport-target">
                                    <div
                                        class="fixed inset-0 z-[100] flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5"
                                        x-show="modalDeviceDelete"
                                        role="dialog"
                                        @keydown.window.escape="modalDeviceDelete = false"
                                    >
                                        <div
                                        class="absolute inset-0 bg-slate-900/60 backdrop-blur transition-opacity duration-300"
                                        @click="modalDeviceDelete = false"
                                        x-show="modalDeviceDelete"
                                        x-transition:enter="ease-out"
                                        x-transition:enter-start="opacity-0"
                                        x-transition:enter-end="opacity-100"
                                        x-transition:leave="ease-in"
                                        x-transition:leave-start="opacity-100"
                                        x-transition:leave-end="opacity-0"
                                        ></div>
                                        <div
                                        class="relative max-w-lg rounded-lg bg-white px-4 py-10 text-center transition-opacity duration-300 dark:bg-navy-700 sm:px-5"
                                        x-show="modalDeviceDelete"
                                        x-transition:enter="ease-out"
                                        x-transition:enter-start="opacity-0"
                                        x-transition:enter-end="opacity-100"
                                        x-transition:leave="ease-in"
                                        x-transition:leave-start="opacity-100"
                                        x-transition:leave-end="opacity-0"
                                        >
                                        <div class="avatar h-20 w-20">
                                            <img
                                            class="rounded-full"
                                            src="{{ asset('images/browser/' . strtolower($device->browser) . '.png') }}"
                                            alt="avatar"
                                            />
                                            <div
                                            class="absolute right-0 m-1 h-4 w-4 rounded-full border-2 border-white bg-primary dark:border-navy-700 dark:bg-accent"
                                            ></div>
                                        </div>
                                        <div class="mt-4 px-4 sm:px-12">
                                            <h3 class="text-lg text-slate-800 dark:text-navy-50">
                                            {{ $device->device_name }}
                                            </h3>
                                            <p class="mt-1 text-slate-500 dark:text-navy-200">
                                            Apakah kamu yakin ingin menghapus perangkat ini ? akun kamu akan otomatis di keluarkan dari perangkat tersebut
                                            </p>
                                        </div>
                                        <div class="my-4 mt-16 h-px bg-slate-200 dark:bg-navy-500"></div>

                                        <div class="space-x-3">
                                            <button
                                            @click="modalDeviceDelete = false"
                                            class="btn min-w-[7rem] rounded-lg border border-slate-300 font-medium text-slate-800 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-50 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90"
                                            >
                                            Batalkan
                                            </button>
                                            <button
                                                id="btn-deletedevice"
                                                data-device="{{ $device->cookie_token }}"
                                                @click="modalDeviceDelete = false"
                                                class="btn min-w-[7rem] rounded-lg bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                                Ya, Hapus Perangkat
                                            </button>
                                        </div>
                                        </div>
                                    </div>
                                    </template>
                                </div>
                            @endif
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        @endforeach
    </div>
  </div>