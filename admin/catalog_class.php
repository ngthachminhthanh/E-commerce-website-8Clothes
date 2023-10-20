<?php
include "database.php";
?>
<?php
class catalog {
  private $db;

  public func_construct()
  {
    $this -> db = new Database();
  }
  public function insert($catalog_name){
    $query = "INSERT IN tbl_catalog (catalog_name) VALUES ('$catalog_name') "; //nhap catalog_name vao ban tbl_catalog
    $result = $this -> db -> insert($query);
    return $result;
  }
}
?>