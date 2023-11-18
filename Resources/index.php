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
    <link rel="stylesheet" href="./Font/zhcn.ttf">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Online eStore</title>
</head>
<body>
<header>
        <div id="header__logo">
            <a href="index.php"> <!-- Đặt liên kết đến trang chủ ở đây -->
                <img src="./Image/logo_shopping.png" alt="logo">
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
                echo '<li><a href="index.php">ĐĂNG XUẤT</a></li>';
            ?>
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
            <h2>PHÂN LOẠI SẢN PHẨM</h2>
            <div class="loai">
                <p id="aonu">&nbsp;&nbsp;&nbsp;Áo nữ</p>
                <p id="aonam">&nbsp;&nbsp;&nbsp;Áo nam</p> 
                <p id="quanvaynu">&nbsp;&nbsp;&nbsp;Quần váy nữ</p>
                <p id="quannam">&nbsp;&nbsp;&nbsp;Quần nam</p> 
                <p id="phukien">&nbsp;&nbsp;&nbsp;Phụ kiện</p>
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
                showProducts($all_product);
            ?>
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
   /*$(document).ready(function () {
        // Sự kiện click nút áo nữ
        $("#aonu").click(function () {
            //alert("111");
            // Gửi yêu cầu AJAX để lấy sản phẩm áo nữ
            $.ajax({
                url: "./php/filter.php", // Đường dẫn đến file xử lý dữ liệu
                method: "POST",
                data: {category: 'áo'}, // Truyền category = "AoNu" để lọc áo nữ
                success: function (data) {
                    console.log(data);
                    $("#content").html(data);
                }
            });
            //alert("222");
        });
        
    });*/
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