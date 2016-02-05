<?php

namespace App\Providers;

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
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->resolving('payum.builder', function(\Payum\Core\PayumBuilder $payumBuilder) {
            $payumBuilder
                // this method registers filesystem storages, consider to change them to something more
                // sophisticated, like eloquent storage
                ->addDefaultStorages()

                ->addGateway('authorize_net', [
                    'factory' => 'authorize_net_aim',
                    'login_id' => '9q8HNPjd8M',
                    'transaction_key' => '7p75R2a3ZZ4Yx5zg',
                    'sandbox' => true
                ])
            ;
        });
    }
}
