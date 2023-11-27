<?php
// session_start();
include_once('ketnoi.php');

if (!isset($_SESSION['username_'])) {
    header('location:index.php');
    exit();
}

if (isset($_GET['Id'])) {
    $Id = $_GET['Id'];

    $sql = "SELECT * FROM  `product category`  WHERE Id='$Id'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);



    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }

    $rowsPerPage = isset($_SESSION['rows_per_page']) ? $_SESSION['rows_per_page'] : 10;
    $perRow = $page * $rowsPerPage - $rowsPerPage;

    $searchTerm = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
    $searchTerm = trim($searchTerm);

    $sqlProduct = "SELECT * FROM `product` WHERE `Product category ID` = '$Id' AND `Name` LIKE '%$searchTerm%' LIMIT $perRow, $rowsPerPage";
    $queryProduct = mysqli_query($conn, $sqlProduct);


    if (isset($_POST['submit'])) {
        $tendanhmuc = mysqli_real_escape_string($conn, $_POST['ten_danhmuc']);

        $sql_update = "UPDATE  `product category`  SET `Category name` ='$tendanhmuc' WHERE Id='$Id'";
        $query_update = mysqli_query($conn, $sql_update);

        if ($query_update) {

            // header('location:quantri.php?page_layout=danhmucsp');
            // exit();
            $sql = "SELECT * FROM  `product category`  WHERE Id='$Id'";
            $query = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($query);

            echo '<script>
        console.log("Tên danh mục đã được cập nhật thành công.");
        setTimeout(() => {
        const successBox = document.getElementById("successBox");
        successBox.innerHTML = "Tên danh mục đã được cập nhật thành công.";
        successBox.style.top = "75px";
        successBox.style.right = "45px";
        successBox.classList.remove("hidden");

        setTimeout(function() {
        successBox.classList.add("hidden");
        }, 3000);
        }, 100);
        
        </script>';
        } else {
            echo "Sửa danh mục không thành công!";
        }
    }
}
?>




<main class="py-10 dark:bg-slate-800 dark:ring-white/10 dark:shadow-inner">
    <div class="px-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
        <div class="min-w-0 flex flex-1 items-center space-x-2">
            <a href="quantri.php?page_layout=danhmucsp" class="btn btn-default btn-xs">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M17 10a.75.75 0 01-.75.75H5.612l4.158 3.96a.75.75 0 11-1.04 1.08l-5.5-5.25a.75.75 0 010-1.08l5.5-5.25a.75.75 0 111.04 1.08L5.612 9.25H16.25A.75.75 0 0117 10z" clip-rule="evenodd"></path>
                </svg> </a>
            <h1 class="text-2xl font-medium text-slate-900 truncate dark:text-slate-100">
                <?php echo $row['Category name']; ?>
            </h1>

        </div>
    </div>


    <div class="p-4 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-3 gap-6">
            <div class="col-span-3 xl:col-span-2 space-y-6">

                <form method="post" action="">
                    <div class="bg-white shadow-sm ring-1 ring-slate-200 rounded-md sm:rounded-lg dark:bg-slate-900 dark:ring-white/10 dark:shadow-inner dark:shadow-xl relative overflow-hidden">
                        <div class="px-4 py-5 sm:px-6">
                            <fieldset class="grid grid-cols-1 gap-6">

                                <div>
                                    <label class="block font-medium text-sm text-slate-700 dark:text-slate-200" for="name">
                                        Tên
                                    </label>

                                    <input class="appearance-none border border-slate-300 rounded-md shadow-sm checked:bg-sky-500 checked:text-sky-500 disabled:bg-slate-100 disabled:opacity-50 disabled:cursor-not-allowed focus:border-sky-500 focus:ring-sky-500 dark:border-white/10 dark:bg-white/5 dark:focus:border-sky-500 dark:focus:ring-sky-500 dark:text-slate-300 dark:focus:ring-offset-slate-900 dark:checked:bg-sky-500 mt-1 block w-full sm:text-sm" type="text" name="ten_danhmuc" id="name" placeholder="Nhập tên danh mục" value="<?php echo $row['Category name']; ?>" required>

                                </div>


                            </fieldset>
                        </div>
                        <div class="px-4 py-3 rounded-b-md sm:px-6 sm:rounded-b-lg bg-slate-50 dark:bg-slate-800/75">
                            <div class="flex items-center justify-end">

                                <button type="submit" name="submit" class="btn btn-primary">
                                    Lưu thay đổi
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="bg-white shadow-sm ring-1 ring-slate-200 rounded-md sm:rounded-lg dark:bg-slate-900 dark:ring-white/10 dark:shadow-inner dark:shadow-xl relative overflow-hidden">

                    <div>
                        <div class="px-4 py-5 rounded-t-md sm:px-6 sm:rounded-t-lg">
                            <div class="-ml-4 -mt-2 flex items-center justify-between flex-wrap sm:flex-nowrap">
                                <div class="ml-4 mt-2">
                                    <h3 class="text-base leading-6 font-medium text-slate-900 dark:text-slate-200">
                                        Products
                                    </h3>
                                </div>
                                <div class="ml-4 mt-2 flex-shrink-0">
                                    <a href="quantri.php?page_layout=themsp">

                                        <button class="btn btn-link">
                                            Thêm sản phẩm
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-5 sm:px-6 -mx-4 -my-5 sm:-mx-6">
                            <ul class="border-t border-slate-300 divide-y divide-slate-200 dark:border-slate-200/20 dark:divide-slate-700/50">




                                <?php
                                while ($row = mysqli_fetch_array($queryProduct)) {
                                ?>
                                    <li class="p-4 sm:px-6 hover:bg-slate-50 dark:hover:bg-slate-800/75">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <img src="<?php echo $row['Image']; ?>" alt=" <?php echo $row['Name'] ?>" class="rounded object-center object-cover w-10 h-10">
                                                <a href="quantri.php?page_layout=suasp&Id=<?php echo $row['Id']; ?>" class="ml-3 line-clamp-2 font-medium text-sm text-slate-700 hover:text-sky-600 dark:text-slate-200 dark:hover:text-sky-400">
                                                    <?php echo $row['Name'] ?>
                                                </a>
                                            </div>
                                            <div class="pl-5 flex items-center">

                                                <span class="text-slate-500 hover:text-slate-600 dark:hover:text-slate-400"><?php echo $row['Quantity']; ?> sp</span>

                                            </div>
                                        </div>
                                    </li>

                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>

                </div>



                <?php
                // $totalRows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `product` WHERE `Name` LIKE '%$searchTerm%'"));
                // $sqlProduct = "SELECT * FROM `product` WHERE `Product category ID` = '$Id' AND `Name` LIKE '%$searchTerm%' LIMIT $perRow, $rowsPerPage";
                $totalRows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `product` WHERE `Product category ID` = '$Id' AND `Name` LIKE '%$searchTerm%'"));
                $totalPage = ceil($totalRows / $rowsPerPage);
                $listPage = '';
                for ($i = 1; $i <= $totalPage; $i++) {
                    if ($i == $page) {
                        $listPage .= " <span class='border-b'>" . $i . "</span> ";
                    } else {
                        $listPage .= ' <a href="' . $_SERVER['PHP_SELF'] . '?page=' . $i . '&page_layout=suadanhmuc&Id=' . $Id . '&search=' . $searchTerm . '">' . $i . '</a> ';
                    }
                }
                ?>
                <p id="pagination">
                    <?php
                    // echo $listPage; 
                    ?>
                </p>
                <div class="mt-6">
                    <div>
                        <nav role="navigation" class="flex items-center justify-between">
                            <div class="flex justify-between flex-1 sm:hidden">
                                <span>
                                    <a href="<?php echo $page > 1 ?  $_SERVER['PHP_SELF'] . '?page_layout=suadanhmuc&Id=' . $Id . '&search=' . $searchTerm . '' . '&page=' . ($page - 1) : 'javascript:void(0)'; ?>" <?php echo $page == $totalPage ? 'role="link" aria-disabled="true"' : ''; ?>>
                                        <button type="button" class="btn btn-default" <?php echo $page == 1 ? 'disabled' : ''; ?>>
                                            « Previous
                                        </button>
                                    </a>
                                </span>

                                <span> <a href="<?php echo $page < $totalPage ?  $_SERVER['PHP_SELF'] . '?page_layout=suadanhmuc&Id=' . $Id . '&search=' . $searchTerm . '' . '&page=' . ($page + 1) : 'javascript:void(0)'; ?>" <?php echo $page == $totalPage ? 'role="link" aria-disabled="true"' : ''; ?>>
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
                                        <a href="<?php echo $page > 1 ?  $_SERVER['PHP_SELF'] . '?page_layout=suadanhmuc&Id=' . $Id . '&search=' . $searchTerm . '' . '&page=' . ($page - 1) : 'javascript:void(0)'; ?>">
                                            <button type="button" class="btn btn-default" <?php echo $page == 1 ? 'disabled' : ''; ?>>
                                                « Trước
                                            </button>
                                        </a>
                                    </span>
                                    <span>
                                        <a href="<?php echo $page < $totalPage ?  $_SERVER['PHP_SELF'] . '?page_layout=suadanhmuc&Id=' . $Id . '&search=' . $searchTerm . '' . '&page=' . ($page + 1) : 'javascript:void(0)'; ?>">
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
    </div>
</main>



<div id="successBox" class="hidden fixed z-50 top-0 right-2 m-4 p-4 bg-green-500 dark:text-white bg-gray-50/10 border border-gray-200 rounded-xl shadow-lg dark:bg-gray-800 dark:border-gray-700 rounded shadow">
    ...
</div>