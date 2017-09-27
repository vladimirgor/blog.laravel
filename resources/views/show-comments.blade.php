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
                            <th class = "confirm_th">
                                Comment text
                            </th>
                            <th class = "confirm_th">
                               Click to confirm the comment*
                            </th>
                        </tr>
                        @foreach( $comments as $comment )
                            <tr>
                                <td class = "confirm_td">
                                    {{ $comment->comment }}
                                </td>
                                <td class = "confirm_td_ch">
                                    <input type="checkbox"
                                           name = "{{ $comment->article_id }}"
                                           value = "{{ $comment->id }}" >
                                </td>
                            </tr>
                        @endforeach
                    </table><br>
                    <h4>*Unclicked comments will be deleted</h4>
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