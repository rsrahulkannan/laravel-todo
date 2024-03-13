<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $todos = Todo::all();
        return view('todo.index', [
            'todos' => $todos
        ]);
    }

    public function create()
    {
        return view('todo.create');
    }

    public function store(TodoRequest $request)
    {
        $request->validated();
        try {

            Todo::create([
                'title' => $request->title,
                'description' => $request->description,
                'is_completed' => 0
            ]);

            $request->session()->flash('success', 'Todo created successfully');
        } catch (\Throwable $th) {

            $request->session()->flash('error', $th->getMessage());
        }

        return redirect()->route('todo.index');
    }

    public function show($id)
    {
        $todo = Todo::find($id);
        if(!$todo) {
            request()->session()->flash('error', 'Unable to locate the todo');
            return redirect()->route('todo.index');
        }
        return view('todo.show', [
            'todo' => $todo
        ]);
    }

    public function edit($id)
    {
        $todo = Todo::find($id);
        if(!$todo) {
            request()->session()->flash('error', 'Unable to locate the todo');
            return redirect()->route('todo.index');
        }
        return view('todo.edit', [
            'todo' => $todo
        ]);
    }

    public function update(TodoRequest $request)
    {
        $request->validated();
        $todo = Todo::find($request->todo_id);
        if(!$todo) {
            request()->session()->flash('error', 'Unable to locate the todo');
            return redirect()->route('todo.index');
        }

        try {
            $todo->update([
                'title' => $request->title,
                'description' => $request->description,
                'is_completed' => $request->is_completed ?? 0
            ]);

            $request->session()->flash('success', 'Todo created successfully');
        } catch (\Throwable $th) {

            $request->session()->flash('error', $th->getMessage());
        }

        return redirect()->route('todo.index');
    }

    public function delete(Request $request) {
        $todo = Todo::find($request->todo_id);
        if(!$todo) {
            request()->session()->flash('error', 'Unable to locate the todo');
            return redirect()->route('todo.index');
        }

        $todo->delete();
        $request->session()->flash('success', 'Todo deleted successfully');
        return redirect()->route('todo.index');
    }
}
