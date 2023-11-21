<?php
    session_start();
    require_once './php/config.php';

    $sql = "SELECT * FROM `product`;";
    $all_product = $con->query($sql);
    include_once './php/components/header.php';
?>
<body>
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
            if(isset($_GET['submit'])){
                $keyword = $_GET['input'];
                $sql_search = "SELECT * FROM product WHERE `Name` LIKE '%$keyword%' OR `Description` LIKE '%$keyword%' ";
                $exec_search = mysqli_query($con, $sql_search);
                if(mysqli_num_rows($exec_search) > 0){
                    while($row = mysqli_fetch_assoc($exec_search)) {

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
                }else {
                    echo "Không tìm thấy sản phẩm nào!";
                }
            } else {
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
            <?php
                } }
            ?>

        </div>
    </div>
    <?php include_once("./php/components/footer.php")?>
    <?php include_once("./php/components/cartToast.php")?>
</body>
<script src='./JS/index.js'></script>


<script src="./JS/tailwind.config.js"></script>
<script src="./JS/app.js"></script>
</html>