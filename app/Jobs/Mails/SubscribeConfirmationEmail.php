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

class SubscribeConfirmationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected string $email;
    protected string $name;
    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        $this->email=$user->email;
        $this->name=$user->name;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $title = 'You have been subscribed to IB gazette';
        $body = 'Welcome to IB gazette '.$this->name.' thanks for subscribing to our newsletter!';
        Mail::to($this->email)->send(new WelcomeMail($title, $body));
    }
}
