<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Follow;
use Auth;

class UsersController extends Controller
{
    //
    public function profile(){
        return view('users.profile');
    }
    public function search(){
        $users = User::get();
        return view('users.search')
        ->with([
                'users' => $users,
            ]);
    }


   //検索機能
    public function index(Request $request)
    {

     // 検索フォームで入力された値を取得する
        $search = $request->input('search');

        // ユーザーネームと部分一致するものがあれば、$usersとしてgetする
        $users = User::query()->where('username', 'like', '%'.$search.'%')->get();


        // ビューにusersとsearchを変数として渡す
        return view('users.search')
            ->with([
                'users' => $users,
                'search' => $search,
            ]);
    }

        // フォロー
    public function follow(User $user)
    {
        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if(!$is_following) {
            // フォローしていなければフォローする
            $follower->follow($user->id);
            return back(); // back() : 元々きたページに戻る
                           // 今回の場合、return redirect('/search')と同じ意味
        }
    }

    // フォロー解除
    public function unfollow(User $user)
    {
        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if($is_following) {
            // フォローしていればフォローを解除する
            $follower->unfollow($user->id);
            return back();
        }
    }


    public function follow_list(){

        // ↓全ての投稿を取得（ログインしてるユーザーのみにするから消し）
        // $posts = Post::get();

        // フォローしているユーザーのidを取得
        $following_id = Auth::user()->follows()->pluck('followed_id');
        // pluck()は、テーブル名()->pluck('カラム名') でテーブル内の欲しい情報だけ拾い出せる。
        // 今回は、followsテーブルからログインしているユーザーがフォローされているidを拾ってくるような記述となっている。

        return view('follows.followList',[
            'follows'=> $following_id // 配列として取得
        ]);
}


    public function user_update(Request $request)
    {
        $id = $request->input('id');
        $up_username = $request->input('username');
        $up_mail = $request->input('mail');
        $up_password = $request->input('password');
        $up_bio = $request->input('bio');

        $filename = $request->images->getClientOriginalName();
        $up_images = $request->images->storeAs('', $filename,'public');


        \DB::table('users')
            ->where('id', $id)
            ->update([
                'username' => $up_username,
                'mail' => $up_mail,
                'password' => bcrypt($up_password),
                'bio' => $up_bio,
                'images' => $up_images,
            ]);



        return redirect('top');
    }

}
