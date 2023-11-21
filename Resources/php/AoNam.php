<?php
    session_start();
    require_once './config.php';

    $sql = "SELECT * FROM `product`
    WHERE `Product category ID` = 1;";
    $all_product = $con->query($sql);
    include_once './components/header.php';
    
?>
    <div id="content">
        <div class="phanloai">
            <h2>PHÂN LOẠI</h2>
            <div class="loai">
                <p id="aonu"><a href="./AoNu.php">&nbsp;&nbsp;&nbsp;Áo nữ</a></p>
                <p id="aonam"><a href="./AoNam.php" style="color: #990B61;">&nbsp;&nbsp;&nbsp;Áo nam</a></p> 
                <p id="quanvaynu"><a href="./QuanVayNu.php">&nbsp;&nbsp;&nbsp;Quần váy nữ</a></p>
                <p id="quannam"><a href="./QuanNam.php">&nbsp;&nbsp;&nbsp;Quần nam</a></p> 
                <p id="phukien"><a href="./PhuKien.php">&nbsp;&nbsp;&nbsp;Phụ kiện</a></p>
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
                            <a href="#" onclick="addToCart(<?php echo $row['Id']; ?>, '<?php echo $row['Name']; ?>', '<?php echo $row['Image']; ?>', <?php echo $row['Price']; ?>, <?php echo '1' ?>)" class="product-cart-icon"><i class="fa-solid fa-cart-shopping"></i></a>
                    </td>
                    </tr>
                </table>
            </div>
            <?php }?>

        </div>
    </div>
    <?php include_once("./components/footer.php")?>
</body>
<script src='../JS/index.js'></script>

<script>
function addToCart(product_id, product_name, product_image_link, product_price) {
    var xhr = new XMLHttpRequest();
    var data = "product_id=" + product_id +
               "&product_name=" + product_name +
               "&product_image_link=" + product_image_link +
               "&product_price=" + product_price;
    xhr.open("POST", "./services/add_to_cart.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            alert(xhr.responseText);
        }
    };

    xhr.send(data);
}
</script>
<script>
    $(document).ready(function () {
        // Sự kiện click nút áo nữ
        $("#searchButton").click(function () {
            // Lấy giá trị từ trường input
            var keyword = $("#input").val().trim();
            // Gửi yêu cầu AJAX để tìm kiếm sản phẩm
            $.ajax({
                url: "./filter.php", // Đường dẫn đến file xử lý tìm kiếm
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

<script src="./JS/tailwind.config.js"></script>
<script src="./JS/app.js"></script>    
</html>