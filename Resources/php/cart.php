<?php
session_start();
include("config.php");
include_once 'header.php';



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
};

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

if (isset($_SESSION['shopping_cart'])) {
echo '
    <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:px-0">
      <h1 class="text-center text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
        Giỏ hàng
      </h1>
    
      <div class="mt-16">
        <section >';
echo '<ul role="list" class="divide-y divide-slate-200 border-b border-t border-slate-200">';


// if (isset($_SESSION['shopping_cart'])) {
  $total_price = 0;
  foreach ($_SESSION['shopping_cart'] as $productID => $product) {
    $total_price += ($product['product_price'] * $product['quantity']);
    $product_price_vnd = number_format($product['product_price'] / 1, 0, ',', '.') . ' đ';
    echo '<li class="flex py-6">
      <div class="flex-shrink-0 border border-slate-200 rounded-md">
        <img alt="' . $product['product_name'] . '" class="h-24 w-24 rounded-md object-cover object-center sm:h-32 sm:w-32" src="' . $product['product_image_link'] . '">
      </div>

      <div class="ml-4 flex flex-1 flex-col sm:ml-6">
        <div>
          <div class="flex justify-between">
            <h4 class="text-sm">
              <a href=" ' . $product['product_image_link'] . '" class="text-lg font-medium text-slate-700 hover:text-slate-800">
                ' . $product['product_name'] . '
              </a>
            </h4>
            <p class="ml-4 text-sm font-medium text-slate-900">
            ' . $product_price_vnd . '
            </p>
          </div>
          <ul class="mt-1 space-x-2 divide-x divide-slate-200 text-sm text-slate-500">

          </ul>
        </div>

        <div class="mt-4 flex flex-1 items-end justify-between">
          <div>
            <input class="appearance-none border border-slate-300 rounded-md shadow-sm checked:bg-sky-500 checked:text-sky-500 disabled:bg-slate-100 disabled:opacity-50 disabled:cursor-not-allowed focus:border-sky-500 focus:ring-sky-500 dark:border-white/10 dark:bg-white/5 dark:focus:border-sky-500 dark:focus:ring-sky-500 dark:text-slate-600 dark:focus:ring-offset-slate-900 dark:checked:bg-sky-500 w-16 no-spinners text-center sm:text-sm" type="number" min="1" name="quantity" value="' . $product['quantity'] . '" id="quantity" onchange="updateCartItemQuantity(' . $product['product_id'] . ', this.value)">
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
  };
  $total_price_vnd = number_format($total_price / 1, 0, ',', '.') . ' đ';
  echo '</section>
  <section class="mt-10">

    <div>
      <dl class="space-y-4">
        <div class="flex items-center justify-between">
          <dt class="text-base font-medium text-slate-900">
          Tổng cộng
          </dt>
          <dd id="total_price_vnd" class="ml-4 text-base font-medium text-slate-900">
          ' . $total_price_vnd. '
          </dd>
        </div>
      </dl>
      <p class="mt-1 text-sm text-slate-500">
        Phí vận chuyển sẽ được tính khi thanh toán.
      </p>
    </div>

    <div class="mt-10">
      <a href="checkout.php" class="btn btn-primary btn-xl w-full">
        Mua hàng
      </a>
    </div>

    <div class="mt-6 text-center text-sm">
      <p>
        hoặc
        <a href="../index.php" class="btn btn-link">
          Tiếp tục mua sắm
          <span aria-hidden="true"> →</span>
        </a>
      </p>
    </div>
  </section>
</div>
</div>';
} else {
  echo '<div class="flex justify-center items-center h-[90vh]"><span class="text-9xl">Giỏ hàng trống.</span></div>';
}
echo '';
include_once 'footer.php';
$con->close();
