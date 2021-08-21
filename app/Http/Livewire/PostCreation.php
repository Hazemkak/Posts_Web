<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class PostCreation extends Component
{
    use WithPagination;

    protected $listeners = ['refreshParentComponent' => '$refresh'];

    public function store(Request $req){
        $this->validateOnly($req,[
            'body'=>'required'
        ]);
            
        $req->user()->posts()->create([
            'body'=>$req->body
        ]);
        //$this->emit('update');
    }

    public function render()
    {
        return view('livewire.post-creation', ['posts' => Post::orderBy('created_at','desc')->with('user','likes')->paginate(10)]);
    }
}
