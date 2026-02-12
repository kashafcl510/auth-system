<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
// use DataTables;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
   public function store (Request $request){

   $data = $request->validate([
        'name' => 'required|max:255',
        'phone' => 'required',
        'email' => 'required|email|unique:students,email',
   ]);

     Student::create($data);
    return response()->json([
        'success'  => true,
        'message' => 'Student created successfully'
    ]);

   }





public function index(Request $request)
{
    if ($request->ajax()) {
        $data = Student::latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                return '<button class="btn btn-sm btn-success edit">Edit</button>
                        <button class="btn btn-sm btn-danger delete">Delete</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    return view('site.velzonTable');
}





}
