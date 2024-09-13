<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Formulario extends Component
{
    public $categories, $tags;

    public $post;


    // #[Rule('required')]
    // public $title;

    // #[Rule('required')]
    // public $content;

    // #[Rule('required|exists:categories,id', as: 'CATEGORIA' )]
    // public $category_id="";

    // #[Rule('required|array')]
    // public $selectedTags =[];

    // #[Rule(
    //     [
    //         'postCreate.title' => 'required',
    //         'postCreate.content' => 'required',
    //         'postCreate.category_id' => 'required|exists:categories',
    //         'postCreate.tags' => 'required|array'
    //     ],
    //     [],
    //     [
    //         'postCreate.category_id' => 'CATEGOrE'
    //     ]
    // )]
    public $postCreate = [
        'title' => '',
        'content' => '',
        'category_id' => '',
        'tags' => []
    ];

    public $posts;

    public $postEditId = '';

    public $postEdit = [
        'category_id' => '',
        'title' => '',
        'content' => '',
        'tags' => []
    ];
    public $open = false;

    public function rules()
    {
        return [
            'postCreate.title' => 'required',
            'postCreate.content' => 'required',
            'postCreate.category_id' => 'required|exists:categories',
            'postCreate.tags' => 'required|array'
        ];
    }
    public function messages()
    {
        return [
            'postCreate.title' => 'CAMPO TITULO SE REQUIERE',
        ];
    }
    public function validationAttributes()
    {
        return [
            'postCreate.category_id' => 'CATEGORIAS',
            'postCreate.content' => 'contenido',
        ];
    }

    public function mount()
    {
        $this->categories = Category::all();
        $this->tags = Tag::all();
        $this->posts = Post::all();
    }

    public function save()
    {
        $this->validate();
        
        //===| Validación |===
        // $this->validate([
        //     'title'=> 'required',
        //     'content' => 'required',
        //     'category_id' => 'required|exists:categories,id',
        //     'selectedTags' => 'required|array'
        // ],[
        //     'title.required' => 'el campo título es requeridooo'
        // ],[
        //     'category_id' => 'categoria'
        // ]);

        //===| Crear registro forma 1 |===
        // $post = Post::create([
        //     'category_id' => $this->category_id,
        //     'title' => $this->title,
        //     'content' => $this->content,
        // ]);

        //===| Crear registro forma 2 simplificada |===
        // $post = Post::create($this->only('category_id', 'title', 'content'));
        // $post->tags()->attach($this->selectedTags);
        //===| Crear registro forma 3 con postCreate. |===
        $post = Post::create([
            'category_id' => $this->postCreate['category_id'],
            'title' => $this->postCreate['title'],
            'content' => $this->postCreate['content'],
        ]);
        $post->tags()->attach($this->postCreate['tags']);


        $this->reset(['postCreate']);

        $this->posts = Post::all();

       
        // dd([
        //     'category_id' => $this->category_id,
        //     'title' => $this->title,
        //     'content' => $this->content,
        //     'tags' => $this->selectedTags,
        // ]);
    }

    public function edit($postId)
    {
        $this->resetValidation();
        $this->open = true;

        $this->postEditId = $postId;

        $post = Post::find($postId);

        $this->postEdit['category_id'] = $post->category_id;
        $this->postEdit['title'] = $post->title;
        $this->postEdit['content'] = $post->content;

        $this->postEdit['tags'] = $post->tags->pluck('id')->toArray();
    }

    public function update()
    {
        //===| Validación |===
        $this->validate([
            'postEdit.title' => 'required',
            'postEdit.content' => 'required',
            'postEdit.category_id' => 'required|exists:categories,id',
            'postEdit.selectedTags' => 'required|array'
        ], [], [
            'postEdit.content' => 'contenido',
        ]);
        $post = Post::find($this->postEditId);

        // dd($this->postEditId);

        $post->update([
            'category_id' => $this->postEdit['category_id'],
            'title' => $this->postEdit['title'],
            'content' => $this->postEdit['content']
        ]);

        $post->tags()->sync($this->postEdit['tags']);


        $this->reset([
            'postEditId',
            'postEdit',
            'open'
        ]);
        $this->posts = Post::all();
    }

    public function destroy($postId)
    {
        $post = Post::find($postId);

        $post->delete();
        $this->posts = Post::all();
    }

    public function render()
    {
        return view('livewire.formulario');
    }
}
