/* eslint-disable no-console */
/* eslint-disable dollar-sign/dollar-sign */
$(document).ready(function() {
  var offset = 600;
  var duration = 200;
  $(window).scroll(function() {
    // console.log($("body").scrollTop());

    if ($(this).scrollTop() > offset) {
      $(".back_totop").fadeIn(duration);
    } else {
      $(".back_totop").fadeOut(duration);
    }
  });

  // $(".back_totop").click(function() {
  //   $("html").animate({ scrollTop: 0 }, duration);
  //   return false;
  // });
  //u nekim browserima radi sa html a u nekima sa html
  //pa sam ukiuo, stavio sam stxle html { scroll - behavior: smooth; }
});

window.addEventListener("load", () => {
  document.body.classList.add("ready");
});
