<?php

namespace App\Http\Controllers\Api;

use App\Models\TodoList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TodoListController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->userId = auth()->user()->id;
    
            return $next($request);
        });
    }

    public function index()
    {
        $todoList = TodoList::where('user_id', $this->userId)->get();

        return response()->json($todoList);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $todoList = TodoList::create([
            'user_id' => $this->userId,
            'name' => $request->name
        ]);

        return response()->json($todoList, 201);
    }

    public function show($id)
    {
        $todoList = TodoList::where('user_id', $this->userId)->find($id);

        if (!$todoList) {
            return response()->json(['message' => 'Unauthorized.'], 401);
        } else {
            return response()->json($todoList);
        }
    }

    public function destroy($id)
    {
        $result = TodoList::destroy($id);

        if ($result === 1) {
            $todoList = TodoList::where('user_id', $this->userId)->get();
            return response()->json($todoList);
        }
    }
}
