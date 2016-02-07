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


         $this->app['payum.action.obtain_credit_card_application'] = $this->app->share(function($app) {
            return new \App\Action\ObtainCreditCardAction();
        });

        $this->app->resolving('payum.builder', function(\Payum\Core\PayumBuilder $payumBuilder) {
            $payumBuilder
                // this method registers filesystem storages, consider to change them to something more
                // sophisticated, like eloquent storage
                ->addDefaultStorages()
                ->setCoreGatewayFactoryConfig([
                    'payum.action.get_http_request' => 'payum.action.get_http_request',
                    'payum.action.obtain_credit_card' => 'payum.action.obtain_credit_card_application',
                ])
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
