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
                    <input type="text" required autofocus class="form-control" id="comment"
                           name="comment" placeholder="Input your comment here, please.">
                </div>
                <input type="number" hidden name="article_id" value="{{$article_id}}">
                <input type="number" hidden name="user_id" value="{{$user_id}}">
                <div id="comment_message" class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Thanks a lot for the comment!</strong> To be published your comment must pass the moderation procedure.
                </div>
                <div id="comment_error" class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>An error occurred while sending the comment.</strong> Apply to the administrator, please.
                </div>
                <!-- Add Comment Button -->
                <button  type="submit" class="button btn-primary">Submit</button>
                {{ csrf_field() }}
            </form>
        </div>
        <hr>
    </div> <!-- /container -->
@endsection
