<?php
// Start or resume the session
session_start();

require_once('header.php');
include("config.php");

// session_destroy();
$query = "SELECT * FROM product WHERE id <20";
$result = mysqli_query($con, $query) or die("Select Error");
$products = $result->fetch_all(MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_add_to_cart'])) {


  $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : '';
  $product_name = isset($_POST['product_name']) ? $_POST['product_name'] : '';
  $product_price = isset($_POST['product_price']) ? $_POST['product_price'] : '';
  $product_image_link = isset($_POST['product_image_link']) ? $_POST['product_image_link'] : '';
  $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

  $product_item = [
    'product_id' => $product_id,
    'product_name' => $product_name,
    'product_image_link' => $product_image_link,
    'product_price' => $product_price,
    'quantity' => $quantity,
  ];

  // Kiểm tra xem sản phẩm có trong giỏ hàng chưa
  if (!isset($_SESSION['shopping_cart'])) {
    $_SESSION['shopping_cart'] = [];
  }

  $found = false;

  foreach ($_SESSION['shopping_cart'] as &$item) {
    if ($item['product_id'] === $product_id) {
      // Nếu sản phẩm đã tồn tại trong giỏ hàng, cập nhật số lượng
      $item['quantity'] += $quantity;
      $found = true;
      break;
    }
  }

  // Nếu sản phẩm chưa tồn tại trong giỏ hàng, thêm mới
  if (!$found) {
    $_SESSION['shopping_cart'][] = $product_item;
  }

}

?>
<div class="flex flex-wrap mt-20">

  <?php foreach ($products as $product) : ?>
    <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
      <h3><?php echo $product['Name']; ?></h3>
      <img alt="Xiaomi 11T" class="h-24 w-24 rounded-md object-cover object-center sm:h-32 sm:w-32" src="<?php echo $product['Image']; ?>">
      <p>Cái giá phải trả: $<?php echo $product['Price']; ?></p>
      <form action="" method="post">
        <input type="hidden" name="product_id" value="<?php echo $product['Id']; ?>">
        <input type="hidden" name="product_price" value="<?php echo $product['Price']; ?>">
        <input type="hidden" name="product_name" value="<?php echo $product['Name']; ?>">
        <input type="hidden" name="product_image_link" value="<?php echo $product['Image']; ?>">
        <label for="quantity">SL:</label>
        <input type="number" name="quantity" value="1" min="1">
        <input type="submit" value="Chơi luôn" name="form_add_to_cart">
      </form>
    </div>
    <?php endforeach; ?>
  </div>
<?php
require_once('header.php');


require_once('footer.php');
?>