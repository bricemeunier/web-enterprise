// jquery loading when page starts
$(document).ready(function() {
  //set datepicker
  $(".datepicker").datepicker({
      format: "yyyy-mm-dd",
      autoClose: true,
      showClearBtn: true
  });

  $('.collapsible').collapsible();
});
