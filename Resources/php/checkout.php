<?php
include_once("config.php");
include_once 'header.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Lấy thông tin từ biểu mẫu
  $name = mysqli_real_escape_string($con, $_POST["shipping-name"]);
  $address = mysqli_real_escape_string($con, $_POST["shipping-address"]);
  $phone = mysqli_real_escape_string($con, $_POST["shipping-phone"]);
  $orderNotes = mysqli_real_escape_string($con, $_POST["order_notes"]);
  $total_price = mysqli_real_escape_string($con, $_POST["total_price"]);
  $userId = 1; // Đây là giá trị ví dụ, cần thay thế bằng user_id thực tế

  print_r($_POST);

  //mysqli_prepare
  // Tạo đơn hàng
  $sql = "INSERT INTO orders (user_id, total_amount, order_date, order_number, payment_status, shipping_status) VALUES ('$userId', '$total_price', NOW(), '', 'Chưa thanh toán', 'Chưa vận chuyển')";
  if ($con->query($sql) === TRUE) {
    $orderId = $con->insert_id;

    $updateSql = "UPDATE orders SET order_number = '$orderId' WHERE id = $orderId";
    $con->query($updateSql);
    // Lưu chi tiết đơn hàng
    $orderItems = $_POST["order_items"];
    foreach ($orderItems as $item) {
      $productId = $item["product_id"];
      $quantity = $item["quantity"];
      $price = $item["price"];

      // Lưu mục đơn hàng
      $sql = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ('$orderId', '$productId', '$quantity', '$price')";
      if ($con->query($sql) !== TRUE) {
        echo "Lỗi: " . $sql . "<br>" . $con->error;
        exit;
      }
    }

    // Cập nhật tổng số tiền của đơn hàng
    $sql = "UPDATE orders SET total_amount = (SELECT SUM(quantity * price) FROM order_items WHERE order_id = '$orderId') WHERE id = '$orderId'";
    if ($con->query($sql) === TRUE) {
      // Lưu chi tiết đơn hàng
      $sql = "INSERT INTO order_details (order_id, name, address, phone, order_notes) VALUES ('$orderId', '$name', '$address', '$phone', '$orderNotes')";
      if ($con->query($sql) === TRUE) {
        // echo "Đơn hàng đã được đặt thành công. Mã đơn hàng của bạn là: " . $orderId;
        // Lấy ID đơn hàng mới tạo
        $orderId = $con->insert_id;

        // Lưu ID đơn hàng vào Session (hoặc truyền qua URL)
        $_SESSION['new_order_id'] = $orderId;

        header("Location: process_checkout.php");
        exit;
      } else {
        echo "Lỗi: " . $sql . "<br>" . $con->error;
      }
    } else {
      echo "Lỗi: " . $sql . "<br>" . $con->error;
    }
  } else {
    echo "Lỗi: " . $sql . "<br>" . $con->error;
  }
}
if (!isset($_SESSION['shopping_cart']) || count($_SESSION['shopping_cart']) == 0) {
  // return;
  header("Location: ./cart.php");
  // header("Location: ../index.php");
}
$con->close();
?>





  <main class="mx-auto max-w-2xl px-4 pb-24 pt-16 sm:px-6 sm:pt-28 sm:pb-64  lg:max-w-7xl lg:px-8">
    <h1 class="text-center text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl mt-8 mb-16">
        Đặt hàng
      </h1>
   
    <form method="post" class="lg:grid lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16">
      <?php
      if (isset($_SESSION['shopping_cart'])) {
        $i = 0;
        foreach ($_SESSION['shopping_cart'] as $productID => $product) {
          echo '<input type="hidden" name="order_items[' . $i . '][product_id]" value="' . $product['product_id'] . '">';
          echo '<input type="hidden" name="order_items[' . $i . '][quantity]" value="' . $product['quantity'] . '">';
          echo '<input type="hidden" name="order_items[' . $i . '][price]" value="' . $product['product_price'] . '">';
          $i++;
        };
      };
      ?>
      <div>
        <div class="mb-10 border-b border-slate-200 pb-10">
          <h2 class="text-lg font-medium text-slate-900">Thông tin giao hàng</h2>
          <!-- <h2 class="text-lg font-medium text-slate-900">Contact information</h2> -->

          <div class="mt-4">
            <label class="block block text-sm text-sm font-medium font-medium text-slate-700 text-slate-700 dark:text-slate-700" for="contact-email"> Email </label>
            <div class="mt-1">
              <input required class="p-2 block w-full appearance-none rounded-md border border-slate-300 shadow-sm checked:bg-sky-500 checked:text-sky-500 focus:border-sky-500 focus:ring-sky-500 disabled:cursor-not-allowed disabled:bg-slate-100 disabled:opacity-50 dark:border-white/10 dark:bg-white/5 dark:text-slate-700 dark:checked:bg-sky-500 dark:focus:border-sky-500 dark:focus:ring-sky-500 dark:focus:ring-offset-slate-900 sm:text-sm" type="email" id="contact-email" name="contact-email" autocomplete="email" />
            </div>
          </div>
        </div>
        <div>
          <!-- <h2 class="text-lg font-medium text-slate-900">Shipping information</h2> -->

          <div class="mt-4 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
            <div class="sm:col-span-2">
              <label class="block text-sm font-medium text-slate-700 dark:text-slate-700" for="shipping-name"> Họ tên </label>
              <div class="mt-1">
                <input required class="p-2 block w-full appearance-none rounded-md border border-slate-300 shadow-sm checked:bg-sky-500 checked:text-sky-500 focus:border-sky-500 focus:ring-sky-500 disabled:cursor-not-allowed disabled:bg-slate-100 disabled:opacity-50 dark:border-white/10 dark:bg-white/5 dark:text-slate-700 dark:checked:bg-sky-500 dark:focus:border-sky-500 dark:focus:ring-sky-500 dark:focus:ring-offset-slate-900 sm:text-sm" type="text" id="shipping-name" placeholder="injection" name="shipping-name" autocomplete="given-name" />
              </div>
            </div>

            <div class="sm:col-span-2">
              <label class="block text-sm font-medium text-slate-700 dark:text-slate-700" for="shipping-address-line-1"> Địa chỉ </label>
              <div class="mt-1">
                <input required class="p-2 block w-full appearance-none rounded-md border border-slate-300 shadow-sm checked:bg-sky-500 checked:text-sky-500 focus:border-sky-500 focus:ring-sky-500 disabled:cursor-not-allowed disabled:bg-slate-100 disabled:opacity-50 dark:border-white/10 dark:bg-white/5 dark:text-slate-700 dark:checked:bg-sky-500 dark:focus:border-sky-500 dark:focus:ring-sky-500 dark:focus:ring-offset-slate-900 sm:text-sm" type="text" placeholder="injection"  name="shipping-address" id="shipping-address" autocomplete="street-address" />
              </div>
            </div>

            <div class="sm:col-span-2">
              <label class="block text-sm font-medium text-slate-700 dark:text-slate-700" for="shipping-phone"> Số điện thoại </label>
              <div class="mt-1">
                <input required class="p-2 block w-full appearance-none rounded-md border border-slate-300 shadow-sm checked:bg-sky-500 checked:text-sky-500 focus:border-sky-500 focus:ring-sky-500 disabled:cursor-not-allowed disabled:bg-slate-100 disabled:opacity-50 dark:border-white/10 dark:bg-white/5 dark:text-slate-700 dark:checked:bg-sky-500 dark:focus:border-sky-500 dark:focus:ring-sky-500 dark:focus:ring-offset-slate-900 sm:text-sm" type="tel" placeholder="injection"  name="shipping-phone" id="shipping-phone" />
              </div>
            </div>
          </div>
        </div>

        <div class="mt-10 border-t border-slate-200 pt-10">
          <h2 class="text-lg font-medium text-slate-900">Phương thức thanh toán</h2>

          <fieldset class="mt-4">

            <div class="space-y-4">
              <label class="relative block cursor-pointer rounded-lg border border-gray-300 bg-white px-6 py-4 shadow-sm focus:outline-none sm:flex sm:justify-between" :class="{'border-transparent ring-2 ring-sky-600': paymentMethod === 'cash_on_delivery', 'border-gray-300': paymentMethod !== 'cash_on_delivery'}">
                <span class="flex items-center">
                  <span class="flex flex-col text-sm">
                    <div class="flex">
                      <input type="radio" checked>
                      <span class="ml-2 font-medium text-gray-900"> Thanh toán khi nhận hàng </span>
                    </div>
                    <span class="text-gray-500">
                      <span class="block sm:inline">  </span>
                    </span>
                  </span>
                </span>
              </label>
            </div>
          </fieldset>
        </div>

        <div class="mt-10 border-t border-slate-200 pt-10">
          <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
            <div class="sm:col-span-2">
              <label class="block text-sm font-medium text-slate-700 dark:text-slate-700" for="notes"> Ghi chú (không bắt buộc) </label>
              <div class="mt-1">
                <textarea class="block w-full appearance-none rounded-md border border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500 disabled:cursor-not-allowed disabled:bg-slate-100 disabled:opacity-50 dark:border-white/10 dark:bg-white/5 dark:text-slate-700 dark:focus:border-sky-500 dark:focus:ring-sky-500 dark:focus:ring-offset-slate-900 sm:text-sm" placeholder="injection"  name="order_notes" id="notes" placeholder="..."> </textarea>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="mt-10 lg:mt-0">
        <div class="sticky top-4">
          <h2 class="text-lg font-medium text-slate-900">Sản phẩm <?php echo '('.count($_SESSION['shopping_cart']).')' ?></h2>

          <div class="mt-4 rounded-lg border border-slate-200 bg-white shadow-sm">

            <ul role="list" class="divide-y divide-gray-200 text-sm text-gray-900">
      <?php
      if (isset($_SESSION['shopping_cart'])) {
        $total_price = 0;
        $i = 0; 
        $cart_items_count = count($_SESSION['shopping_cart']);
        foreach ($_SESSION['shopping_cart'] as $productID => $product) {
          echo '<input type="hidden" name="order_items[' . $i . '][product_id]" value="' . $product['product_id'] . '">';
          echo '<input type="hidden" name="order_items[' . $i . '][quantity]" value="' . $product['quantity'] . '">';
          echo '<input type="hidden" name="order_items[' . $i . '][price]" value="' . $product['product_price'] . '">';
          $i++;
          $total_price += ($product['product_price'] * $product['quantity']);
    $product_price_vnd = number_format($product['product_price'] / 1, 0, ',', '.') . ' đ';
      echo '<li class="flex items-center space-x-4 px-4 py-6 sm:px-6">
                <div class="relative flex flex-shrink-0 rounded-md border border-slate-200">
                  <img alt="' . $product['product_name'] . '" class="h-20 w-20 rounded-md" src="' . $product['product_image_link'] . '" />
                  <span class="absolute -right-2 -top-3 whitespace-nowrap rounded-full bg-slate-400 px-2 py-0.5 text-center text-xs font-medium tabular-nums leading-5 text-white ring-1 ring-inset ring-slate-400">' . $product['quantity'] . '</span>
                </div>
                <div class="ml-6 flex-auto space-y-1">
                  <h4 class="line-clamp-2">
                    <a href="https://" class="font-medium text-slate-700 hover:text-slate-800"> ' . $product['product_name'] . ' </a>
                  </h4>
                  <ul class="space-x-2 divide-x divide-slate-200 text-sm text-slate-500">
                  </ul>
                </div>
                <p class="flex flex-col space-y-1 text-right font-medium">' . $product_price_vnd . '</p>
              </li>';
            };
            $total_price_vnd = number_format($total_price / 1, 0, ',', '.') . ' đ';
      };
                    ?>        

            </ul>

            <dl class="space-y-6 border-t border-slate-200 px-4 py-6 sm:px-6">
              <div class="flex items-center justify-between">
                <dt class="text-sm font-medium">Giá trị đơn hàng</dt>
                <dd class="text-sm font-medium text-slate-900"><?php echo $total_price_vnd?></dd>
              </div>

              <div class="flex items-center justify-between">
                <dt class="text-sm font-medium">Phí vận chuyển</dt>
                <dd class="text-sm font-medium text-slate-900">0</dd>
              </div>
              <div class="flex items-center justify-between">
                <dt class="text-sm font-medium">Thuế</dt>
                <dd class="text-sm font-medium text-slate-900">0</dd>
              </div>
              <div class="flex items-center justify-between border-t border-slate-200 pt-6">
                <dt class="text-base font-medium">Tổng thanh toán</dt>
                <dd class="text-base font-medium text-slate-900"><?php echo $total_price_vnd?></dd>
                <input type="hidden" name="total_price" value="<?php echo $total_price ?>">
              </div>
            </dl>

            <div class="border-t border-slate-200 px-4 py-6 sm:px-6">
              <button type="submit" class="btn btn-primary btn-xl w-full bg-[#0d6efd]" style="background: #990B61; color:#fff; border-color: #000;">Đặt hàng</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </main>

<?php
  include_once 'footer.php';
  ?>