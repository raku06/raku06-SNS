@extends('layouts.logout')

@section('content')
<div class="added_header">
<header>
    <div class="center">
    <h1><img src="/images/atlas.png"></h1>
    <h2 class="white title">Social Network Service</h2>
    </div>
  </header>
</div>
<div id="clear" class="white center">
  <p class="username"> {{$post_data}} さん</p>
  <p class="welcome">ようこそ！AtlasSNSへ！</p>
  <p>ユーザー登録が完了しました。</p>
  <p>早速ログインをしてみましょう！</p>

  <p class="btn"><a class="white" href="/login">ログイン画面へ</a></p>
</div>

@endsection
