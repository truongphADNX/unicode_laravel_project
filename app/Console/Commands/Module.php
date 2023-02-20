<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Module extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create module CLI';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');
        if(File::exists(base_path('modules/'.$name))){
            $this->error('Module already exists');
        }else {
            File::makeDirectory(base_path('modules/' . $name), 0755, true, true);

            //configs
            $configFolder = base_path('modules/' . $name . '/configs');
            if (!File::exists($configFolder)) {
                File::makeDirectory($configFolder, 0755, true, true);
            }

            //helpers
            $helperFolder = base_path('modules/' . $name . '/helpers');
            if (!File::exists($helperFolder)) {
                File::makeDirectory($helperFolder, 0755, true, true);
                $helperFile = base_path('modules/' . $name . '/helpers/function.php');
                if (!File::exists($helperFile)) {
                    File::put($helperFile, "<?php\n");
                }
            }

            //routes
            $routeFolder = base_path('modules/' . $name . '/routes');
            if (!File::exists($routeFolder)) {
                File::makeDirectory($routeFolder, 0755, true, true);
                $routeFile = base_path('modules/' . $name . '/routes/routes.php');
                if (!File::exists($routeFile)) {
                    $moduleRouteFile = app_path('Console/Commands/Templates/ModuleRoute.txt');
                    $moduleRouteContent = "";
                    if (File::exists($moduleRouteFile)) {
                        $moduleRouteContent = file_get_contents($moduleRouteFile);
                        $moduleRouteContent = str_replace('{module}',$name,$moduleRouteContent);
                        $moduleRouteContent = str_replace(['{prefix}', '{name}'],strtolower(ConvertNoun($name,true)),$moduleRouteContent);
                        $moduleRouteContent = str_replace('{argument}',strtolower(ConvertNoun($name)),$moduleRouteContent);
                    }
                    File::put($routeFile, $moduleRouteContent);
                }
            }
////////////////////////////////here////////////////////////////////////////////////////////////////

            //migrations
            $migrationFolder = base_path('modules/' . $name . '/migrations');
            if (!File::exists($migrationFolder)) {
                File::makeDirectory($migrationFolder, 0755, true, true);
            }

            //resources
            $resourceFolder = base_path('modules/' . $name . '/resources');
            if (!File::exists($resourceFolder)) {
                File::makeDirectory($resourceFolder, 0755, true, true);

                $langFolder = base_path('modules/' . $name . '/resources/lang');
                if (!File::exists($langFolder)) {
                    File::makeDirectory($langFolder, 0755, true, true);

                    //enFolder
                    $enFolder = base_path('modules/' . $name . '/resources/lang/en');
                    if (!File::exists($enFolder)) {
                        File::makeDirectory($enFolder, 0755, true, true);
                    }

                    //viFolder
                    $viFolder = base_path('modules/' . $name . '/resources/lang/vi');
                    if (!File::exists($viFolder)) {
                        File::makeDirectory($viFolder, 0755, true, true);
                    }
                }

                //viewsFolder
                $viewsFolder = base_path('modules/' . $name . '/resources/views');
                if (!File::exists($viewsFolder)) {
                    File::makeDirectory($viewsFolder, 0755, true, true);
                }

            }

            //src
            $srcFolder = base_path('modules/' . $name . '/src');
            if (!File::exists($srcFolder)) {
                File::makeDirectory($srcFolder, 0755, true, true);

                //commands
                $commandsFolder = base_path('modules/' . $name . '/src/Commands');
                if (!File::exists($commandsFolder)) {
                    File::makeDirectory($commandsFolder, 0755, true, true);
                }

                //Http
                $httpFolder = base_path('modules/' . $name . '/src/Http');
                if (!File::exists($httpFolder)) {
                    File::makeDirectory($httpFolder, 0755, true, true);

                    //Controllers
                    $controllersFolder = base_path('modules/' . $name . '/src/Http/Controllers');
                    if (!File::exists($controllersFolder)) {
                        File::makeDirectory($controllersFolder, 0755, true, true);

                        //classController
                        $controllerFile = base_path('modules/' . $name . '/src/Http/Controllers/' . $name . 'Controller.php');
                        if (!File::exists($controllerFile)) {
                            $moduleControllerFile = app_path('Console/Commands/Templates/ModuleController.txt');
                            $moduleControllerContent = "";
                            if (File::exists($moduleControllerFile)) {
                                $moduleControllerContent = file_get_contents($moduleControllerFile);
                                $moduleControllerContent = str_replace('{module}',$name, $moduleControllerContent);
                            }
                            File::put($controllerFile, $moduleControllerContent);
                        }
                    }

                    //Middlewares
                    $middlewaresFolder = base_path('modules/' . $name . '/src/Http/Middlewares');
                    if (!File::exists($middlewaresFolder)) {
                        File::makeDirectory($middlewaresFolder, 0755, true, true);

                        //class middlewares
                        $middwareFile = base_path('modules/'. $name .'/src/Http/Middlewares/'. $name .'Middleware.php');
                        if (!File::exists($middwareFile)) {
                            $moduleMiddwareFile = app_path('Console/Commands/Templates/ModuleMiddleware.txt');
                            $moduleMiddwareContent= "";
                            if (File::exists($moduleMiddwareFile)) {
                                $moduleMiddwareContent = file_get_contents($moduleMiddwareFile);
                                $moduleMiddwareContent = str_replace('{module}', $name, $moduleMiddwareContent);
                            }
                            File::put($middwareFile,$moduleMiddwareContent);
                        }
                    }
                }

                //Models
                $modelsFolder = base_path('modules/' . $name . '/src/Models');
                if (!File::exists($modelsFolder)) {
                    File::makeDirectory($modelsFolder, 0755, true, true);
                    $modelFile = base_path('modules/' . $name . '/src/Models/' . $name . '.php');
                    if (!File::exists($modelFile)) {
                        $moduleModelFile = app_path('Console/Commands/Templates/ModuleModels.txt');
                        $moduleModelContent = "";
                        if (File::exists($moduleModelFile)) {
                            $moduleModelContent = file_get_contents($moduleModelFile);
                            $moduleModelContent = str_replace('{module}', $name, $moduleModelContent);
                        }
                        File::put($modelFile, $moduleModelContent);
                    }
                }

                //create Repositories Folder
                $repositoriesFolder = base_path('modules/' . $name . '/src/Repositories');
                if (!File::exists($repositoriesFolder)) {
                    File::makeDirectory($repositoriesFolder, 0755, true, true);

                    //create file name-repositoryInterface
                    $repositoriesInterface = base_path('modules/' . $name . '/src/Repositories/'.$name.'RepositoryInterface.php');

                    //class module repository interface
                    if(!File::exists($repositoriesInterface)){
                        $moduleRepoInterfaceFile = app_path('/Console/Commands/Templates/ModuleRepositoryInterface.txt');
                        $moduleRepoInterfaceContent = "";
                        if (File::exists($moduleRepoInterfaceFile)) {
                            $moduleRepoInterfaceContent = file_get_contents($moduleRepoInterfaceFile);
                            $moduleRepoInterfaceContent = str_replace('{module}', $name, $moduleRepoInterfaceContent);
                        }
                        File::put($repositoriesInterface,$moduleRepoInterfaceContent);
                    }


                    //create file name-repository
                    $repositoriesInterface = base_path('modules/' . $name . '/src/Repositories/'.$name.'Repository.php');

                    if(!File::exists($repositoriesInterface)){
                        $moduleRepoFile = app_path('/Console/Commands/Templates/ModuleRepository.txt');
                        $moduleRepoContent = "";
                        if (File::exists($moduleRepoFile)) {
                            $moduleRepoContent = file_get_contents($moduleRepoFile);
                            $moduleRepoContent = str_replace('{module}', $name, $moduleRepoContent);
                        }
                        File::put($repositoriesInterface,$moduleRepoContent);
                    }
                }
            }

            $this->info('Module created successfully!');
        }
    }
}
