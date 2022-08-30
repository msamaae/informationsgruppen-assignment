<?php

namespace App\Http\Controllers\Api;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TodoController extends Controller
{
    public function index($todoListId)
    {
        $todo = Todo::where([
            ['user_id', auth()->user()->id],
            ['todo_list_id', $todoListId]
        ])
        ->get();

        return response()->json($todo);
    }

    public function store(Request $request, $todoListId)
    {
        $request->validate([
            'description' => 'required'
        ]);

        $todo = Todo::create([
            'user_id' => auth()->user()->id,
            'todo_list_id' => $todoListId,
            'description' => $request->description,
        ]);

        return response()->json($todo, 201);
    }

    public function destroy($todoListId, $todoId) 
    {
        $result = Todo::destroy($todoId);

        if ($result === 1) {
            $todo = Todo::where([
                ['user_id', auth()->user()->id],
                ['todo_list_id', $todoListId]
            ])
            ->get();

            return response()->json($todo);
        }
    }

    public function completed(Request $request, $todoListId, $todoId) 
    {
        $result = Todo::where([
            ['id', $todoId],
            ['user_id', auth()->user()->id],
            ['todo_list_id', $todoListId]
        ])
        ->update(['completed' => $request->completed]);

        if ($result > 0) {
            $todo = Todo::where([
                ['user_id', auth()->user()->id],
                ['todo_list_id', $todoListId]
            ])
            ->get();

            return response()->json($todo);
        }
    }
}