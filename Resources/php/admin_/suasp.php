<?php
// session_start();
include_once('ketnoi.php');

if (!isset($_SESSION['username_'])) {
    header('location: index.php');
    exit();
}

if (isset($_GET['Id'])) {
    $id = $_GET['Id'];

    $result = mysqli_query($conn, "SELECT * FROM product WHERE Id = $id") or die("Query Error: " . mysqli_error($conn));
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        echo "Không tìm thấy sản phẩm.";
        exit();
    } else {

        $categoryQuery = mysqli_query($conn, "SELECT * FROM `product category`") or die("Query Error: " . mysqli_error($conn));
        $selectedCategories = explode(',', $row['Product category ID']);
    }
} else {
    echo "Không có ID sản phẩm được cung cấp.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Xử lý dữ liệu được gửi từ form sửa sản phẩm
    $ten_sp = isset($_POST['ten_sp']) ? mysqli_real_escape_string($conn, $_POST['ten_sp']) : '';
    $gia_sp = isset($_POST['gia_sp']) ? mysqli_real_escape_string($conn, $_POST['gia_sp']) : '';
    $mo_ta_sp = isset($_POST['mo_ta_sp']) ? mysqli_real_escape_string($conn, $_POST['mo_ta_sp']) : '';
    $link_anh_sp = isset($_POST['link_anh_sp']) ? mysqli_real_escape_string($conn, $_POST['link_anh_sp']) : '';
    $sl_ton_kho_sp = isset($_POST['sl_ton_kho_sp']) ? mysqli_real_escape_string($conn, $_POST['sl_ton_kho_sp']) : '';
    $selectedCategory = isset($_POST['selectedCategory']) ? mysqli_real_escape_string($conn, $_POST['selectedCategory']) : '';
    $selectedCategory001 = isset($_POST['selectedCategory001']) ? mysqli_real_escape_string($conn, $_POST['selectedCategory001']) : '';
    // $gia_sp = isset($_POST['gia_sp']) ? mysqli_real_escape_string($conn, $_POST['gia_sp']) : '';
    echo $ten_sp;
    echo $gia_sp;
    echo $selectedCategory;
    echo $selectedCategory001;
    echo $_POST['selectedCategory'];

    if (!empty($ten_sp) && !empty($gia_sp)) {
        $updateQuery = "UPDATE product SET Name = '$ten_sp', Price = '$gia_sp', Description = '$mo_ta_sp', Image = '$link_anh_sp', Quantity = '$sl_ton_kho_sp', `Product category ID` = $selectedCategory WHERE Id = $id";
        $result = mysqli_query($conn, $updateQuery);
        $id = $_GET['Id'];
        $result = mysqli_query($conn, "SELECT * FROM product WHERE Id = $id") or die("Query Error: " . mysqli_error($conn));
        $row = mysqli_fetch_assoc($result);

        // chặn nhay rlaij
        $categoryQuery = mysqli_query($conn, "SELECT * FROM `product category`") or die("Query Error: " . mysqli_error($conn));
        $selectedCategories = explode(',', $row['Product category ID']);

        if ($result && $row['Name'] == $ten_sp && $row['Price'] == $gia_sp) {
            // echo "Sản phẩm đã được cập nhật thành công.";
            echo '<script>
            console.log("Sản phẩm đã được cập nhật thành công.");
            setTimeout(() => {
            const successBox = document.getElementById("successBox");
            successBox.innerHTML = "Sản phẩm đã được cập nhật thành công.";
            successBox.style.top = "75px";
            successBox.style.right = "45px";
            successBox.classList.remove("hidden");

            setTimeout(function() {
                successBox.classList.add("hidden");
            }, 3000);
            }, 100);
            
            </script>';
        } else {
            echo "Cập nhật sản phẩm thất bại: " . mysqli_error($conn);
        }
    } else {
        echo "Vui lòng nhập đầy đủ thông tin sản phẩm.";
    }
}
?>

<main class="py-10">
    <div>
        <div class="px-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
            <div class="min-w-0 flex flex-1 items-center space-x-2">
                <a href="quantri.php?page_layout=danhsachsp" class="btn btn-default btn-xs">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M17 10a.75.75 0 01-.75.75H5.612l4.158 3.96a.75.75 0 11-1.04 1.08l-5.5-5.25a.75.75 0 010-1.08l5.5-5.25a.75.75 0 111.04 1.08L5.612 9.25H16.25A.75.75 0 0117 10z" clip-rule="evenodd"></path>
                    </svg> </a>
                <h1 class="text-2xl font-medium text-slate-900 truncate dark:text-slate-100">
                    <?php echo $row['Name']; ?>
                </h1>
                <span class="inline-flex items-center rounded-full font-medium bg-green-50 text-green-700 ring-1 ring-inset ring-green-600/20 dark:bg-green-500/10 dark:text-green-400 dark:ring-green-500/20 text-xs px-2 py-1">
                    <?php echo $row['Quantity'] > 0 ? 'Sẵn sàng' : 'Hết hàng'; ?>
                </span>
            </div>
        </div>


        <div class="p-4 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-3 gap-6">
                <div class="col-span-3 xl:col-span-2 space-y-6">
                    <div>
                        <form id="form1" method="POST" action="">
                            <input type="hidden" name="selectedCategory" id="field1" placeholder="Enter product name" value="<?php echo $row['Product category ID']; ?>" required>

                            <div class="bg-white shadow-sm ring-1 ring-slate-200 rounded-md sm:rounded-lg dark:bg-slate-900 dark:ring-white/10 dark:shadow-inner dark:shadow-xl relative overflow-hidden">
                                <div class="px-4 py-5 sm:px-6">
                                    <fieldset class="grid grid-cols-1 gap-6">

                                        <div>
                                            <label class="block font-medium text-sm text-slate-700 dark:text-slate-200" for="name">
                                                Tên
                                            </label>

                                            <input class="appearance-none border border-slate-300 rounded-md shadow-sm checked:bg-sky-500 checked:text-sky-500 disabled:bg-slate-100 disabled:opacity-50 disabled:cursor-not-allowed focus:border-sky-500 focus:ring-sky-500 dark:border-white/10 dark:bg-white/5 dark:focus:border-sky-500 dark:focus:ring-sky-500 dark:text-slate-300 dark:focus:ring-offset-slate-900 dark:checked:bg-sky-500 mt-1 block w-full sm:text-sm" type="text" name="ten_sp" id="name" placeholder="Enter product name" value="<?php echo $row['Name']; ?>" required>

                                        </div>


                                        <div>
                                            <label class="block font-medium text-sm text-slate-700 dark:text-slate-200" for="price">
                                                Giá
                                            </label>

                                            <div class="relative text-slate-500 mt-1 focus-within:text-slate-600 dark:focus-within:text-slate-200">
                                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <span class="sm:text-sm">
                                                        đ
                                                    </span>
                                                </div>

                                                <input class="appearance-none border border-slate-300 rounded-md shadow-sm checked:bg-sky-500 checked:text-sky-500 disabled:bg-slate-100 disabled:opacity-50 disabled:cursor-not-allowed focus:border-sky-500 focus:ring-sky-500 dark:border-white/10 dark:bg-white/5 dark:focus:border-sky-500 dark:focus:ring-sky-500 dark:text-slate-300 dark:focus:ring-offset-slate-900 dark:checked:bg-sky-500 pl-7 block w-full sm:text-sm" type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" min="0" name="gia_sp" id="price" placeholder="0" value="<?php echo $row['Price']; ?>" required>
                                            </div>

                                        </div>

                                        <div>
                                            <label class="block font-medium text-sm text-slate-700 dark:text-slate-200" for="excerpt">
                                                Ảnh
                                            </label>

                                            <input class="appearance-none border border-slate-300 rounded-md shadow-sm checked:bg-sky-500 checked:text-sky-500 disabled:bg-slate-100 disabled:opacity-50 disabled:cursor-not-allowed focus:border-sky-500 focus:ring-sky-500 dark:border-white/10 dark:bg-white/5 dark:focus:border-sky-500 dark:focus:ring-sky-500 dark:text-slate-300 dark:focus:ring-offset-slate-900 dark:checked:bg-sky-500 mt-1 block w-full sm:text-sm" type="text" name="link_anh_sp" id="link_anh_sp" placeholder="Enter product excerpt" value="<?php echo $row['Image']; ?> " required>

                                            </input>

                                        </div>
                                        <div>
                                            <label class="block font-medium text-sm text-slate-700 dark:text-slate-200" for="excerpt">
                                                Số lượng hàng tồn kho
                                            </label>
                                            <input class="appearance-none border border-slate-300 rounded-md shadow-sm checked:bg-sky-500 checked:text-sky-500 disabled:bg-slate-100 disabled:opacity-50 disabled:cursor-not-allowed focus:border-sky-500 focus:ring-sky-500 dark:border-white/10 dark:bg-white/5 dark:focus:border-sky-500 dark:focus:ring-sky-500 dark:text-slate-300 dark:focus:ring-offset-slate-900 dark:checked:bg-sky-500 block w-full sm:text-sm" type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" min="0" name="sl_ton_kho_sp" id="excerpt" value="<?php echo $row['Quantity']; ?>" required>

                                            </input>

                                        </div>


                                        <div>
                                            <span class="cursor-default block font-medium text-sm text-slate-700 dark:text-slate-200">
                                                Mô tả
                                            </span>
                                            <textarea class="appearance-none border border-slate-300 rounded-md shadow-sm disabled:bg-slate-100 disabled:opacity-50 disabled:cursor-not-allowed focus:border-sky-500 focus:ring-sky-500 dark:border-white/10 dark:bg-white/5 dark:focus:border-sky-500 dark:focus:ring-sky-500 dark:text-slate-300 dark:focus:ring-offset-slate-900 mt-1 block w-full sm:text-sm" name="mo_ta_sp" id="excerpt" rows="3" placeholder="Enter product excerpt"><?php echo $row['Description']; ?></textarea>



                                        </div>
                                    </fieldset>
                                </div>
                                <div class="px-4 py-3 rounded-b-md sm:px-6 sm:rounded-b-lg bg-slate-50 dark:bg-slate-800/75">
                                    <div class="flex items-center justify-end">

                                        <button type="submit" class="btn btn-primary">
                                            Lưu thay đổi
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>


                    </div>

                    <div>
                        <div>
                            <div class="bg-white shadow-sm ring-1 ring-slate-200 rounded-md sm:rounded-lg dark:bg-slate-900 dark:ring-white/10 dark:shadow-inner dark:shadow-xl overflow-hidden">
                                <div class="px-4 py-5 rounded-t-md sm:px-6 sm:rounded-t-lg">
                                    <div class="-ml-4 -mt-2 flex items-center justify-between flex-wrap sm:flex-nowrap">
                                        <div class="ml-4 mt-2">
                                            <h3 class="text-base font-medium text-slate-900 dark:text-slate-200">
                                                Ảnh
                                            </h3>
                                        </div>

                                    </div>
                                </div>
                                <div class="px-4 py-5 sm:px-6 -mt-5">
                                    <div class="grid grid-cols-3 lg:grid-cols-4 gap-4 auto-rows-fr">
                                        <div class="relative overflow-hidden border border-slate-200 group rounded-md flex items-center justify-center dark:border-slate-200/20 col-start-1 col-span-2 row-span-2">
                                            <img id="productImage" src="<?php echo $row['Image']; ?>" alt="<?php echo $row['Name'] ?>" class="h-full w-full object-cover object-center transition group-hover:scale-125">
                                            <div class="absolute inset-0 group-hover:bg-opacity-50 group-hover:bg-slate-600 rounded-md transition-all">
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="bg-white shadow-sm ring-1 ring-slate-200 rounded-md sm:rounded-lg dark:bg-slate-900 dark:ring-white/10 dark:shadow-inner dark:shadow-xl overflow-hidden">
                    <div class="px-4 py-5 rounded-t-md sm:px-6 sm:rounded-t-lg">
                        <div class="-ml-4 -mt-2 flex items-center justify-between flex-wrap sm:flex-nowrap">
                            <div class="ml-4 mt-2">
                                <h3 class="text-base font-medium text-slate-900 dark:text-slate-200">
                                    Danh mục
                                </h3>
                            </div>
                            <div class="ml-4 mt-2 flex-shrink-0" style="display: none;">
                                <button class="btn btn-link">
                                    Lưu
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-5 sm:px-6 -mt-5">
                        <div class="-mx-4 -mb-5 border-t border-slate-300 max-h-[60%] overflow-y-auto sm:-mx-6 dark:border-slate-200/20">


                            <form method="POST" id="form2">
                                <ul class="divide-y divide-slate-200 dark:divide-slate-200/10">
                                    <?php
                                    while ($categoryRow = mysqli_fetch_assoc($categoryQuery)) {
                                        $categoryId = $categoryRow['Id'];
                                        $isChecked = in_array($categoryId, $selectedCategories);
                                    ?>
                                        <div class="relative flex items-start p-4 sm:px-6 hover:bg-slate-50 dark:hover:bg-slate-800">
                                            <span onclick="event.preventDefault(); document.querySelector('#collection-<?php echo $categoryId; ?>').click()" class="absolute inset-0 cursor-pointer"></span>
                                            <div class="min-w-0 flex-1 text-sm">
                                                <label class="block font-medium text-sm text-slate-700 dark:text-slate-200" for="collection-<?php echo $categoryId; ?>">
                                                    <?php echo $categoryRow['Category name']; ?>
                                                </label>
                                            </div>
                                            <div class="ml-3 flex items-center h-5">
                                                <input class="appearance-none border border-slate-300 rounded-md shadow-sm checked:bg-sky-500 checked:text-sky-500 disabled:bg-slate-100 disabled:opacity-50 disabled:cursor-not-allowed focus:border-sky-500 focus:ring-sky-500 dark:border-white/10 dark:bg-white/5 dark:focus:border-sky-500 dark:focus:ring-sky-500 dark:text-slate-300 dark:focus:ring-offset-slate-900 dark:checked:bg-sky-500 h-4 w-4 !rounded !shadow-none" name="selectedCategory001" id="collection-<?php echo $categoryId; ?>" type="radio" value="<?php echo $categoryId; ?>" <?php echo $isChecked ? 'checked' : ''; ?>>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

</main>


<script>
    $(document).ready(function() {
        document.getElementById('form1').addEventListener('submit', function(event) {
            event.preventDefault();
            document.getElementById('field1').value = document.querySelector('input[name="selectedCategory001"]:checked').value;
            this.submit();
        });
        document.getElementById('link_anh_sp').addEventListener('change', function() {
            var imageUrl = this.value;
            document.getElementById('productImage').src = imageUrl;
        });
    });
</script>

<div class="max-w-xs bg-white border border-gray-200 rounded-xl shadow-lg dark:bg-gray-800 dark:border-gray-700 fixed  right-2.5 top-24 transition-all" role="alert">
    <div id="sToast" class="flex p-4">
        <div class="flex-shrink-0">
            <svg class="flex-shrink-0 h-4 w-4 text-teal-500 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
            </svg>
        </div>
        <div class="ms-3">
            <p id="toast-body" class="text-sm text-gray-700 dark:text-gray-400">
                This is a success message.
            </p>
        </div>
    </div>
</div>

<div id="successBox" class="hidden fixed z-50 top-0 right-2 m-4 p-4 bg-green-500 dark:text-white bg-gray-50/10 border border-gray-200 rounded-xl shadow-lg dark:bg-gray-800 dark:border-gray-700 rounded shadow">
    ...
</div>