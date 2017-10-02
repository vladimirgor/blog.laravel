@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>New Article </h2>

        <div class="form">
            <!-- Display Validation Errors -->
            @include('common.errors')

            <form method="POST" action="{{route('articleStore')}}">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" autofocus required class="form-control" id="title" name="title" placeholder="Title">
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class=" form-control" required id = "content" name="content" placeholder="Content"></textarea>
                 </div>

                <div class="form-group">
                    <label for="image">Image Address</label>
                    <input type="text" class=" form-control"  id = "image" name="image_path" placeholder="Image Address">
                </div>
                <button type="submit" class="button btn-primary">Submit</button>

                   {{ csrf_field() }}
            </form>

        </div>

        <hr>
    </div> <!-- /container -->
@endsection