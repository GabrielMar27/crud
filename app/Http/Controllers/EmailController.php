<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;


class EmailController extends Controller
{

    public static function sendWelcomeEmail(User $user)
    {

        $title = 'Welcome aboard  IB gazette';
        $body = 'Welcome to IB gazette you can subscribe to our newsletter if you want to be notified via email each time a new post is made!';
        Mail::to($user->email)->send(new WelcomeMail($title, $body));

        return  redirect('/')->withSuccess('welcome!');
    }
    public static function newPost($user, $post) :void{

        $title = 'New Post:'.$post['title'];
        $body = 'Hello '.$user->name.' a new post was added come and check it out!';
        Mail::to($user->email)->send(new WelcomeMail($title, $body));
    }
    public static function subscriptionEmailconfirmation(User $user)
    {

        $title = 'You have subscribed to IB gazette';
        $body = 'Welcome to IB gazette you can subscribe to our newsletter if you want to be notified via email each time a new post is made!';
        Mail::to($user->email)->send(new WelcomeMail($title, $body));

        return  redirect('/')->withSuccess('welcome!');
    }

}
