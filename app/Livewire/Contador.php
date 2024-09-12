<?php

namespace App\Livewire;

use Livewire\Component;

class Contador extends Component
{
    public $contador = 0;
    public function render()
    {
        return view('livewire.contador');
    }

    public function increment(){
        $this->contador++;
        // $this->contador+=$cant;

    }

    public function decrement(){
        $this->contador--;
    }
}
