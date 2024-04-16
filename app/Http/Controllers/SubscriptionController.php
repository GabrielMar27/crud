<?php

namespace App\Http\Controllers;

use App\Jobs\Mails\SubscribeConfirmationEmail;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\LaravelIgnition\Recorders\DumpRecorder\Dump;

class SubscriptionController extends Controller
{
    public function create()
    {
        return view('subscribe.SubscribeForm',[
            'user'=>Auth::user()
        ]);
    }
    public function destroy()
    {
        return view('subscribe.unSubscribe',[
            'subscription'=>DB::table('subscriptions')->where('user_id',Auth::user()->id)->get()[0]
        ]);
    }
    public  static  function  getSubscribedUsers(){
            $subscriptions=Subscription::all();
            $subscribedUsers = $subscriptions->map(function ($subscription) {
            $user = DB::table('users')->where('id', $subscription->user_id)->select('name','email')->first();
            return $user;
        });

            return $subscribedUsers;
    }

    public function delete($userID)
    {


        DB::table('subscriptions')->where('user_id',$userID)->delete();
        DB::table('users')->where('id',$userID)->update(['subscribed' => 0]);

        return  redirect()->route('/')->withSuccess('You unsubscribed!');
    }
    public function store(User $user)
    {
        try {
            Subscription::query()->create([
                'user_id' => $user->id,
            ]);
            DB::table('users')->where('id',$user->id)->update(['subscribed' => 1]);

            SubscribeConfirmationEmail::dispatch($user)->onQueue("mail");
            return redirect('/')->withSuccess('You are subscribed!');
        }catch (Exception $ex){
            throw $ex;
            }
        }
    public static  function checkForSub($userID) {

        return DB::table('subscriptions')->where('user_id',$userID)->first();
    }
}
