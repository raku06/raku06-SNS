@extends('layouts.login')

@section('content')
<div class="form-body fw">
  <p class="fw-title">Folow List</p>
  <div class="user-list">
  @foreach ($following_users as $following_user)
<p><a href="/userprofile/{{$following_user->id}}"><img src="{{ asset('storage/'.$following_user->images)}}" alt="icon"></a></p>
  @endforeach
  </div> <!-- user-list -->
</div>

<div class="card-body">
  @foreach($posts->sortByDesc('updated_at') as $post )
<div class="post-outer">
<div class="post-container">
  <!-- プロフィール写真 -->
    <div class="icon"><a href="/userprofile/{{$post->user->id}}"><img src="{{ asset('storage/'.$post->user->images)}}" alt="icon"></a></div>
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
