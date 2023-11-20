
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="shortcut icon" href="./Image/title-icon.png" type="image/x-icon">
    <link rel="stylesheet" href="./Font/zhcn.ttf">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Online eStore</title>
</head>
<body>
    <div id="content">
        <div class="phanloai">
            <h2>PHÂN LOẠI SẢN PHẨM</h2>
            <div class="loai">
                <p id="aonu"><a href="./AoNu.php">&nbsp;&nbsp;&nbsp;Áo nữ</a></p>
                <p id="aonam"><a href="./AoNam.php">&nbsp;&nbsp;&nbsp;Áo nam</a></p> 
                <p id="quanvaynu"><a href="./QuanVayNu.php">&nbsp;&nbsp;&nbsp;Quần váy nữ</a></p>
                <p id="quannam"><a href="./QuanNam.php">&nbsp;&nbsp;&nbsp;Quần nam</a></p> 
                <p id="phukien"><a href="./PhuKien.php">&nbsp;&nbsp;&nbsp;Phụ kiện</a></p>
            </div>
            </div>
        </div>
        <div class="products-container">
            <div class="sort">
                <label for="">Sắp xếp</label>
                <select name="sapxep">
                    <option value=""></option>
                    <option value="highlow">Từ cao đến thấp</option>
                    <option value="lowhigh">Từ thấp đến cao</option>
                </select>    
            </div>
            <?php
require_once 'config.php';

if (isset($_POST['category'])) {
    $category = $_POST['category'];

    // Xử lý điều kiện lọc và truy vấn sản phẩm từ cơ sở dữ liệu
    $sql = "SELECT * FROM `product` WHERE (`Name` like '%$category%') or (`Description` like '%$category%')"; 
    $result = $con->query($sql);

    // Kiểm tra nếu có kết quả trả về
    if ($result->num_rows > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            // Hiển thị sản phẩm
            ?>
            <div class="product">
                <table id="myTable">
                    <tr>
                        <td>
                            <div class="product--hoverEffect">
                                <img class="product-img" src="<?php echo $row["Image"]; ?>" alt="test">
                            </div>
                        </td>
                        <td>
                            <div class="product-description">
                                <span><?php echo $row["Name"]?></span> 
                                <h5><?php echo $row["Description"]?></h5>
                                <div class="star">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </div>
                                <h4><?php echo $row["Price"]?> VND</h4>
                            </div>
                            <a href="#" onclick="addToCart(<?php echo $row['Id']; ?>, '<?php echo $row['Name']; ?>', '<?php echo $row['Image']; ?>', <?php echo $row['Price']; ?>, <?php echo '1' ?>)" class="product-cart-icon"><i class="fa-solid fa-cart-shopping"></i></a>
                        </td>
                    </tr>
                </table>
            </div>
            <?php
        }
    } else {
        // Xử lý trường hợp không tìm thấy sản phẩm
        echo "Không tìm thấy sản phẩm.";
    }
}
?>
         </div>
    </div>
</body>
<script src='./JS/index.js'></script>
</html>
<?php
    function showProducts($product) {
        foreach ($product as $row) {
            echo '
            <div class="product">
                <table id="myTable">
                    <tr>
                        <td>
                            <div class="product--hoverEffect">
                                <img class="product-img" src="'.$row["Image"].'" alt="test">
                            </div>
                        </td>
                        <td>
                            <div class="product-description">
                                <span>'.$row["Name"].'</span> 
                                <h5>'.$row["Description"].'</h5>
                                <div class="star">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </div>
                                <h4>'.$row["Price"].' VND</h4>
                            </div>
                            <a href="#" class="product-cart-icon"><i class="fa-solid fa-cart-shopping"></i></a>
                        </td>
                    </tr>
                </table>
            </div>';
        }
}
?>