<div class="card">
  <div
    class="flex flex-col items-center space-y-4 border-b border-slate-200 p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5"
  >
    <h2
      class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100"
    >
      Akun Pengguna
    </h2>
    <div class="flex justify-center space-x-2">
      <button
        id="btn-editaccount"
        class="btn min-w-[7rem] rounded-lg bg-primary font-xs text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
      >
        Simpan
      </button>
    </div>
  </div>
  <div class="p-4 sm:p-5">
    <div class="flex flex-col">
      <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
      <label class="block">
        <span>Paket Avatar </span>
        <span class="relative mt-1.5 flex">
          <input
            class="form-input peer w-full rounded-lg bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
            type="text"
            value="@if(isset($settingavatar)){{ ucwords($settingavatar->avatar_pack) }}@endif"
            disabled
          />
          <span
            class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"
          >
          <i class="fa-duotone fa-box-open text-base"></i>
          </span>
        </span>
      </label>
      <label class="block">
        <span>Avatar Tipe </span>
        <span class="relative mt-1.5 flex">
          <input
            class="form-input peer w-full rounded-lg bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
            type="text"
            value="@if(isset($settingavatar)){{ ucwords($settingavatar->avatar_type) }}@endif"
            disabled
          />
          <span
            class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"
          >
          <i class="fa-duotone fa-tags text-base"></i>
          </span>
        </span>
      </label>
      </div>
    </div>
    <div class="my-7 h-px bg-slate-200 dark:bg-navy-500"></div>
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
      <label class="block">
        <span>Username </span>
        <span class="relative mt-1.5 flex">
          <input
            id="usernameAccount"
            class="form-input peer w-full rounded-lg bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
            placeholder="Masukan username"
            type="text"
            value="@if(isset($settingaccount)){{ $settingaccount->username }}@endif"
          />
          <span
            class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"
          >
          <i class="fa-duotone fa-user text-base"></i>
          </span>
        </span>
      </label>
      <label class="block">
        <span>Nama Lengkap </span>
        <span class="relative mt-1.5 flex">
          <input
            id="nameAccount"
            class="form-input peer w-full rounded-lg bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
            placeholder="Masukan nama lengkap"
            type="text"
            value="@if(isset($settingaccount)){{ $settingaccount->name }}@endif"
          />
          <span
            class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"
          >
          <i class="fa-duotone fa-id-card text-base"></i>
          </span>
        </span>
      </label>
      <label class="block">
        <span>Alamat Email <i x-tooltip.on.click.warning="'Kamu tidak dapat memperbaharui Alamat Email'" class="fa-solid fa-circle-info text-warning px-2"></i></span>
        <span class="relative mt-1.5 flex">
          <input 
            class="form-input peer w-full rounded-lg bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
            placeholder="Masukan alamat email"
            type="text"
            value="@if(isset($account)){{ $account['auth_data']->email }}@endif"
            disabled
          />
          <span
            class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"
          >
          <i class="fa-duotone fa-envelope text-base"></i>
          </span>
        </span>
      </label>
      <label class="block">
        <span>Nomor Telepon</span>
        <span class="relative mt-1.5 flex">
          <input
            id="phoneAccount"
            class="form-input peer w-full rounded-lg bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
            placeholder="Masukan nomor telepon"
            type="text"
            value="@if(isset($settingaccount)){{ $settingaccount->phone }}@endif"
          />
          <span
            class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"
          >
          <i class="fa-duotone fa-phone text-base"></i>
          </span>
        </span>
      </label>
      <label class="block">
        <span>Jenis Kelamin</span>
        <span class="relative mt-1.5 flex">
          <select
            id="genderAccount"
            class="form-select peer w-full rounded-lg bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
          >
            <option value="male" {{ (isset($settingaccount) && $settingaccount->gender == 'male') ? 'selected' : '' }}>Laki Laki</option>
            <option value="female" {{ (isset($settingaccount) && $settingaccount->gender == 'female') ? 'selected' : '' }}>Perempuan</option>
            <option value="other" {{ (isset($settingaccount) && $settingaccount->gender == 'other') ? 'selected' : '' }}>Lainnya</option>
          </select>
          <span
            class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"
          >
          <i class="fa-duotone fa-venus-mars text-base"></i>
          </span>
        </span>
      </label>
      <label class="block">
        <span>Tanggal Lahir</span>
        <span class="relative mt-1.5 flex">
          <input
            id="birthdayAccount"
            x-init="$el._x_flatpickr = flatpickr($el)"
            class="form-input peer w-full rounded-lg bg-slate-150 px-3 py-2 pl-9 ring-primary/50 placeholder:text-slate-400 hover:bg-slate-200 focus:ring dark:bg-navy-900/90 dark:ring-accent/50 dark:placeholder:text-navy-300 dark:hover:bg-navy-900 dark:focus:bg-navy-900"
            placeholder="Masukan tanggal lahir"
            type="text"
            value="@if(isset($settingaccount)){{ $settingaccount->birthday }}@endif"
          />
          <span
            class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"
          >
          <i class="fa-duotone fa-cake-candles text-base"></i>
          </span>
        </span>
      </label>
    </div>
    <div class="my-7 h-px bg-slate-200 dark:bg-navy-500"></div>
    <div>
      <h3
        class="text-base font-medium text-slate-600 dark:text-navy-100"
      >
        Tautkan Akun
      </h3>
      <p class="text-xs+ text-slate-400 dark:text-navy-300">
        Kamu dapat menautkan akunmu dengan sosial media yang tersedia.
      </p>
      <div class="flex items-center justify-between pt-4">
        <div class="flex items-center space-x-4">
          <div class="h-8 w-8">
            <img src="{{asset('images/socials/google.png')}}" alt="logo" />
          </div>
          <p class="font-medium line-clamp-1">
            Google
          </p>
        </div>
        @if(isset($account) && isset($account['auth_data']->provider_id))
            @php
                // Pastikan provider_id adalah JSON valid
                $providerData = json_decode($account['auth_data']->provider_id, true);
            @endphp

            @if(is_array($providerData) && isset($providerData['google']))
                <!-- Tombol untuk 'google' -->
                <button
                    class="btn h-8 rounded-full border border-slate-200 px-3 text-xs+ font-medium text-success hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-500 dark:text-accent-light dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90"
                >
                    <i class="fa-solid fa-shield-check fa-lg text-success"></i>
                </button>
            @else
                <!-- Tombol untuk 'tautkan google' -->
                <button
                    id="btn-redirecttogoogle"
                    class="btn h-8 rounded-full border border-slate-200 px-3 text-xs+ font-medium text-primary hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-500 dark:text-accent-light dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90"
                >
                    Tautkan Google
                </button>
            @endif
        @endif
      </div>
    </div>
  </div>
</div>