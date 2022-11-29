<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Post;
use App\Follow;
use Auth;

class UsersController extends Controller
{
    //
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255'],
            'mail' => ['required', 'string', 'email', 'max:255',],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
            'bio' => ['required', 'string', 'max:255'],
            'images' => ['image'],
        ]);
    }



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

        // フォローしているユーザーのidを取得
        $following_id = Auth::user()->follows()->pluck('followed_id');
        // pluck()は、テーブル名()->pluck('カラム名') でテーブル内の欲しい情報だけ拾い出せる。
        // 今回は、followsテーブルからログインしているユーザーがフォローされているidを拾ってくるような記述となっている。

        // フォローしているユーザーのidを元に投稿内容を取得
        $posts = Post::with('user')->whereIn('posts.user_id', $following_id)->get();

        return view('follows.followList')
        ->with([
            'posts'=> $posts, // 配列として取得
        ]);

}

    public function follower_list(){

        // フォローされているユーザーのidを取得
        $followed_id = Auth::user()->followers()->pluck('following_id');
        // pluck()は、テーブル名()->pluck('カラム名') でテーブル内の欲しい情報だけ拾い出せる。
        // 今回は、followsテーブルからログインしているユーザーがフォローされているidを拾ってくるような記述となっている。

        // フォローされているユーザーのidを元に投稿内容を取得
        $posts = Post::whereIn('posts.user_id', $followed_id)->get();

        return view('follows.followerList')
        ->with([
            'posts'=> $posts, // 配列として取得
        ]);

}


    public function user_update(Request $request)
    {
        $id = $request->input('id');
        $up_username = $request->input('username');
        $up_mail = $request->input('mail');
        $up_password = $request->input('password');
        $up_bio = $request->input('bio');

        if($request->filled('images')){
            $filename = $request->images->getClientOriginalName();
            $up_images = $request->images->storeAs('', $filename,'public');
        }


        $data = $request->input();
        $validator = $this ->validator($data);
             if ($validator->fails()) {
            return redirect('/profile')
                        ->withErrors($validator)
                        ->withInput();
        }else{


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

    public function userprofile($id){

        $user = User::where('id',$id)->first();
        $posts = Post::with('user')->where('user_id',$id)->get();

        return view('follows.userprofile')
        ->with([
            'user' =>$user,
            'posts'=> $posts, // 配列として取得
        ]);
    }

}
