<?php
include "config.php";
?>
<?php
class Database{
  public $host= DB_HOST;
  public $user= DB_USER;
  public $pass= DB_PASS;
  public $dbname= DB_NAME;
  public $link;
  public $erro;
  public function __construct(){
    $this->connectDB();
  }
  private function connectDB(){
    $this->link= new mysqli($this->host, $this->user, $this->pass, $this->dbname);
    if(!$this->link){
      $this->error="connection fail".$this->link->connect_error;
      return false;
    }
  }
  //selecct or read data
  public function select($query){
    $result= $this->query($query) or
      die (this->link->error.__LINE__);
    if($result->num_row > 0){
      return $result;
    } else return false;
  } 
}
?>