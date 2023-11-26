<?php
session_start();
ob_start();
include_once("config.php");
include_once './components/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Lấy thông tin từ biểu mẫu
  $name = mysqli_real_escape_string($con, $_POST["shipping-name"]);
  // $address = mysqli_real_escape_string($con, $_POST["shipping-address"]) . ' - ' . $_POST["shipping-ward"] . $_POST["shipping-district"] . $_POST["shipping-city"];
  $address = mysqli_real_escape_string($con, $_POST["shipping-address"]) . ' - ' . $_POST["shipping-ward-text"] . ', ' . $_POST["shipping-district-text"] . ', ' . $_POST["shipping-city-text"];
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
        unset($_SESSION['shopping_cart']);
        exit();
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
  header("Location: ./cart.php");
  exit();
  // header("Location: ./index.php");
}
$con->close();

ob_end_flush();
?>





<main class="mx-auto max-w-2xl px-4 pb-24 pt-16 sm:px-6 sm:pt-28 sm:pb-64  lg:max-w-7xl lg:px-8 dark:bg-gray-800">
  <h1 class="text-center text-3xl font-bold tracking-tight text-slate-900 dark:text-slate-50 sm:text-4xl mt-8 mb-16">
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
      }
      ;
    }
    ;
    ?>
    <div>
      <div class="mb-10 border-b border-slate-200 dark:!border-gray-500  pb-10">
        <h2 class="text-lg font-medium text-slate-900 dark:text-slate-50">Thông tin giao hàng</h2>
        <!-- <h2 class="text-lg font-medium text-slate-900">Contact information</h2> -->

        <div class="mt-4">
          <label
            class="block block text-sm text-sm font-medium font-medium text-slate-700 text-slate-700 dark:text-slate-50"
            for="contact-email"> Email </label>
          <div class="mt-1">
            <input required
              class="p-2 block w-full appearance-none rounded-md border border-slate-300  dark:!border-gray-500 shadow-sm checked:bg-sky-500 checked:text-sky-500 focus:border-sky-500 focus:ring-sky-500 disabled:cursor-not-allowed disabled:bg-slate-100 disabled:opacity-50 dark:border-white/10 dark:bg-gray-800 dark:text-slate-50 dark:checked:bg-sky-500 dark:focus:border-sky-500 dark:focus:ring-sky-500 dark:focus:ring-offset-slate-900 sm:text-sm"
              type="email" id="contact-email" name="contact-email" autocomplete="email" placeholder="VD: abc123@gmail.com" disabled value="<?php echo $_SESSION['valid'];?>"/>
          </div>
        </div>
      </div>
      <div>
        <!-- <h2 class="text-lg font-medium text-slate-900">Shipping information</h2> -->

        <div class="mt-4 grid grid-cols-1 gap-y-6 sm:grid-cols-3 sm:gap-x-4">
          <div class="sm:col-span-3">
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-50" for="shipping-name"> Họ tên
            </label>
            <div class="mt-1">
              <input required
                class="p-2 block w-full appearance-none rounded-md border border-slate-300  dark:!border-gray-500 shadow-sm checked:bg-sky-500 checked:text-sky-500 focus:border-sky-500 focus:ring-sky-500 disabled:cursor-not-allowed disabled:bg-slate-100 disabled:opacity-50 dark:border-white/10 dark:bg-gray-800 dark:text-slate-50 dark:checked:bg-sky-500 dark:focus:border-sky-500 dark:focus:ring-sky-500 dark:focus:ring-offset-slate-900 sm:text-sm"
                type="text" id="shipping-name" value="<?php echo $_SESSION['username'];?>" placeholder="VD: Nguyễn Văn A" name="shipping-name" autocomplete="given-name" />
            </div>
          </div>

          <div class="sm:col-span-3">
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-50" for="shipping-phone"> Số điện
              thoại </label>
            <div class="mt-1">
              <input required
                class="p-2 block w-full appearance-none rounded-md border border-slate-300  dark:!border-gray-500 shadow-sm checked:bg-sky-500 checked:text-sky-500 focus:border-sky-500 focus:ring-sky-500 disabled:cursor-not-allowed disabled:bg-slate-100 disabled:opacity-50 dark:border-white/10 dark:bg-gray-800 dark:text-slate-50 dark:checked:bg-sky-500 dark:focus:border-sky-500 dark:focus:ring-sky-500 dark:focus:ring-offset-slate-900 sm:text-sm"
                type="tel" placeholder="VD: 0XXX-XXX-XXX" name="shipping-phone" id="shipping-phone" value="<?php echo $_SESSION['phone'];?>"/>
            </div>
          </div>
          <div class="sm:col-span-3">
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-50" for="shipping-address-line-1">
              Địa chỉ </label>
            <div class="mt-1">
              <input required
                class="p-2 block w-full appearance-none rounded-md border border-slate-300  dark:!border-gray-500 shadow-sm checked:bg-sky-500 checked:text-sky-500 focus:border-sky-500 focus:ring-sky-500 disabled:cursor-not-allowed disabled:bg-slate-100 disabled:opacity-50 dark:border-white/10 dark:bg-gray-800 dark:text-slate-50 dark:checked:bg-sky-500 dark:focus:border-sky-500 dark:focus:ring-sky-500 dark:focus:ring-offset-slate-900 sm:text-sm"
                type="text" placeholder="VD: Số 549/89/21 đường Xô Viết Nghệ Tĩnh" name="shipping-address" id="shipping-address"
                autocomplete="street-address" />
            </div>
          </div>

          <div>
            <label
              class="block block text-sm text-sm font-medium font-medium text-slate-700 text-slate-700 dark:text-slate-200"
              for="shipping-country"> Tỉnh thành </label>
            <div class="mt-1">
              <select required
                class="p-2 block block w-full w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500 dark:border-white/10 dark:bg-white/5 dark:text-slate-300 dark:focus:border-sky-500 dark:focus:ring-sky-500 dark:focus:ring-offset-slate-900 sm:text-sm"
                id="shipping-city" name="shipping-city" autocomplete="country-name"
                onchange="$('#shipping-city-text').val($(this).find('option:selected').text())">
                <option value="" class="dark:text-slate-40 dark:bg-slate-800">Chọn tỉnh thành</option>
              </select>
            </div>
          </div>
          <input type="hidden" name="shipping-city-text" id="shipping-city-text" value="" />
          <div>
            <label
              class="block block text-sm text-sm font-medium font-medium text-slate-700 text-slate-700 dark:text-slate-200"
              for="shipping-country"> Quận huyện </label>
            <div class="mt-1">
              <select required
                class="p-2 block block w-full w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500 dark:border-white/10 dark:bg-white/5 dark:text-slate-300 dark:focus:border-sky-500 dark:focus:ring-sky-500 dark:focus:ring-offset-slate-900 sm:text-sm"
                id="shipping-district" name="shipping-district" autocomplete="country-name"
                onchange="$('#shipping-district-text').val($(this).find('option:selected').text())">
                <option value="" class="dark:text-slate-40 dark:bg-slate-800">Chọn quận huyện</option>
              </select>
            </div>
          </div>

          <input type="hidden" name="shipping-district-text" id="shipping-district-text" value="" />
          <div>
            <label
              class="block block text-sm text-sm font-medium font-medium text-slate-700 text-slate-700 dark:text-slate-200"
              for="shipping-country"> Phường xã </label>
            <div class="mt-1">
              <select required
                class="p-2 block block w-full w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500 dark:border-white/10 dark:bg-white/5 dark:text-slate-300 dark:focus:border-sky-500 dark:focus:ring-sky-500 dark:focus:ring-offset-slate-900 sm:text-sm"
                id="shipping-ward" name="shipping-ward" autocomplete="country-name"
                onchange="$('#shipping-ward-text').val($(this).find('option:selected').text())">
                <option value="" class="dark:text-slate-40 dark:bg-slate-800">Chọn phường xã</option>
              </select>
            </div>
          </div>
          <input type="hidden" name="shipping-ward-text" id="shipping-ward-text" value="" />

        </div>
      </div>

      <div class="mt-10 border-t border-slate-200 dark:!border-gray-500  pt-10">
        <h2 class="text-lg font-medium text-slate-900 dark:text-slate-50">Phương thức thanh toán</h2>

        <fieldset class="mt-4">

          <div class="space-y-4">
            <label
              class="relative block cursor-pointer rounded-lg border border-gray-300 dark:!border-gray-500 bg-gray-50/20 dark:bg-gray-600 px-6 py-4 shadow-sm focus:outline-none sm:flex sm:justify-between"
              :class="{'border-transparent ring-2 ring-sky-600': paymentMethod === 'cash_on_delivery', 'border-gray-300': paymentMethod !== 'cash_on_delivery'}">
              <span class="flex items-center">
                <span class="flex flex-col text-sm">
                  <div class="flex">
                    <input type="radio" class=" border-2 border-blue-500 checked:bg-indigo-500" checked>
                    <span class="ml-2 font-medium text-slate-900 dark:text-slate-50"> Thanh toán khi nhận hàng </span>
                  </div>
                  <span class="text-slate-500">
                    <span class="block sm:inline"> </span>
                  </span>
                </span>
              </span>
            </label>
          </div>
        </fieldset>
      </div>

      <div class="mt-10 border-t border-slate-200 dark:!border-gray-500  pt-10">
        <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
          <div class="sm:col-span-3">
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-50" for="notes"> Ghi chú (không bắt
              buộc) </label>
            <div class="mt-1">
              <textarea
                class="block w-full appearance-none rounded-md border border-slate-300  dark:!border-gray-500 shadow-sm focus:border-sky-500 focus:ring-sky-500 disabled:cursor-not-allowed disabled:bg-slate-100 disabled:opacity-50 dark:border-white/10 dark:bg-gray-800 dark:text-slate-50 dark:focus:border-sky-500 dark:focus:ring-sky-500 dark:focus:ring-offset-slate-900 sm:text-sm"
                placeholder="injection" name="order_notes" id="notes" placeholder="..."> </textarea>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="mt-10 lg:mt-0">
      <div class="sticky top-4">
        <h2 class="text-lg font-medium text-slate-900 dark:text-slate-50">Sản phẩm
          <?php echo '(' . count($_SESSION['shopping_cart']) . ')' ?>
        </h2>

        <div class="mt-4 rounded-lg border border-slate-200 dark:!border-gray-500  bg-gray-50/20 shadow-sm">

          <ul role="list" class="divide-y divide-gray-200 text-sm text-gray-900 border-t-0">
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
                echo '<li class="flex items-center space-x-4 px-4 py-6 sm:px-6   border-slate-200 dark:!border-gray-500  ">
                <div class="relative flex flex-shrink-0 rounded-md">
                  <img alt="' . $product['product_name'] . '" class="h-20 w-20 rounded-md" src="' . $product['product_image_link'] . '" />
                  <span class="absolute -right-2 -top-3 whitespace-nowrap rounded-full bg-slate-400 px-2 py-0.5 text-center text-xs font-medium tabular-nums leading-5 text-white ring-1 ring-inset ring-slate-400">' . $product['quantity'] . '</span>
                </div>
                <div class="ml-6 flex-auto space-y-1">
                  <h4 class="line-clamp-2">
                    <a href="https://" class="font-medium text-slate-700 dark:text-slate-50 hover:text-slate-800"> ' . $product['product_name'] . ' </a>
                  </h4>
                  <ul class="space-x-2 divide-x divide-slate-200 text-sm text-slate-500">
                  </ul>
                </div>
                <p class="flex flex-col space-y-1 text-right font-medium dark:text-slate-50">' . $product_price_vnd . '</p>
              </li>';
              }
              ;
              $total_price_vnd = number_format($total_price / 1, 0, ',', '.') . ' đ';
            }
            ;
            ?>

          </ul>

          <dl class="space-y-6 border-t border-slate-200 dark:!border-gray-500  px-4 py-6 sm:px-6">
            <div class="flex items-center justify-between">
              <dt class="text-sm font-medium dark:text-slate-50">Giá trị đơn hàng</dt>
              <dd class="text-sm font-medium text-slate-900 dark:text-slate-50">
                <?php echo $total_price_vnd ?>
              </dd>
            </div>

            <div class="flex items-center justify-between">
              <dt class="text-sm font-medium dark:text-slate-50">Phí vận chuyển</dt>
              <dd class="text-sm font-medium text-slate-900 dark:text-slate-50">0</dd>
            </div>
            <div class="flex items-center justify-between">
              <dt class="text-sm font-medium dark:text-slate-50">Thuế</dt>
              <dd class="text-sm font-medium text-slate-900 dark:text-slate-50">0</dd>
            </div>
            <div class="flex items-center justify-between border-t border-slate-200 dark:!border-gray-500  pt-6">
              <dt class="text-base font-medium dark:text-slate-50">Tổng thanh toán</dt>
              <dd class="text-base font-medium text-slate-900 dark:text-slate-50">
                <?php echo $total_price_vnd ?>
              </dd>
              <input type="hidden" name="total_price" value="<?php echo $total_price ?>">
            </div>
          </dl>

          <div class="border-t border-slate-200 dark:!border-gray-500  px-4 py-6 sm:px-6">
            <button type="submit"
              class="btn btn-primary hover:opacity-80 dark:!bg-indigo-500 dark:hover:!bg-indigo-600 !border-none  btn-xl w-full"
              style="background: #990B61; color:#fff; border-color: #000;">Đặt hàng</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</main>
<!-- <script src="../JS/app.js"></script>
<script src="../JS/tailwind.config.js"></script> -->
<?php
include_once './components/footer.php';
?>
<script>$(document).ready(addAddress())</script>