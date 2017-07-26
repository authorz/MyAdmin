<?php

    namespace App\Providers;

    use App\Libarary\Inter\CrumbInterface;

    use Illuminate\Support\Facades\View;
    use Illuminate\Support\ServiceProvider;

    class CrumbServiceProvider extends ServiceProvider
    {
        /**
         * Bootstrap the application services.
         *
         * @return void
         */
        public function boot(CrumbInterface $crumbInterface)
        {
            error_reporting(0);

            if ($crumbInterface->init()) {

                View::share('crumb', ['data' => $crumbInterface->index()]);

            }
        }

        /**
         * @desc 注册面包屑导航解析类
         */
        public function register()
        {
            $this->app->bind(
                'App\Libarary\Inter\CrumbInterface',
                'App\Libarary\Crumb\CrumbBasic'
            );
        }


    }
