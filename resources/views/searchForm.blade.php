@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Search details&#128269</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('searchDetails') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="field" value="title" checked> Title
                                        </label>
                                    </div>
                                </div>
                            </div><div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="field" value="content"> Content
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('searchText') ? ' has-error' : '' }}">
                                <label for="search" class="col-md-4 control-label">Search text</label>

                                <div class="col-md-6">
                                    <input autofocus id="searh" type="text" class="form-control" name="searchText" value="{{ old('searchText') }}">

                                    @if ($errors->has('searchText'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('searchText') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="button btn-primary">
                                        <i class="fa fa-btn fa-sign-in"></i> Submit
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
