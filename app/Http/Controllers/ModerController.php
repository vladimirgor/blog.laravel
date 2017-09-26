<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Comment;

class ModerController extends Controller
{
    public function showComments(){
        $this->authorize('moderationComments');
        $comments = Comment::select(['id','article_id','user_id','comment',
           'date','status'])->where('status',0)->orderBy('id','desc')
            ->paginate(PER_PAGE_COMMENT)
        ;
        return view('show-comments')->with(['comments'=>$comments]);
    }
}
