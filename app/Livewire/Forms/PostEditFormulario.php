<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PostEditFormulario extends Form
{
    #[Validate('required|min:5')]
    public $title = '';

    #[Validate('required')]
    public $content = '';

    #[Validate('required|exists:categories,id')]
    public $category_id = '';

    #[Validate('required|array')]
    public $tagsArray = [];

    public $openEdit = false;
    public $postId = '';

    public function find($postId){
        $this->openEdit = true;
        
        $post = Post::find($postId);

        $this->postId = $postId;
        
        $this->category_id = $post->category_id;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->tagsArray = $post->tags->pluck('id')->toArray();

    }
    public function updateReg(){
        $this->validate();
        
        $post = Post::find($this->postId);

        $post->update($this->only('category_id', 'title', 'content'));

        $post->tags()->sync($this->tagsArray);
        $this->openEdit = false;
    }
}
