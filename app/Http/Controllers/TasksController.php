<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $tasks = Task::all();

            return response()->json([
                'status' => 'success',
                'message' => 'Get all tasks success',
                'data' => $tasks,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Get all tasks failed',
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name'          => 'required|string',
        //     'address'       => 'required|string',
        //     'class'         => 'required|integer',
        //     'phone'         => 'required|integer'
        // ]);

        // $students = new Students([
        //     'name'          => $request->name,
        //     'address'       => $request->address,
        //     'class'         => $request->class,
        //     'phone'         => $request->phone
        // ]);
        // $students->save();

        // if ($students) {
        //     return response()->json([
        //         'status' => 'success',
        //         'message' => 'Data added succesfully',
        //         'data' => $students
        //     ]);
        // } else {
        //     return Response()->json([
        //         'status' => 'error',
        //         'message' => 'Error adding data',
        //         'data' => $students
        //     ]);
        // }
    }

    public function validateUser(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username',
            'email' => 'required|email|unique:users,email'
        ]);

        return response()->json(['message' => 'Valid']);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $students = Students::find($id);

        // // Jika data siswa tidak ditemukan
        // if (!$students) {
        //     return response()->json(['message' => 'Student not found'], 404);
        // }

        // $request->validate([
        //     'name' => 'required|string',
        //     'class' => 'required|string',
        //     'address' => 'required|integer',
        //     'phone' => 'required|integer',
        // ]);

        // $students->update([
        //     'name' => $request->name,
        //     'class' => $request->class,
        //     'address' => $request->address,
        //     'phone' => $request->phone,
        // ]);

        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'Data updated succesfully',
        //     'data' => $students
        // ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // $students = Students::find($id);

        // // Jika data siswa tidak ditemukan
        // if (!$students) {
        //     return response()->json(['message' => 'Student not found'], 404);
        // }

        // $students->delete();

        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'Data deleted succesfully',
        //     'data' => $students
        // ]);
    }
}
