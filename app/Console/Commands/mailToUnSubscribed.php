<?php

namespace App\Console\Commands;

use App\Http\Controllers\SubscriptionController;
use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class mailToUnSubscribed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mail-to-un-subscribed';

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

        $unSubUsers=DB::table('users')->where('subscribed', 0)->get();


        foreach ($unSubUsers as $user){
            Mail::to($user->email)->send(new WelcomeMail('You are missing out', 'Subscribe today to be notified when new articles are available'));

        }
        $this->info('The emails are sent successfully!');
    }
}
