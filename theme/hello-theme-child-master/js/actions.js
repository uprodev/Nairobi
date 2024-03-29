jQuery(document).ready(function ($) {

  /**
   * change_price
   */

  var product = $('.wrap-items input:checked').val();
  //change_price()
  setTimeout(function(){
    $('.wrap-items input:checked').change()
  }, 300)

  change_persons();
  $('.wrap-items input').change();
  $('.input-wrap-number-col').change();
  $('.num-kids').hide();
  $('.wrap-items input').change(function(){
    //change_price();
    var title = $(this).closest('.item').find('.text').html();
    $('.sub-title-box').html(title);
    var val = $(this).val();


    if ('regular' === val) {
      $('.total-block .total-wrap').hide();
      $('.input-wrap-characteristics').hide();
      $('.num-meals').show();
      var title = $('.select-plan').attr('data-title-reg');
      $('.select-plan').html(title);
      $('[name="action"]').val('select_meals');
    } else {
      $('[name="action"]').val('dynamic_cart');
      $('.info').hide();
      $('.num-meals').hide();
      $('.total-block .total-wrap').show();
      $('.input-wrap-characteristics').show();
      var title = $('.select-plan').attr('data-title');
      $('.select-plan').html(title)
      $('#desc-' + val).show();
      $('.num-kids').show();
      $('.num-mb').hide();
      $('.num-adults p').html('Adults')
      if (val !== "692") {
        $('.num-kids').hide();
        $('.num-kids input').val(0);
        $('.num-mb').show();
        $('.num-adults p').html('Meals (+12,50€)')
      }


      dynamic_cart(val)
      return false  ;




    }
  })


  function dynamic_cart(val) {
    $.ajax({
      url: '/wp-admin/admin-ajax.php',
      data: $('.box-form').serialize(),
      data0: {
        action: 'dynamic_cart',
        product_id: val,
        qty: $('[name="count_adults"]').val(),
        count_drinks: $('[name="count_drinks"]').val(),
        count_deserts: $('[name="count_deserts"]').val(),
      },
      type: 'POST',
      dataType: 'json',
      success: function (data) {
        if (data) {
          console.log(data)

          $('.dynamic-cart').html(data.html)

        }
      }
    });
  }

  $('.input-wrap-number-col').change(function(){
   // change_price();
    change_persons();
    dynamic_cart(product)
  })

  function change_persons()  {
    var a,k
    a = parseInt($('.num-adults input').val());
    k = parseInt($('.num-kids input').val());
    $('.tab-item input').attr('name', '')

    $('.persons').html('');
    for (var i=1;i<=a;i++) {
      $('.persons').append('<li class="option"><a href="#">Person '+ i +'</a></li>');
      $('.tab-item').eq(i-1).find('.check-item input').each(function(){
        $(this).attr('name', 'feature[person-'+ i +'][]')
      })

    }
    for (var i=1;i<=k;i++) {
      $('.persons').append('<li class="option"><a href="#">Kid '+ i +'</a></li>');
      $('.tab-item').eq((a+i)-1).find('.check-item input').each(function(){
        $(this).attr('name', 'feature[kid-'+ i +'][]')
      })
    }

    $(".tabs").lightTabs();
  }

  $('.check-item input').change(function(){

    var val = $(this).val();
    var prop = $(this).prop('checked');
    var apply = $('[name="apply-to-all"]').prop('checked');
    if (apply) {
      $('.tab-content-features [value="'+ val +'"]' ).prop('checked', prop);
    }
    dynamic_cart(product)
  })


  /**
   * change_price
   */


  function change_price() {
      var price = parseFloat($('.wrap-items input:checked').attr('data-price'));
      var a,k
      a = parseInt($('.num-adults input').val());
      k = parseInt($('.num-kids input').val());
      var total = (a+k) * price;
      var total_pp = total/(a+k);

      $('.box_price').html('€' + price);

      var delivery =  parseFloat($('.box_price_pp').attr('data-price'))
      var totalDelivery = Math.round((total + delivery) * 100) / 100;
      $('.box_price_pp').html('€' + delivery);
      $('.box_price_total').html('€' + totalDelivery);
  }


  /**
   * select box
   */

  $('.box-form').submit(function(e){
    e.preventDefault();
    var data = $(this).serialize();


    if ($('[name="action"]').val() == 'dynamic_cart')
      location.href = $('.select-plan').attr('data-url')


    $.ajax({
      url: '/wp-admin/admin-ajax.php',
      data: data,
      type: 'POST',
      dataType: 'json',
      success: function (data) {
        if (data) {
          console.log(data)

          if (data.url) {
            location.href = data.url
          }

        }
      }
    });

  })


  /**
   * filter
   */

  $('.filter-form .filter-line [name]').change(function(){
    $('.filter-form').submit()
  })
  $('.filter-form').submit(function(e){
    e.preventDefault();
    var data = $(this).serialize();
    $('.filter_output > div').block({
      message: null,
      overlayCSS: {
        background: '#fff',
        opacity: 0.4
      }
    })
    $.ajax({
      url: '/wp-admin/admin-ajax.php',
      data: data,
      type: 'POST',
      dataType: 'json',
      success: function (data) {
        if (data) {
          console.log(data)

          $('.filter_output').html(data.html)

          $(".fancybox").fancybox({
            touch:false,
            autoFocus:false,
          });

        }
      }
    });

  })


  /**
   * add-to-cat
   */

  $(document).on('click', '.add_to_cart', function(e){
    e.preventDefault();
    var product_id = $(this).attr('data-product_id');
    var qty = $(this).closest('.item').find('input').val();
    var meta = $('[name="person"]').val();

    $('.mini-cart, .total-block').block({
      message: null,
      overlayCSS: {
        background: '#fff',
        opacity: 0.4
      }
    })

    $.ajax({
      url: wc_add_to_cart_params.ajax_url,
      type:'POST',
      data: {
        action: 'add_to_cart',
        product_id: product_id,
        meta: meta,
        qty: qty
      },
      success: function (data) {

        console.log(data)

        if (data.msg) {
          alert(data.msg)
        }

        if (data.url) {
          location.href = data.url
        }

        $( document.body ).trigger( 'wc_fragment_refresh' );

        setTimeout(function(){
          select_current_user()
          if ($(window).width() < 767) {
            $('.catalog-menu .menu-right').addClass('is-active');
          }
        }, 500)
      },
    });
  })


  /**
   * cart
   */

  $(document).on('change', '.cart-qty input', function () {
    var item_hash = $(this)
      .attr('name')
      .replace(/cart\[([\w]+)\]\[qty\]/g, '$1');
    var item_quantity = $(this).val();
    var currentVal = parseFloat(item_quantity);


    $('.mini-cart').block({
      message: null,
      overlayCSS: {
        background: '#fff',
        opacity: 0.4
      }
    })


    $.ajax({
      type: 'POST',
      url: wc_add_to_cart_params.ajax_url,
      data: {
        action: 'qty_cart',
        hash: item_hash,
        quantity: currentVal,
      },
      success: function (data) {
        if (data.msg) {
          alert(data.msg)
        }

        $(document.body).trigger('wc_update_cart');
        $( document.body ).trigger( 'wc_fragment_refresh');
        setTimeout(function(){
          select_current_user()
        }, 500)

      },
    });
  });

  /**
   * remove_from_cart
   */
  $(document).on('click', '.remove_from_cart', function () {

    var item_hash = $(this).attr('data-hash');

    $.ajax({
      type: 'POST',
      url: wc_add_to_cart_params.ajax_url,
      data: {
        action: 'remove_item_from_cart',
        hash: [item_hash],
      },
      success: function (data) {
        $(document.body).trigger('wc_update_cart');

        select_current_user()
      },
    });
  })

  $(document).on('removed_from_cart',  function () {

    select_current_user()

  })


  /**
   * persons
   */
  $(document).on('change', '#person', function () {
    select_current_user()
  })

  function select_current_user() {
    var val = $('#person').val();
    $('.person-item-wrap').hide()
    $('.' + val).show()

    $('.filter_output input').val(1)
  }

  /**
   * complete-order
   */

  $(document).on('click', '.complete-order', function (e) {
    e.preventDefault();
    var valid = $(this).attr('data-valid');
    var url = $(this).attr('href');
    if (valid == 'valid') {
      location.href = url
    } else {
      alert( $(this).attr('data-msg'))
    }
  })


  $(document).on('click', '.show-all', function (e) {
    e.preventDefault();
    $(this).closest('.title-wrap').next('.content').find('.item').show()
  })


  /**
   * login
   */

  $('.form-login').submit(function(e){
    e.preventDefault();
    var data = $(this).serialize();


    $('.form-login').block({
      message: null,
      overlayCSS: {
        background: '#fff',
        opacity: 0.4
      }
    })
    $('.result').html('')
    $.ajax({
      url: '/wp-admin/admin-ajax.php',
      data: data,
      type: 'POST',
      dataType: 'json',
      success: function (data) {
        if (data) {
          console.log(data)

          if (data.url) {
            location.href = data.url
          }
          if (data.msg) {
            $('.result').html(data.msg)
          }

          $('.form-login').unblock()

        }
      }
    });

  })


  /**
   * apply_coupon
   */

  $(document).on('click', '.apply_coupon_checkout', function (e) {

    e.preventDefault()

    var coupon = $('#code').val();
    $.ajax({
      type: 'POST',
      url: wc_add_to_cart_params.ajax_url,
      data: {
        action: 'apply_coupon',
        coupon: coupon,
      },
      success: function (data) {
        console.log(data)
        $(document.body).trigger('update_checkout');

      },
    });



  });


})
