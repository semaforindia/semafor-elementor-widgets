$(document).ready(function() {
  var $carousel = $("[data-owl-carousel]");
  if ($carousel.length) {
    $carousel.each(function(index, el) {
      $(this).owlCarousel($(this).data("owl-carousel"));
    });
  }
});
