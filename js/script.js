jQuery(document).ready(function ($) {

  //number col
  $(".btn-count-plus").click(function () {
    var e = $(this).parent().find("input");
    return e.val(parseInt(e.val()) + 1), e.change(), !1
  }), $(".btn-count-minus").click(function () {
    var e = $(this).parent().find("input"), t = parseInt(e.val()) - 1;
    return t = t < 0 ? 1 : t, e.val(t), e.change(), !1
  })

  //select
  $('select').niceSelect();


  /* mob-menu*/
  $(document).on('click', '.open-menu a', function (e){
    e.preventDefault();

    $(this).toggleClass('is-open');

    if($(this).hasClass('is-open')){
      $('header').addClass('is-active');
      $.fancybox.open( $('#menu-responsive'), {
        touch:false,
        autoFocus:false,
      });
      setTimeout(function() {
        $('html').addClass('is-menu');

      }, 100);

    }else{
      e.preventDefault();
      $.fancybox.close();
      $('header').removeClass('is-active');
      $('html').removeClass('is-menu');
    }

  });

  //TABS
  (function($){
    jQuery.fn.lightTabs = function(options){

      var createTabs = function(){
        tabs = this;
        i = 0;

        showPage = function(i){
          $(tabs).find(".tab-content").children("div").hide();
          $(tabs).find(".tab-content").children("div").eq(i).show();
          $(tabs).find(".tabs-menu").children("li").removeClass("is-active");
          $(tabs).find(".tabs-menu").children("li").eq(i).addClass("is-active");
        }

        showPage(0);

        $(tabs).find(".tabs-menu").children("li").each(function(index, element){
          $(element).attr("data-page", i);
          i++;
        });

        $(tabs).find(".tabs-menu li").children("a").click(function(e){
          e.preventDefault()
          let item = $(this).closest('li').index() + 1;
          $('.tab-content .tab-item').hide();
          $(".tab-content .tab-item:nth-child("+ item + ")").show()

        });
      };
      return this.each(createTabs);
    };
  })(jQuery);
  $(".tabs").lightTabs();

  //slider
  var swiperImg1 = new Swiper(".filter-slider-1", {
    slidesPerView: 'auto',
    spaceBetween: 15,
    navigation: {
      nextEl: ".next-filter-1",
      prevEl: ".prev-filter-1",
    },
  });


  //popup
  $(".fancybox").fancybox({
    touch:false,
    autoFocus:false,
  });
});