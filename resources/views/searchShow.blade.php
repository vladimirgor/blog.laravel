@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>SearchShow</h2>
        <p>{{$request->field}}</p>
        <p>{{$request->searchText}}</p>
    </div> <!-- /container -->
@endsection