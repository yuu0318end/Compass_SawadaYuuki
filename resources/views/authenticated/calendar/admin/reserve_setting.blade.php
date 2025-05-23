<x-sidebar>
<div class="w-100 vh-100 d-flex pt-5 pb-5" style="align-items:center; justify-content:center;">
  <div class="border w-75 m-auto pt-5" style="border-radius:10px; background:#FFF;box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);">
    <p class="text-center">{{ $calendar->getTitle() }}</p>
    <div class="">
      {!! $calendar->render() !!}
    </div>
    <div class="adjust-table-btn m-auto text-right">
      <input type="submit" class="btn btn-primary mb-5" value="登録" form="reserveSetting" onclick="return confirm('登録してよろしいですか？')">
    </div>
  </div>
</div>
</x-sidebar>
