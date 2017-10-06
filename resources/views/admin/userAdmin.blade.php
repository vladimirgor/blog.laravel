@extends('layouts.app')

@section('content')

    <div class="container">
        @if ($users)
            <!-- Example row of columns -->
            <div class="row">
                <table class="table table-hover table-condensed table-bordered">
                    <tr>
                        <td>Id</td><td>Name</td><td>Login</td><td>Email</td><td>Action</td>
                    </tr>
                    @foreach( $users as $user )
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->login }}</td>
                            <td>{{ $user->email }}</td>
                            <td><a class="btn-danger" href="{{ route('userDelete',['user'=>$user->id]) }}">
                                    Delete User</a></td>
                        </tr>
                    @endforeach
                </table>
            </div>
            {{ $users->links() }}
            <hr>
        @endif
    </div> <!-- /container -->

@endsection
