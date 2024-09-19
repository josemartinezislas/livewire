<?php

namespace App\Livewire;

use Livewire\Component;

class CreaTarjeta extends Component
{
    public function render()
    {
        return <<<'HTML'
        <div class="bg-slate-50 shadow-md flex flex-col justify-center items-center p-5 rounded-md " >
           <h4>Componente tarjeta inline</h4>
        </div>
        HTML;
    }
}
