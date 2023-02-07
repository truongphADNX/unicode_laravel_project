<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Repository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository';

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
        //create RepositoriesFolder
        $repoFolder = base_path('app/Repositories');
        if (!File::exists($repoFolder)) {
            File::makeDirectory($repoFolder, 0755, true, true);

            //create RepositoryInterface
            $repositoryInterface = base_path('app/Repositories/RepositoryInterface.php');
            if (!File::exists($repositoryInterface)) {
                $repoInterfaceFile = app_path('Console/Commands/Templates/RepositoryInterface.txt');
                $repoInterfaceContent = "";
                if (File::exists($repoInterfaceFile)) {
                    $repoInterfaceContent = file_get_contents($repoInterfaceFile);
                }
                File::put($repositoryInterface,$repoInterfaceContent);
            }

            //Create BaseRepository
            $baseRepository = base_path('app/Repositories/BaseRepository.php');
            if (!File::exists($baseRepository)) {
                $baseRepoFile = app_path('Console/Commands/Templates/BaseRepository.txt');
                $baseRepoContent = "";
                if (File::exists($baseRepoFile)) {
                    $baseRepoContent = file_get_contents($baseRepoFile);
                }
                File::put($baseRepository,$baseRepoContent);
            }


            $this->info('Repositories created successfully!');
        }else{
            $this->error('Repositories already exists');
        }
    }
}
