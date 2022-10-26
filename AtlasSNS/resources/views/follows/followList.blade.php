@extends('layouts.login')

@section('content')
<div>
  <p>Folow List</p>
  @foreach ($following_id as $follow)
<p><img src="{{ asset('storage/'.$user->images)}}" alt=""></p>
  @endforeach
</div>
<div>
  @foreach($following_id as $follow)
<tr>
  <!-- プロフィール写真 -->
  <td class="table-text">
    <div><img src="{{ asset('storage/'.$user->images)}}" alt="icon"></div>
  </td>
  <!-- 投稿者名の表示 -->
  <td class="table-text">
    <div>{{ $follow->users->username }}</div>
  </td>
  <!-- 投稿詳細 -->
  <td class="table-text">
    <div>{{ $follow->posts->post }}</div>
  </td>
  <!-- 更新タイムスタンプ -->
  <td class="table-text">
    <div>{{$follow->posts->updated_at}}</div>
  </td>
</tr>
  @endforeach
</div>
@endsection
