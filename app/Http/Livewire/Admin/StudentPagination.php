<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class StudentPagination extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'lastname';
    public $sortDirection = 'asc';
    public $showEditModal = false;

    public $listeners = ['refreshStudents' => 'render'];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        } 
    }

    public function paginationView()
    {
        return 'pagination::default';
    }

    public function render()
    {
        return view('livewire.admin.student-pagination', [
            'data' => User::where('role', 'student')->orderBy($this->sortField, $this->sortDirection)->search('student_no', $this->search)->paginate(10)
        ]);
    }
}
