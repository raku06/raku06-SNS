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
        <div class="img">
          <img src="{{ asset('storage/'.Auth::user()->images)}}" alt="icon">
        </div>
        <div class="col-sm-6">
          <input type="text" name="post_content" class="form-control" placeholder="投稿内容を入力してください。">
        </div>
      </div>
      <!-- 登録ボタン -->
      <div class="form-btn">
        <div>
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
        <!-- テーブル本体 -->
          @foreach ($posts as $post)
              <div class="post-outer">
              <div class="post-container">
              <!-- プロフィール写真 -->
                <div class="icon"><img src="{{ asset('storage/'.$post->user->images)}}" alt="icon"></div>
              <div class="post-content">
              <div class="post-box">
              <!-- 投稿者名の表示 -->
                <div>{{ $post->user->username }}</div>
              <!-- 投稿詳細 -->
                <div class="post">{{ $post->post }}</div>
              </div> <!-- post-box -->
              <!-- 更新タイムスタンプ -->
                <div class="update_at">{{$post->updated_at}}</div>
              </div> <!-- post-content -->
              </div> <!-- post-container -->

              @if ($post->user->id === Auth::user()->id)
              <div class="post-btn">
              <!-- 編集ボタン -->
                <div><a class="js-modal-open" href="" post="{{ $post->post }}" post_id="{{ $post->id }}">
                  <img src="/images/edit-h.png" alt="編集">
                  <img src="/images/edit.png" alt="編集">
                  </a>
                  </div>
                <!-- 削除ボタン -->
                <div><a class="btn" href="/top/{{$post->id}}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">
                <img src="/images/trash-h1.png" alt="削除">
                <img src="/images/trash.png" alt="削除">
                </a>
                </div>
              </div> <!-- post-btn -->

              @endif
          </div> <!-- post-outer -->
          @endforeach


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
  @else
  <p class="empty_txt">まだ投稿がありません。</p>
  @endif

@endsection
