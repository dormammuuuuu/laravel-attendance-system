<?php

namespace App\Http\Livewire\Admin\Student;

use LivewireUI\Modal\ModalComponent;

class SearchFilter extends ModalComponent
{
    public function render()
    {
        return view('livewire.admin.student.search-filter');
    }
}
