@extends('layouts.login')

@section('content')
<div class="card-body">
  <table class="table table-striped task-table">
  <!-- テーブルヘッダ -->
  <thead>
    <tr>
      <td class="table-text">
          <p><img src="{{ asset('storage/'.$posts->user->images)}}" alt="icon"></p>
      </td>
      <td class="table-text">
          <p>名前</p>
          <p>"{{$posts->user->username}}"</p>
      </td>
      <td class="table-text">
          <p>自己紹介文</p>
          <p>"{{$posts->user->bio}}"</p>
      </td>
      <td>
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
      </td>
    </tr>
  </thead>
  <!-- テーブル本体 -->
  <tbody>
    @foreach ($posts as $post)
      <tr>
        <!-- プロフィール写真 -->
        <td class="table-text">
          <div><img src="{{ asset('storage/'.$post->user->images)}}" alt="icon"></div>
        </td>
        <!-- 投稿者名の表示 -->
        <td class="table-text">
          <div>{{ $post->user->username }}</div>
        </td>
        <!-- 投稿詳細 -->
        <td class="table-text">
          <div>{{ $post->post }}</div>
        </td>
        <!-- 更新タイムスタンプ -->
        <td class="table-text">
          <div>{{$post->updated_at}}</div>
        </td>
    </tr>
    @endforeach



@endsection
