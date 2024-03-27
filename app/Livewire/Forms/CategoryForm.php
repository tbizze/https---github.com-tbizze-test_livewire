<?php

namespace App\Livewire\Forms;

use App\Models\Category;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CategoryForm extends Form
{
    public ?Category $category;

    #[Validate([
        'title' => ['required', 'string', 'min:3', 'max:30'],
        'description' => ['nullable', 'string'],
    ])]

    public $title;
    public $description;

    public function setCategory(Category $category)
    {
        $this->category = $category;
        $this->title = $category->title;
        $this->description = $category->description;
    }

    public function store()
    {
        $this->validate();
        Category::create([
            'title' => $this->title,
            'description' => $this->description,
        ]);
        $this->reset();
    }
    public function update()
    {
        $this->validate();
        $this->category->update([
            'title' => $this->title,
            'description' => $this->description,
        ]);
        $this->reset();
    }
}
