<?php

namespace App\Providers;

use App\Models\Income;
use App\Models\WishList;
use Illuminate\Support\Facades\Auth;
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
        //
        view()->composer('*',function($count){
            if (Auth::check()) {
                $income = Income::where('user_id',auth()->user()->id)->count(); 
                $wish_list = WishList::where('user_id',auth()->user()->id)->count();
                $count->with('income_count', $income);
                $count->with('wish_list_count', $wish_list);
            }
        });
    }
}
