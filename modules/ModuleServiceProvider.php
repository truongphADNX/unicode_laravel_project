<?php

namespace Modules;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\User\src\Repositories\UserRepository;
use Modules\Course\src\Repositories\CourseRepository;
use Modules\Teacher\src\Repositories\TeacherRepository;
use Modules\User\src\Repositories\UserRepositoryInterface;
use Modules\Categories\src\Repositories\CategoriesRepository;
use Modules\Course\src\Repositories\CourseRepositoryInterface;
use Modules\Teacher\src\Repositories\TeacherRepositoryInterface;
use Modules\Categories\src\Repositories\CategoriesRepositoryInterface;

class ModuleServiceProvider extends ServiceProvider
{

    private $middlewares = [];

    private $commands = [];
    // get base name
    private function getModules()
    {
        $directories = array_map('basename', File::directories(__DIR__));
        return $directories;
    }
    public function boot()
    {
        $modules = $this->getModules();

        if (!empty($modules)) {
            foreach ($modules as $directory) {
                $this->registerModule($directory);
            }
        }
    }

    // dang ky Configuration
    private function registerConfig($directory)
    {
        $configPath = $directory . '/configs';
        if (File::exists(__DIR__ . '/' . $configPath)) {
            $configFiles = array_map('basename', File::allFiles(__DIR__ . '/' . $configPath));
            foreach ($configFiles as $config) {
                $alias = str_replace('.php', '', $config);
                $alias = basename($config, '.php');
                $this->mergeConfigFrom(__DIR__ . '/' . $configPath . '/' . $config, $alias);
            }
        }
    }

    // dang ky middleware
    private function registerMiddleware()
    {
        if (!empty($this->middlewares)) {
            foreach ($this->middlewares as $key => $middleware) {
                $this->app['router']->pushMiddlewareToGroup($key, $middleware);
            }
        }
    }

    private function registerCommand()
    {
    }

    private function bindingRepository()
    {
        //biding category
        $this->app->singleton(
            CategoriesRepositoryInterface::class,
            CategoriesRepository::class,
        );

        //biding course
        $this->app->singleton(
            CourseRepositoryInterface::class,
            CourseRepository::class,
        );

        //biding teacher
        $this->app->singleton(
            TeacherRepositoryInterface::class,
            TeacherRepository::class,
        );

        //biding User
        $this->app->singleton(
            UserRepositoryInterface::class,
            UserRepository::class,
        );
    }

    public function register()
    {
        $modules = $this->getModules();
        //configs
        if (!empty($modules)) {
            foreach ($modules as $module) {
                $this->registerConfig($module);
            }
        }

        //middleware
        $this->registerMiddleware();

        //khai bao commands
        $this->registerCommand();

        // khai bao binding repository
        $this->bindingRepository();
    }

    //khai bao module
    private function registerModule($module)
    {
        $modulePath = __DIR__ . '/' . $module . '/';

        //khai báo routes
        Route::group(['namespace' => "Modules\\{$module}\src\Http\Controllers", 'middleware' => 'web'], function () use ($modulePath) {
            if (File::exists($modulePath . '/routes/web.php')) {
                $this->loadRoutesFrom($modulePath . '/routes/web.php');
            }
        });

        Route::group(['namespace' => "Modules\\{$module}\src\Http\Controllers", 'middleware' => 'api', 'prefix' => 'api'], function () use ($modulePath) {
            if (File::exists($modulePath . '/routes/api.php')) {
                $this->loadRoutesFrom($modulePath . '/routes/api.php');
            }
        });

        //Khai báo Migrations
        if (File::exists($modulePath . 'migrations')) {
            $this->loadMigrationsFrom($modulePath . 'migrations');
        }

        //khai báo languages
        if (File::exists($modulePath . 'resources/lang')) {
            $this->loadTranslationsFrom($modulePath . 'resources/lang', strtolower($module));
            $this->loadJsonTranslationsFrom($modulePath . 'resources/lang');
        }

        //Khai báo views
        if (File::exists($modulePath . 'resources/views')) {
            $this->loadViewsFrom($modulePath . 'resources/views', strtolower($module));
        }
        //Khai báo helpers
        if (File::exists($modulePath . 'helpers')) {
            $helpers_dir = File::allFiles($modulePath . 'helpers');
            foreach ($helpers_dir as $key => $value) {
                $file = $value->getPathname();
                require $file;
            }
        }
    }
}