<?php
// session_start();
include_once('ketnoi.php');

// if (!isset($_SESSION['username_'])) {
//     header('location:index.php');
//     exit();
// }


if (isset($_POST['submit'])) {
    $tendanhmuc = mysqli_real_escape_string($conn, $_POST['ten_danhmuc']);

    $sql_max_id = "SELECT MAX(Id) AS max_id FROM `product category`";
    $query_max_id = mysqli_query($conn, $sql_max_id);
    $result_max_id = mysqli_fetch_assoc($query_max_id);
    $max_id = $result_max_id['max_id'];

    $new_id = $max_id + 1;

    $sql_insert = "INSERT INTO `product category` (`Id`, `Category name`) VALUES ('$new_id', '$tendanhmuc')";
    $query_insert = mysqli_query($conn, $sql_insert);
    // $sql_insert = "INSERT INTO `product category` (`Category name`) VALUES ('$tendanhmuc')";
    // $query_insert = mysqli_query($conn, $sql_insert);

    if ($query_insert) {
        // header('location:quantri.php?page_layout=danhmucsp');
        // exit();

        echo '<script>
        console.log("Thêm thành công.");
        setTimeout(() => {
        const successBox = document.getElementById("successBox");
        successBox.innerHTML = "Thêm thành công.";
        successBox.style.top = "75px";
        successBox.style.right = "45px";
        successBox.classList.remove("hidden");

        setTimeout(function() {
        successBox.classList.add("hidden");
        }, 3000);
                }, 100);
                
        </script>';
    } else {
        echo "Thêm danh mục không thành công!";
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
                Thêm danh mục
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

                                    <input class="appearance-none border border-slate-300 rounded-md shadow-sm checked:bg-sky-500 checked:text-sky-500 disabled:bg-slate-100 disabled:opacity-50 disabled:cursor-not-allowed focus:border-sky-500 focus:ring-sky-500 dark:border-white/10 dark:bg-white/5 dark:focus:border-sky-500 dark:focus:ring-sky-500 dark:text-slate-300 dark:focus:ring-offset-slate-900 dark:checked:bg-sky-500 mt-1 block w-full sm:text-sm" type="text" name="ten_danhmuc" id="name" placeholder="Nhập tên danh mục" value="" required>

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

            </div>
        </div>
    </div>
</main>



<div id="successBox" class="hidden fixed z-50 top-0 right-2 m-4 p-4 bg-green-500 dark:text-white bg-gray-50/10 border border-gray-200 rounded-xl shadow-lg dark:bg-gray-800 dark:border-gray-700 rounded shadow">
    ...
</div>