<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Post;

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
}
