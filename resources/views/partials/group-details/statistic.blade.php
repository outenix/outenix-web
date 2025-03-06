<main
    :style="$store.global.isDarkModeEnabled ? { backgroundImage: `url('{{asset('images/illustrations/ufo-bg-dark.svg')}}` } :
    { backgroundImage: `url('{{asset('images/illustrations/ufo-bg.svg')}}` }"
    class="grid w-full grow grid-cols-1 place-items-center bg-center">
    <div class="max-w-[26rem] text-center">
        <div class="w-full">
            <img class="w-full" x-show="!$store.global.isDarkModeEnabled" src="{{asset('images/illustrations/ufo.svg')}}"
                alt="image" />
            <img class="w-full" x-show="$store.global.isDarkModeEnabled" src="{{asset('images/illustrations/ufo-dark.svg')}}"
                alt="image" />
        </div>
        <p class="pt-4 text-xl font-semibold text-slate-800 dark:text-navy-50">
            Fitur Belum Tersedia
        </p>
        <p class="pt-2 text-slate-500 dark:text-navy-200">
            Nantikan fitur menarik dari outenix
        </p>
    </div>
</main>