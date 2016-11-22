@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Article </h2>
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
                    {!! $article->content !!}
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
                                <div>
                                    <a class="btn btn-danger btn-xs" href="{{ route('commentDelete',['id'=>$comment->id
                                    ,'article_id' => $comment->article_id, 'page' => $page]) }}" role="button">
                                        Delete Comment</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
                <ul class="nav nav-pills">
                    @if ( $article->image_path == NULL )
                    <li role="presentation" class="active"><a class="btn-primary" href="{{ route('imageAdd',['id' => $article->id,'page'=>$page]) }}" >
                            Add image</a></li>
                    @endif
                    <li role="presentation"><a class="btn-warning" href="{{ route('articleUpdate',['id' => $article->id,'page'=>$page]) }}">
                            Update</a></li>
                    <li role="presentation"><a class="btn-danger" href="{{ route('articleDelete',['article'=>$article->id]) }}">
                            Delete Article</a></li>
                    <li role="presentation"><a  class="btn-success" href="{{ url('admin/?page='. $page) }}" >
                            Back</a></li>
                </ul>
            @endif
        </div>
        <hr>
    </div>
@endsection
