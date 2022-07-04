<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Livewire\Component;

class StudentsComponent extends Component
{
    public $student_id;
    public $name;
    public $email;
    public $phone;
    public $student_selected_id;
    public $ui = [
        'state' => 'add',
        'title' => 'add new student',
        'btnText' => 'Add New',
    ];

    // protected $rules = [
    //     'student_id' => "required|unique:students,student_id,{$this->student_selected_id}",
    //     'email' => 'required|email',
    //     'name' => 'required',
    //     'phone' => 'required|numeric',
    // ];

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'student_id' => "required|unique:students,student_id,{$this->student_selected_id}",
            'email' => 'required|email',
            'name' => 'required',
            'phone' => 'required|numeric',
        ]);
        // $this->validateOnly($propertyName);
    }

    public function openAddNewModal()
    {
        $this->ui = [
            'state' => 'add',
            'title' => 'add new student',
            'btnText' => 'Add New',
        ];
        $this->dispatchBrowserEvent('open-modal');
    }

    public function saveStudent()
    {
        $validatedData = $this->validate([
            'student_id' => "required|unique:students,student_id,{$this->student_selected_id}",
            'email' => 'required|email',
            'name' => 'required',
            'phone' => 'required|numeric',
        ]);
        if ($this->student_selected_id) {
            $student = Student::find($this->student_selected_id);
            if (!$student) return;
            $student->student_id = $this->student_id;
            $student->name = $this->name;
            $student->email = $this->email;
            $student->phone = $this->phone;
            $student->save();
            session()->flash('message', 'Student has been updated successfully');
    
        } else {
            Student::create($validatedData);
            session()->flash('message', 'New student has been added successfully');
        }

        $this->closeModal();
    }

    public function openEditModal($id)
    {
        $student = Student::find($id);
        if (!$student) return;
  
        $this->student_selected_id = $student->id;
        $this->student_id = $student->student_id;
        $this->name = $student->name;
        $this->email = $student->email;
        $this->phone = $student->phone;
        $this->ui = [
            'state' => 'edit',
            'title' => 'Edit student',
            'btnText' => 'Update',
        ];
        $this->dispatchBrowserEvent('open-modal');
    }

    public function openDeleteModal($id)
    {
        $student = Student::find($id);
        if (!$student) return;
        $this->student_selected_id = $id;
        $this->dispatchBrowserEvent('show-delete-modal-student');
    }

    public function deleteStudent()
    {
        $student = Student::find($this->student_selected_id);
        $student->delete();
        session()->flash('message', 'The student has been deleted successfully');
        $this->closeModal();
    }

    public function resetInputs()
    {
        $this->student_id = '';
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->student_selected_id = '';
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInputs();
    }

    public function render()
    {
        $students = Student::all();
        return view('livewire.students-component', compact('students'))->layout('livewire.layouts.base');
    }
}
