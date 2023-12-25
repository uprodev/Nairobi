jQuery(document).ready(function ($) {
  change_price()
  $('.wrap-items input').change();

  $('.wrap-items input').change(function(){
    change_price();
    var title = $(this).closest('.item').find('.text').html();
    $('.sub-title-box').html(title);
    var val = $(this).val();

    if ('regular' === val) {
      $('.total-block .total-wrap').hide();
      $('.input-wrap-characteristics').hide();
      var title = $('.select-plan').attr('data-title-reg');
      $('.select-plan').html(title);
      $('[name="action"]').val('select_meals');
    } else {
      $('.total-block .total-wrap').show();
      $('.input-wrap-characteristics').show();
      var title = $('.select-plan').attr('data-title');
      $('.select-plan').html(title);
      $('[name="action"]').val('add_to_cart');
    }
  })
    $('.input-wrap-number-col').change(function(){
      change_price()
      var a,k
      a = $('.num-adults input').val();
      k = $('.num-kids input').val();

      $('.persons').html('');
      for (var i=1;i<=a;i++) {
        $('.persons').append('<li class="option"><a href="#">Person '+ i +'</a></li>');
      }
      for (var i=1;i<=k;i++) {
        $('.persons').append('<li class="option"><a href="#">Kid '+ i +'</a></li>');
      }

      $(".tabs").lightTabs();
    })

    $('.check-item input').change(function(){
      change_price()
      var val = $(this).val();
      var prop = $(this).prop('checked');
      var apply = $('[name="apply-to-all"]').prop('checked');
      if (apply) {
        $('.tab-content-features [value="'+ val +'"]' ).prop('checked', prop);
      }
    })




  function change_price() {
      var price = parseFloat($('.wrap-items input:checked').attr('data-price'));
      var a,k
      a = parseInt($('.num-adults input').val());
      k = parseInt($('.num-kids input').val());
      var total = (a+k) * price;
      var total_pp = total/(a+k);

      $('.box_price').html('€' + price);
      $('.box_price_pp').html('€' + price);
      $('.box_price_total').html('€' + total);
  }


  $('.box-form').submit(function(e){
    e.preventDefault();
    var data = $(this).serialize();

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


  $('.filter-form [name]').change(function(){
    $('.filter-form').submit()
  })
  $('.filter-form').submit(function(e){
    e.preventDefault();
    var data = $(this).serialize();

    $.ajax({
      url: '/wp-admin/admin-ajax.php',
      data: data,
      type: 'POST',
      dataType: 'json',
      success: function (data) {
        if (data) {
          console.log(data)

          $('.filter_output').html(data.html)
        }
      }
    });

  })


  $(document).on('click', '.add_to_cart', function(e){
    e.preventDefault();
    var product_id = $(this).attr('data-product_id');
    var qty = $(this).closest('.item').find('input').val();
    var meta = $('[name="person"]').val();

    $('.mini-cart').block({
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
        $( document.body ).trigger( 'wc_fragment_refresh' );

      },
    });
  })


  /**
   * cart
   */

  $(document).on('change', '.mini-cart input', function () {
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
        $(document.body).trigger('wc_update_cart');
        $( document.body ).trigger( 'wc_fragment_refresh' );
      },
    });
  });






  //name="apply-to-all"
})
