<?php
  include "header.php";
  include "slider.php";
  include "catalog_class.php";
?>
<?php
$catalog= new catalog;
if($_SERVER['REQUEST_METHOD']=== 'POST') {
  $catalog_name= $_POST['catalog_name'];
  $insert_catalog= $catalog -> $insert_catalog($catalog_name); 
}
?>
<div class="admin-content-right">
  <div class="admin-content-right-catalog">
    <h1>Thêm danh mục</h1>
    <form action="" method="post">
      <input name="catalog_name" type="text" placeholder="Nhập tên danh mục">
      <button type="submit">Thêm</button>
    </form>
  </div>
</div>