<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\PostLiked;

class PostLikeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function store(Post $post){

        if(!$post->alreadyLiked(Auth::user())){
            $post->likes()->create([
                'user_id'=>Auth::user()->id,
                'post_id'=>$post->id
            ]);
        }

        // Mail::to($post->user)->send(new PostLiked(Auth::user(),$post));
        

        return back();
    }

    public function unstore(Post $post){
        //dd($post);
        if($post->alreadyLiked(Auth::user())){
            $post->likes()->where('post_id',$post->id)->where('user_id',Auth::user()->id)->delete();
        }
        return back();
    }
}
