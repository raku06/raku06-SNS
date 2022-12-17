@extends('layouts.logout')

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
<div class="center login_form white">
{!! Form::open(['url' => 'login']) !!}

<p class="white form_title">AtlasSNSへようこそ</p>
<div class="form_box">
<p class="form_txt">{{ Form::label('mail address') }}</p>
<p>{{ Form::text('mail',null,['class' => 'input']) }}</p>
</div>
<div class="form_box">
<p class="form_txt">{{ Form::label('password') }}</p>
<p>{{ Form::password('password',['class' => 'input']) }}</p>
</div>
<p class= btn_box>{{ Form::submit('LOGIN',['class' => 'login_btn']) }}</p>

<p><a class="white" href="/register">新規ユーザーの方はこちら</a></p>

{!! Form::close() !!}
</div>

@endsection
