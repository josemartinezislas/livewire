<?php
//=======| REFACTORIZACION |========
namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Post;

class PostCreateForm extends Form
//=======|  PostCreateForm   |========
//=======| FORMULARIO CREATE |=======
{
    public $new = '';

    #[Rule('required|min:3')]
    public $title;

    #[Rule('required')]
    public $content;

    #[Rule('required|exists:categories,id')]
    public $category_id = ' ';

    #[Rule('required|array')]
    public $tags = [];
    //=======| S A V E |=======
    public function save()
    {
        $this->validate();

        //===| Crear registro forma 3 con postCreate. |===
        $post = Post::create(
            $this->only('title', 'content', 'category_id')
        );
        
        $post->tags()->attach($this->tags);

        $this->reset();
    }
}
