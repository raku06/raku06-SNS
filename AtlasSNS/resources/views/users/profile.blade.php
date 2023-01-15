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
<div class="form_label">
<p class="name_label"><span><img src="{{ asset('storage/'.Auth::user()->images)}}" alt=""></span> {{ Form::label('ユーザー名') }}</p>
<p class="label">{{ Form::label('メールアドレス') }}</p>
<p class="label">{{ Form::label('パスワード') }}</p>
<p class="label">{{ Form::label('パスワード確認') }}</p>
<p class="label">{{ Form::label('自己紹介文') }}</p>
<p class="label img_label">{{ Form::label('アイコン画像') }}</p>
</div><!-- form_label -->
<div class="form_box">
<p class="name_form">{{ Form::text('username',Auth::user()->username,['class' => 'input']) }}</p>
<p class="form">{{ Form::text('mail',Auth::user()->mail,['class' => 'input']) }}</p>
<p class="form">{{ Form::password('password',null,['class' => 'input']) }}</p>
<p class="form">{{ Form::password('password-confirm',null,['class' => 'input']) }}</p>
<p class="form">{{ Form::text('bio',Auth::user()->bio,['class' => 'input']) }}</p>
{{ Form::hidden('id',Auth::user()->id,['class' => 'input']) }}
<p class="img_input">{{ Form::file('images',Auth::user()->image,['class' => 'input']) }}</p>
</div> <!-- form_box -->
</div> <!-- profile_form -->

<p class="prof-btn">{{ Form::submit('更新') }}</p>
{!! Form::close() !!}


@endsection
