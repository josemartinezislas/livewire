<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\DB;

use Livewire\Component;

class CreatePost extends Component
{
    public $title;
    public $name, $id, $email;

    public function mount(User $user){
        // $this->id = $user->id;
        // $this->name = $user->name;
        // $this->email = $user->email;
        // dd($user);
       $this->fill($user->only([
            'id',
            'name',
            'email'
       ] ));
       
    }

//==================================
    // public $name1;
    // public function mount(){
    //     $libros = User::all();
    //     $dos = compact('libros');
        
    //     $name1 = $libros[1];

    //     // dd($libros[1]);
      
       
    // }

    public function save(){
        // dd($this->name);
    }
   
    // public function mount($user){
        
    //     $this->user = User::find($user);
    //     //  dd($this->user);
    //     // $this->user = DB::table('users')->get();
    // }

    // <li>{{ $user->id }}</li>
    //     <li>{{ $user->name }}</li>
    
    public function render()
    {
        return view('livewire.create-post');
    }
}
