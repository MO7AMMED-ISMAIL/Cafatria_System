
$(document).ready(function () {
  $('.fa-plus-square').on('click', function () {
      $(this).closest('tr.order').nextUntil('tr.order').toggleClass('details-hidden');
  });
});