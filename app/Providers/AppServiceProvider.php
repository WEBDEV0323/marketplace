<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use App\Models\Size;
use App\Models\ProductSize;
use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('*', function ($view) 
        {   
            //delete_size_not_exits()
            
            // fi size me brand category and gender id 0 ho to delte kr do
               // $deletdProductsize = Size::query()->where('brand_id', '=', 0)->where('shop_category_id', '=', 0)->where('gender', '=', 0)->pluck('id');
                $deletdProductsize = Size::where(function ($query) {
                    $query->where('brand_id', '=', 0)
                          ->orWhere('shop_category_id', '=', 0)
                          ->orWhere('gender', '=', 0);
                })->pluck('id');
                // Size::query()->where('brand_id', '=', 0)->where('shop_category_id', '=', 0)->where('gender', '=', 0)->delete();
                Size::where(function ($query) {
                    $query->where('brand_id', '=', 0)
                        ->orWhere('shop_category_id', '=', 0)
                        ->orWhere('gender', '=', 0);
                })->delete();
                ProductSize::whereIn('size_id', $deletdProductsize)->delete();            
        });  
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
