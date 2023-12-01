<?php
session_start();
include_once("../config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image_link = isset($_POST['product_image_link']) ? $_POST['product_image_link'] : '';
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    // Lấy số lượng hàng của sản phẩm từ bảng product
    $query = "SELECT quantity FROM product WHERE Id = '$product_id'";
    $result = mysqli_query($con, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $currentQuantity = $row['quantity'];

        // Kiểm tra số lượng sản phẩm có đủ để thêm vào giỏ hàng hay không
        if ($currentQuantity > 0) {
            $product_item = [
                'product_id' => $product_id,
                'product_name' => $product_name,
                'product_image_link' => $product_image_link,
                'product_price' => $product_price,
                'quantity' => $quantity,
            ];

            if (!isset($_SESSION['shopping_cart'])) {
                $_SESSION['shopping_cart'] = [];
            }

            $found = false;

            foreach ($_SESSION['shopping_cart'] as &$item) {
                if ($item['product_id'] === $product_id) {
                    $item['quantity'] += $quantity;
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                $_SESSION['shopping_cart'][] = $product_item;
            }

            // Gửi phản hồi về cho trình duyệt
            echo "Sản phẩm đã được thêm vào giỏ hàng!";
        } else {
            // Số lượng sản phẩm không đủ, thông báo cho người dùng
            http_response_code(200);
            echo "Sản phẩm đã hết hàng. Hãy quay lại sau!";
        }
    } else {
        http_response_code(500);
        echo "Lỗi truy vấn: " . mysqli_error($con);
    }
} else {
    http_response_code(400);
    echo "Invalid request.";
}
?>
