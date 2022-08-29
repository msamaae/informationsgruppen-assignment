<?php

namespace App\Http\Controllers\Api;

use App\Models\TodoList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TodoListController extends Controller
{
    public function index()
    {
        $todoList = TodoList::where('user_id', auth()->user()->id)->get();

        return response()->json($todoList);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $todoList = TodoList::create([
            'user_id' => auth()->user()->id,
            'name' => $request->name
        ]);

        return response()->json($todoList, 201);
    }

    public function show($id)
    {
        return response()->json(TodoList::findOrFail($id));
    }

    public function destroy($id)
    {
        return response()->json(TodoList::destroy($id));
    }
}
