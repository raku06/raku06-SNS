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
}
