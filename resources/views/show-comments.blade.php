@extends('layouts.app')

@section('content')

    @if ( !$comments->isEmpty() )

        <div class="container">

            <div class="row">

                @foreach( $comments as $comment )

                    <div class="panel panel-primary">

                        <div class="panel-body">
                            <p>{{ $comment->comment }}</p>
                        </div>
                    </div>

                @endforeach

            </div>

            {{ $comments->links() }}

            <hr>
        </div> <!-- /container -->

    @endif

@endsection