<?php
session_start();
include_once("config.php");
include_once './components/header.php';

// $isLoggedIn = isset($_SESSION['user_id']);
// if (!$isLoggedIn) {
//     header("Location: login.php");
//     exit;
// }

if (isset($_SESSION['new_order_id'])) {
    $orderId = $_SESSION['new_order_id'];
    // unset($_SESSION['shopping_cart']);
    // Lấy thông tin đơn hàng 
    $orderQuery = "SELECT * FROM orders WHERE id = '$orderId'";
    $orderResult = $con->query($orderQuery);

    if ($orderResult->num_rows > 0) {
        $order = $orderResult->fetch_assoc();
        $total_price_vnd = number_format($order['total_amount'] / 1, 0, ',', '.') . ' đ';
        // Lấy chi tiết sản phảm
        $orderItemsQuery = "SELECT oi.*, p.Name, p.Image FROM order_items oi 
                          INNER JOIN product p ON oi.product_id = p.id 
                          WHERE oi.order_id = '$orderId'";
        $orderItemsResult = $con->query($orderItemsQuery);

        // Lấy thông tin chi tiết đơn hàng
        $orderDetailsQuery = "SELECT * FROM order_details WHERE order_id = '$orderId'";
        $orderDetailsResult = $con->query($orderDetailsQuery);
        $OrDetail = $orderDetailsResult->fetch_assoc();

        ?>

        <?php
        echo '<main class="mx-auto max-w-3xl px-4 py-16 sm:px-6 sm:py-24 sm:pb-60 lg:px-8">
<div class="max-w-3xl">
    <h1 class="mt-2 text-4xl font-bold tracking-tight text-slate-900 dark:text-slate-50 sm:text-4xl">
        Cảm ơn bạn đã đặt hàng!
    </h1>
    <p class="mt-2 text-base text-slate-500">
        Hãy giữ chặt điện thoại chờ đợi cuộc gọi từ chúng tôi...
    </p>
    <dl class="mt-12 grid flex-1 grid-cols-2 gap-6 text-sm sm:col-span-4 sm:grid-cols-4 lg:col-span-2">
        <div>
            <dt class="font-medium  text-slate-900 dark:text-slate-50 ">Mã đơn hàng</dt>
            <dd class="mt-1 font-medium text-sky-600">' . $order['order_number'] . '</dd>
        </div>
        <div>
            <dt class="font-medium  text-slate-900 dark:text-slate-50 ">Ngày đặt</dt>
            <dd class="mt-1 font-medium text-sky-600"> ' . $order['order_date'] . '</dd>
        </div>
        <div>
            <dt class="font-medium  text-slate-900 dark:text-slate-50 ">Trạng thái thanh toán</dt>
            <dd class="mt-1 font-medium text-sky-600">' . $order['payment_status'] . '</dd>
        </div>
        <div>
            <dt class="font-medium  text-slate-900 dark:text-slate-50 ">Trạng thái vận chuyển</dt>
            <dd class="mt-1 font-medium text-sky-600">' . $order['shipping_status'] . '</dd>
        </div>
    </dl>
</div>

<div class="mt-10 border-t border-slate-200 dark:!border-gray-500 ">

    <ul role="list" class="divide-y divide-slate-200 border-b border-slate-200 dark:!border-gray-500 ">
                                
                  ';
        while ($item = $orderItemsResult->fetch_assoc()) {
            $total_product_price_vnd = number_format(($item['quantity'] * $item['price']) / 1, 0, ',', '.') . ' đ';
            echo '    <li class="py-4 sm:py-6">
                <div class="flex items-center sm:items-stretch">
                    <div class="relative h-20 w-20 flex-shrink-0 overflow-hidden rounded-md border border-slate-200 dark:!border-gray-500  sm:h-40 sm:w-40">
                                                                <img alt=" ' . $item['Name'] . '" class="h-full w-full object-cover object-center" src=" ' . $item['Image'] . '">
                                                        </div>
                    <div class="ml-6 flex flex-col flex-1 justify-between text-sm">
                        <div>
                            <div class="font-medium  text-slate-900 dark:text-slate-50 text-lg sm:flex sm:justify-between">
                                <h4>
                                    ' . $item['quantity'] . 'x
                                   ' . $item['Name'] . '
                                </h4>
                                <p class="mt-2 sm:mt-0">
                                    ' . $total_product_price_vnd . '
                                </p>
                            </div>
                                                                        <ul class="mt-2 space-x-2 divide-x divide-slate-200 text-slate-700">
                                                                                        </ul>
                                                                </div>

                    </div>
                </div>
            </li>';
        }
        ;
        echo '</ul>

    <div class="sm:ml-40 sm:pl-6">
        <dl class="grid grid-cols-1 gap-x-6 py-10 text-sm">
            <div>
                <dt class="font-medium  text-slate-900 dark:text-slate-50 ">Thông tin giao hàng</dt>
                <dd class="mt-2 text-slate-700 dark:text-slate-50/80 ">
                    <address class="not-italic">
                    ' . $OrDetail['name'] . '<br>
                    ' . $OrDetail['address'] . ' <br>
                    ' . $OrDetail['phone'] . '<br>
                    ' . $OrDetail['order_notes'] . '<br>
                                                        </address>
                </dd>
            </div>
            
        </dl>

        <dl class="grid grid-cols-1 gap-x-6 border-t border-slate-200 dark:!border-gray-500  py-10 text-sm">
            <div>
                <dt class="font-medium  text-slate-900 dark:text-slate-50 ">Phương thức thanh toán</dt>
                <dd class="mt-2  text-slate-700 dark:text-slate-50/80 ">
                    <p>Thanh toán khi nhận hàng</p>
                </dd>
            </div>
            <div>
                
            </div>
        </dl>


        <dl class="space-y-6 border-t border-slate-200 dark:!border-gray-500  pt-10 text-sm">
            <div class="flex justify-between">
                <dt class="font-medium text-slate-900 dark:text-slate-50 ">Giá trị đơn hàng</dt>
                <dd class="text-slate-700 dark:text-slate-50/80">
                ' . $total_price_vnd . '
                </dd>
            </div>
            <div class="flex justify-between">
                <dt class="font-medium text-slate-900 dark:text-slate-50 ">Phí vận chuyển</dt>
                <dd class="text-slate-700 dark:text-slate-50/80">
                    0
                </dd>
            </div>
            <div class="flex justify-between">
                <dt class="font-medium text-slate-900 dark:text-slate-50 ">Thuế</dt>
                <dd class="text-slate-700 dark:text-slate-50/80">
                    0
                </dd>
            </div>
            <div class="flex justify-between">
                <dt class="font-medium text-slate-900 dark:text-slate-50 ">Tổng thanh toán</dt>
                <dd class="text-slate-900 dark:text-slate-50">
                ' . $total_price_vnd . '
                </dd>
            </div>
        </dl>
    </div>
</div>
</main>';
    } else {
        echo "Không tìm thấy thông tin đơn hàng.";
    }
} else {
    echo "Không có ID đơn hàng mới.";
}

// echo '
// ';
require_once('./components/footer.php');
?>
<!-- <script src="../JS/tailwind.config.js"></script>
<script src="../JS/app.js"></script> -->