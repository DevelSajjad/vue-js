<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function store(Request $request)
    {
       $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
        if ($request->filled('id')) {
            Employee::find($request->id)->update($validated);
        } else {
            Employee::create($validated);
        }

        return response()->json('Employee add successfully');
    }

    public function delete($id) 
    {
        Employee::find($id)->delete();

        return response()->json('Employee delete successfully');
    }
}
