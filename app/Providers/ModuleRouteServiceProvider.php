<?php

    namespace App\Providers;

    use Illuminate\Support\Facades\Route;
    use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;


    class ModuleRouteServiceProvider extends ServiceProvider
    {
        /**
         * This namespace is applied to your controller routes.
         *
         * In addition, it is set as the URL generator's root namespace.
         *
         * @var string
         */
        protected $namespace = 'App\Module';

        /**
         * Define your route model bindings, pattern filters, etc.
         *
         * @return void
         */
        public function boot()
        {
            //
            parent::boot();
        }

        /**
         * Define the routes for the application.
         *
         * @return void
         */
        public function map()
        {
            $this->mapModuleRoutes();

            //
        }

        /**
         * Define the "module" routes for the application.
         *
         * These routes all receive session state, CSRF protection, etc.
         *
         * @return void
         */
        protected function mapModuleRoutes()
        {
            Route::middleware('module')
                ->namespace($this->namespace)
                ->group(base_path('routes/module.php'));
        }


    }
