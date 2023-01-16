@extends('layouts.login')

@section('content')
<div class="form-body">
      <div class="user-prof">
      <div>
          <p><img src="{{ asset('storage/'.$user->images)}}" alt="icon"></p>
      </div>
      <div class="prof-inner">
      <div class="user-box">
      <div class="user-inner">
          <p>名前</p>
          <p>{{$user->username}}</p>
      </div>
      <div class="user-inner">
          <p>自己紹介文</p>
          <p>{{$user->bio}}</p>
      </div>
      </div> <!-- user-box -->


      <div class="prof-btn">
        @if (Auth::user()->isFollowing($user->id)) <!-- ボタン切り替えのためのif文 -->
                <form action="{{ route('unfollow', ['user' => $user->id]) }}" method="POST">
                    @csrf
                    @method("DELETE")


                    <button type="submit" class="btn btn-danger">フォロー解除</button>
                </form>
            @else
                <form action="{{ route('follow', ['user' => $user->id]) }}" method="POST">
                    @csrf

                    <button type="submit" class="btn btn-primary">フォローする</button>
                </form>
            @endif
    </div>

      </div>

      </div>
</div>
  <!-- テーブル本体 -->
<div class="card-body">
    @foreach ($posts as $post)
        <div class="post-outer">
        <div class="post-container">
        <!-- プロフィール写真 -->
          <div class="icon"><img src="{{ asset('storage/'.$post->user->images)}}" alt="icon"></div>
          <div class="post-content">
          <div class="post-box">
        <!-- 投稿者名の表示 -->
          <div>{{ $post->user->username }}</div>
        <!-- 投稿詳細 -->
        <div class="post">{{ $post->post }}</div>
        </div> <!-- post-box -->
        <!-- 更新タイムスタンプ -->
          <div class="update_at">{{$post->updated_at}}</div>
          </div> <!-- post-content -->
          </div> <!-- post-container -->
          </div> <!-- post-outer -->

    @endforeach
</div>


@endsection
