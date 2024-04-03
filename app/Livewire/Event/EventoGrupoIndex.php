<?php

namespace App\Livewire\Event;

use Livewire\Attributes\Title;
use Livewire\Component;

class EventoGrupoIndex extends Component
{
    /* Renderiza componente */
    #[Title('Evento grupos')]
    public function render()
    {
        return view('livewire.event.evento-grupo-index');
    }
}
