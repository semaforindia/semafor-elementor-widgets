$(document).ready(function() {
  var $carousel = $("[data-owl-carousel]");
  if ($carousel.length) {
    $carousel.each(function(index, el) {
      $(this).owlCarousel($(this).data("owl-carousel"));
    });
  }
  $('.owl-carousel').find('.owl-nav').removeClass('disabled');
  $('.owl-carousel').on('changed.owl.carousel', function(event) {
    $(this).find('.owl-nav').removeClass('disabled');
  });
});
