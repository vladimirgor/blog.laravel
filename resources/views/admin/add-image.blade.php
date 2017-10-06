@extends ('layouts.app')

@section('content')
    <div class="container">
        <h2>New Image</h2>


        <div class="form">
            <!-- Display Validation Errors -->
            @include('common.errors')
            <!-- New Comment Form -->
            <form enctype="multipart/form-data" method="POST" action="{{route('imageStore',['id'=>$article_id, 'page' => $page])}}">
                <div class="form-group">
                    <label for="comment">Image</label>
                    <input type="file"  class="form-control" id="image" name="image" placeholder="Image">
                </div>

                <!-- Add Comment Button -->
                <button type="submit" class="button btn-primary">Submit</button>

                {{ csrf_field() }}

            </form>

        </div>

        <hr>
    </div> <!-- /container -->
@endsection