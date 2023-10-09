@extends('layouts.app')
@section('title' ,'Task List')

@section('content')
<div>
    <div>
        <a href="{{ route('tasks.create') }}">Create Task</a>
    </div>
    <br/>
    <ul>
        @forelse ($tasks as $task )
        <a href="{{ route('tasks.show' ,['task'=>$task->id]) }}">
            <li>{{ $task->title }}</li>
        </a>    
        @empty
        <strong>No Record</strong>
        @endforelse
    </ul>
    @if($tasks->count())
        <nav>{{ $tasks->links() }}</nav>
        
    @endif
</div>


@endsection