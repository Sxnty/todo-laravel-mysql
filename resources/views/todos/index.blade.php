@extends('home')

@section('content')
<div class="container w-50 border p-4">
    <form action="{{ route('todos') }}" method="POST">
        @csrf
        @if (session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
        @endif
        @error('title')
        <p class="alert alert-danger">{{ $message }}</p>
        @enderror
        <div class="form-group">
            <label for="title">* Task Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter task title">
        </div>
        <div class="form-group">
            <label for="description">Task description</label>
            <textarea class="form-control description" id="description" name="description" rows="3" resize='none' placeholder="Enter task description"></textarea>
        </div>
        <div class="form-check my-2">
            <input class="form-check-input" type="checkbox" id="important" name="important">
            <label class="form-check-label" for="flexCheckDefault">
                Important
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Add task</button>
    </form>
    <hr />
    @if (count($todos) == 0)
    <p class="font-weight-bold">Empty task list.</p>
    @endif
    @foreach ($todos as $todo)
    <div class="row py-1 border mt-2 rounded p-2">
        <div class="col-md-9 d-flex  flex-column justify-content-start">
            <h5 class="fit-content"> @if ($todo->important)
                <i class="bi bi-star-fill size-sm"></i>
                
                @endif{{$todo->title}}
            </h5>
            <p>{{$todo->description}}</p>

        </div>
        <div class="col-md-3 d-flex justify-content-end">
            <form action="{{ route('todos-destroy', [$todo->id]) }}" method="POST" class="mx-2">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger btn-md"><i class="bi bi-trash"></i></button>
            </form>
            <form action="{{ route('todos-edit', [$todo->id]) }}">
                @csrf
                <button class="btn btn-success btn-md"><i class="bi bi-pencil-square"></i></button>
            </form>
        </div>
    </div>
    @endforeach

</div>
@endsection

<style>
    .description {
        resize: none;
    }
</style>