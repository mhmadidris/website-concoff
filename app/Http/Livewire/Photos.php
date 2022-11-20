<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Photos extends Component
{
    public $validateImage;

    public function mount()
    {
    }

    public function render()
    {
        return view('livewire.photos');
    }
}
