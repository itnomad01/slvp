<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Inout;

class ShowInout extends Component
{

    public Inout $inout;

    public function delete() {
        $this->inout->delete();
    }

    public function render()
    {
        return view('livewire.show-inout');
    }
}
