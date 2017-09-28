<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Comment;
use App\Article;
use App\Comment_mod;


class ModerController extends Controller
{
    public function showComments(){
        $this->authorize('moderationComments');
        $comments_mod = Comment_mod::all();
        if ( !empty($comments_mod)) {
            foreach ( $comments_mod  as $comment_mod ) {
                $comment_mod->delete();
            }
        }
        $comments = Comment::select(['id','article_id','user_id','comment',
           'date','status'])->where('status',0)->orderBy('id','desc')->get();
        if ( !empty($comments) )
        {
            foreach ($comments as $comment ){
                $comment_mod = new Comment_mod;
                $comment_mod->id = $comment->id;
                $comment_mod->status = $comment->status;
                $comment_mod->save();
            }
        }
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
                $comment_mod = Comment_mod::where('id',$id)->first();
                $comment_mod->delete();
            }
        }
        $comments_mod = Comment_mod::where('status',0)->get();
        if ( !empty( $comments_mod)  )
            foreach ( $comments_mod  as $comment_mod ) {
                $comment = Comment::where('id',$comment_mod->id)->first();
                $comment->delete();
                $comment_mod->delete();
            }
        return(redirect(url('/moderation')));
    }
}
