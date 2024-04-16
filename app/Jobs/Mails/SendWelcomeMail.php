<?php

namespace App\Jobs\Mails;

use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendWelcomeMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected string $email;
    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        $this->email=$user->email;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $title = 'Welcome aboard  IB gazette';
        $body = 'Welcome to IB gazette you can subscribe to our newsletter if you want to be notified via email each time a new post is made!';
        Mail::to($this->email)->send(new WelcomeMail($title, $body));
    }

}
