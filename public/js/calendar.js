$(function(){
  $('.delete_btn').on('click',function(){
    $('.js-modal').fadeIn();
    var date = $(this).data('reserve-date');
    var part = $(this).data('reserve-part');
    var reserveId = $(this).data('reserve-id');
    $('.modal-day').text(date);
    $('.modal-part').text(part);
    $('.delete-reserve-hidden').val(reserveId);
    return false;
  });
  $('.js-modal-close').on('click', function () {
    $('.js-modal').fadeOut();
    return false;
  });
});
