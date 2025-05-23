<x-sidebar>
<div class="board_area w-100 border m-auto d-flex">
  <div class="post_view w-75 mt-5">
    <p class="w-75 m-auto"></p>
    @foreach($posts as $post)
    <div class="post_area border w-75 m-auto p-3">
      <p><span>{{ $post->user->over_name }}</span><span class="ml-3">{{ $post->user->under_name }}</span>さん</p>
      <p><a href="{{ route('post.detail', ['id' => $post->id]) }}" style="color:#212529;font-weight:bold;">{{ $post->post_title }}</a></p>
      <div class="post_bottom_area d-flex">
        <p class="category_box2">{{ $post->subCategories->first()?->sub_category ?? '' }}</p>
        <div class="d-flex post_status">
          <div class="mr-5">
            <i class="fa fa-comment" style="color:#a9a9a9"></i><span class="" style="margin-left:4px">{{ $post->commentCounts($post->id) }}</span>
          </div>
          <div>
            @if(Auth::user()->is_Like($post->id))
            <p class="m-0"><i class="fa-solid fa-heart un_like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}" style="margin-left:4px;">{{ $post->likeCounts($post->id) }}</span></p>
            @else
            <p class="m-0"><i class="fa-regular fa-heart like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}" style="margin-left:4px">{{ $post->likeCounts($post->id) }}</span></p>
            @endif
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="other_area w-25">
    <div class="m-4">
      <div class="post"><a href="{{ route('post.input') }}">投稿</a></div>
      <div class="search-box">
        <input class="post_search" type="text" placeholder="キーワードを検索" name="keyword" form="postSearchRequest">
        <input class="post_search_btn" type="submit" value="検索" form="postSearchRequest">
      </div>
      <input type="submit" name="like_posts" class="category_btn1" value="いいねした投稿" form="postSearchRequest">
      <input type="submit" name="my_posts" class="category_btn2" value="自分の投稿" form="postSearchRequest">
      <div class="category">
        <ul>
          <p>カテゴリー検索</p>
          @foreach($mainCategories as $mainCategory)
          <li class="main_categories" category_id="{{ $mainCategory->id }}">
            <span>{{ $mainCategory->main_category }}</span>
            <span class="arrow"></span>
          </li>
            @foreach($mainCategory->subCategories as $subCategory)
            <li class="category_num{{ $mainCategory->id }} " name="category_word" category_id="{{ $subCategory->id }}">
              <a class="sub_categories" href="{{ route('post.show', ['category_word' => $subCategory->id]) }}">{{ $subCategory->sub_category }}</a>
            </li>
            @endforeach
          @endforeach
        </ul>
      </div>
    </div>
  </div>
  <form action="{{ route('post.show') }}" method="get" id="postSearchRequest"></form>
</div>
</x-sidebar>
