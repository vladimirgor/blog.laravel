@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>New Comment</h2>
        <h4>Title</h4>
        <div class="panel panel-primary">
            <div class="panel-body">
                {{$title}}
            </div>
        </div>
        <div class="form">
            <!-- Display Validation Errors -->
            @include('common.errors')
            <!-- New Comment Form -->
            <form id = "comment_form" method="POST" >
                <div class="form-group">
                    <label for="comment">Comment</label>
                    <input type="text" autofocus class="form-control" id="comment" name="comment" placeholder="Comment">
                </div>
                <input type="number" hidden name="article_id" value="{{$article_id}}">
                <input type="number" hidden name="user_id" value="{{$user_id}}">
                <!-- Add Comment Button -->
                <button  type="submit" class="button btn-primary">Submit</button>
                {{ csrf_field() }}
            </form>
        </div>
        <hr>
    </div> <!-- /container -->
@endsection
