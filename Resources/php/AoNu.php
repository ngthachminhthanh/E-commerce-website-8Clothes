<?php
session_start();
require_once './config.php';
$sql = "SELECT * FROM `product` WHERE `Product category ID` = 0;";
$all_product = $con->query($sql);
include_once("./components/header.php");
?>

<div id="content">
    <div class="phanloai">
        <h2 class="dark:text-gray-100">Phân loại</h2>
        <div class="loai">
            <p id="aonu"><a class="dark:!text-gray-100" href="./AoNu.php">&nbsp;&nbsp;&nbsp;Áo nữ</a></p>
            <p id="aonam"><a class="dark:!text-gray-100" href="./AoNam.php">&nbsp;&nbsp;&nbsp;Áo nam</a></p>
            <p id="quanvaynu"><a class="dark:!text-gray-100" href="./QuanVayNu.php">&nbsp;&nbsp;&nbsp;Quần váy nữ</a>
            </p>
            <p id="quannam"><a class="dark:!text-gray-100" href="./QuanNam.php">&nbsp;&nbsp;&nbsp;Quần nam</a></p>
            <p id="phukien"><a class="dark:!text-gray-100" href="./PhuKien.php">&nbsp;&nbsp;&nbsp;Phụ kiện</a></p>
        </div>
    </div>
    <div class="products-container dark:!bg-slate-800">
        <div class="sort">
            <label for="" class="dark:text-gray-100">Sắp xếp</label>
            <select name="sapxep" class="dark:text-slate-300  dark:bg-white/5 " onchange="sortPL(0, this.value)">
                <option class="dark:text-slate-40 dark:bg-slate-800" value="">Mặc định</option>
                <option class="dark:text-slate-40 dark:bg-slate-800" value="highlow">Từ cao đến thấp</option>
                <option class="dark:text-slate-40 dark:bg-slate-800" value="lowhigh">Từ thấp đến cao</option>
            </select>
        </div>
        <?php
        while ($row = mysqli_fetch_assoc($all_product)) {
            ?>
            <div class="product dark:!bg-slate-800">
                <table id="myTable">
                    <tr>
                        <td>
                            <div class="product--hoverEffect">
                                <img class="product-img" src="<?php echo $row["Image"]; ?>" alt="test">
                            </div>
                        </td>
                        <td>
                            <div class="product-description dark:!text-gray-200">
                                <span>
                                    <?php echo $row["Name"] ?>
                                </span>
                                <h5 class="dark:!text-gray-200">
                                    <?php echo $row["Description"] ?>
                                </h5>
                                <div class="star">
                                    <i class="fa-solid fa-star dark:!text-indigo-600"></i>
                                    <i class="fa-solid fa-star dark:!text-indigo-600"></i>
                                    <i class="fa-solid fa-star dark:!text-indigo-600"></i>
                                    <i class="fa-solid fa-star dark:!text-indigo-600"></i>
                                    <i class="fa-regular fa-star dark:!text-indigo-600"></i>
                                </div>
                                <h4 class="dark:!text-indigo-600">
                                    <?php echo $row["Price"] ?> VND
                                </h4>
                            </div>
                            <a href="#0"
                                onclick="addToCart(<?php echo $row['Id']; ?>, '<?php echo $row['Name']; ?>', '<?php echo $row['Image']; ?>', <?php echo $row['Price']; ?>, <?php echo '1' ?>)"
                                class="product-cart-icon"><i class="fa-solid fa-cart-shopping"></i></a>
                        </td>
                    </tr>
                </table>
            </div>
        <?php } ?>
    </div>
</div>

<?php
// include_once("./components/cartToast.php");
include_once("./components/footer.php");
?>