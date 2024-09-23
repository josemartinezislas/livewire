<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PostCreateFormulario extends Form
{
    #[Validate('required|min:3')]
    public $title = '';

    #[Validate('required')]
    public $content = '';

    #[Validate('required|exists:categories,id')]
    public $category_id = '';

    #[Validate('required|array')]
    public $tagsArray = [];

    public $openSave = false;

    public function store(){
        $this->validate();
        
        $post = Post::create(
            $this->only('title', 'content', 'category_id')
        );
        $post->tags()->attach($this->tagsArray);
        
        $this->openSave = false;
        $this->reset();
    }
}
