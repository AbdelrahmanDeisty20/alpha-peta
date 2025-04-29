<?php

namespace App\Livewire;

use Livewire\Component;

class DisplayImage extends Component
{
    public $record;

    public function mount($record)
    {
        $this->record = $record;


    }
    public function render()
    {
        return view('livewire.display-image');
    }
}
