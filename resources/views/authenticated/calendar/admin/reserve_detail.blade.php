<x-sidebar>
<div class="d-flex" style="align-items:center;margin-left:150px;margin-top:100px">
  <div class="">
    <p><span>{{ \Carbon\Carbon::parse($date)->format('Y年m月d日') }}</span><span class="ml-3">{{ $part }}部</span></p>
    <div class="detail_container">
      <table class="detail_wrapper">
        <tr class="detail_label">
          <th class="">ID</th>
          <th class="w-50">名前</th>
          <th class="w-50">場所</th>
        </tr>
        @foreach($reservePersons as $reservePerson)
          @foreach($reservePerson->users as $user)
            <tr class="detail_items">
              <td class="">{{ $user->id }}</td>
              <td class="w-50">{{ $user->over_name }}{{ $user->under_name }}</td>
              <td class="w-50">リモート</td>
            </tr>
          @endforeach
        @endforeach
      </table>
    </div>
  </div>
</div>
</x-sidebar>
