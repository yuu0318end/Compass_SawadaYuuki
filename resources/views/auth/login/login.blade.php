<x-guest-layout>
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
  <form action="{{ route('loginPost') }}" method="POST">
    <div class="login_logo">
      <img src="{{ asset('image/atlas-black.png') }}" alt="">
    </div>
    <div class="w-100 d-flex login_container" style="align-items:center; justify-content:center;">
      <div class="border vh-50 w-25 login_wrapper">
        <div class="w-75 m-auto pt-5">
          <label class="d-block m-0" style="font-size:13px;">メールアドレス</label>
          <div class="border-bottom border-primary w-100">
            <input type="text" class="w-100 border-0" name="mail_address">
          </div>
        </div>
        <div class="w-75 m-auto pt-5">
          <label class="d-block m-0" style="font-size:13px;">パスワード</label>
          <div class="border-bottom border-primary w-100">
            <input type="password" class="w-100 border-0" name="password">
          </div>
        </div>
        <div class="text-right m-3">
          <input type="submit" class="btn btn-primary" value="ログイン">
        </div>
        <div class="text-center">
          <a href="{{ route('registerView') }}">新規登録はこちら</a>
        </div>
      </div>
      {{ csrf_field() }}
    </div>
  </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="{{ asset('js/register.js') }}" rel="stylesheet"></script>
</x-guest-layout>
