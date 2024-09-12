<?php

namespace App\Livewire;

use Livewire\Component;

class Paises extends Component
{
    public $paises = [
        'Peru',
        'Colombia',
        'Argentina',
    ];
    public $pais;
    public $active;
    public $count = 0;
    public $open = true;

    public function save()
    {
        array_push($this->paises, $this->pais);
        $this->reset('pais');
    }

    public function delete($ind)
    {
        unset($this->paises[$ind]);
    }

    public function changeActive($pai)
    {
        $this->active = $pai;
    }

    public function increment()
    {
        $this->count++;
        // dd('hola');
    }



    public function render()
    {
        return view('livewire.paises');
        // $pais = $this->paises;
        // dd( $this->paises);

    }
}
