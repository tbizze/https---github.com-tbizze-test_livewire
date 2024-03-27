<?php

namespace App\Livewire;

use App\Livewire\Forms\PostForm;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;

class PostIndex extends Component
{
    use Toast;
    use WithPagination;

    public PostForm $form;

    public bool $postModal = false;
    public bool $confirmDeleteModal = false;
    public bool $editMode = false;
    public $registro_id = '';

    public array $sortBy = ['column' => 'title', 'direction' => 'asc'];
    public string $search = '';

    public function showModal()
    {
        $this->form->reset();
        $this->postModal = true;
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $this->form->setPost($post);
        $this->editMode = true;
        $this->postModal = true;
    }

    public function save()
    {
        if ($this->editMode) {
            $this->form->update();
            $this->editMode = false;
            $this->success('Registro salvo com sucesso!');
        } else {
            $this->form->store();
            $this->success('Registro incluído com sucesso!');
        }
        $this->postModal = false;
    }

    public function confirmDelete($id)
    {
        $this->registro_id = $id;
        $this->confirmDeleteModal = true;
    }

    public function delete($id)
    {
        Post::find($id)->delete();
        $this->confirmDeleteModal = false;
        $this->success('Registro excluído com sucesso!');
    }

    /* Table data */
    public function posts()
    {
        return Post::query()
            ->withAggregate('toCategory', 'title')
            ->orderBy(...array_values($this->sortBy))
            ->paginate(4);
    }

    /* Table headers */
    public function headers()
    {
        return [
            ['key' => 'id', 'label' => '#', 'class' => 'bg-base-200 w-1'],
            ['key' => 'title', 'label' => 'Title'],
            ['key' => 'slug', 'label' => 'Slug', 'sortable' => false],
            ['key' => 'date_published', 'label' => 'Publish', 'sortable' => false],
            ['key' => 'to_category_title', 'label' => 'Category'],
            ['key' => 'description', 'label' => 'Description', 'sortable' => false],
        ];
    }

    public function render()
    {
        return view('livewire.post-index', [
            'headers' => $this->headers(),
            'posts' => $this->posts(),
            'categories' => Category::orderBy('title')->get(['id', 'title as name']),
        ]);
    }
}
