<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Category;
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

    public function create()
    {
        $categories = Category::all();
        return view('tasks.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'tasks' => 'required|array',
            'tasks.*.name' => 'required|string',
            'tasks.*.category_id' => 'required|exists:categories,id',
        ]);

        // Simpan User
        $user = User::create([
            'name' => $validatedData['name'],
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
        ]);

        $userId = $user->id;

        // Simpan Tasks
        foreach ($validatedData['tasks'] as $task) {
            Task::create([
                'user_id' => $userId,
                'description' => $task['name'],
                'category_id' => $task['category_id'],
            ]);
        }

        return response()->json(['message' => 'Data berhasil disimpan!']);
    }

    public function validateUsername(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username',
        ]);
    }

    public function validateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
        ]);
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
    public function update(Request $request, string $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {}
}
