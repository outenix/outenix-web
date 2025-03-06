<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Carbon\Carbon; 

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Mendapatkan waktu saat ini
        $currentTime = Carbon::now();

        // Menentukan salam berdasarkan waktu
        $greeting = '';

        if ($currentTime->hour < 12) {
            $greeting = 'Selamat Pagi';
        } elseif ($currentTime->hour < 18) {
            $greeting = 'Selamat Siang';
        } else {
            $greeting = 'Selamat Malam';
        }

        // Membagikan data greeting ke semua view
        View::share('greeting', $greeting);

        // Menambahkan direktif Blade untuk format angka
        Blade::directive('number_format_indonesia', function ($expression) {
            return "<?php echo \\App\\Utils\\NumberUtils::formatToIndonesianShort($expression); ?>";
        });

        // Menambahkan SidebarComposer jika diperlukan
        View::composer('*', 'App\Http\View\Composers\SidebarComposer');
    }
}
