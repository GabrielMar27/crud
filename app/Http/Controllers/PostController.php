<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Jobs\Mails\NewPostMail;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {

        if(request()->has('search'))
        {
            return view('posts.index',[
                'posts'=>Post::where("title",'like',"%".request()->get("search",'')."%")->latest()->paginate(3)
            ]);
        }
        else{
            return view('posts.index',[
                'posts'=>Post::all()
            ]);
        }

    }
    public function indexCreatedBy($user) : View
    {
        return view('posts.indexCreatedBy',[
            'posts'=>Post::all()->where("wroteBy",$user),
            "user"=>DB::table("users")->get()->where('id',$user)->first()
        ]);
    }



    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $name=uniqid('', true);
        $path=storage_path("app/public/media/" . $name);
        if ($request->hasFile('image')) {
            File::makeDirectory($path,0777,true);
            $imageName = $request->image->getClientOriginalName();
            $imageFile = $request->file('image');
            $imageFile->move($path, $imageName);
            $post1=$request->all();
            $post1['image']=$imageName;
            $post1['imageFolder']=$name;
            $post1['wroteBy']=Auth::user()->id;

            Post::create($post1);

            $users=SubscriptionController::getSubscribedUsers();


            $users->map(fn($user) =>( NewPostMail::dispatch($user,$post1)->onQueue("mail")));
            return redirect()->route('/')
                ->withSuccess('New post is added successfully.');
        }
        else{
            return redirect()->route('posts.create')
                ->withError('Add image');
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): View
    {
        return  view('posts.show',[
            'post'=>$post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post): View
    {
        return  view('posts.edit',[
           'post'=>$post
        ]);
    }
    public static function deleteDirectory($dirPath): void
    {
        if (is_dir($dirPath)) {
            $files = scandir($dirPath);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    $filePath = $dirPath . '/' . $file;
                    if (is_dir($filePath)) {
                        deleteDirectory($filePath);
                    } else {
                        unlink($filePath);
                    }
                }
            }
            rmdir($dirPath);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {

        $newPost=$request->all();
        if($request->has('image')){
            $path=storage_path("app/public/media/" . $post->imageFolder);
            $dir=glob($path.'/*');
            if(!empty($dir))
            {
                foreach ($dir as $files)
                    unlink($files);
            }
            $imageName = $request->image->getClientOriginalName();
            $imageFile = $request->file('image');
            $newPost['image']= $imageName;
            $imageFile->move($path, $imageName);
    }

        $post->update($newPost);
        return  redirect()->back()->withSuccess('post is update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post) : RedirectResponse
    {

        self::deleteDirectory(storage_path("app/public/media/" . $post->imageFolder));
        $post->delete();
        return  redirect()->route('/')->withSuccess('Posts is deleted successfully');
    }

}
