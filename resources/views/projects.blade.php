@extends('layouts.master')

@section('content')
    <h1>{{ $title }}</h1>
    @foreach($projects as $data)
        <tr>
                <th>{{ $data->id}}</th>
                <a href="/singleProject?id=<?php echo $data->id; ?>"><th>{{ $data->projectname}}</th></a> <br>
        </tr>
    @endforeach

@endsection