<?php require_once __DIR__ . "/../config/config.php";
class Branch{
  /* database connection */
  private $link = null;
  private $stmt = null;
  public $error = "";
  
  function __construct(){
    try {
      $this->link = new PDO(
        "mysql:host=".DB_HOST.";
         dbname=".DB_BRANCH.";
         charset=".DB_CHAR,
        DB_USER, DB_PASS, [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
          PDO::ATTR_EMULATE_PREPARES => false,
        ]
      );
    } catch (Exception $ex) { die($ex->getMessage()); }
  }

  function __destruct(){
    if ($this->stmt!==null) { $this->stmt = null; }
    if ($this->link!==null) { $this->link = null; }
  }

  function query($sql, $cond=[]){
    try {
      $this->stmt = $this->link->prepare($sql);
      $this->stmt->execute($cond);
    } catch (Exception $ex) { 
      $this->error = $ex->getMessage();
      return false;
    }
    $this->stmt = null;
    return true;
  }

  /* product function */
  function getAllProduct(){
    $this->stmt = $this->link->prepare("SELECT * FROM `storehouse`");
    $this->stmt->execute();
    $prd = $this->stmt->fetchAll();
	return count($prd)==0 ? false : $prd;
  }

  function getProductID($id){
    $this->stmt = $this->link->prepare("SELECT * FROM `storehouse` WHERE `id`=?");
	  $cond = [$id];
    $this->stmt->execute($cond);
    $prd = $this->stmt->fetchAll();
	 return count($prd)==0 ? false : $prd[0];
  }

  function getProductCode($product_code){
    $this->stmt = $this->link->prepare("SELECT * FROM `storehouse` WHERE `product_code`=?");
    $cond = [$product_code];
    $this->stmt->execute($cond);
    $prd = $this->stmt->fetchAll();
  return count($prd)==0 ? false : $prd[0];
  }

  function updateProduct($product_name, $product_code, $price){
    return $this->query("INSERT INTO `storehouse` (`product_name`,`product_code`,`price`) VALUES (?,?,?)",[$product_name, $product_code, $price]);
  }

  function deleteProduct(){
    return $this->query("DELETE FROM `storehouse`");
  }

  function getAllTrans(){
    $this->stmt = $this->link->prepare("SELECT * FROM `transactions`");
    $this->stmt->execute();
    $prd = $this->stmt->fetchAll();
  return count($prd)==0 ? false : $prd;
  }

  function createTrans($emp_id, $phone, $total_price){
    return $this->query("INSERT INTO `transactions` (`emp_id`,`customer_phone`,`total_price`) VALUES (?,?,?)", [$emp_id, $phone,$total_price]);
  }
}
?>