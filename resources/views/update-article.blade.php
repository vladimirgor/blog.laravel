@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Article update </h2>

        <div class="form">
            <!-- Display Validation Errors -->
            @include('common.errors')

            <form method="POST" action="{{route('updateStore',['id'=>$article->id, 'page' => $page])}}">

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" required class="form-control" id="title" name="title" value = "{{ $article->title }}" >
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" required id = "content" name="content" >{{ $article->content }}</textarea>
                </div>

                <div class="form-group">
                    <label for="view">View</label>
                    <input type="text" class="form-control"  id = "view" name="view" value="{{ $article->view }}">
                </div>

                <div class="form-group">
                    <label for="image_path">Image_Path</label>
                    <input type="text" class="form-control" id = "image_path" name="image_path" value="{{ $article->image_path }}">
                </div>

                <button type="submit" class="btn btn-default">Submit</button>

                {{ csrf_field() }}
            </form>

        </div>

        <hr>
    </div> <!-- /container -->
@endsection