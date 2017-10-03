<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Article;
use App\User;

class IndexController extends Controller
{
    protected $message;
    protected $header;

    public function __construct(){

    }
    public function index(){

        $articles = Article::select(['id','title','content','comment',
            'view','image_path','date'])->orderBy('id','desc')->paginate(PER_PAGE)
        ;
        return view('article')->with(['articles'=>$articles]);
    }
    public function show($id, $page, $step=1){
        $article = Article::select(['id','title','content','view','image_path'])->where('id',$id)->first();

        $comments = Article::find($id)->comments->where('status',1);
        if ( $step == 1 ){
            $article->view++;
            $article->save();
        }
        foreach ($comments as $key => $comment ){
            $user = User::find($comment->user_id);
            $comment->user_id = $user->name;// change user_id by name
        }
        return view('article-content')->with([
            'comments'=>$comments,
            'page' => $page,
            'article'=>$article,
            'step'=>$step
        ]);
    }

}
