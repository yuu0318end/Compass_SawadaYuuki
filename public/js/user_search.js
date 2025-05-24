$(function () {
  $('.search_conditions').click(function () {
    $('.search_conditions_inner').slideToggle();
    // 矢印の回転切り替え
    $(this).find('.arrow').toggleClass('open');
  });

  $('.subject_edit_btn').click(function () {
    $(this).next('.arrow2').toggleClass('open');
    $(this).nextAll('.subject_inner').slideToggle();
  });
});
