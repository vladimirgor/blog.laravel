@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Search</h2>
        <div class="form">
            <!-- New Comment Form -->
            <form method="POST" action="{{route('searchShow')}}">
                <div class="radio">
                    <label>
                        <input type="radio" name="field" id="title" value="title" checked>
                        Title
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="field" id="content" value="content">
                        Content
                    </label>
                </div>
                <div class="form-group">
                    <label for="comment">SearchText</label>
                    <input type="text"  class="form-control" id="SearchText" name="searchText" placeholder="SearchText">
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