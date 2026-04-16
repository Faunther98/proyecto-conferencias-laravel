<?php

namespace App\Livewire\Publico;

use Livewire\Component;
use Livewire\Attributes\Layout; 

class HomeComponent extends Component
{
    #[Layout('layouts.invitado')] 
    public function render()
    {
        return view('livewire.publico.home-component');
    }
}