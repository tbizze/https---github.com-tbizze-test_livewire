<?php

namespace App\Livewire;

use App\Livewire\Forms\CategoryForm;
use App\Models\Category;
use Livewire\Component;
use Mary\Traits\Toast;

class CategoryIndex extends Component
{
    use Toast;

    public CategoryForm $form;

    public bool $categoryModal = false;
    public bool $confirmDeleteModal = false;
    public bool $editMode = false;
    public $registro_id = '';

    public function showModal()
    {
        $this->form->reset();
        $this->categoryModal = true;
    }

    public function edit($id)
    {
        $post = Category::find($id);
        $this->form->setCategory($post);
        $this->editMode = true;
        $this->categoryModal = true;
    }

    public function save()
    {
        if ($this->editMode) {
            $this->form->update();
            $this->editMode = false;
            $this->success('Registro salvo com sucesso!');
        } else {
            //dd('Error');
            $this->form->store();
            $this->success('Registro incluído com sucesso!');
        }
        $this->categoryModal = false;
    }

    public function confirmDelete($id)
    {
        $this->registro_id = $id;
        $this->confirmDeleteModal = true;
    }

    public function delete($id)
    {
        Category::find($id)->delete();
        $this->confirmDeleteModal = false;
        $this->success('Registro excluído com sucesso!');
    }
    public function render()
    {
        $headers = [
            ['key' => 'id', 'label' => '#', 'class' => 'bg-base-200 w-1'],
            ['key' => 'title', 'label' => 'Title'],
            ['key' => 'description', 'label' => 'Description', 'sortable' => false],
        ];
        return view('livewire.category-index',[
            'headers' => $headers,
            'categories' => Category::all(),
        ]);
    }
}
