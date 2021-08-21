<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UpdateLikes extends Component
{
    public $post;

    public function like(){
            if(!$this->post->alreadyLiked(Auth::user())){
                $this->post->likes()->create([
                    'user_id'=>Auth::user()->id,
                    'post_id'=>$this->post->id
                ]);
            }
        $this->post=$this->post->fresh();   
    }

    public function unlike(){
        if($this->post->alreadyLiked(Auth::user())){
            $this->post->likes()->where('post_id',$this->post->id)->where('user_id',Auth::user()->id)->delete();
        }
        $this->post=$this->post->fresh();
    }

    public function delete($id){
        Post::find($id)->delete();
        $this->emitTo('PostCreation','refreshParentComponent');
    }

    public function render()
    {
        return view('livewire.update-likes');
    }


}
