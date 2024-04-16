<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class nukeDates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:nuke-dates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ($this->confirm('Do you wish to continue?')) {
            Artisan::call('migrate:fresh');
                Artisan::call('db:seed');
                    $this->info('DB has been nukes');
        }else{
            $this->info('Action aborted');
        }
    }
}
