<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Article;
use App\User;

class SearchController extends Controller
{
    public function searchForm(){

        return view('searchForm');
    }
    public function searchDetails(Request $request){

        $this->validate($request,[
            'searchText' => 'required',
        ]);
        return redirect(url('search' .'/'. $request->field .'/' . $request->searchText));
    }
    public function search($field,$searchText){

        $articles = Article::select(['id','title','content','comment',
            'view','image_path','date'])->
        where($field,'LIKE','%'.$searchText.'%')->
        orderBy('id','desc')->paginate(PER_PAGE);
        return view('articlesFound')->with(['articles'=>$articles,
            'field'=>$field,'searchText'=>$searchText
        ]);
    }
    public function show($id, $field, $searchText, $page, $step=1){
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
        return view('article-contentFound')->with([
            'comments'=>$comments,
            'page' => $page,
            'field' => $field,
            'searchText' => $searchText,
            'article'=>$article,
            'step'=>$step
        ]);
    }
}
