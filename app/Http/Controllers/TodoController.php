<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        return view('todo.index');
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

            $request->session()->flash('alert-success', 'Todo created successfully');
        } catch (\Throwable $th) {

            $request->session()->flash('alert-danger', $th->getMessage());
        }

        return redirect()->route('todo.index');
    }
}
