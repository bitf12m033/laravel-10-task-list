@extends('layouts.app')

@section('title' ,$task->title)

@section('content')

<p>{{ $task->description }}</p>

@if( $task->long_description )
    <p>{{ $task->long_description }}</p>
@endif
    <div>
        <a href="{{ route('tasks.edit' ,['task' =>$task]) }}">Edit</a>
    </div>
    <br/>
    <div>
        <form method="POST" action="{{ route('tasks.toggle-complete' , ['task'=>$task]) }}">
            @csrf
            @method('PUT')
            <button type="submit">Mark as {{ $task->completed ? 'NOT Completed' : 'Completed' }}</button>
        </form>
    </div>
    <br/>
    <div>
        <form method="POST" action="{{ route('tasks.destroy' , ['task'=>$task]) }}">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </div>
@endsection
