<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }
    
    public function create()
    {
        return view('students.create');
    }
    
    public function store(Request $request)
    {
        $student = new Student;
        $student->name = $request->name;
        $student->email = $request->email;
        $student->save();
    
        return redirect()->route('students.index');
    }
    
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }
    
    public function update(Request $request, Student $student)
    {
        $student->name = $request->name;
        $student->email = $request->email;
        $student->save();
    
        return redirect()->route('students.index');
    }
    
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index');
    }
}