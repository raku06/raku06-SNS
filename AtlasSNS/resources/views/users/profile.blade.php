@extends('layouts.login')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ url('profile') }}" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}
<div class="profile_form">
<div class="form_label">
<p class="name_label"><span><img src="{{ asset('storage/'.Auth::user()->images)}}" alt=""></span>ユーザー名</p>
<p class="label">メールアドレス</p>
<p class="label">パスワード</p>
<p class="label">パスワード確認</p>
<p class="label">自己紹介文</p>
<p class="label img_label">アイコン画像</p>
</div><!-- form_label -->
<div class="form_box">
<p class="name_form">
    <input type="text" name="username" class="input" value="{{Auth::user()->username}}" >
</p>
<p class="form">
    <input type="email" name="mail" class="input" value="{{Auth::user()->mail}}" >
</p>
<p class="form">
    <input type="password" name="password" class="input" value="" >
</p>
<p class="form">
    <input type="password" name="password-confirm" class="input" value="" >
</p>
<p class="form">
    <input type="text" name="bio" class="input" value="{{Auth::user()->bio}}" >
</p>
<input type="hidden" name="id" class="input" value="{{Auth::user()->id}}" >
<div class="img_input">
    <label>
    <input type="file" name="images" class="input input-img" value="{{Auth::user()->image}}" >ファイル選択
    </label>
    <p class="file_name"></p>
    </div>
</div> <!-- form_box -->
</div> <!-- profile_form -->

<p class="prof-btn">
    <input type="submit" value="更新">
    </p>



@endsection
