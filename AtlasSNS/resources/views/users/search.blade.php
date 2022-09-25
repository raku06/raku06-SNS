@extends('layouts.login')

@section('content')
<form action="{{ url('search')}}" method="POST">
  @csrf
    <input type="search" placeholder="ユーザー名" name="search" value="">
        <button type="submit">検索</button>
</form>

    <table>
@foreach ($users as $user)
    <tr>
              <!-- プロフィール写真 -->
              <td class="table-text">
                <div><img src="/images/icon1.png" alt="icon"></div>
              </td>
              <!-- アカウント名 -->
              <td class="table-text">
                <div>{{ $user->username }}</div>
              </td>
              <!-- フォローボタン -->
              <td class="table-text">
            @if (Auth::user()->isFollowing($user->id)) <!-- ボタン切り替えのためのif文 -->
                <form action="{{ route('unfollow', ['user' => $user->id]) }}" method="POST">
                    @csrf
                    @method("DELETE")


                    <button type="submit" class="btn btn-danger">フォロー解除</button>
                </form>
            @else
                <form action="{{ route('follow', ['user' => $user->id]) }}" method="POST">
                    @csrf

                    <button type="submit" class="btn btn-primary">フォローする</button>
                </form>
            @endif
              </td>
    </tr>
@endforeach
    </table>

@endsection
