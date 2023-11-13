$(function () {
  "use strict";

  // sticky menu js
  $(window).scroll(function () {
    if ($(this).scrollTop() > 300) {
      $('.sticky-top').addClass('shadow-lg').css('top', '0px');
    } else {
      $('.sticky-top').removeClass('shadow-lg').css('top', '-100px');
    }
  });


  $(".js-select2").select2({
    closeOnSelect: true
  });

  // mobile sidebar js

  let mobile_sidebar_close = document.querySelector(".mobile_sidebar_close");
  let mobile_menu = document.querySelector(".mobile_menu");
  let left_sidebar = document.querySelector(".left_sidebar");

  if (mobile_menu) {
    mobile_menu.addEventListener("click", () => {
      left_sidebar.classList.add("show_mobile_sidebar");
    })
  }

  if (mobile_sidebar_close) {
    mobile_sidebar_close.addEventListener("click", () => {
      left_sidebar.classList.remove("show_mobile_sidebar");
    })
  }


  // back to top js
  var btn = $("#button");

  $(window).scroll(function () {
    btn.toggleClass("show", $(window).scrollTop() > 300);
  });

  btn.click(function (e) {
    e.preventDefault();
    if (navigator.userAgent.toLowerCase().indexOf("firefox") > -1) {
      $("html").animate({
          scrollTop: 0,
        },
        1000
      );
    } else {
      $("html, body").animate({
          scrollTop: 0,
        },
        0
      );
    }
  });


  // // mobile menu js
  // $('.mobile-topbar .bars i').click(function () {
  //   $('.mobile-menu-main').addClass('show-mobile-menu')
  // })
  // $('.close-m-menu').click(function () {
  //   $('.mobile-menu-main').removeClass('show-mobile-menu')
  // })
  // $('.mobile-topbar .bars i').click(function () {
  //   $('.mobile-menu-overlay').addClass('show-mobile-menu-overlay')
  // })
  // $('.mobile-topbar .bars i').click(function () {
  //   $('.mobile-menu-overlay').addClass('show-mobile-menu-overlay')
  // })
  // $('.close-m-menu').click(function () {
  //   $('.mobile-menu-overlay').removeClass('show-mobile-menu-overlay')
  // })
  // $('.mobile-menu-overlay').click(function () {
  //   $('.mobile-menu-overlay').removeClass('show-mobile-menu-overlay')
  // })
  // $('.mobile-menu-overlay').click(function () {
  //   $('.mobile-menu-main').removeClass('show-mobile-menu')
  // })

  // $('.sub-menu ul').hide();
  // $(".sub-menu a").click(function () {
  //   $(this).parent(".sub-menu").children("ul").slideToggle("100");
  //   $(this).find(".right").toggleClass("fa-caret-up fa-caret-down");
  // });

});

