<?php
session_start();
include("config.php");
include_once './components/header.php';

// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_quantity'])) {
//   $product_id = $_POST['product_id'];
//   $new_quantity = $_POST['new_quantity'];

//   foreach ($_SESSION['shopping_cart'] as &$item) {
//     if ($item['product_id'] === $product_id) {
//       $item['quantity'] = $new_quantity;
//       break;
//     }
//   }
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_item'])) {
  $product_id = $_POST['product_id'];
  if (isset($_SESSION['shopping_cart'])) {
    $_SESSION['shopping_cart'] = array_filter($_SESSION['shopping_cart'], function ($item) use ($product_id) {
      return $item['product_id'] !== $product_id;
    });
  }
}
;

echo '<script>
function updateCartItemQuantity(productId, quantity) {
  $.ajax({
    url: "./services/update_cart_item_quantity.php",
    method: "POST",
    data: {
      product_id: productId,
      quantity: quantity
    },
    success: function(response) {
      console.log(response);
      var responseData = response;
      var responseData = JSON.parse(response);
      
      function formatCurrency(amount) {
        var formattedAmount = amount.toLocaleString("vi-VN", {
          style: "currency",
          currency: "VND"
        });

        return formattedAmount;
      }

      var formattedTotalPrice = formatCurrency(responseData.newTotalPrice);

      console.log(formattedTotalPrice);
      if (responseData.hasOwnProperty("newTotalPrice")) {
        console.log("--------------" + responseData.newTotalPrice);
        $("#total_price_vnd").text(formattedTotalPrice);
      }
      console.log(response);
    },
    error: function(xhr, status, error) {
      console.log(error);
    }
  });
}
</script>';

if (isset($_SESSION['shopping_cart']) && count($_SESSION['shopping_cart']) > 0) {
  echo '
    <main class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:pt-28 sm:pb-48 lg:px-0 pb-10 dark:bg-gray-800">
      <h1 class="text-center text-3xl font-bold tracking-tight text-slate-900 dark:text-slate-50 sm:text-4xl">
        Giỏ hàng
      </h1>
    
      <div class="mt-16">
        <section >';
  echo '<ul role="list" class="divide-y divide-slate-200 border-b border-t border-slate-200 dark:!border-gray-500 ">';


  // if (isset($_SESSION['shopping_cart'])) {
  $total_price = 0;
  foreach ($_SESSION['shopping_cart'] as $productID => $product) {
    $total_price += ($product['product_price'] * $product['quantity']);
    $product_price_vnd = number_format($product['product_price'] / 1, 0, ',', '.') . ' đ';
    echo '<li class="flex py-6 border-slate-200 dark:!border-gray-500">
      <div class="flex-shrink-0 rounded-md">
        <img alt="' . $product['product_name'] . '" class="h-24 w-24 rounded-md object-cover object-center sm:h-32 sm:w-32" src="' . $product['product_image_link'] . '">
      </div>

      <div class="ml-4 flex flex-1 flex-col sm:ml-6">
        <div>
          <div class="flex justify-between">
            <h4 class="text-sm">
              <a href=" ' . $product['product_image_link'] . '" class="text-lg font-medium text-slate-700 hover:text-slate-800 dark:text-slate-50">
                ' . $product['product_name'] . '
              </a>
            </h4>
            <p class="ml-4 text-sm font-medium text-slate-900 dark:text-slate-50">
            ' . $product_price_vnd . '
            </p>
          </div>
          <ul class="mt-1 space-x-2 divide-x divide-slate-200 text-sm text-slate-500">

          </ul>
        </div>

        <div class="mt-4 flex flex-1 items-end justify-between">
          <div>
            <input class="appearance-none border border-slate-300 rounded-md shadow-sm checked:bg-sky-500 checked:text-sky-500 disabled:bg-slate-100 disabled:opacity-50 disabled:cursor-not-allowed focus:border-sky-500 focus:ring-sky-500 dark:border-white/10 dark:bg-gray-800 dark:focus:border-sky-500 dark:focus:ring-sky-500 dark:text-slate-50 dark:focus:ring-offset-slate-900 dark:checked:bg-sky-500 w-16 no-spinners text-center sm:text-sm" type="number" min="1" name="quantity" value="' . $product['quantity'] . '" id="quantity" onchange="updateCartItemQuantity(' . $product['product_id'] . ', this.value)">
          </div>
          <div class="ml-4">
            <form action="" method="post">
            <input type="hidden" name="product_id" value="' . $product['product_id'] . '">
            <input type="submit" class="text-red-400" value="Xoá" name="remove_item">
        </form>
          </div>
        </div>
      </div>
    </li>';
  }
  ;
  $total_price_vnd = number_format($total_price / 1, 0, ',', '.') . ' đ';
  echo '</section>
  <section class="mt-10">

    <div>
      <dl class="space-y-4">
        <div class="flex items-center justify-between">
          <dt class="text-base font-medium text-slate-900 dark:text-slate-50">
          Tổng cộng
          </dt>
          <dd id="total_price_vnd" class="ml-4 text-base font-medium text-slate-900 dark:text-slate-50">
          ' . $total_price_vnd . '
          </dd>
        </div>
      </dl>
      <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
        Phí vận chuyển sẽ được tính khi thanh toán.
      </p>
    </div>

    <div class="mt-10">
      <a class="btn btn-primary hover:opacity-80 dark:!bg-indigo-500 dark:hover:!bg-indigo-600 !border-none btn-xl w-full" 
      ' . ( /**/NULL) . 'style="background: #990B61; color:#fff; border-color: #000;", id = "btn_muahang">
        Mua hàng
      </a>
    </div>

    <div class="mt-6 text-center text-sm ">
      <p class="dark:text-slate-500">
        <a href="./index.php" class="btn btn-link dark:!text-indigo-400"
        ' . ( /**/NULL) . 'style="color: #990B61;">
          Hoặc tiếp tục mua sắm
          <span aria-hidden="true"> →</span>
        </a>
      </p>
    </div>
  </section>
</div>
</main>';

} else {
  echo '<main class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:pt-28 sm:pb-48 lg:px-0 pb-10 dark:bg-gray-800">
  <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:px-0">
                      <div class="mb-6 mx-auto text-center">
              <svg class="mx-auto h-24 w-24 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"></path>
</svg>
              <h3 class="mt-2 text-lg font-medium text-slate-900 dark:text-slate-50">
                  Hiện không có sản phẩm nào trong giỏ hàng
              </h3>

              <p class="mt-1 text-sm text-slate-500 dark:text-slate-50">
              </p>

              <div class="mt-6">
                  <a href="./index.php" class="btn btn-primary hover:opacity-80  dark:!bg-indigo-500 dark:hover:!bg-indigo-600  !border-none" 
                  ' . ( /**/NULL) . 'style="background: #990B61; color:#fff; border-color: #000;">
                      Tiếp tục mua sắm
                  </a>
              </div>
          </div>
              </div>
</main>';
}

echo '';
include_once './components/footer.php';
$con->close();
?>
<!-- <script src="../JS/tailwind.config.js"></script>
<script src="../JS/app.js"></script> -->
<script>
  $(document).ready(function(){
    $("#btn_muahang").click(function(){
      $.ajax({
        url: "process_cart.php", 
        type: "POST",
        data: {action: 'click'},
        success: function(response){
          if (response === "checkout.php"){
            window.location.href = `${response}`;
          }
          else if (response === "login.php"){
            window.location.href = `${response}` + '?passToCart=1';
          }
        }
      })
    })
  })
</script>