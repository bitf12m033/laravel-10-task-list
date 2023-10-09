@extends('layouts.app')
@section('title' ,'Task List')

@section('content')
<div>
    <ul>
        @forelse ($tasks as $task )
        <a href="{{route('tasks.show' ,['task'=>$task->id])}}">
            <li>{{$task->title}}</li>
        </a>    
        @empty
        <strong>No Record</strong>
        @endforelse
    </ul>
    <!-- @if (count($tasks))
        <strong>There are Tasks</strong>
        <ul>
            @foreach ($tasks as $task )
            <li>{{$task->title}}</li>
            @endforeach

        </ul>
    @else
        <strong>No Record</strong>    
    @endif -->
    @if($tasks->count())
        <nav>{{ $tasks->links() }}</nav>
        
    @endif
</div>


@endsection