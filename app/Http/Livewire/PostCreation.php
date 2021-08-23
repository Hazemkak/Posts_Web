<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;
use Symfony\Component\HttpFoundation\Session\Session;

class PostCreation extends Component
{
    use WithPagination;
    public $body;

    protected $listeners = ['refreshParentComponent' => 'deletedPost'];

    protected $rules = [
        'body' => 'required'
    ];

    public function deletedPost(){
        dd("deleted");
        //reset to first page
        $this->resetPage();
        session()->flash('message', 'Post Deleted Successfully!');
    }

    public function store(Request $req){
        $this->validate();
        //dd($this->body);
            
        $req->user()->posts()->create([
            'body'=>$this->body
        ]);
        
        $this->body = "";

        //reset to first page
        $this->resetPage();
        session()->flash('message', 'Post Added Successfully!');
    }

    public function render()
    {
        return view('livewire.post-creation', ['posts' => Post::orderBy('created_at','desc')->with('user','likes')->paginate(10)]);
    }
	
}
