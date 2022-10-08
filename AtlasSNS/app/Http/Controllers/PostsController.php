<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Follow;
use Auth;
use Validator;

class PostsController extends Controller
{
    // ホーム画面でそれぞれのページに飛べるようにルートを設定
    public function index(){
        return view('posts.index');
    }

    public function follow(){
        return view('follows.followList');
    }

    public function follower(){
        return view('follows.followerList');
    }

    public function search(){
        return view('users.search');
    }


    //ホーム画面で今までの投稿を取得して表示
    public function posts(){

        // ↓全ての投稿を取得（ログインしてるユーザーのみにするから消し）
        // $posts = Post::get();

        // フォローしているユーザーのidを取得
        $following_id = Auth::user()->follows()->pluck('followed_id');
        // pluck()は、テーブル名()->pluck('カラム名') でテーブル内の欲しい情報だけ拾い出せる。
        // 今回は、followsテーブルからログインしているユーザーがフォローされているidを拾ってくるような記述となっている。

        $my_id = Auth::user()->id;

        // フォローしているユーザーのidを元に投稿内容を取得
        $posts = Post::with('user')->whereIn('posts.user_id', [$following_id, $my_id])->get();
        // whereInメソッドは、
        // whereIn( '判定したいテーブル名.判定したいカラム名', [判定したいカラム名の値として期待されるものを配列状に記載する])
        // のように記載する。

        return view('posts.index',[
            'posts'=> $posts // 配列として取得
        ]);
    }


    //
    public function store(Request $request){

    //バリデーション
    $validator = Validator::make($request->all(), [
        'post_content' => 'required|max:255',
        ]);

    //バリデーション:エラー
    if ($validator->fails()) {
        return redirect('/top')
        ->withInput()
        ->withErrors($validator);
        }

    //以下に登録処理を記述（Eloquentモデル）
    $posts = new Post;
    $posts->user_id = Auth::id(); //ここでログインしているユーザidを登録しています
    $posts->post = $request->post_content;
    $posts->save();

    return redirect('/top');
}


 public function update(Request $request)
    {
        $id = $request->input('id');
        $up_post = $request->input('post');
        \DB::table('posts')
            ->where('id', $id)
            ->update(
                ['post' => $up_post]
            );

        return redirect('top');
    }


    public function delete($id){
        \DB::table('posts')
            ->where('id', $id)
            ->delete();

        return redirect('/top');
    }

}
