<?php

namespace App\Livewire;

use App\Models\Movimento;
use Livewire\Attributes\Title;
use Livewire\Component;

class DashboardIndex extends Component
{
    #[Title('Dashboard')]
    public function render()
    {
        //sdd(Movimento::latest()->get());
        return view('livewire.dashboard-index',[
            'movtos_d' => Movimento::latest()->limit(5)->where('tipo','D')->get(),
            'movtos_c' => Movimento::latest()->limit(5)->where('tipo','C')->get(),
        ]);
    }
}
