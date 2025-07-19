<?php

namespace App\Providers;

use App\Models\Destination;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $domesticDestinations = Destination::where('type','domestic')->where('status',1)->where('is_featured',1)->get();
        $internationalDestinations = Destination::where('type','international')->where('status',1)->where('is_featured',1)->get();

        return View::share([
            'domesticDestinations' => $domesticDestinations,
            'internationalDestinations' => $internationalDestinations,
        ]);
    }
}
