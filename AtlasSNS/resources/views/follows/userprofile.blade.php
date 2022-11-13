@extends('layouts.login')

@section('content')
      <div>
          <p><img src="{{ asset('storage/'.$user->images)}}" alt="icon"></p>
      </div>
      <div>
          <p>名前</p>
          <p>{{$user->username}}</p>
      </div>
      <div>
          <p>自己紹介文</p>
          <p>{{$user->bio}}</p>
      </div>
      <div>
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
  <!-- テーブル本体 -->
<div class="card-body">
<table class="table table-striped task-table">
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

  </tbody>
</table>
</div>
    @endforeach



@endsection
