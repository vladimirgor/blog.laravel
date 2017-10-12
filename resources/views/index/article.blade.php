@extends('layouts.app')

@section('content')

@if ( !$articles->isEmpty() )
    <?php $items = ( $articles->currentPage() == $articles->lastPage()) ?
            $articles->total()- ($articles->currentPage()-1)*PER_PAGE :
            PER_PAGE
    ?>
<div>
    <div class="row empty">
        <div class="col-md-4 empty"></div>
        <div class="col-md-4 empty">
            <div id="carousel" class="carousel slide div_car" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel" data-slide-to="0" class="active"><p class = "slide_number"></p></li>
                    <?php for ($i = 1; $i < $items; $i++ ) {?>
                    <li data-target="#carousel" data-slide-to="<?=$i?>"><p class = "slide_number"></p></li>
                    <?}?>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">

                    <div class="item active">
                        <img class="image_crs img-responsive img-rounded" src="<?=$articles[0]['image_path']?>"  alt="Image">
                        <div class="carousel-caption empty">
                            <p class = "title_crs"><?=$articles[0]['title']?></p>
                        </div>
                    </div>

                    <?php  for ($i = 1; $i < $items; $i++ ) { ?>

                    <div class="item">
                        <img class="image_crs img-responsive img-rounded" src="<?=$articles[$i]['image_path']?>"  alt="Image">
                        <div class="carousel-caption empty">
                            <p class = "title_crs"><?=$articles[$i]['title']?></p>
                        </div>
                    </div>
                    <?}?>

                </div>
            </div>
        </div>
        <div class="col-md-4 empty"></div>
    </div>
    <div class="row">

        @foreach( $articles as $article )

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h5>{{ $article->title }}</h5> Posted :{{ $article->date }}/ Views :{{ $article->view }}/ Comments :{{ $article->comment }}
                </div>
                <div class="panel-body">
                    <p>{{ articles_intro($article->content,100) }}<button class="button btn-primary">
                            <a href="{{ route('articleShow',['id' => $article->id,
                            'page' => $articles->currentPage()]) }}" role="button">
                            Read full article &raquo;</a></button></p>
                </div>
            </div>

        @endforeach

    </div>

    {{ $articles->links() }}

    <hr>
</div> 

@endif

@endsection
