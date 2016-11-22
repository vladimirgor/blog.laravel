<?php
/**
 * Created by PhpStorm.
 * User: Владимир
 * Date: 30.10.2016
 * Time: 23:32
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Article;
use Illuminate\Support\Facades\Auth;
class CommentController extends Controller{

    public function add($article_id, $page){

        return view('add-comment',['article_id' => $article_id, 'page' => $page]);
    }

    public function store(Request $request, $article_id, $page){


        $this->validate($request,[

            'comment' => 'required'
        ]);

        $data = $request->all();
        $comment = new Comment;
        $comment->date = date('Y-m-d-H:i:s');
        $comment->article_id = $article_id;
        $comment->fill($data);
        $user = Auth::user();
        $comment->user_id=$user->id;
        $comment->save();
        $article = Article::where('id',$article_id)->first();
        $article->comment++;
        $article->save();
        return redirect(url('/article' .'/'. $article_id .'/' . $page. '/0'));

        ///
        ///
    }
}