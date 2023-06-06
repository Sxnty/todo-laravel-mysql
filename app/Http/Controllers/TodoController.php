<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Todo;

class TodoController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|min:3',
            'description' => 'min:3',
        ]);

        $todo = new Todo;
        $todo->title = $request->title;
        $todo->description = $request->description;
        $todo->important = $request->has('important');
        $todo->save();

        return redirect()->route('todos')->with('success', 'Task created successfully');
    }

    public function index()
    {
        $todos = Todo::all();
        return view('todos.index', ['todos' => $todos]);
    }
    public function show($id)
    {
        $todo = Todo::find($id);
        return view('todos.show', ['todo' => $todo]);
    }
    public function update(Request $req, $id)
    {
        $todo = Todo::find($id);
        $todo->title = $req->title;
        $todo->description = $req->description;
        $todo->important = $req->important;
        $todo->save();
        return redirect()->route('todos')->with('success', 'Task updated successfully');

    }
    public function destroy($id) {
        $todo = Todo::find($id);
        $todo->delete();
        return redirect()->route('todos')->with('success', 'Task deleted successfully');
    }
}
