<x-sidebar>
<div class="search_content w-100 d-flex">
  <div class="reserve_users_area">
    @foreach($users as $user)
    <div class="border one_person users_card">
      <div class="users_card_text">
        <span style="color:#9E9E9E;">ID : </span><span>{{ $user->id }}</span>
      </div>
      <div class="users_card_text"><span style="color:#9E9E9E;">名前 : </span>
        <a href="{{ route('user.profile', ['id' => $user->id]) }}">
          <span>{{ $user->over_name }}</span>
          <span>{{ $user->under_name }}</span>
        </a>
      </div>
      <div class="users_card_text">
        <span style="color:#9E9E9E;">カナ : </span>
        <span>({{ $user->over_name_kana }}</span>
        <span>{{ $user->under_name_kana }})</span>
      </div>
      <div class="users_card_text">
        @if($user->sex == 1)
        <span style="color:#9E9E9E;">性別 : </span><span>男</span>
        @elseif($user->sex == 2)
        <span style="color:#9E9E9E;">性別 : </span><span>女</span>
        @else
        <span style="color:#9E9E9E;">性別 : </span><span>その他</span>
        @endif
      </div>
      <div class="users_card_text">
        <span style="color:#9E9E9E;">生年月日 : </span><span>{{ $user->birth_day }}</span>
      </div>
      <div class="users_card_text">
        @if($user->role == 1)
        <span style="color:#9E9E9E;">役職 : </span><span>教師(国語)</span>
        @elseif($user->role == 2)
        <span style="color:#9E9E9E;">役職 : </span><span>教師(数学)</span>
        @elseif($user->role == 3)
        <span style="color:#9E9E9E;">役職 : </span><span>講師(英語)</span>
        @else
        <span style="color:#9E9E9E;">役職 : </span><span>生徒</span>
        @endif
      </div>
      <div class="users_card_text">
      @if($user->role == 4)
        <span style="color:#9E9E9E;">選択科目 :</span>
        @foreach($user->subjects as $subject)
          <span>{{ $subject->subject }}</span>
        @endforeach
      @endif
      </div>
    </div>
    @endforeach
  </div>
  <div class="search_area w-25">
    <div class="">
      <div class="search_box2">
        <p class="search_label">検索</p>
        <input type="text" class="free_word" name="keyword" placeholder="キーワードを検索" form="userSearchRequest">
      </div>
      <div>
        <p class="search_label">カテゴリ</p>
        <select class="search_select" form="userSearchRequest" name="category">
          <option value="name">名前</option>
          <option value="id">社員ID</option>
        </select>
      </div>
      <div>
        <p class="search_label">並び替え</p>
        <select class="search_select" name="updown" form="userSearchRequest">
          <option value="ASC">昇順</option>
          <option value="DESC">降順</option>
        </select>
      </div>
      <div class="">
        <p class="search_conditions">
          <span style="color:#696969;">検索条件の追加</span>
          <span class="arrow"></span>
        </p>

        <div class="search_conditions_inner">
          <div>
            <div>
              <label style="color:#696969;">性別</label>
            </div>
            <span>男</span><input type="radio" name="sex" value="1" form="userSearchRequest" style="margin-right:5px">
            <span>女</span><input type="radio" name="sex" value="2" form="userSearchRequest" style="margin-right:5px">
            <span>その他</span><input type="radio" name="sex" value="3" form="userSearchRequest" style="margin-right:5px">
          </div>
          <div>
            <div>
              <label class="search_label">権限</label>
            </div>
            <select name="role" form="userSearchRequest" class="search_select">
              <option selected disabled>----</option>
              <option value="1">教師(国語)</option>
              <option value="2">教師(数学)</option>
              <option value="3">教師(英語)</option>
              <option value="4" class="">生徒</option>
            </select>
          </div>
          <div class="selected_engineer">
            <div>
              <label class="search_label">選択科目</label>
            </div>
              @foreach($subjects as $subject)
              <label>{{ $subject->subject }}</label>
              <input type="checkbox" name="subject[]" value="{{ $subject->id }}" form="userSearchRequest" style="margin-right:5px">
              @endforeach
          </div>
        </div>
      <div class="search_btn_container">
        <input class="search_btn" type="submit" name="search_btn" value="検索" form="userSearchRequest">
      </div>
      <div class="search_btn_container">
        <input class="reset_btn" type="reset" value="リセット" form="userSearchRequest">
      </div>
    </div>
    <form action="{{ route('user.show') }}" method="get" id="userSearchRequest"></form>
  </div>
</div>
</x-sidebar>
