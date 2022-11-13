@extends('layouts.login')

@section('content')
<div>
  <p>Folow List</p>
  @foreach ($posts as $post)
<p><a href="/userprofile/{{$post->user->id}}"><img src="{{ asset('storage/'.$post->user->images)}}" alt="icon"></a></p>
  @endforeach
</div>

<div class="card-body">
<table class="table table-striped task-table">
  <tbody>

  @foreach($posts as $post)
<tr>
  <!-- プロフィール写真 -->
  <td class="table-text">
    <div><a href="/userprofile/{{$post->user->id}}"><img src="{{ asset('storage/'.$post->user->images)}}" alt="icon"></a></div>
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

  </tbody>
</table>
</div>
@endsection
