<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Classroom;
use Livewire\WithPagination;

class DisplayClass extends Component
{
    use WithPagination;
    public $search = '';

    public function paginationView()
    {
        return 'pagination::default';
    }

    public function render()
    {
        return view('livewire.admin.display-class', [
            'classes' => Classroom::search([
                'class_name',
                'class_section',
                'class_prof',
                'class_room',
            ], $this->search)->paginate(8),
            'param' =>  '/admin/classes/',
        ]);
    }
}
