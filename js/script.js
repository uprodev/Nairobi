jQuery(document).ready(function ($) {

  //number col
  $(".btn-count-plus").click(function () {
    var e = $(this).parent().find("input");
    return e.val(parseInt(e.val()) + 1), e.change(), !1
  }), $(".btn-count-minus").click(function () {
    var e = $(this).parent().find("input"), t = parseInt(e.val()) - 1;
    return t = t < 1 ? 1 : t, e.val(t), e.change(), !1
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

});