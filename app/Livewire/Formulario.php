<?php
//=========| CLASS:: FORMULARIO |=========
namespace App\Livewire;

use App\Livewire\Forms\PostCreateForm;
use App\Livewire\Forms\PostEditForm;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
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

    public function mount()
    {
        $this->categories = Category::all();
        $this->tags = Tag::all();
        // $this->posts = Post::all();

    }
    //=======| FUNCTION SAVE |=======
    public function save()
    {
        $this->postCreate->save();
        $this->resetPage(pageName: 'pagePost');
        // $this->posts = Post::all();
        $this->dispatch('post-created', 'Nuevo articulo creado');
    }
    //=======| FUNCTION EDIT |=======
    public function edit($postId)
    {
        $this->resetValidation();
        $this->postEdit->edit($postId);
    }
    //=======| FUNCTION UPDATE |=======
    public function update()
    {
        $this->postEdit->update();
        // $this->posts = Post::all();
        $this->dispatch('post-created', 'articulo actualizado');
    }
    //=======| FUNCTION DESTROY |=======
    public function destroy($postId)
    {
        $post = Post::find($postId);
        $post->delete();
        // $this->posts = Post::all();
        $this->dispatch('post-created', 'articulo Eliminado!!');
    }
    public function paginationView(){
        return 'vendor.livewire.tailwind';
    }

    public function render()
    {
        // $posts = Post::paginate(3);
        // $posts = Post::orderBy('id', 'desc')->paginate(3, pageName: 'pagePost');
        $posts = Post::orderBy('id', 'desc')
        ->when($this->search, function ($query){
            $query->where('title', 'like', '%' . $this->search . '%');
        })
        ->paginate(3, pageName: 'pagePost');
        

        return view('livewire.formulario', compact('posts'));
    }
}
