$(document).ready(function () {
    var t = ".MultiCarousel",
       s = ".MultiCarousel-inner",
       a = "";
 
    function i() {
       var i = 0,
          r = 0,
          e = "",
          n = "",
          o = $(t).width(),
          d = $("body").width();
       $(s).each(function () {
          r += 1;
          var t = $(this).find(".item").length;
          e = $(this).parent().attr("data-items"), n = e.split(","), $(this).parent().attr("id", "MultiCarousel" + r), d >= 1200 ? (i = n[3], a = o / i) : d >= 992 ? (i = n[2], a = o / i) : d >= 768 ? (i = n[1], a = o / i) : (i = n[0], a = o / i), $(this).css({
             transform: "translateX(0px)",
             width: a * t
          }), $(this).find(".item").each(function () {
             $(this).outerWidth(a)
          }), $(".leftLst").addClass("over"), $(".rightLst").removeClass("over")
       })
    }
 
    function r(t, i) {
       var r = "#" + $(i).parent().attr("id");
       ! function (t, i, r) {
          var e = "",
             n = $(i + " " + s).css("transform").match(/-?[\d\.]+/g),
             o = Math.abs(n[4]);
          if (0 == t) e = parseInt(o) - parseInt(a * r), $(i + " .rightLst").removeClass("over"), e <= a / 2 && (e = 0, $(i + " .leftLst").addClass("over"));
          else if (1 == t) {
             var d = $(i).find(s).width() - $(i).width();
             e = parseInt(o) + parseInt(a * r), $(i + " .leftLst").removeClass("over"), e >= d - a / 2 && (e = d, $(i + " .rightLst").addClass("over"))
          }
          $(i + " " + s).css("transform", "translateX(" + -e + "px)")
       }(t, r, $(r).attr("data-slide"))
    }
    $(".leftLst, .rightLst").click(function () {
       r($(this).hasClass("leftLst") ? 0 : 1, this)
    }), i(), $(window).resize(function () {
       i()
    })
 });