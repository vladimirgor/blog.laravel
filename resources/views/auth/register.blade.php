@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}
                        <!-- name -->
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input autofocus id="name" type="text" class="form-control" name="name"
                                       value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- login -->
                        <div class="form-group{{ $errors->has('login') ? ' has-error' : '' }}">
                            <label for="login" class="col-md-4 control-label">Login</label>

                            <div class="col-md-6">
                                <input id="login" type="text" class="form-control" name="login"
                                       value="{{ old('login') }}">

                                @if ($errors->has('login'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('login') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- email -->
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email"
                                       value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- password -->

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password_login" class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input id="password_login" type="password" class="form-control " name="password"
                                           aria-describedby="basic-addon1">
                                    <span class="input-group-addon eye" id="basic-addon1">
                                        <span id = "show_password_login" class="glyphicon glyphicon-eye-open"
                                              aria-hidden="true">
                                        </span>
                                    </span>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <!-- password confirm -->
                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password_confirm" class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input id="password_confirm" type="password" class="form-control "
                                           name="password_confirmation"
                                           aria-describedby="basic-addon2">
                                    <span class="input-group-addon eye" id="basic-addon2">
                                        <span id = "show_password_confirm" class="glyphicon glyphicon-eye-open"
                                              aria-hidden="true">
                                        </span>
                                    </span>
                                </div>
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="button btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Register
                                </button>
                            </div>
                        </div>
                        @if(Session::has('message'))
                            <strong>{!!Session::get('message')!!}</strong>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
