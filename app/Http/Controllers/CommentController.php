<?php
/**
 * Created by PhpStorm.
 * User: Владимир
 * Date: 30.10.2016
 * Time: 23:32
 */
/*
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
//use App\Article;
use Illuminate\Support\Facades\Auth;
class CommentController extends Controller{

    public function add($article_id,$title, $page){
        return view('comment.add-comment',['article_id' => $article_id, 'user_id' => Auth::user()->id,
            'title' => $title,'page' => $page]);
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
        $comment->user_id=Auth::user()->id;
        $comment->save();
        return redirect(url('/article' .'/'. $article_id .'/' . $page. '/2'));
    }
    public function addS($article_id,$title,$page,$field,$searchText){

        return view('comment.add_commentSearch',['article_id' => $article_id, 'title' => $title,'page' => $page,
        'field' => $field, 'searchText' => $searchText]);
    }

    public function storeS(Request $request, $article_id, $page,$field, $searchText){


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
        return redirect(url('articleFound' .'/'. $article_id .'/'. $field .'/'. $searchText .'/'
            . $page. '/2'));
    }
}
*/