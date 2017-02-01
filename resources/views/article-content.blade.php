@extends('layouts.app')

@section('content')
<div class="container">

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
                            <li class="comment">
                               {{ $comment->user_id }}. {{ $comment->date }}
                                <br>
                                <blockquote class = "comment_text">
                                    <b><i>{{$comment->comment}}</i></b>
                                </blockquote>
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
                        <a class="btn btn-primary" href="{{ route('commentAdd',['id' => $article->id,'page'=>$page]) }}" role="button">
                                Leave your comment</a>
                    @endif
                    <a class="btn btn-success" href="{{ url('/?page='. $page) }}" role="button">
                        Back</a>
                </div>
            @endif
    </div>
    <hr>
</div>
@endsection