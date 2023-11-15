<?php
    require_once './php/config.php';

    $sql = "SELECT * FROM `product`;";
    $all_product = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="shortcut icon" href="./Image/title-icon.png" type="image/x-icon">
    <link rel="stylesheet" href="./Font/zhcn.ttf">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Online eStore</title>
</head>
<body>
<header>
        <div id="header__logo">
            <img src="./Image/logo_shopping.png" alt="logo">
        </div>

        <div class="searchBar">
            <input type="text" id="input" name="input" placeholder="Nhập sản phẩm cần tìm...">
            <div class="searchIcon">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
        </div>

        <ul id="header__nav">
            <li><a href="#content">SẢN PHẨM</a></li>
            <li><a href="#">GIỎ HÀNG</a></li>
            <li><a href="#">ĐĂNG XUẤT</a></li>
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
            <h2>DANH MỤC SẢN PHẨM</h2>
            <p>Các sản phẩm TOP SALE</p>
            <?php
            while($row = mysqli_fetch_assoc($all_product)){
            ?>
            <div class="product">
                <div class="product--hoverEffect">
                    <img class="product-img" src="<?php echo $row["Image"]; ?>" alt="test">
                </div>
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
                    <h4><?php echo $row["Price"]?></h4>
                </div>
                <a href="#" class="product-cart-icon"><i class="fa-solid fa-cart-shopping"></i></a>
            </div>
            <?php }?>

            <div class="phantrang">
                <div class="button pre">
                    <i class="fa-solid fa-arrow-left"></i>
                </div>

                <div class="button next">
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
		<div class="container row">
			<div class="footer-col">
				<h4>Company</h4>
				<ul>
					<li><a href="#">About us</a></li>
					<li><a href="#">Our services</a></li>
					<li><a href="#">Privacy policy</a></li>
					<li><a href="#">Visit website</a></li>
				</ul>
			</div>
			<div class="footer-col">
				<h4>Get help</h4>
				<ul>
					<li><a href="#">FAQ</a></li>
					<li><a href="#">Shipping</a></li>
					<li><a href="#">Returns</a></li>
					<li><a href="#">Order status</a></li>
					<li><a href="#">Payment options</a></li>
				</ul>
			</div>
			<div class="footer-col">
				<h4>Online shop</h4>
				<ul>
					<li><a href="#">Download</a></li>
					<li><a href="#">Changelog</a></li>
					<li><a href="#">Github</a></li>
					<li><a href="#">All version</a></li>
				</ul>
			</div>
			<div class="footer-col">
				<h4>Follow Us</h4>
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
<script src='./Resources/JS/index.js'></script>
</html>