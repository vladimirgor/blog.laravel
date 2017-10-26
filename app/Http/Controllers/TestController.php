<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests;
use App\Article;

class TestController extends Controller
{
    public function index(){
       // dump($page);

        $articles = Article::select(['id','title','content','comment',
            'view','image_path','date'])->orderBy('id','desc')->paginate(env('PER_PAGE'));
        //get();
        //dump($articles);
       // $articles = new LengthAwarePaginator($collection, $collection->count(), env('PER_PAGE'));
        //$articles->resolveCurrentPage($page);
        //dump($articles->links());
        //$links = str_replace('?page=', '/page/',$articles->links());
        //dump($links);

        return view('article_test')->with(['articles'=>$articles]);
       // return('TestController');
    }
}
