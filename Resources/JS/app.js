
function showCartToast(product_name) {
  var toastBody = $("#cartToast .toast-body");

  toastBody.text("Đã thêm sản phẩm  vào giỏ hàng.");

  $("#cartToast").toast({
    delay: 2000
  }).toast("show");
}


// var script = document.createElement('script');
// 	script.src = 'https://code.jquery.com/jquery-3.6.0.min.js';
// 	script.type = 'text/javascript';
// 	document.head.appendChild(script);
function addToCart(product_id, product_name, product_image_link, product_price) {
  $.ajax({
    type: "POST",
    url: "./php/services/add_to_cart.php",
    data: {
      product_id: product_id,
      product_name: product_name,
      product_image_link: product_image_link,
      product_price: product_price
    },
    success: function (response) {
      console.log('success')
      showCartToast(product_name);
    },
    error: function (xhr, status, error) {
      console.error("AJAX request failed:", status, error);
    }
  });
}
