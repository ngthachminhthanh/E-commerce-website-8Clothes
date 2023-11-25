<?php
// session_start();
include_once('ketnoi.php');

if (!isset($_SESSION['username_'])) {
  header('location:index.php');
  exit();
}

$rowsPerPage = isset($_SESSION['rows_per_page']) ? $_SESSION['rows_per_page'] : 10;

if (isset($_POST['submit'])) {
  $newRowsPerPage = mysqli_real_escape_string($conn, $_POST['rows_per_page']);

  $_SESSION['rows_per_page'] = $newRowsPerPage;
  $rowsPerPage = $newRowsPerPage;
  echo '<script>
        console.log("Cài đặt số lượng rowsPerPage đã được cập nhật thành công.");
        setTimeout(() => {
            const successBox = document.getElementById("successBox");
            successBox.innerHTML = "Cài đặt số lượng rowsPerPage đã được cập nhật thành công.";
            successBox.style.top = "75px";
            successBox.style.right = "45px";
            successBox.classList.remove("hidden");

            setTimeout(function() {
                successBox.classList.add("hidden");
            }, 3000);
        }, 100);
    </script>';
}
?>

<div class="grid grid-cols-3 px-8 py-10 mx-auto max-w-7xl">

  <div class="sm:col-span-3 lg:col-span-2">
    <form method="post" action="">
      <label for="rows_per_page" class="block font-medium text-sm text-slate-700 dark:text-slate-200" for="storeNameInput">
        Số lượng hàng mỗi trang
      </label>
      <div class="mt-2">
        <input class="appearance-none border border-slate-300 rounded-md shadow-sm checked:bg-sky-500 checked:text-sky-500 disabled:bg-slate-100 disabled:opacity-50 disabled:cursor-not-allowed focus:border-sky-500 focus:ring-sky-500 dark:border-white/10 dark:bg-white/5 dark:focus:border-sky-500 dark:focus:ring-sky-500 dark:text-slate-300 dark:focus:ring-offset-slate-900 dark:checked:bg-sky-500 block w-full sm:text-sm" onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="number" min="1" name="rows_per_page" value="<?php echo $rowsPerPage; ?>" required>
        <div class="mt-6 flex items-center justify-end gap-x-6">
          <button class="btn btn-primary" type="submit" name="submit">Lưu</button>
        </div>

      </div>

    </form>
  </div>
</div>