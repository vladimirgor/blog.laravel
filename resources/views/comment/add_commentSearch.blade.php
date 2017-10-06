@extends('layouts.app')

@section('content')
    <div class="container">
        &#128269
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
            <form method="POST" action="{{route('commentSStore',['id'=>$article_id, 'page' => $page,
            'field' => $field, 'searchText' => $searchText])}}">
                <div class="form-group">
                    <label for="comment">Comment</label>
                    <input type="text" autofocus class="form-control" id="comment" name="comment" placeholder="Comment">
                </div>

                <!-- Add Comment Button -->
                <button type="submit" class="button btn-primary">Submit</button>

                {{ csrf_field() }}

            </form>

        </div>
        <hr>
    </div> <!-- /container -->
@endsection
