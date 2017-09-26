@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Comments confirmation</h2>
        @if ( !$comments->isEmpty() )
            <div class="form">
                <!-- Display Validation Errors -->
                @include('common.errors')
                <form method="POST" action="{{route('confirmationComments')}}">
                    <div class="form-group">
                        @foreach( $comments as $comment )
                            {{ $comment->comment }} <input type="checkbox"  name = "{{ $comment->article_id }}" value = "{{ $comment->id }}" >
                             confirm<br>
                        @endforeach
                    </div>
                    <button type="submit" class="button btn-primary">Submit</button>
                    {{ csrf_field() }}
                </form>

            </div>
        @else
            <br><h4>There are no comments to confirm</h4>
        @endif
        <hr>
    </div> <!-- /container -->
@endsection