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

    /*
    |-------------------------------------------------------------------------------
    | Get all todolists
    |-------------------------------------------------------------------------------
    | URL:              /api/todolists
    | Method:           GET
    | Description:      Get all todolists for current authenticated user 
    */
    public function index()
    {
        $todoList = TodoList::where('user_id', $this->userId)->get();

        return response()->json($todoList);
    }

    /*
    |-------------------------------------------------------------------------------
    | Create a todolist
    |-------------------------------------------------------------------------------
    | URL:              /api/todolists
    | Method:           POST
    | Description:      Validate and create a todolist 
    */
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

    /*
    |-------------------------------------------------------------------------------
    | Delete a todolist
    |-------------------------------------------------------------------------------
    | URL:              /api/todolists/{todolist}
    | Method:           DELETE
    | Description:      Delete a todolist
    */
    public function destroy($id)
    {
        $result = TodoList::destroy($id);

        if ($result === 1) {
            $todoList = TodoList::where('user_id', $this->userId)->get();
            return response()->json($todoList);
        }
    }
}
