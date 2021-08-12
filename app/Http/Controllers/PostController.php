<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware(['auth'])->only(['store','destroy']);
    }

    public function index(){
        $posts=Post::orderBy('created_at','desc')->with('user','likes')->paginate(10);//collection
        

        return view('posts.index',[
            'posts'=>$posts
        ]);
    }

    public function store(Request $req){
        $this->validate($req,[
            'body'=>'required'
        ]);

        

        $req->user()->posts()->create([
            'body'=>$req->body
        ]);

        return back();
    }

    public function destroy(Post $post){
        $this->authorize('delete',$post);
        $post->delete();
        
        
        return back();
    }

    public function show(Post $post){
        return view('posts.show',[
            'post'=>$post
        ]);
    }
}
