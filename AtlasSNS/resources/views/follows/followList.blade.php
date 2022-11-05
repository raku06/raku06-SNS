@extends('layouts.login')

@section('content')
<div>
  <p>Folow List</p>
  @foreach ($posts as $post)
<p><img src="{{ asset('storage/'.$post->user->images)}}" alt=""></p>
  @endforeach
</div>
<div>
  @foreach($posts as $post)
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
</div>
@endsection
