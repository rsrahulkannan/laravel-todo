@extends('layouts.app')

@section('styles')
<style>
    .outer {
        width: auto;
    }

    .inner {
        display: inline-block;
    }
</style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>{{ __('Todo') }}</h4>
                        <a href="{{ route('todo.create') }}" class="btn btn-primary">New todo</a>
                    </div>

                    @if (Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    @endif

                    <div class="card-body">
                        @if (count($todos) > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Completed</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($todos as $todo)
                                <tr>
                                    <th>1</th>
                                    <td>{{ $todo->title }}</td>
                                    <td>{{ $todo->description }}</td>
                                    <td>
                                        @if ($todo->is_completed)
                                            <a href="{{ route('todo.show', $todo->id) }}" class="btn btn-sm btn-success">completed</a> 
                                        @else
                                            <a href="{{ route('todo.show', $todo->id) }}" class="btn btn-sm btn-danger">in completed</a>
                                        @endif
                                    </td>
                                    <td class="outer">
                                        <a href="{{ route('todo.show', $todo->id) }}" class="inner btn btn-sm btn-primary">View</a>
                                        <a href="{{ route('todo.edit', $todo->id) }}" class="inner btn btn-sm btn-warning">Edit</a>
                                        <form class="inner" method="POST" action="{{ route('todo.delete') }}">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="todo_id" value="{{ $todo->id }}">
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                            <h4>No todos are created yet</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
