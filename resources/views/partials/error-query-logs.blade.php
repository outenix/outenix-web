<div x-data="{ showModal: false, activeLog: null }">
    @foreach ($errorLogs as $log)
        <div 
            class="flex cursor-pointer flex-col rounded-t-lg border-b p-2.5 font-semibold text-slate-700 hover:bg-slate-100 dark:border-navy-500 dark:text-navy-100 dark:hover:bg-navy-600 sm:flex-row sm:items-center"
        >
            <div class="flex items-center justify-between">
                <div class="flex space-x-2 sm:w-72">
                    <div class="flex">
                        <label class="flex h-8 w-8 items-center justify-center" x-tooltip="'Select'">
                            <input 
                                type="checkbox" 
                                class="form-checkbox is-outline h-4.5 w-4.5 rounded border-slate-400/70 checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent"
                            />
                        </label>
                        <button 
                            @click="showModal = true; activeLog = {{ $log }}" 
                            x-tooltip="'Error Code'" 
                            class="btn hidden h-8 w-8 rounded-full p-0 text-slate-400 hover:bg-slate-300/20 dark:text-navy-300 dark:hover:bg-navy-300/20 sm:inline-flex"
                        >
                            <i class="fa-regular fa-code"></i>
                        </button>
                    </div>
                    <div class="flex items-center space-x-2">
                        <h3 class="line-clamp-1 text-info">#{{ $log->user_id }}</h3>
                    </div>
                </div>
                <div class="shrink-0 px-1 text-xs sm:hidden">
                    {{ $log->created_at->locale('id')->isoFormat('dddd, D MMM - H:mm') }}
                </div>
            </div>

            <div class="flex flex-1 items-center justify-between space-x-2">
                <div class="flex items-center space-x-2 px-2">
                    <span class="line-clamp-1">
                        {{ $log->error_title }} / {{ $log->error_at }}
                    </span>
                </div>
                <div class="flex sm:hidden">
                    <button 
                        @click="showModal = true; activeLog = {{ $log }}" 
                        x-tooltip="'Error Code'" 
                        class="btn h-8 w-8 rounded-full p-0 text-slate-400 hover:bg-slate-300/20 dark:text-navy-300"
                    >
                        <i class="fa-regular fa-code"></i>
                    </button>
                    <button 
                        x-tooltip="'Delete'" 
                        class="btn h-8 w-8 rounded-full p-0 text-slate-400 hover:bg-slate-300/20 dark:text-navy-300"
                    >
                        <i class="fa-solid fa-trash-xmark text-error"></i>
                    </button>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal -->
    <template x-if="showModal">
        <div 
            class="fixed inset-0 z-[100] flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5"
            x-show="showModal" 
            @keydown.window.escape="showModal = false"
        >
            <div 
                class="absolute inset-0 bg-slate-900/60 transition-opacity duration-300" 
                @click="showModal = false" 
                x-show="showModal"
            ></div>
            <div 
                class="relative w-full max-w-lg origin-bottom rounded-lg bg-white pb-4 transition-all duration-300 dark:bg-navy-700"
                x-show="showModal"
            >
                <div class="flex justify-between rounded-t-lg bg-slate-200 px-4 py-3 dark:bg-navy-800 sm:px-5">
                    <h3 class="text-base font-medium text-slate-700 dark:text-navy-100">
                        <template x-if="activeLog">
                            <span x-text="activeLog.error_title"></span>
                        </template>
                    </h3>
                    <button 
                        @click="showModal = false" 
                        class="btn -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 dark:hover:bg-navy-300/20"
                    >
                        <svg 
                            xmlns="http://www.w3.org/2000/svg" 
                            class="h-4.5 w-4.5" 
                            fill="none" 
                            viewBox="0 0 24 24" 
                            stroke="currentColor" 
                            stroke-width="2"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="is-scrollbar-hidden min-w-full overflow-x-auto p-3">
                    <textarea 
                        rows="4" 
                        class="form-textarea w-full resize-none rounded-lg bg-slate-150 p-2.5 placeholder:text-slate-400 dark:bg-navy-900"
                        x-text="activeLog ? activeLog.error_code : ''"
                    ></textarea>
                </div>
                <div class="text-center">
                    <button 
                        class="btn mt-4 border border-primary/30 bg-primary/10 font-medium text-primary hover:bg-primary/20 dark:border-accent-light/30 dark:bg-accent-light/10"
                    >
                        Show All
                    </button>
                </div>
            </div>
        </div>
    </template>
</div>
