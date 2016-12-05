@extends('layouts.app')

@section('content')

    <div class="container">
        @if ($articles)
            @can('admin') <!-- проверяем права -->
            <div class="panel-body">
                <a class="btn btn-xs btn-default" href="{{ route('articleAdd') }}" role="button">
                    Add new article</a>
            </div>
            @endcan
            <!-- Example row of columns -->
            <div class="row">

                @foreach( $articles as $article )

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4>{{ $article->title }}</h4> Posted :{{ $article->date }}/ Views :{{ $article->view }}/ Comments :{{ $article->comment }}
                        </div>
                        <div class="panel-body">
                            <p>{{ articles_intro($article->content,100) }}<a class="btn btn-default btn-xs" href="{{ route('articleAdmin',['id' => $article->id,'page' => $articles->currentPage()]) }}" role="button">
                                    Read full article &raquo;</a></p>
                        </div>
                    </div>

                @endforeach

            </div>

            {{ $articles->links() }}

            <hr>
        @endif
    </div> <!-- /container -->
@endsection
<!--
<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
-->