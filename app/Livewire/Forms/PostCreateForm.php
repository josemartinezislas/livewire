<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Post;
class PostCreateForm extends Form
{
    #[Rule('required|min:3')]
    public $title;

    #[Rule('required')]
    public $content;

    #[Rule('required|exists:categories,id')]
    public $category_id = ' ';

    #[Rule('required|array')]
    public $tags = [];

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
