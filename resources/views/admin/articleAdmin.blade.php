@extends('layouts.app')

@section('content')

    <div class="container">
        @if ($articles)
            @can('access','articleAdmin') <!-- проверяем права -->
            <div class="panel-body">
                <button class="button  btn-warning"><a  href="{{ route('articleAdd') }}">
                    Add new article</a></button>
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
                            <p>{{ articles_intro($article->content,100) }}<button class="button btn-primary"><a  href="{{ route('articleAdmin',['id' => $article->id,'page' => $articles->currentPage()]) }}" role="button">
                                    Read full article &raquo;</a></button></p>
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