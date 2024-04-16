<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\subscription;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Http\Controllers\PostController;
class userController extends Controller
{

    public function index():View
    {
        return view('usersManagement.index',[
            'users'=>User::get()
        ]);
    }
    public function edit($user): View
    {
        return  view('usersManagement.edit',[
            'user'=>User::find($user)
        ]);
    }
    public function update($user,Request $request )
    {

       DB::table('users')->where('id',$user)->update(['email'=>$request->email,'name'=>$request->name,'admin'=>$request->admin]);
        return  redirect()->back()->withSuccess('user is updated successfully');
    }

//benh yxbn xeba cokd

    public function destroy($user) : RedirectResponse
    {
//        dd(DB::table('posts')->where('wroteBy',$user)->count());
        if(DB::table('posts')->where('wroteBy',$user)->count()!=0){
            $entries=(DB::table('posts')->where('wroteBy',$user)->select('id','image','imageFolder')->get());
        foreach ($entries as $entry){
            User::select('id','image','imageFolder');
            PostController::deleteDirectory(storage_path("app/public/media/".$entry->imageFolder));
            DB::table('posts')->where('id',$entry->id)->delete();
            }
        }
        if(DB::table('subscriptions')->where('user_id',$user)->count()!=0){
            DB::table('subscriptions')->where('user_id',$user)->delete();
        }

        DB::table('users')->where('id',$user)->delete();
        return  redirect()->route('usersManagement.index')->withSuccess('User  deleted successfully');
    }
}
