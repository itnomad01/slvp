<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Org;

class ShowOrg extends Component
{
    public Org $org;

    public function delete() {
        $this->org->delete();
    }

    public function render()
    {
        return view('livewire.show-org');
    }
}
