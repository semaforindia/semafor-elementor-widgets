$(document).ready(function() {
  var $carousel = $("[data-owl-carousel]");
  // debugger;
  if ($carousel.length) {
    // debugger;
    $carousel.each(function(index, el) {
      var settings = $(this).data("owl-carousel");
      console.log(settings);
      // debugger;
      // console.log(JSON.parse(settings));

      $(this).owlCarousel(settings);
      // $(this).owlCarousel({
      //   items: 4
      //   // slides_to_scroll: 3,
      //   // infinite: true,
      //   // slides_nav: true,
      //   // slides_dots: true,
      //   // transition_speed: 100,
      //   // autoplay: true
      // });
    });
  }
  // $('.owl-carousel').find('.owl-nav').removeClass('disabled');
  // $('.owl-carousel').on('changed.owl.carousel', function(event) {
  //   $(this).find('.owl-nav').removeClass('disabled');
  // });
});
