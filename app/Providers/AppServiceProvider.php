<?php

namespace App\Providers;

use App\Order;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // For MySQL Error for index key length
        Schema::defaultStringLength(191);

        Order::created(function ($order) {
            if ($order->payment_method=='COD') {
                $user = \Auth::user();
                \Mail::send('mails.order-placed', compact('user', 'orders', 'payment_reference'), function ($message) use ($user) {
                    $message->to($user->email, $user->name)->bcc(['sales@gbmart.in'])
                        ->subject('Order Placed!');
                });
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
