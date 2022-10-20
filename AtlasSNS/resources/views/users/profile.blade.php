@extends('layouts.login')

@section('content')

{!! Form::open(['url' => 'profile', 'files' => true]) !!}

{{ Form::label('ユーザー名') }}
{{ Form::text('username',Auth::user()->username,['class' => 'input']) }}
{{ Form::label('メールアドレス') }}
{{ Form::text('mail',Auth::user()->mail,['class' => 'input']) }}

{{ Form::label('パスワード') }}
{{ Form::password('password',null,['class' => 'input']) }}

{{ Form::label('パスワード確認') }}
{{ Form::password('password-confirm',null,['class' => 'input']) }}

{{ Form::label('自己紹介文') }}
{{ Form::text('bio',Auth::user()->bio,['class' => 'input']) }}

{{ Form::hidden('id',Auth::user()->id,['class' => 'input']) }}

{{ Form::label('アイコン画像') }}
{{ Form::file('images',null,['class' => 'input']) }}

{{ Form::submit('更新') }}

{!! Form::close() !!}


@endsection
