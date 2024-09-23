<?php

namespace App\Livewire;

use App\Livewire\Forms\PostCreateFormulario;
use App\Livewire\Forms\PostEditFormulario;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    public $post, $categories, $tags, $users;
    public $postId = '';
    public $search;
    public PostEditFormulario $formEdit;
    public PostCreateFormulario $formCreate;

    //=============| FUNCTION M O U N T |=============
    public function mount()
    {
        $this->categories = Category::all();
        $this->tags = Tag::all();
      
    }
    //==============| FUNCTION S A V E |===============
       public function save(){
        $this->formCreate->store();
       
        $this->resetPage(pageName: 'pagePost');
        $this->dispatch('alertSave', 'Registro guardado...');
    }
    //==============| FUNCTION E D I T |===============
    public function edit($postId){
        $this->resetValidation();        
        $this->formEdit->find($postId);
    }
    //============| FUNCTION U P D A T E |=============
    public function update(){
        $this->formEdit->updateReg();
        $this->dispatch('alertUpdate', 'Registro actualizado...');
    }
    //=============| FUNCTION D E S T R O Y |=============
     #[On('delete')]
     public function destroy($postId){
         $post = Post::find($postId);
         $post->delete();
     }
    //===========| SETUP P A G I N A D O R |===========
     public function paginationView()
     {        return 'vendor.livewire.tailwind';    }
    //=======| FUNCTION R E N D E R - T A B L E |=======
    public function render()
    {
       

        $posts = Post::orderBy('id', 'desc')
            ->when($this->search, function ($query) {
                $query->where('id', 'like', '%' . $this->search . '%');
            })
            ->paginate(4, pageName: 'pagePost');
        return view('livewire.table', compact('posts'));
    }
}