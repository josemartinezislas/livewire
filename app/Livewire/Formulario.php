<?php
//=========| CLASS:: FORMULARIO |=========
namespace App\Livewire;

use App\Livewire\Forms\PostCreateForm;
use App\Livewire\Forms\PostEditForm;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Formulario extends Component
{
    use WithPagination;
    public PostCreateForm $postCreate;
    public PostEditForm $postEdit;
    public $categories, $tags;
    public $post;

    #[Url(as: 's')]
    public $search = '';
    // public $posts;
    //=============| FUNCTION M O U N T |=============
    public function mount()
    {
        $this->categories = Category::all();
        $this->tags = Tag::all();
        // $this->posts = Post::all();
    }
    //==============| FUNCTION S A V E |===============
    public function save()
    {
        $title = $this->postCreate->title;
        $this->postCreate->save();

        $this->resetPage(pageName: 'pagePost');
        // $this->posts = Post::all();
        $this->dispatch('alertSave', 'Registro guardado ...'. $title);
        // $this->dispatch('post-created', 'El post ' . $title . ' se guardo!!');
    }
    //==============| FUNCTION E D I T |===============
    public function edit($postId)
    {
        $this->resetValidation();
        $this->postEdit->edit($postId);
    }
    //============| FUNCTION U P D A T E |=============
    public function update()
    {
        $this->postEdit->update();
           //$this->posts = Post::all();
        $this->dispatch('alertUpdate', 'Registro actualizado...');
    }
    //=============| FUNCTION D E S T R O Y |=============
    #[On('delete')]
    public function destroy($postId)
    {
        $post = Post::find($postId);
        $post->delete();
        // $this->posts = Post::all();
    }
    //===========| SETUP P A G I N A D O R |===========
    public function paginationView()
    {        return 'vendor.livewire.tailwind';    }
    //=======| FUNCTION R E N D E R - T A B L E |=======
    public function render()
    {
        
       //$posts = Post::all();

        // $posts = Post::paginate(3);
        // $posts = Post::orderBy('id', 'desc')->paginate(3, pageName: 'pagePost');

        $posts = Post::orderBy('id', 'desc')
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->paginate(4, pageName: 'pagePost');
           // dd(compact('posts'));
        return view('livewire.formulario', compact('posts'));
    }
}