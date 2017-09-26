<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Comment;
use App\Article;


class ModerController extends Controller
{
    public function showComments(){
        $this->authorize('moderationComments');
        $comments = Comment::select(['id','article_id','user_id','comment',
           'date','status'])->where('status',0)->orderBy('id','desc')->get();
        return view('show-comments')->with(['comments'=>$comments]);
    }

    public function confirmationComments(){
        $this->authorize('moderationComments');
        foreach($_POST as $article_id => $id){
            if ( $article_id != '_token' ) {
                $article = Article::where('id',$article_id)->first();
                $article->comment++;
                $article->save();
                $comment = Comment::where('id',$id)->first();
                $comment->status=1;
                $comment->save();
            }
        }
        $comments = Comment::where('status',0)->get();
        if ( count($comments) != 0 )
            foreach ( $comments as $comment ) {
                $comment->delete();
            }
        return(redirect(url('/moderation')));
    }
}
