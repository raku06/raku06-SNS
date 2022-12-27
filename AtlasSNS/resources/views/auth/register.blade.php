@extends('layouts.logout')
<div class="register_header">
<header>
    <div class="center">
    <h1><img src="/images/atlas.png"></h1>
    <h2 class="white title">Social Network Service</h2>
    </div>
  </header>
</div>
@section('content')
@if ($errors->any())
    <div class="alert alert-danger white center">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="center register_form white">
{!! Form::open(['url' => 'register']) !!}

<p class = "white form_title">新規ユーザー登録</p>
<div class="form_box">
<p class="form_txt">{{ Form::label('user name') }}</p>
<p>{{ Form::text('username',null,['class' => 'input']) }}</p>
</div>

<div class="form_box">
<p class="form_txt">{{ Form::label('mail address') }}</p>
<p>{{ Form::text('mail',null,['class' => 'input']) }}</p>
</div>

<div class="form_box">
<p class="form_txt">{{ Form::label('password') }}</p>
<p>{{ Form::password('password',null,['class' => 'input']) }}</p>
</div>

<div class="form_box">
<p class="form_txt">{{ Form::label('password comfirm') }}</p>
<p>{{ Form::password('password-confirm',null,['class' => 'input']) }}</p>
</div>

<p class="btn_box">{{ Form::submit('REGISTER', ['class' => 'register_btn']) }}</p>

<p class="back_login"><a class="white" href="/login">ログイン画面に戻る</a></p>

{!! Form::close() !!}
</div>

@endsection
