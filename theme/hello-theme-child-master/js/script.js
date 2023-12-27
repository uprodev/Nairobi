jQuery(document).ready(function ($) {

  //number col
  $(document).on('click', '.btn-count-plus', function(e){

    var e = $(this).parent().find("input");
    var max = e.attr('max') ? parseInt(e.attr('max')) : 99,t = parseInt(e.val())+ 1

    return t = t < max ? t : max ,  e.val(t), e.change(), !1
  }),
    $(document).on('click', '.btn-count-minus', function(e){
      var e = $(this).parent().find("input")
      var min = e.attr('min') ? parseInt(e.attr('min')) : 1,t = parseInt(e.val()) - 1
      return t = t > min ? t : min ,  e.val(t), e.change(), !1
    //return t = t < 0 ? 1 : t, e.val(t), e.change(), !1
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
  var swiperFilter1 = new Swiper(".filter-slider-1", {
    slidesPerView: 'auto',
    spaceBetween: 15,
    noSwiping: false,
    allowTouchMove:false,
    touchRatio: 1,
    freeMode: true,
    preventClicks :true,
    a11y: false,
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


  /*datapicker*/
  const localeEn = {
    days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
    daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
    daysMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
    months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    today: 'Today',
    clear: 'Clear',
    dateFormat: 'MM/dd/yyyy',
    timeFormat: 'hh:mm aa',
    firstDay: 0
  }

  const localeFr = {
    days: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
    daysShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
    daysMin: ['Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa'],
    months: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
    monthsShort: ['Jan', 'Fév', 'Mars', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Dec'],
    today: "Aujourd'hui",
    clear: 'Effacer',
    dateFormat: 'dd/MM/yyyy',
    timeFormat: 'HH:mm',
    firstDay: 1
  }

  const localeNl = {
    days: ['zondag', 'maandag', 'dinsdag', 'woensdag', 'donderdag', 'vrijdag', 'zaterdag'],
    daysShort: ['zo', 'ma', 'di', 'wo', 'do', 'vr', 'za'],
    daysMin: ['zo', 'ma', 'di', 'wo', 'do', 'vr', 'za'],
    months: ['Januari', 'Februari', 'Maart', 'April', 'Mei', 'Juni', 'Juli', 'Augustus', 'September', 'Oktober', 'November', 'December'],
    monthsShort: ['Jan', 'Feb', 'Mrt', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec'],
    today: 'Vandaag',
    clear: 'Legen',
    dateFormat: 'dd-MM-yyyy',
    timeFormat: 'HH:mm',
    firstDay: 0
  }


  new AirDatepicker('.date1', {
    locale: localeEn,
    autoClose: true,
  });


  //mask code
  $('.code').mask("00000", {placeholder: "00000"});

  //mask phone
  $('.tel').mask("(000) 000-0000", {placeholder: "(000) 000-0000"});

  //mask time
  $('.time').mask("00-00", {placeholder: "00-00"});

  //mask bank cart
  $('.bank-cart').mask("0000 0000 0000 0000", {placeholder: "0000 0000 0000 0000"});

  //mask bank date
  $('.bank-date').mask("00/00", {placeholder: "MM/YY"});

  //mask cvc
  $('.cvc').mask("000", {placeholder: "000"});

  //hide/show
  $(document).on('click', '.title-product', function (e){
    e.preventDefault();
    $(this).toggleClass('is-active');
    if($(this).hasClass('is-active')){
      $(this).siblings('.wrap').slideDown();
    }else{
      $(this).siblings('.wrap').slideUp();
    }
  });

  //delete product
  $(document).on('click', '.delete-product a', function (e) {
    e.preventDefault();
    $(this).closest('.item-product').hide();
  });

  //hide/show
  $(document).on('click', '.title-user', function (e){
    e.preventDefault();
    $(this).toggleClass('is-active');
    if($(this).hasClass('is-active')){
      $(this).siblings('.wrap-user').slideDown();
    }else{
      $(this).siblings('.wrap-user').slideUp();
    }
  });


  //open menu
  $(document).on('click', '.mob-btn-filter a', function (e) {
    e.preventDefault();
    $('.catalog-menu .menu-right').addClass('is-active');
  });
  //close menu
  $(document).on('click', '.close-menu a', function (e) {
    e.preventDefault();
    $('.catalog-menu .menu-right').removeClass('is-active');
  });

});
