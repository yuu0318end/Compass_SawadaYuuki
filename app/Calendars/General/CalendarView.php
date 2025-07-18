<?php
namespace App\Calendars\General;

use Carbon\Carbon;
use Auth;

class CalendarView{

  private $carbon;
  function __construct($date){
    $this->carbon = new Carbon($date);
  }

  public function getTitle(){
    return $this->carbon->format('Y年n月');
  }

  function render(){
    $html = [];
    $html[] = '<div class="calendar text-center">';
    $html[] = '<table class="table">';
    $html[] = '<thead class="border">';
    $html[] = '<tr class="border">';
    $html[] = '<th>月</th>';
    $html[] = '<th>火</th>';
    $html[] = '<th>水</th>';
    $html[] = '<th>木</th>';
    $html[] = '<th>金</th>';
    $html[] = '<th class="day-sat">土</th>';
    $html[] = '<th class="day-sun">日</th>';
    $html[] = '</tr>';
    $html[] = '</thead>';
    $html[] = '<tbody>';
    $weeks = $this->getWeeks();
    foreach($weeks as $week){
      $html[] = '<tr class="'.$week->getClassName().'">';

      $days = $week->getDays();
      foreach($days as $day){
        $startDay = $this->carbon->copy()->format("Y-m-01");
        $toDay = $this->carbon->copy()->format("Y-m-d");

        if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
          $html[] = '<td class="border past-day calendar-td '.$day->getClassName().'">';
        }else{
          $html[] = '<td class="border calendar-td '.$day->getClassName().'">';
        }
        $html[] = $day->render();

        if(in_array($day->everyDay(), $day->authReserveDay())){
          $reservePart = $day->authReserveDate($day->everyDay())->first()->setting_part;
          if($reservePart == 1){
            $reservePart = "リモ1部";
            $pastPart = "1部参加";
          }else if($reservePart == 2){
            $reservePart = "リモ2部";
            $pastPart = "2部参加";
          }else if($reservePart == 3){
            $reservePart = "リモ3部";
            $pastPart = "3部参加";
          }
          if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
            $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px; color:#494949;">'. $pastPart .'</p>';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
          }else{
            $html[] = '<button type="button" class="delete_btn btn btn-danger p-0 w-75"
            data-reserve-date="'. $day->everyDay() .'"
            data-reserve-part="'. $reservePart .'"
            data-reserve-id="'. $day->authReserveDate($day->everyDay())->first()->id .'"
            style="font-size:12px">'. $reservePart .'</button>';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
          }
        }else if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
          $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px; color:#494949;">受付終了</p>';
          $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
        }else{
          $html[] = $day->selectPart($day->everyDay());
        }
        $html[] = $day->getDate();
        $html[] = '</td>';
      }
      $html[] = '</tr>';
    }
    $html[] = '</tbody>';
    $html[] = '</table>';
    $html[] = '</div>';
    $html[] = '<form action="/reserve/calendar" method="post" id="reserveParts">'.csrf_field().'</form>';
    $html[] = '<form action="/delete/calendar" method="post" id="deleteParts">'.csrf_field().'</form>';

    return implode('', $html);
  }

  protected function getWeeks(){
    $weeks = [];
    $firstDay = $this->carbon->copy()->firstOfMonth();
    $lastDay = $this->carbon->copy()->lastOfMonth();
    $week = new CalendarWeek($firstDay->copy());
    $weeks[] = $week;
    $tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();
    while($tmpDay->lte($lastDay)){
      $week = new CalendarWeek($tmpDay, count($weeks));
      $weeks[] = $week;
      $tmpDay->addDay(7);
    }
    return $weeks;
  }
}
