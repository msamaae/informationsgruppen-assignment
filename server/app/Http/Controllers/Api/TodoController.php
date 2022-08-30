<?php

namespace App\Http\Controllers\Api;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TodoController extends Controller
{
    /*
    |-------------------------------------------------------------------------------
    | Get todos
    |-------------------------------------------------------------------------------
    | URL:              /api/todolists/{todolist}/todos
    | Method:           GET
    | Description:      Get all todos for current authenticated user 
    */
    public function index($todoListId)
    {
        $todo = Todo::where([
                ['user_id', auth()->user()->id],
                ['todo_list_id', $todoListId]
            ])
            ->get();

        return response()->json($todo);
    }

    /*
    |-------------------------------------------------------------------------------
    | Create a todo
    |-------------------------------------------------------------------------------
    | URL:              /api/todolists/{todolist}/todos
    | Method:           POST
    | Description:      Store a todo for corresponding user and todolist
    */
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

    /*
    |-------------------------------------------------------------------------------
    | Delete a todo
    |-------------------------------------------------------------------------------
    | URL:              /api/todolists/{todolist}/todos/{todo}
    | Method:           DELETE
    | Description:      Delete a todo where corresponding user ID and todolist ID matches 
    */
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

    /*
    |-------------------------------------------------------------------------------
    | Complete a todo
    |-------------------------------------------------------------------------------
    | URL:              /api/todolists/{todolist}/todos/todo
    | Method:           PUT
    | Description:      Check a todo as completed/!completed
    */
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
