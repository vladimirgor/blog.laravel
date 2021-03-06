@extends('layouts.app')

@section('content')
    <div class="container">
        &#128269
        <div class="panel panel-primary">
            @if( $article )
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $article->title }}</h3>
                </div>
                @if ( !$article->image_path  == NULL )
                    <p>
                        <img class = "art_img img-responsive img-rounded" src="{{$article->image_path}}">
                    </p>
                @endif
                <div class="panel-body content">
                    {!! nl2br($article->content) !!}
                </div>
                <p class="clear"><p>
                    COMMENTS:
                @if ( $comments )
                    <ul>
                        @foreach ( $comments as $comment )
                            <div class ="sharp"></div>
                            <li class="comment">
                                {{ $comment->user_id }}. {{ $comment->date }}
                                <br>
                                <p class = "comment_text">
                                    <b><i>{{$comment->comment}}</i></b>
                                </p>
                            </li>
                        @endforeach
                    </ul>
                @endif
                <div class="panel-body">
                    @if (Auth::guest())
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Warning!</strong> To leave your comment login, please.
                        </div>
                    @else
                        <hr>
                        <div class="form">
                            <!-- Display Validation Errors -->
                            @include('common.errors')
                            <!-- New Comment Form -->
                            <form id = "comment_form" method="POST" >
                                <div class="form-group">
                                    <textarea class="form-control comment_area" required  name="comment"
                                              rows="3" placeholder="Input your comment here, please."></textarea>
                                </div>
                                <input type="number" hidden name="article_id" value="{{$article->id}}">
                                <input type="number" hidden name="user_id" value="{{Auth::user()->id}}">
                                <div id="comment_message" class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <strong>Thanks a lot for the comment!</strong> To be published your comment must pass the moderation procedure.
                                </div>
                                <div id="comment_error" class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <strong>An error occurred while sending the comment.</strong> Apply to the administrator, please.
                                </div>
                                <!-- Add Comment Button -->
                                <button  type="submit" class="button-comment btn-primary">Submit comment</button>
                                {{ csrf_field() }}
                            </form>
                        </div>
                        <hr>
                    @endif
                    <button class="button btn-success"><a href="{{ url('search/'.$field.'/'.$searchText.
                    '/'.'?page='. $page) }}" role="button">
                            Back</a></button>
                </div>
            @endif
        </div>
        <hr>
    </div>
@endsection