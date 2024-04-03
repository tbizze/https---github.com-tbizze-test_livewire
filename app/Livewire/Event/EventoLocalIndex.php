<?php

namespace App\Livewire\Event;

use Livewire\Attributes\Title;
use Livewire\Component;

class EventoLocalIndex extends Component
{
    /* Renderiza componente */
    #[Title('Evento locais')]
    public function render()
    {
        return view('livewire.event.evento-local-index');
    }
}
