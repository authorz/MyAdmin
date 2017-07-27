<?php
    namespace App\Module\<{{moduleName}}>;

    use Illuminate\Support\ServiceProvider;

    class <{{moduleName}}>ServiceProvider extends ServiceProvider
    {
        public function boot()
        {
            $this->registerMigrations();
        }

        protected function registerMigrations()
        {
            $this->loadMigrationsFrom(__DIR__ . '/Database/migrations');
        }

    }