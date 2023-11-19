<?php
    session_start();
    require_once './php/config.php';

    $sql = "SELECT * FROM `product`;";
    $all_product = $con->query($sql);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/filter.css">
    <link rel="shortcut icon" href="./Image/title-icon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Online eStore</title>
</head>
<body>
<header>
        <div id="header__logo">
            <a href="index.php"> <!-- Đặt liên kết đến trang chủ ở đây -->
                <img src="../logo.jpg" alt="logo">
            </a>
        </div>
        <div class="searchBar">
            <div class="searchIcon">
                <i class="fa-solid fa-magnifying-glass"></i>
                <button id="submit">submit</button>
            </div>
            
            <input type="text" id="input" name="input" placeholder="Nhập sản phẩm cần tìm...">
        </div>

        <ul id="header__nav">
            <?php 
                if(isset($_SESSION['username'])){
                    echo '<i class="fa-regular fa-user"></i>';
                    echo '<li style="padding: 0 10px;">' . $_SESSION['username'] . '</li>';
                    session_destroy();
                }
            ?>
            
            <li><a href="#">GIỎ HÀNG</a></li>
            
            <?php
                if(isset($_SESSION['valid'])){
                    echo '<li><a href="index.php">ĐĂNG XUẤT</a></li>';
                }
                else {
                    echo '<li><a href="./php/login.php">ĐĂNG NHẬP</a></li>';
                }
            ?>

        </ul>
    </header>

    <div id="content">
        <div class="phanloai">
            <h2>PHÂN LOẠI</h2>
            <div class="loai">
                <p id="aonu"><a href="./php/AoNu.php">&nbsp;&nbsp;&nbsp;Áo nữ</a></p>
                <p id="aonam"><a href="./php/AoNam.php">&nbsp;&nbsp;&nbsp;Áo nam</a></p> 
                <p id="quanvaynu"><a href="./php/QuanVayNu.php">&nbsp;&nbsp;&nbsp;Quần váy nữ</a></p>
                <p id="quannam"><a href="./php/QuanNam.php">&nbsp;&nbsp;&nbsp;Quần nam</a></p> 
                <p id="phukien"><a href="./php/PhuKien.php">&nbsp;&nbsp;&nbsp;Phụ kiện</a></p>
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
            while($row = mysqli_fetch_assoc($all_product)){
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
                            <a href="#" class="product-cart-icon"><i class="fa-solid fa-cart-shopping"></i></a>
                        </td>
                    </tr>
                </table>
            </div>
            <?php }?>

        </div>
    </div>
    <footer class="footer">
		<div class="container row">
			<div class="footer-col">
				<h4>Liên hệ với chúng tôi</h4>
				<ul>
					<li><a href="#">Số điện thoại +84-XXX-XXX-XXX</a></li>
					<li><a href="#">Địa chỉ TPHCM</a></li>
				</ul>
			</div>
			<div class="footer-col">
				<h4>Theo dõi chúng tôi qua</h4>
				<div class="social-links">
					<a href="#"><i class="fa-brands fa-facebook-f"></i></a>
					<a href="#"><i class="fa-brands fa-x-twitter"></i></a>
					<a href="#"><i class="fa-brands fa-instagram"></i></a>
					<a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
				</div>
			</div>
		</div>
	</footer>
</body>
<script src='./JS/index.js'></script>

<script>
function addToCart(product_id, product_name, product_image_link, product_price) {
    var xhr = new XMLHttpRequest();
    var data = "product_id=" + product_id +
               "&product_name=" + product_name +
               "&product_image_link=" + product_image_link +
               "&product_price=" + product_price;
    xhr.open("POST", "./php/services/add_to_cart.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            alert(xhr.responseText);
        }
    };

    xhr.send(data);
}
</script>
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        // Sự kiện click nút áo nữ
        $("#submit").click(function () {
            // Lấy giá trị từ trường input
            var keyword = $("#input").val().trim();

            // Gửi yêu cầu AJAX để tìm kiếm sản phẩm
            $.ajax({
                url: "./php/filter.php", // Đường dẫn đến file xử lý tìm kiếm
                method: "POST",
                data: { category: keyword },
                success: function (data) {
                    // Cập nhật nội dung trang với kết quả tìm kiếm
                    $("#content").html(data);
                }
            });
        });
        
    });
</script>