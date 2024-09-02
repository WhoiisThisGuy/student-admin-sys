<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController
{
    public function index()
    {
        $students = Student::paginate(10); // Fetch 10 students per page

        return view('welcome',compact('students'));
    }

    public function create()
    {
        return view('students-create');
    }

    public function store(Request $request)
    {
        $dump = Student::create([
            "name" => $request->get('name'),
            "sex" => $request->get('sex'),
            "place_of_birth" => $request->get('place_of_birth'),
            "date_of_birth" => $request->get('date_of_birth'),
            "email_address" => $request->get('email_address'),
        ]);

        return redirect()->route('students.index');
    }

    public function show(Student $student)
    {
        return view("students-show",[
            "student" => $student
        ]);
    }

    public function update(Request $request,Student $student)
    {
        $student->update($request->all());

        return redirect()->route('students.index')->with(["message"=>"ANYÁD ÁGYÁBA TP-ZEK!"]);
    }

    public function delete(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index');
    }
}
