<?php

namespace App\Livewire;

use Livewire\Component;

class HelloWorld extends Component
{
    public $name = 'jose';
    public $num = 'hi';

    public function mount(){

    }
    

    public function enter($num){
        dd($num);

    }

    public function render()
    {
        return view('livewire.hello-world');
    }
}
