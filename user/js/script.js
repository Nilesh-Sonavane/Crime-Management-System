$(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      $(".navbar").addClass("sticky");
    } else {
      $(".navbar").removeClass("sticky");
    }
  });

 
 