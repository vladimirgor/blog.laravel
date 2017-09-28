<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Comment;
use App\Article;
use App\Comment_mod;


class ModerController extends Controller
{
    public function showComments(){
        $this->authorize('moderationComments');
        // cleaning Comments_mod table
        DB::table('Comment_mod')->truncate();
        //getting 0 status comments
        $comments = Comment::select(['id','article_id','user_id','comment',
           'date','status'])->where('status',0)->orderBy('id','desc')->get();
                if ( !empty($comments) )
        //saving 0 status information
                {
            foreach ($comments as $comment ){
                $comment_mod = new Comment_mod;
                $comment_mod->id = $comment->id;
                $comment_mod->status = $comment->status;
                $comment_mod->save();
            }
        }
        //show form to confirm comments
        return view('show-comments')->with(['comments'=>$comments]);
    }

    public function confirmationComments(){
        $this->authorize('moderationComments');
        //Getting confirmed comments information
        foreach($_POST as $article_id => $id){
            if ( $article_id != '_token' ) {
                // add 1 to comments  count in Article table
                $article = Article::where('id',$article_id)->first();
                $article->comment++;
                $article->save();
                //change comment status in Comment table
                $comment = Comment::where('id',$id)->first();
                $comment->status=1;
                $comment->save();
                //delete confirmed comment information from Commen_mod table
                $comment_mod = Comment_mod::where('id',$id)->first();
                $comment_mod->delete();
            }
        }
        //deleting non-confirmed comments from Comment and Comment_mod table
        $comments_mod = Comment_mod::all();
        if ( !empty( $comments_mod)  )
            foreach ( $comments_mod  as $comment_mod ) {
                $comment = Comment::where('id',$comment_mod->id)->first();
                $comment->delete();
                $comment_mod->delete();
            }
        return(redirect(url('/moderation')));
    }
}
