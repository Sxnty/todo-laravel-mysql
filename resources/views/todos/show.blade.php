@extends('home')

@section('content')
<div class="container w-50 border p-4">
    <form action="{{ route('todos-edit', [$todo->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        @if (session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
        @endif
        @error('title')
        <p class="alert alert-danger">{{ $message }}</p>
        @enderror
        <div class="form-group">
            <label for="title">Task Title</label>
            <input value="{{$todo->title}}" type="text" class="form-control" id="title" name="title" placeholder="Enter task title">
        </div>
        <div class="form-group">
            <label for="description">Task description</label>
            <textarea class="form-control description" id="description" name="description" rows="3" resize='none'>{{$todo->description}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update task</button>
    </form>


</div>

<style>
    .description {
        resize: none;
    }
</style>

@endsection