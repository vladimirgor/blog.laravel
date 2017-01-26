@extends('layouts.mes')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-<?=$level?>">
                    <div class="panel-heading"><?=$title?></div>

                    <div class="panel-body">
                        <?=$text?>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection