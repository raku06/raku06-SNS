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

{!! Form::open(['url' => 'profile', 'files' => true]) !!}
<div class="profile_form">

<div class="form_box">
<p><img src="{{ asset('storage/'.Auth::user()->images)}}" alt="">
{{ Form::label('ユーザー名') }}</p>
<p>{{ Form::text('username',Auth::user()->username,['class' => 'input']) }}</p>
</div>

<div class="form_box box">
<p>{{ Form::label('メールアドレス') }}</p>
<p>{{ Form::text('mail',Auth::user()->mail,['class' => 'input']) }}</p>
</div>

<div class="form_box box">
<p>{{ Form::label('パスワード') }}</p>
<p>{{ Form::password('password',null,['class' => 'input']) }}</p>
</div>

<div class="form_box box">
<p>{{ Form::label('パスワード確認') }}</p>
<p>{{ Form::password('password-confirm',null,['class' => 'input']) }}</p>
</div>

<div class="form_box box">
<p>{{ Form::label('自己紹介文') }}</p>
<p>{{ Form::text('bio',Auth::user()->bio,['class' => 'input']) }}</p>
</div>

<div>
{{ Form::hidden('id',Auth::user()->id,['class' => 'input']) }}
</div>

<div class="form_box box">
<p>{{ Form::label('アイコン画像') }}</p>
<p class="img_input">{{ Form::file('images',Auth::user()->image,['class' => 'input']) }}</p>
</div>

<p class="prof-btn">{{ Form::submit('更新') }}</p>



</div>
{!! Form::close() !!}


@endsection
