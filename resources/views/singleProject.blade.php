@extends('layouts.master')

@section('content')
    <h1>{{ $title }}</h1>
    @foreach($task as $data)
        <tr>
                <th>{{ $data->taskname}}</th>
                <th>{{ $data->asignedTo}}</th> 
                <th>{{ $data->estimatedHours}}</th> <br>
        </tr>
    @endforeach

@endsection