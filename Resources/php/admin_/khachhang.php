<?php
// session_start();
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

$sql = "SELECT customer.Username AS customer_name, customer.Email, COUNT(orders.id) AS num_orders, SUM(orders.total_amount) AS total_amount
        FROM customer
        LEFT JOIN orders ON customer.id = orders.user_id
        WHERE customer.Username LIKE '%$searchTerm%'
        GROUP BY customer.id
        LIMIT $perRow, $rowsPerPage";

$query = mysqli_query($conn, $sql);
?>




<main class="py-10 dark:bg-slate-800 dark:ring-white/10 dark:shadow-inner">
    <div>
        <div class="px-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
            <div class="min-w-0 flex-1">
                <h1 class="text-2xl font-medium text-slate-900 sm:truncate dark:text-slate-100">
                    Khách hàng
                </h1>
            </div>
            <div class="mt-4 flex sm:mt-0 sm:ml-4">

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
                            <input type="hidden" name="page_layout" value="khachhang">

                            <input class="appearance-none border border-slate-300 rounded-md shadow-sm checked:bg-sky-500 checked:text-sky-500 disabled:bg-slate-100 disabled:opacity-50 disabled:cursor-not-allowed focus:border-sky-500 focus:ring-sky-500 dark:border-white/10 dark:bg-white/5 dark:focus:border-sky-500 dark:focus:ring-sky-500 dark:text-slate-300 dark:focus:ring-offset-slate-900 dark:checked:bg-sky-500 placeholder-slate-500 w-full pl-10 sm:text-sm focus:placeholder-slate-400 dark:focus:placeholder-slate-600" name="search" type="text" placeholder="Tìm kiếm khách hàng">
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
                                                Tên
                                            </th>
                                            <th scope="col" class="px-3 py-4 text-left text-sm font-semibold tracking-wide text-slate-900 whitespace-nowrap dark:text-slate-200">
                                                Email
                                            </th>
                                            <th scope="col" class="px-3 py-4 text-center text-sm font-semibold tracking-wide text-slate-900 whitespace-nowrap dark:text-slate-200">
                                                Đơn hàng đã đặt
                                            </th>
                                            <th scope="col" class="pl-3 pr-4 py-4 text-right text-sm font-semibold tracking-wide text-slate-900 whitespace-nowrap sm:pr-6 dark:text-slate-200">
                                                Tổng tiền
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-200 dark:divide-slate-200/10">



                                        <?php
                                        while ($row = mysqli_fetch_array($query)) {
                                        ?>
                                            <tr class="relative hover:bg-slate-50 dark:hover:bg-slate-800/75">
                                                <td class="relative w-12 px-6 sm:w-16 sm:px-8">
                                                    <input class="appearance-none border border-slate-300 rounded-md shadow-sm checked:bg-sky-500 checked:text-sky-500 disabled:bg-slate-100 disabled:opacity-50 disabled:cursor-not-allowed focus:border-sky-500 focus:ring-sky-500 dark:border-white/10 dark:bg-white/5 dark:focus:border-sky-500 dark:focus:ring-sky-500 dark:text-slate-300 dark:focus:ring-offset-slate-900 dark:checked:bg-sky-500 absolute left-4 top-1/2 -mt-2 h-4 w-4 !rounded !shadow-none sm:left-6" type="hidden" value="20">
                                                    <span>
                                                        <?php echo $row['customer_name']; ?>
                                                    </span>
                                                </td>
                                                </td>
                                                <td class="relative px-3 py-4 font-medium text-sm text-slate-900 text-left whitespace-nowrap dark:text-slate-200">
                                                    <div class="">
                                                        <!-- <a href="quantri.php?page_layout=khachhang&Id=<?php echo $row['Id']; ?>" class="inline-flex items-center truncate hover:text-sky-600 dark:hover:text-sky-400"> -->
                                                        <a href="#0" class="inline-flex items-center truncate hover:text-sky-600 dark:hover:text-sky-400">
                                                            <span>
                                                                <?php echo $row['Email']; ?>
                                                            </span>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="relative px-3 py-4 text-sm text-slate-500 text-center whitespace-nowrap dark:text-slate-400">
                                                    <span class="inline-flex items-center rounded-full font-medium bg-green-50 text-green-700 ring-1 ring-inset ring-green-600/20 dark:bg-green-500/10 dark:text-green-400 dark:ring-green-500/20 text-xs px-2 py-1">
                                                        <?php echo $row['num_orders']; ?>
                                                    </span>
                                                </td>
                                                <td class="pl-3 pr-4 py-4 text-right text-sm text-slate-500 whitespace-nowrap sm:pr-6 dark:text-slate-400">
                                                    <?php echo $row['total_amount']; ?> đ
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
            $totalRows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM  `customer` WHERE `Username` LIKE '%$searchTerm%'"));
            $totalPage = ceil($totalRows / $rowsPerPage);
            $listPage = '';
            for ($i = 1; $i <= $totalPage; $i++) {
                if ($i == $page) {
                    $listPage .= " <span class='border-b'>" . $i . "</span> ";
                } else {
                    $listPage .= ' <a href="' . $_SERVER['PHP_SELF'] . '?page=' . $i . '&page_layout=khachhang&search=' . $searchTerm . '">' . $i . '</a> ';
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
                                <a href="<?php echo $page > 1 ?  $_SERVER['PHP_SELF'] . '?page_layout=khachhang&page=' . ($page - 1) : 'javascript:void(0)'; ?>" <?php echo $page == $totalPage ? 'role="link" aria-disabled="true"' : ''; ?>>
                                    <button type="button" class="btn btn-default" <?php echo $page == 1 ? 'disabled' : ''; ?>>
                                        « Previous
                                    </button>
                                </a>
                            </span>

                            <span> <a href="<?php echo $page < $totalPage ?  $_SERVER['PHP_SELF'] . '?page_layout=khachhang&search=' . $searchTerm . '' . '&page=' . ($page + 1) : 'javascript:void(0)'; ?>" <?php echo $page == $totalPage ? 'role="link" aria-disabled="true"' : ''; ?>>
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
                                    <a href="<?php echo $page > 1 ?  $_SERVER['PHP_SELF'] . '?page_layout=khachhang&search=' . $searchTerm . '' . '&page=' . ($page - 1) : 'javascript:void(0)'; ?>">
                                        <button type="button" class="btn btn-default" <?php echo $page == 1 ? 'disabled' : ''; ?>>
                                            « Trước
                                        </button>
                                    </a>
                                </span>
                                <span>
                                    <a href="<?php echo $page < $totalPage ?  $_SERVER['PHP_SELF'] . '?page_layout=khachhang&search=' . $searchTerm . '' . '&page=' . ($page + 1) : 'javascript:void(0)'; ?>">
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