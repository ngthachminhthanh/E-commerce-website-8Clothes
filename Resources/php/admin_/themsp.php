<?php
include_once('ketnoi.php');

if (!isset($_SESSION['username_'])) {
    header('location: index.php');
    exit();
}

$categoryQuery = mysqli_query($conn, "SELECT * FROM `product category`") or die("Query Error: " . mysqli_error($conn));
$selectedCategories = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten_sp = isset($_POST['ten_sp']) ? mysqli_real_escape_string($conn, $_POST['ten_sp']) : '';
    $gia_sp = isset($_POST['gia_sp']) ? mysqli_real_escape_string($conn, $_POST['gia_sp']) : '';
    $mo_ta_sp = isset($_POST['mo_ta_sp']) ? mysqli_real_escape_string($conn, $_POST['mo_ta_sp']) : '';
    $link_anh_sp = isset($_POST['link_anh_sp']) ? mysqli_real_escape_string($conn, $_POST['link_anh_sp']) : '';
    $sl_ton_kho_sp = isset($_POST['sl_ton_kho_sp']) ? mysqli_real_escape_string($conn, $_POST['sl_ton_kho_sp']) : '';
    $selectedCategory = isset($_POST['selectedCategory']) ? mysqli_real_escape_string($conn, $_POST['selectedCategory']) : '';
    $selectedCategory001 = isset($_POST['selectedCategory001']) ? mysqli_real_escape_string($conn, $_POST['selectedCategory001']) : '';

    if (!empty($ten_sp) && !empty($gia_sp)) {
        $sql_max_id = "SELECT MAX(Id) AS max_id FROM `product`";
        $query_max_id = mysqli_query($conn, $sql_max_id);
        $result_max_id = mysqli_fetch_assoc($query_max_id);
        $max_id = $result_max_id['max_id'];

        $new_id = $max_id + 1;

        $insertQuery = "INSERT INTO product (Id, Name, Price, Description, Image, Quantity, `Product category ID`) VALUES ('$new_id', '$ten_sp', '$gia_sp', '$mo_ta_sp', '$link_anh_sp', '$sl_ton_kho_sp', '$selectedCategory')";
        $result = mysqli_query($conn, $insertQuery);

        if ($result) {
            $id = mysqli_insert_id($conn);
            $result = mysqli_query($conn, "SELECT * FROM product WHERE Id = $id") or die("Query Error: " . mysqli_error($conn));
            $row = mysqli_fetch_assoc($result);

            $categoryQuery = mysqli_query($conn, "SELECT * FROM `product category`") or die("Query Error: " . mysqli_error($conn));
            $selectedCategories = explode(',', $row['Product category ID']);

            echo '<script>
            console.log("Sản phẩm đã được thêm thành công.");
            setTimeout(() => {
            const successBox = document.getElementById("successBox");
            successBox.innerHTML = "Sản phẩm đã được thêm thành công.";
            successBox.style.top = "75px";
            successBox.style.right = "45px";
            successBox.classList.remove("hidden");

            setTimeout(function() {
                successBox.classList.add("hidden");
            }, 3000);
            }, 100);
            
            </script>';
        } else {
            echo "Thêm sản phẩm thất bại: " . mysqli_error($conn);
        }
    } else {
        echo "Vui lòng nhập đầy đủ thông tin sản phẩm.";
    }
}
?>

<main class="py-10 dark:bg-slate-800 dark:ring-white/10 dark:shadow-inner">
    <div>
        <div class="px-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
            <div class="min-w-0 flex flex-1 items-center space-x-2">
                <a href="quantri.php?page_layout=danhsachsp" class="btn btn-default btn-xs">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M17 10a.75.75 0 01-.75.75H5.612l4.158 3.96a.75.75 0 11-1.04 1.08l-5.5-5.25a.75.75 0 010-1.08l5.5-5.25a.75.75 0 111.04 1.08L5.612 9.25H16.25A.75.75 0 0117 10z" clip-rule="evenodd"></path>
                    </svg> </a>
                <h1 class="text-2xl font-medium text-slate-900 truncate dark:text-slate-100">
                    Thêm sản phẩm
                </h1>

            </div>
        </div>


        <div class="p-4 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-3 gap-6">
                <div class="col-span-3 xl:col-span-2 space-y-6">
                    <div>
                        <form id="form1" method="POST" action="">
                            <input type="hidden" name="selectedCategory" id="field1" placeholder="Enter product name" value="" required>

                            <div class="bg-white shadow-sm ring-1 ring-slate-200 rounded-md sm:rounded-lg dark:bg-slate-900 dark:ring-white/10 dark:shadow-inner dark:shadow-xl relative overflow-hidden">
                                <div class="px-4 py-5 sm:px-6">
                                    <fieldset class="grid grid-cols-1 gap-6">

                                        <div>
                                            <label class="block font-medium text-sm text-slate-700 dark:text-slate-200" for="name">
                                                Tên
                                            </label>

                                            <input class="appearance-none border border-slate-300 rounded-md shadow-sm checked:bg-sky-500 checked:text-sky-500 disabled:bg-slate-100 disabled:opacity-50 disabled:cursor-not-allowed focus:border-sky-500 focus:ring-sky-500 dark:border-white/10 dark:bg-white/5 dark:focus:border-sky-500 dark:focus:ring-sky-500 dark:text-slate-300 dark:focus:ring-offset-slate-900 dark:checked:bg-sky-500 mt-1 block w-full sm:text-sm" type="text" name="ten_sp" id="name" placeholder="Nhập tên sản phẩm" value="" required>

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

                                                <input class="appearance-none border border-slate-300 rounded-md shadow-sm checked:bg-sky-500 checked:text-sky-500 disabled:bg-slate-100 disabled:opacity-50 disabled:cursor-not-allowed focus:border-sky-500 focus:ring-sky-500 dark:border-white/10 dark:bg-white/5 dark:focus:border-sky-500 dark:focus:ring-sky-500 dark:text-slate-300 dark:focus:ring-offset-slate-900 dark:checked:bg-sky-500 pl-7 block w-full sm:text-sm" type="number" min="0" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="gia_sp" id="price" placeholder="0" value="" required>
                                            </div>

                                        </div>

                                        <div>
                                            <label class="block font-medium text-sm text-slate-700 dark:text-slate-200" for="link_anh_sp">
                                                Ảnh
                                            </label>

                                            <input class="appearance-none border border-slate-300 rounded-md shadow-sm checked:bg-sky-500 checked:text-sky-500 disabled:bg-slate-100 disabled:opacity-50 disabled:cursor-not-allowed focus:border-sky-500 focus:ring-sky-500 dark:border-white/10 dark:bg-white/5 dark:focus:border-sky-500 dark:focus:ring-sky-500 dark:text-slate-300 dark:focus:ring-offset-slate-900 dark:checked:bg-sky-500 mt-1 block w-full sm:text-sm" type="text" name="link_anh_sp" id="link_anh_sp" rows="3" placeholder="Link tới ảnh sản phẩm" value="" required>
                                            </input>

                                        </div>
                                        <div>
                                            <label class="block font-medium text-sm text-slate-700 dark:text-slate-200" for="sl_ton_kho_sp">
                                                Số lượng hàng tồn kho
                                            </label>
                                            <input class="appearance-none border border-slate-300 rounded-md shadow-sm checked:bg-sky-500 checked:text-sky-500 disabled:bg-slate-100 disabled:opacity-50 disabled:cursor-not-allowed focus:border-sky-500 focus:ring-sky-500 dark:border-white/10 dark:bg-white/5 dark:focus:border-sky-500 dark:focus:ring-sky-500 dark:text-slate-300 dark:focus:ring-offset-slate-900 dark:checked:bg-sky-500 block w-full sm:text-sm" type="number" min="0" onkeypress="return event.charCode >= 48 && event.charCode <= 57" name="sl_ton_kho_sp" id="sl_ton_kho_sp" value="" required>

                                            </input>

                                        </div>


                                        <div>
                                            <span class="cursor-default block font-medium text-sm text-slate-700 dark:text-slate-200">
                                                Mô tả
                                            </span>
                                            <textarea class="appearance-none border border-slate-300 rounded-md shadow-sm disabled:bg-slate-100 disabled:opacity-50 disabled:cursor-not-allowed focus:border-sky-500 focus:ring-sky-500 dark:border-white/10 dark:bg-white/5 dark:focus:border-sky-500 dark:focus:ring-sky-500 dark:text-slate-300 dark:focus:ring-offset-slate-900 mt-1 block w-full sm:text-sm" name="mo_ta_sp" id="mo_ta_sp" rows="3" placeholder="Nhập mô tả sản phẩm"></textarea>



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
                                            <img id="productImage" src="#" alt="Ảnh sản phẩm sẽ hiển thị tại đây" class="h-full w-full object-cover object-center transition group-hover:scale-125">
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
                                        $isChecked = 1;
                                        // $isChecked = in_array($categoryId, $selectedCategories);
                                    ?>
                                        <div class="relative flex items-start p-4 sm:px-6 hover:bg-slate-50 dark:hover:bg-slate-800">
                                            <span onclick="event.preventDefault(); document.querySelector('#collection-<?php echo $categoryId; ?>').click()" class="absolute inset-0 cursor-pointer"></span>
                                            <div class="min-w-0 flex-1 text-sm">
                                                <label class="block font-medium text-sm text-slate-700 dark:text-slate-200" for="collection-<?php echo $categoryId; ?>">
                                                    <?php echo $categoryRow['Category name']; ?>
                                                </label>
                                            </div>
                                            <div class="ml-3 flex items-center h-5">
                                                <input class="appearance-none border border-slate-300 rounded-md shadow-sm checked:bg-sky-500 checked:text-sky-500 disabled:bg-slate-100 disabled:opacity-50 disabled:cursor-not-allowed focus:border-sky-500 focus:ring-sky-500 dark:border-white/10 dark:bg-white/5 dark:focus:border-sky-500 dark:focus:ring-sky-500 dark:text-slate-300 dark:focus:ring-offset-slate-900 dark:checked:bg-sky-500 h-4 w-4 !rounded !shadow-none" name="selectedCategory001" id="collection-<?php echo $categoryId; ?>" type="radio" value="<?php echo $categoryId; ?>" required>
                                                <!-- <?php echo $isChecked ? 'checked' : ''; ?>> -->
                                            </div>
                                        </div>
                                    <?php
                                        $isChecked = 0;
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
        document.getElementById('form1').addEventListener('submit', function(event) {
            var radioButtons = document.getElementsByName('selectedCategory001');
            var radioButtonChecked = false;

            for (var i = 0; i < radioButtons.length; i++) {
                if (radioButtons[i].checked) {
                    radioButtonChecked = true;
                    break;
                }
            }

            if (!radioButtonChecked) {
                alert('Vui lòng chọn một danh mục trước khi gửi biểu mẫu.');
                event.preventDefault(); // Ngăn chặn việc submit biểu mẫu nếu ô radio chưa được chọn
            }
        });
    });
</script>


<div id="successBox" class="hidden fixed z-50 top-0 right-2 m-4 p-4 bg-green-500 dark:text-white bg-gray-50/10 border border-gray-200 rounded-xl shadow-lg dark:bg-gray-800 dark:border-gray-700 rounded shadow">
    ...
</div>