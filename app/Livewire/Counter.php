<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

class Counter extends Component
{
    public $count = 1;
    public $search = 'x';
    
    public $confirming = false;
 
    public function increment()
    {
        $this->count++;
    }
 
    public function decrement()
    {
        $this->count--;
    }

    public function search($value)
    {
        //$this->count--;
        $dados = User::query();

        // 3) Aplica filtros a Query:
        // Se passado dados no campo 'search' ==> Pesquisa na coluna 'description'.
        $dados->when($value, function ($query, $vl) {
            $query->where('nome', 'like', '%' . $vl . '%');
        });
        $dados = $dados->get();

        dd($dados);
        return $dados;
    }
    
    #[Title('Create Post')] 
    public function render()
    {
        //return view('livewire.counter');

        return view('livewire.counter', [
            //'users' => $this->search($this->search),
            'users' => User::all(),
        ]);
    }
}
