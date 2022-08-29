<?php

namespace App\Http\Controllers\Api;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TodoController extends Controller
{
    public function index($todoListId)
    {
        $todo = Todo::where('todo_list_id', $todoListId)->get();

        return response()->json($todo);
    }

    public function store(Request $request, $todoListId)
    {
        $request->validate([
            'description' => 'required'
        ]);

        $todo = Todo::create([
            'todo_list_id' => $todoListId,
            'description' => $request->description,
            'completed' => 0
        ]);

        return response()->json($todo, 201);
    }

    public function destroy($todoListId, $todoId) 
    {
        return response()->json(Todo::destroy($todoId));
    }

    public function completed(Request $request, $todoListId, $todoId) 
    {
        $todo = Todo::findOrFail($todoId);

        // $request->validate([
        //     'completed' => 'required'
        // ]);

        $todo->completed = $request->completed;

        return response()->json($todo);
    }
}