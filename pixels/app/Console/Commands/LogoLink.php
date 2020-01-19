<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class LogoLink extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logo:link';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a symbolic link from "public/logo" to "storage/app/logo"';

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
     * @return mixed
     */
    public function handle()
    {
        if (file_exists(public_path('logo'))) {
            return $this->error('The "public/logo" directory already exists.');
        }

        $this->laravel->make('files')->link(
            storage_path('app/logo'), public_path('logo')
        );

        $this->info('The [public/logo] directory has been linked.');
    }
}
