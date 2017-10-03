@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Search details</h2>
        <div class="form">
            <!-- New Comment Form -->
            <form method="POST" action="{{route('searchDetails')}}">
                <h4>Please, choose field to search in.</h4>
                <div class="radio">
                    <label>
                        <input type="radio" name="field"  value="title" checked>
                        Title
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="field"  value="content">
                        Content
                    </label>
                </div>
                <div class="form-group">
                    <h4>Please, input detail to find.</h4>
                    <input type="text"  class="form-control" id="SearchText" name="searchText">
                </div>
                <!-- Display Validation Errors -->
                @include('common.errors')
                <!-- Add Comment Button -->
                <button type="submit" class="button btn-primary">Submit</button>

                {{ csrf_field() }}

            </form>

        </div>
        <hr>
    </div> <!-- /container -->
@endsection