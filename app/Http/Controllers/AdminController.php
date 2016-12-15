<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Comment;
use App\User;
class AdminController extends Controller
{

    public function __construct(){

    }
    public function index(){

        $this->authorize('admin');

        $articles = Article::select(['id','title','content','comment',
            'view','image_path','date'])->orderBy('id','desc')->paginate(PER_PAGE);

        return view('articleAdmin',[
            'articles'=>$articles]);
    }
    public function indexUser(){

        $this->authorize('user');

        $users = User::select(['id','name','login','email'
          ])->orderBy('id','desc')->paginate(PER_PAGE_USER);

        return view('userAdmin',[
            'users'=>$users]);
    }
    public function show($id,$page,$step=1){

        $this->authorize('article');

        $article = Article::select(['id','title','content','view','image_path'])->where('id',$id)->first();

        $comments = Article::find($id)->comments;
        foreach ($comments as $key => $comment ){
            $user = User::find($comment->user_id);
            $comment->user_id = $user->name;// change user_id by name
        }

        return view('article-contentAdmin')->with([
            'comments'=>$comments,
            'page' => $page,
            'article'=>$article]);
    }
    public function add(){

        $this->authorize('addNewArticle');

        return view('add-content');
    }

    public function store(Request $request){

        $this->validate($request,[
            'title' => 'required',
            'content' =>  'required'
        ]);

        $data = $request->all();
        $article = new Article;
        $article->date = date('Y-m-d');
        $article->fill($data);
        $article->save();

        return redirect('admin');

    }
    public function imageAdd($id, $page){

        $this->authorize('addImage');

        return view('add-image',['article_id'=>$id, 'page' => $page]);
    }

    public function imageStore(Request $request, $id, $page){

        if ( $request->hasFile('image') ) {
            if ($request->file('image')->isValid()) {
                $file_name = $request->image->getClientOriginalName();
                $request->image->move('images',$file_name);
                $article = Article::find($id);
                $article->image_path = '/' . IMAGES_FILE .'/'. $file_name;
                $article->save();
            }
        }
        return redirect(url('admin/article' .'/'. $id .'/' . $page. '/0'));

    }

    public function update($id,$page){

        $this->authorize('updateArticle');

        $article = Article::select(['id','title','content','view','image_path'])->where('id',$id)->first();
        return view('update-article',[ 'article' => $article, 'page' => $page]);
    }

    public function updateStore(Request $request, $id, $page){
        $this->validate($request,[
            'title' => 'required',
            'content' =>  'required'
        ]);
        $data = $request->all();
        $article = Article::select(['id','title','content'])->where('id',$id)->first();
        $article->fill($data);
        $article->save();
        return redirect(url('admin/article' .'/'. $id .'/' . $page. '/0'));

    }
    public function deleteComment($id, $article_id, $page){

        $this->authorize('deleteComment');

        $comment = Comment::find($id);
        $article = Article::find($article_id);
        $article->comment--;
        $article->save();
        $comment->delete();
        return redirect(url('admin/article' .'/'. $article_id .'/' . $page. '/0'));
    }
    public function deleteArticle($id){

        $this->authorize('deleteArticle');

        $article = Article::find($id);
        $comments = Article::find($id)->comments;
        foreach( $comments as $comment) {
            $comment->delete();
        }
        if (file_exists('../public'.$article->image_path))
            if ( $article->image_path )unlink('../public'.$article->image_path);
        $article->delete();
        return redirect('admin');
    }
    public function deleteUser($id){

        $this->authorize('deleteUser');
        $user = User::find($id);
        $comments= User::find($id)->comments;

        foreach( $comments as $comment) {
            $article = Article::find($comment->article_id);
            $comment->delete();
            $article->comment--;
            $article->save();
        }
        $user->delete();
        return redirect('admin/user');
    }
}
