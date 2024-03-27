<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

class Counter extends Component
{
    public bool $myModal1 = false;
    public bool $myModal2 = false;
    
    public $count = 1;
    public $search = '';

    public $confirming = false;

    //public $dados = User::all();

    public $headers = [
        ['key' => 'id', 'label' => '#'],
        ['key' => 'name', 'label' => 'Nice Name'],
        ['key' => 'city.name', 'label' => 'City'], # <---- nested attributes
    ];

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }

    public function procura($value)
    {
        if ($value = '') {
            $dados = User::all();
        } else {
            $dados = User::query();

            $dados->when($value, function ($query, $vl) {
                $query->where('nome', 'like', '%' . $vl . '%');
            });
            $dados = $dados->get();
        }
        //dd($dados);
        return $dados;
    }

    #[Title('Create Post')]
    public function render()
    {
        //return view('livewire.counter');

        return view('livewire.counter', [
            'users' => $this->procura($this->search),
            //'users' => User::all(),
        ]);
    }
}
