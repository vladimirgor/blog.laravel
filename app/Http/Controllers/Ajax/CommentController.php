<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Comment;

class CommentController extends Controller
{
    public function comment(Request $request)    {
        $this->validate($request,[
            'comment' => 'required'
        ]);
        $result = false;
        if ( $request->ajax() && !empty($request->comment) )
        {
            $data = $request->all();
            $comment = new Comment;
            $comment->date = date('Y-m-d-H:i:s');
            $comment->fill($data);
            $comment->save();
            $result = true;
        }
        return response()->json(['result' => $result]);
    }
}