<?php
session_start();
require_once './config.php';

$sql = "SELECT distinct * FROM `orders`
where shipping_status = 'Chờ xác nhận';";
$all_order = $con->query($sql);
include_once './components/header.php';
?>
<body>
    <div id="list_donhang">
        <div class="loai_donhang">
            <a class="button wait" href="./wait.php">Chờ xác nhận</a>
            <a class="button delivering" href="./delivering.php">Đang giao</a>
            <a class="button delivered" href="./delivered.php">Đã giao</a>
            <a class="button canceled" href="./canceled.php">Đã hủy</a>
        </div>
        <div class=donhang>
            <?php
            while ($order = $all_order->fetch_assoc()){
                $orderId = $order['id'];
                $sum_sql = "SELECT SUM(quantity) FROM order_items WHERE order_id = '$orderId';";
                $temp = $con->query($sum_sql);
                $temp = $temp->fetch_array();
                $sum_product = (string)$temp[0];
                $list_sql = "SELECT distinct product_id, quantity from order_items WHERE order_id = '$orderId';";
                $product_list = $con->query($list_sql);
                $cus_info_sql = "SELECT distinct order_id, name, address, phone from order_details WHERE order_id = '$orderId';";
                $temp1 = $con->query($cus_info_sql);
                $temp1 = $temp1->fetch_array();
                $cus_info = $temp1;
                echo '
                    <details>
                        <summary>Mã đơn hàng:   #'. $order["id"] .'</summary>
                        <p>Số lượng sản phẩm:   '.$sum_product.'</p>
                        <div class=sanpham>
                            <p>Danh sách mã sản phẩm:</p>
                            <p>';
                            foreach($product_list as $prod_list){
                                echo '  #'.$prod_list['product_id'].':    '.$prod_list['quantity'].' SP<br>';
                            };
                echo    '</p>
                        </div>
                        <div class="khachhang">
                            <h4>Thông tin giao hàng</h4>
                            <p>Họ tên khách hàng:   '.$cus_info['name'].'</p>
                            <p>Địa chỉ: '.$cus_info['address'].'</p>
                            <p>Số điện thoại: '.$cus_info['phone'].'</p>
                        </div>
                        <p>Ngày đặt hàng:   '.$order['order_date'].'</p>
                        <p>Tổng thanh toán: '.$order['total_amount'].'</p>
                        <div class="trangthai">
                        <form action="" method="post">
                            <label for="">Trạng thái đơn hàng:</label>
                            <select name="'.$orderId.'">
                                <option value="wait">Chờ xác nhận</option>
                                <option value="delivering">Đang giao</option>
                                <option value="delivered">Đã giao</option>
                                <option value="canceled">Đã hủy</option>
                            </select>
                            <input type="submit" value="Lưu"/>
                        </form>';
                        
                        if(isset($_POST[''.$orderId.''])){
                            $status_op = $_POST[$orderId];
                            switch ($status_op) {
                                case 'wait':
                                    $sql1 = "UPDATE orders SET shipping_status = 'Chờ xác nhận' WHERE id = '$orderId';";
                                    break;
                                case 'delivering':
                                    $sql1 = "UPDATE orders SET shipping_status = 'Đang giao' WHERE id = '$orderId';";
                                    break;
                                case 'delivered':
                                    $sql1 = "UPDATE orders SET shipping_status = 'Đã giao' WHERE id = '$orderId';";
                                    break;
                                case 'canceled':
                                    $sql1 = "UPDATE orders SET shipping_status = 'Đã hủy' WHERE id = '$orderId';";
                                    break;
                                default:
                                    # code...
                                    echo "Update dữ liệu không thành công";
                                    break;
                            }
                            if ($con->query($sql1) === TRUE) {
                                echo "Record updated successfully";
                              } else {
                                echo "Error updating record: " . $con->error;
                              }
                        }
                            
                echo'
                        </div>
                    </details>';
                
            }  ;
            ?>
        </div>
    </div>

</body>
<?php
// include_once("./components/cartToast.php");
include_once("./components/footer.php");
?>
</html>