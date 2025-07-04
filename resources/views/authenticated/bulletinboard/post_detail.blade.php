<x-sidebar>
<div class="vh-100 d-flex">
  <div class="w-50 mt-5">
    <div class="m-3 detail_container" style="border-radius:10px; background:#FFF;">
      <div class="p-3">
        <div class="detail_inner_head">
          @if($errors->first('post_title'))
          <span class="error_message">{{ $errors->first('post_title') }}</span>
          @endif
          @if($errors->first('post_body'))
          <span class="error_message">{{ $errors->first('post_body') }}</span>
          @endif
          <div>
          </div>

        </div>
        <div style="margin-bottom:10px;">
          <span class="category_box2">{{ $post->subCategories->first()?->sub_category ?? '' }}</span>
          @if($post->user_id == Auth::user()->id)
          <div class="text-right" style="display:inline;margin-left:70%;">
            <span class="edit-modal-open btn btn-primary" post_title="{{ $post->post_title }}" post_body="{{ $post->post }}" post_id="{{ $post->id }}">編集</span>
            <a class="btn btn-danger" href="{{ route('post.delete', ['id' => $post->id]) }}" onclick="return confirm('この投稿をを削除します。よろしいでしょうか？')">削除</a>
          </div>
          @endif
        </div>
        <div class="contributor d-flex">
          <p>
            <span>{{ $post->user->over_name }}</span>
            <span>{{ $post->user->under_name }}</span>
            さん
          </p>
          <span class="ml-5">{{ $post->created_at }}</span>
        </div>
        <div class="detsail_post_title">{{ $post->post_title }}</div>
        <div class="mt-3 detsail_post">{!! nl2br(e($post->post)) !!}</div>
      </div>
      <div class="p-3">
        <div class="comment_container">
          <span class="">コメント</span>
          @foreach($post->postComments as $comment)
          <div class="comment_area border-top">
            <p>
              <span>{{ $comment->commentUser($comment->user_id)->over_name }}</span>
              <span>{{ $comment->commentUser($comment->user_id)->under_name }}</span>さん
            </p>
            <p>{!! nl2br(e($comment->comment)) !!}</p>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <div class="w-50 p-3">
    <div class="comment_container border m-5" style="border-radius:10px; background:#FFF;">
      <div class="comment_area p-3">
        @if($errors->first('comment'))
        <span class="error_message">{{ $errors->first('comment') }}</span>
        @endif
        <p class="m-0">コメントする</p>
        <textarea class="w-100" name="comment" form="commentRequest"></textarea>
        <input type="hidden" name="post_id" form="commentRequest" value="{{ $post->id }}">
        <div class="text-right">
          <input type="submit" class="btn btn-primary mt-2" form="commentRequest" value="投稿">
        </div>
        <form action="{{ route('comment.create') }}" method="post" id="commentRequest">{{ csrf_field() }}</form>
      </div>
    </div>
  </div>
</div>
<div class="modal js-modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">
    <form action="{{ route('post.edit') }}" method="post">
      <div class="w-100">
        <div class="modal-inner-title w-50 m-auto">
          <input type="text" name="post_title" placeholder="タイトル" class="w-100">
        </div>
        <div class="modal-inner-body w-50 m-auto pt-3 pb-3">
          <textarea placeholder="投稿内容" name="post_body" class="w-100"></textarea>
        </div>
        <div class="w-50 m-auto edit-modal-btn d-flex">
          <a class="js-modal-close btn btn-danger d-inline-block" href="">閉じる</a>
          <input type="hidden" class="edit-modal-hidden" name="post_id" value="">
          <input type="submit" class="btn btn-primary d-block" value="編集">
        </div>
      </div>
      {{ csrf_field() }}
    </form>
  </div>
</div>
</x-sidebar>
