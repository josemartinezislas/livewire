<?php

namespace App\Livewire;


use Livewire\Attributes\On;
use Livewire\Component;
//=======| CLASS:: C O M M E N T S |=======
class Comments extends Component
{
    public $comments = [];

    #[On('post-created')]
    public function addComment($comment){
        array_unshift($this->comments, $comment);
    }


    public function render()
    {
        return view('livewire.comments');
    }
}
