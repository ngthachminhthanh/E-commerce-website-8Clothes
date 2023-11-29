<?php
include_once('ketnoi.php');
// if (!isset($_SESSION['username_'])) {
//     header('location:index.php');
// }

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$rowsPerPage = isset($_SESSION['rows_per_page']) ? $_SESSION['rows_per_page'] : 10;

$perRow = $page * $rowsPerPage - $rowsPerPage;

$searchTerm = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$searchTerm = trim($searchTerm);
$sql = "SELECT * 
FROM orders LEFT JOIN order_details ON orders.id = order_details.order_id
WHERE (orders.id LIKE '%$searchTerm%' OR name LIKE '%$searchTerm%' OR address LIKE '%$searchTerm%' OR phone = '$searchTerm') AND shipping_status = 'Đã giao'
LIMIT $perRow, $rowsPerPage;";
$all_order = mysqli_query($conn, $sql);
//$all_order = $conn->query($sql);
//include_once '../components/admin_header.php';
?>

<main class="py-10 dark:bg-slate-800 dark:ring-white/10 dark:shadow-inner">
    <div>
        <div class="px-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
            <div class="min-w-0 flex-1">
                <h1 class="text-2xl font-medium text-slate-900 sm:truncate dark:text-slate-100">
                    Đơn hàng
                </h1>
            </div>
            <div class="inline-flex items-center truncate hover:text-sky-600 dark:hover:text-sky-400">
                <a class="button wait btn btn-primary block w-full order-0 sm:order-1 sm:ml-3" href="quantri.php?page_layout=wait">Chờ xác nhận</a>
                <a class="button delivering btn btn-primary block w-full order-0 sm:order-1 sm:ml-3" href="quantri.php?page_layout=delivering">Đang giao</a>
                <a class="button delivered btn btn-primary block w-full order-0 sm:order-1 sm:ml-3" href="quantri.php?page_layout=delivered">Đã giao</a>
                <a class="button canceled btn btn-primary block w-full order-0 sm:order-1 sm:ml-3" href="quantri.php?page_layout=canceled">Đã hủy</a>
            </div>
        </div>

        <div class="p-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm ring-1 ring-slate-200 rounded-md sm:rounded-lg dark:bg-slate-900 dark:ring-white/10 dark:shadow-inner dark:shadow-xl overflow-hidden">
                <div class="px-4 py-5 rounded-t-md sm:px-6 sm:rounded-t-lg">
                    <div class="relative max-w-sm text-slate-400 focus-within:text-slate-600 dark:focus-within:text-slate-200">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                </path>
                            </svg>
                        </div>

                        <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <input type="hidden" name="page_layout" value="delivering">

                            <input class="appearance-none border border-slate-300 rounded-md shadow-sm checked:bg-sky-500 checked:text-sky-500 disabled:bg-slate-100 disabled:opacity-50 disabled:cursor-not-allowed focus:border-sky-500 focus:ring-sky-500 dark:border-white/10 dark:bg-white/5 dark:focus:border-sky-500 dark:focus:ring-sky-500 dark:text-slate-300 dark:focus:ring-offset-slate-900 dark:checked:bg-sky-500 placeholder-slate-500 w-full pl-10 sm:text-sm focus:placeholder-slate-400 dark:focus:placeholder-slate-600" name="search" type="text" placeholder="Tìm kiếm đơn hàng">
                            <button type="submit" class="absolute inset-y-0 right-0 flex items-center pr-3" style="display: none;">
                        </form>
                        <svg class="w-5 h-5 text-slate-500 hover:text-slate-600 dark:hover:text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-1.72 6.97a.75.75 0 10-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 101.06 1.06L12 13.06l1.72 1.72a.75.75 0 101.06-1.06L13.06 12l1.72-1.72a.75.75 0 10-1.06-1.06L12 10.94l-1.72-1.72z" clip-rule="evenodd"></path>
                        </svg> </button>
                    </div>
                </div>
                <div class="px-4 py-5 sm:px-6 -mx-4 -my-5 sm:-mx-6">
                    <div class="overflow-x-auto">
                        <div class="inline-block min-w-full align-middle">
                            <div class="relative overflow-hidden">

                                <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-200/10">
                                    <thead class="border-t border-slate-200 bg-slate-50 dark:border-slate-200/10 dark:bg-slate-800/75">
                                        <tr>
                                            <th scope="col" class="text-left relative w-12 px-6 sm:w-16 sm:px-8">
                                                ID
                                            </th>
                                            <th scope="col" class="px-3 py-4 text-left text-sm font-semibold tracking-wide text-slate-900 whitespace-nowrap dark:text-slate-200">
                                                Thông tin vận chuyển
                                            </th>
                                            <th scope="col" class="px-3 py-4 text-center text-sm font-semibold tracking-wide text-slate-900 whitespace-nowrap dark:text-slate-200">
                                                Chi tiết đơn hàng
                                            </th>
                                            <th scope="col" class="px-3 py-4 text-center text-sm font-semibold tracking-wide text-slate-900 whitespace-nowrap dark:text-slate-200">
                                                Số lượng sản phẩm
                                            </th>
                                            <th scope="col" class="px-3 py-4 text-center text-sm font-semibold tracking-wide text-slate-900 whitespace-nowrap dark:text-slate-200">
                                                Tổng thanh toán
                                            </th>
                                            <th scope="col" class="pl-3 pr-4 py-4 text-right text-sm font-semibold tracking-wide text-slate-900 whitespace-nowrap sm:pr-6 dark:text-slate-200">
                                                Trạng thái đơn hàng
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-200 dark:divide-slate-200/10">
                                        <?php
                                        while ($order = mysqli_fetch_array($all_order)) {
                                            $orderId = $order['id'];
                                            $sum_sql = "SELECT SUM(quantity) FROM order_items WHERE order_id = '$orderId';";
                                            $temp = $conn->query($sum_sql);
                                            $temp = $temp->fetch_array();
                                            $sum_product = (string)$temp[0];
                                            $list_sql = "SELECT distinct product_id, quantity from order_items WHERE order_id = '$orderId';";
                                            $product_list = $conn->query($list_sql);
                                            $cus_info_sql = "SELECT distinct order_id, name, address, phone from order_details WHERE order_id = '$orderId';";
                                            $temp1 = $conn->query($cus_info_sql);
                                            $temp1 = $temp1->fetch_array();
                                            $cus_info = $temp1;
                                        ?>
                                            <tr class="relative hover:bg-slate-50 dark:hover:bg-slate-800/75">
                                                <td class="relative w-12 px-6 sm:w-16 sm:px-8">
                                                    <span>
                                                        <?php echo $order['id']; ?>
                                                    </span>
                                                </td>
                                                <td class="relative px-3 py-4 font-medium text-sm text-slate-900 text-left whitespace-nowrap dark:text-slate-200">
                                                    <div class="">
                                                        <span>
                                                            <?php echo $cus_info['name'].'<br>';
                                                                echo $cus_info['address'].'<br>';
                                                                echo $cus_info['phone']; ?>
                                                        </span>                                                        
                                                    </div>
                                                </td>
                                                <td class="relative px-3 py-4 text-sm text-slate-500 text-left whitespace-nowrap dark:text-slate-400">
                                                    <?php foreach($product_list as $prod_list){
                                                                echo '  #'.$prod_list['product_id'].':    '.$prod_list['quantity'].' SP<br>';
                                                            }; ?>
                                                </td>
                                                <td class="pl-3 pr-4 py-4 text-left text-sm text-slate-500 whitespace-nowrap sm:pr-6 dark:text-slate-400">
                                                    <?php echo $sum_product ?> products
                                                </td>
                                                <td class="pl-3 pr-4 py-4 text-right text-sm text-slate-500 whitespace-nowrap sm:pr-6 dark:text-slate-400">
                                                    <?php echo number_format($order['total_amount'] / 1, 0, ',', '.') . ' đ'; ?>
                                                </td>
                                                <td class="relative px-3 py-4 text-sm text-slate-500 text-center whitespace-nowrap dark:text-slate-400">
                                                    <?php echo $order['shipping_status']?> 
                                                </td>

                                            </tr>
                                        <?php
                                                                                }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <?php
            $totalRows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM  `order_details` WHERE `address` LIKE '%$searchTerm%'"));
            $totalPage = ceil($totalRows / $rowsPerPage);
            $listPage = '';
            for ($i = 1; $i <= $totalPage; $i++) {
                if ($i == $page) {
                    $listPage .= " <span class='border-b'>" . $i . "</span> ";
                } else {
                    $listPage .= ' <a href="' . $_SERVER['PHP_SELF'] . '?page=' . $i . '&page_layout=delivering&search=' . $searchTerm . '">' . $i . '</a> ';
                }
            }
            ?>
            <p id="pagination">
            </p>

            <div class="mt-6">
                <div>
                    <nav role="navigation" class="flex items-center justify-between">
                        <div class="flex justify-between flex-1 sm:hidden">
                            <span>
                                <a href="<?php echo $page > 1 ?  $_SERVER['PHP_SELF'] . '?page_layout=delivering&page=' . ($page - 1) : 'javascript:void(0)'; ?>" <?php echo $page == $totalPage ? 'role="link" aria-disabled="true"' : ''; ?>>
                                    <button type="button" class="btn btn-default" <?php echo $page == 1 ? 'disabled' : ''; ?>>
                                        « Previous
                                    </button>
                                </a>
                            </span>

                            <span> <a href="<?php echo $page < $totalPage ?  $_SERVER['PHP_SELF'] . '?page_layout=delivering&search=' . $searchTerm . '' . '&page=' . ($page + 1) : 'javascript:void(0)'; ?>" <?php echo $page == $totalPage ? 'role="link" aria-disabled="true"' : ''; ?>>
                                    <button type="button" class="ml-3 btn btn-default" <?php echo $page == $totalPage ? 'disabled' : ''; ?>>
                                        Sau »
                                    </button>
                                </a>
                            </span>
                        </div>

                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-end gap-6">
                            <div>
                                <p class="text-sm text-slate-700 leading-5 dark:text-slate-400">
                                    <?php echo $listPage; ?>
                                </p>
                            </div>

                            <div>
                                <span>
                                    <a href="<?php echo $page > 1 ?  $_SERVER['PHP_SELF'] . '?page_layout=danhmucsp&search=' . $searchTerm . '' . '&page=' . ($page - 1) : 'javascript:void(0)'; ?>">
                                        <button type="button" class="btn btn-default" <?php echo $page == 1 ? 'disabled' : ''; ?>>
                                            « Trước
                                        </button>
                                    </a>
                                </span>
                                <span>
                                    <a href="<?php echo $page < $totalPage ?  $_SERVER['PHP_SELF'] . '?page_layout=delivering&search=' . $searchTerm . '' . '&page=' . ($page + 1) : 'javascript:void(0)'; ?>">
                                        <button type="button" class="ml-3 btn btn-default" <?php echo $page == $totalPage ? 'disabled' : ''; ?>>
                                            Sau »
                                        </button>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>

        </div>
    </div>
</main>
