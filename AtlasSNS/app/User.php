<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

// postsテーブルとのリレーション（主テーブル側）

    public function posts() { //1対多の「多」側なので複数形
        return $this->hasMany('App\Post');
    }


    // リレーションの親子関係
    public function followers()
    {
        return $this->belongsToMany(self::class, 'follows', 'followed_id', 'following_id');
    }

    public function follows()
    {
        return $this->belongsToMany(self::class, 'follows', 'following_id', 'followed_id');
    }

    // --------------------------------------------
    // belongsToMany('User側の外部キーがあるテーブルがあるクラス名',
                    // 'User側の外部キーがあるテーブル名',
                    // 'リレーションを定義しているモデル(User)の外部キー名',
                    // '結合するモデルの外部キー名' )
    // --------------------------------------------


    //  フォロー/フォロー解除/フォローされているか
     // フォローする
    public function follow(Int $user_id)
    {
        return $this->follows()->attach($user_id);
        // 新たに紐づけするにはattach()を使う

    }

    // フォロー解除する
    public function unfollow(Int $user_id)
    {
        return $this->follows()->detach($user_id);
        // 紐付けを解除するにはdetach()を使う
    }

    // フォローしているか
    public function isFollowing(Int $user_id)
    {
        return (boolean) $this->follows()->where('followed_id', $user_id)->first(['follows.id']); //
        // first: 最初の情報を取得する
        // boolean: trueかfolseか返す

    }

    // フォローされているか
    public function isFollowed(Int $user_id)
    {
        return (boolean) $this->followers()->where('following_id', $user_id)->first(['follows.id']);
    }

}
