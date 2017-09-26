@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Comments confirmation</h2>
        @if ( !$comments->isEmpty() )
            <div class="form">
                <!-- Display Validation Errors -->
                @include('common.errors')
                <form method="POST" action="{{route('confirmationComments')}}">
                    <table class = "table-bordered table-hover">
                        <tr>
                            <th>
                                Comment
                            </th>
                            <th>
                                Confirm
                            </th>
                        </tr>
                        @foreach( $comments as $comment )
                            <tr>
                                <td>
                                    {{ $comment->comment }}
                                </td>
                                <td>
                                    <input type="checkbox"
                                           name = "{{ $comment->article_id }}"
                                           value = "{{ $comment->id }}" >
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <button type="submit" class="button btn-primary">Submit</button>
                    {{ csrf_field() }}
                </form>

            </div>
        @else
            <br><h4>There are no comments to confirm.</h4>
        @endif
        <hr>
    </div> <!-- /container -->
@endsection