@extends('layouts.login')

@section('content')
<div class="form-body">
  <!-- バリデーションエラーの表示に使用-->
  <!-- @include('common.errors') -->

    <!-- 投稿フォーム -->
    @if( Auth::check() )
      <form action="{{ url('posts') }}" method="POST" class="form-horizontal">
      {{ csrf_field() }}
      <!-- 投稿の本文 -->
      <div class="form-group">
        <div class="col-sm-6">
          <img src="/images/icon1.png" alt="icon">
        </div>
        <div class="col-sm-6">
          <input type="text" name="post_content" class="form-control" placeholder="投稿内容を入力してください。">
        </div>
      </div>
      <!-- 登録ボタン -->
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
          <button type="submit" class="btn btn-primary">
            <img src="/images/post.png" alt="投稿する">
          </button>
        </div>
      </div>
    </form>
  @endif
</div>
  <!-- 全ての投稿リスト -->
  @if (count($posts) > 0)
    <div class="card-body">
      <div class="card-body">
        <table class="table table-striped task-table">
        <!-- テーブルヘッダ -->
        <thead>
          <th> </th>
        </thead>
        <!-- テーブル本体 -->
        <tbody>
          @foreach ($posts as $post)
            <tr>
              <!-- プロフィール写真 -->
              <td class="table-text">
                <div><img src="/images/icon1.png" alt="icon"></div>
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
              <!-- 編集ボタン -->
               <td class="table-text content">
                <div><a class="js-modal-open" href="" post="{{ $post->post }}" post_id="{{ $post->id }}"><img src="/images/edit.png" alt="編集"></a></div>
              </td>
              <td>
                <!-- 削除ボタン -->
                <td><a class="btn " href="/top/{{$post->id}}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')"><img src="/images/trash.png" alt="削除"></a></td>
              </td>
          </tr>
          @endforeach


     </tbody>
    </table>
            <!-- モーダルの中身 -->
            <div class="modal js-modal">
                <div class="modal__bg js-modal-close"></div>
                <div class="modal__content">
                  <form action="/top/update" method="POST">
                    @csrf
                        <textarea name="post" class="modal_post"></textarea>
                        <input type="hidden" name="id" class="modal_id" value="">
                        <input type="submit" value="更新">

                  </form>
                  <a class="js-modal-close" href="">閉じる</a>
                </div>
            </div>
  </div>
</div>
  @else
  <p class="empty_txt">まだ投稿がありません。</p>
  @endif

@endsection
