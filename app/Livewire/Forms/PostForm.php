<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PostForm extends Form
{
    public ?Post $post;

    #[Validate([
        'title' => ['required', 'string', 'min:3', 'max:30'],
        'slug' => ['required', 'string'],
        'date_published' => ['nullable','date'],
        'category_id' => ['nullable'],
        'description' => ['nullable', 'string'],
    ])]

    public $title;
    public $slug;
    public $category_id;
    public $date_published;
    public $description;

    public function setPost(Post $post)
    {
        $this->post = $post;
        $this->title = $post->title;
        $this->slug = $post->slug;
        $this->category_id = $post->category_id;
        //$this->date_published = $post->date_published->format('Y-m-d');
        $this->date_published = $post->date_published;
        $this->description = $post->description;
    }

    public function store()
    {
        //dd($this->slug);
        $this->validate();
        Post::create([
            'title' => $this->title,
            'slug' => $this->slug,
            'category_id' => $this->category_id,
            'date_published' => $this->date_published,
            'description' => $this->description,
        ]);
        $this->reset();
    }
    public function update()
    {
        //dd($this->category_id);
        $this->validate();
        $this->post->update(
            $this->all()
        );
        /* $this->post->update([
            'title' => $this->title,
            'slug' => $this->slug,
            'category_id' => $this->category_id,
            'date' => $this->date,
            'description' => $this->description,
        ]); */
        $this->reset();
    }
}
