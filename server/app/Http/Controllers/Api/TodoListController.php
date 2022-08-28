<?php

namespace App\Http\Controllers\Api;

use App\Models\TodoList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TodoListController extends Controller
{
    public function index()
    {
        return TodoList::where('user_id', '=', auth()->user()->id)->get();
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

        return $todoList;
    }

    public function destroy($id) 
    {
        return TodoList::destroy($id);
    }
}
