<?php
session_start();
// session_destroy();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id']) && isset($_POST['quantity'])) {
  $product_id = $_POST['product_id'];
  $quantity = $_POST['quantity'];

  // Kiểm tra và xử lý số lượng sản phẩm, 
  // ví dụ như kiểm tra giới hạn số lượng, cập nhật cơ sở dữ liệu, ...

  $new_total_price = updateCartItemQuantity($product_id, $quantity);


  $response = [
    'status' => 'success',
    'message' => 'Số lượng sản phẩm đã được cập nhật.',
    'newTotalPrice' => $new_total_price
  ];
  echo json_encode($response);
} else {
  $response = [
    'status' => 'error',
    'message' => 'Yêu cầu không hợp lệ.'
  ];
  echo json_encode($response);
}

function updateCartItemQuantity($product_id, $quantity)
{
  $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : '';
  $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
  
  $newTotalPrice=0;
  foreach ($_SESSION['shopping_cart'] as &$item) {
    // print_r($item);
    // var_dump($item['product_id']);
    // var_dump($product_id);
    // var_dump($item['product_id'] === $product_id);
    if ($item['product_id'] === $product_id) {
      // If the product already exists in the shopping cart, update the quantity
      $item['quantity'] = $quantity;
      // break;
    }
    $newTotalPrice += ($item['product_price'] * $item['quantity']);
  }
  return $newTotalPrice;

}
