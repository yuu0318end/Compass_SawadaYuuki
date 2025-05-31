<x-sidebar>
<div class="w-100 h-100 pt-5 pb-5">
  <div class="w-75 m-auto pt-5 pb-5" style="border-radius:10px; background:#FFF;box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);">
    <p class="text-center">{{ $calendar->getTitle() }}</p>
    <p>{!! $calendar->render() !!}</p>
  </div>
</div>
</x-sidebar>
