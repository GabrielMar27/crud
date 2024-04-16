<?php

namespace App\Jobs\Mails;

use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NewPostMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $post;
    protected $user;
    /**
     * Create a new job instance.
     */
    public function __construct($user,$post)
    {
        $this->user=$user;
        $this->post=$post;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $title = 'New Post:'.$this->post['title'];
        $body = 'Hello '.$this->user->name.' a new post was added come and check it out!';
        if(Mail::to($this->user->email)->send(new WelcomeMail($title, $body))){
            Log::info("Mail sent");
        }

    }
}
