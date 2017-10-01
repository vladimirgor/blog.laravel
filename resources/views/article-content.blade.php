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
                @if ($step == 2 )
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Thanks a lot for the comment!</strong> To be published your comment must pass the moderation procedure.
                    </div>
                @endif
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
                        <button class="button btn-primary"><a  href="{{ route('commentAdd',['id' => $article->id,'title'=>$article->title,'page'=>$page]) }}" role="button">
                                Leave your comment</a></button>
                    @endif
                    <!--<a class="btn btn-success" href="{{ url('/?page='. $page) }}" role="button">
                        Back</a>-->
                        <button class="button btn-success"><a href="{{ url('/?page='. $page) }}" role="button">
                                Back</a></button>
                </div>
            @endif
    </div>
    <hr>
</div>
@endsection