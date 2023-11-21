
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
            <?php
require_once 'config.php';
if (isset($_POST['sortOption']) && isset($_POST['category'])) {
    // Đã nhận cả hai đối số
    $sortOption = $_POST['sortOption'];
    $category = $_POST['category'];
/*if (isset($_POST['sortOption'])) {
    // Lấy giá trị đã chọn từ client
    $sortOption = $_POST['sortOption'];
*/
    // Xử lý giá trị được chọn (ví dụ: sắp xếp dữ liệu)
    if ($sortOption === 'highlow') {
        $sql = "SELECT * FROM product WHERE (`Name` like '%$category%') or (`Description` like '%$category%') ORDER BY price DESC";
    } elseif ($sortOption === 'lowhigh') {
        $sql = "SELECT * FROM product WHERE (`Name` like '%$category%') or (`Description` like '%$category%') ORDER BY price ASC";
    }

    // Xử lý điều kiện lọc và truy vấn sản phẩm từ cơ sở dữ liệu

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