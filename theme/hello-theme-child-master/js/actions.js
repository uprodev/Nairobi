jQuery(document).ready(function ($) {
  change_price()
  $('.wrap-items input').change();

  $('.wrap-items input').change(function(){
    change_price();
    var title = $(this).closest('.item').find('.text').html();
    $('.sub-title-box').html(title)
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

        }
      }
    });

  })


  //name="apply-to-all"
})
