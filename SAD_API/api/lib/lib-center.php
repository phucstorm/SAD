<?php require_once __DIR__ . "/../config/config.php";
class Center{
  /* database connection */
  private $link = null;
  private $stmt = null;
  public $error = "";
  
  function __construct(){
    try {
      $this->link = new PDO(
        "mysql:host=".DB_HOST.";
         dbname=".DB_ADMIN.";
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

  function checkLog($name, $password){
    $this->stmt = $this->link->prepare("SELECT * FROM `employees` WHERE `emp_user`=? AND `emp_password` =?");
    $cond = [$name, MD5($password)];
    $this->stmt->execute($cond);
    $user = $this->stmt->fetchAll();
  return count($user)==0 ? false : $user[0];
  }

  function getAllProduct(){
    $this->stmt = $this->link->prepare("SELECT * FROM `products`");
    $this->stmt->execute();
    $prd = $this->stmt->fetchAll();
    return count($prd)==0 ? false : $prd;
  }

  function getProductID($id){
    $this->stmt = $this->link->prepare("SELECT * FROM `products` WHERE `id`=?");
    $cond = [$id];
    $this->stmt->execute($cond);
    $prd = $this->stmt->fetchAll();
   return count($prd)==0 ? false : $prd[0];
  }

  function addProduct($product_name, $product_code, $price){
    return $this->query("INSERT INTO `products` (`product_name`, `product_code`, `price`) VALUES (?,?,?)",
      [$product_name, $product_code, $price]);
  }

  function updateProduct($product_name, $product_code, $price,$id){
  $q = "UPDATE `products` SET `product_name`=?,`product_code`=?,`price`=?";
  $cond = [$product_name, $product_code, $price];
  $q .= " WHERE `id`=?";
  $cond[] = $id;
    return $this->query($q, $cond);
  }

  function deleteProduct($id){
    return $this->query("DELETE FROM `products` WHERE `id`=?",[$id]);
  }

  function addTrans($branch_id, $trs_code,$emp_id, $customer_phone, $total_price, $created_at){
    return $this->query("INSERT INTO `transaction` (`branch_id`, `transaction_code`, `emp_id`, `customer_phone`, `total_price`, `created_at`) VALUES (?,?,?,?,?,?)", [$branch_id, $trs_code,$emp_id, $customer_phone, $total_price, $created_at]);
  }

  function getAllEmp(){
    $this->stmt = $this->link->prepare("SELECT `employees`.`id`, `employees`.`emp_name`, `employees`.`emp_user`, `employees`.`phone_number`, `employees`.`address`,`branchs`.`branch_name` as `branch_name`, `employee_type`.`emp_type` as `type_emp` FROM `employees` , `branchs`, `employee_type` WHERE `branchs`.branch_id = `employees`.`branch` AND `employees`.`type` = `employee_type`.`id`");
    $this->stmt->execute();
    $emp = $this->stmt->fetchAll();
    return count($emp)==0 ? false : $emp;
  }

  function getAlltrans(){
    $this->stmt = $this->link->prepare("SELECT `branch_name` as `branch_name`, `transaction_code` , `emp_name` as `emp_name`, `customer_phone`, `total_price`, `created_at` FROM `transaction`, `branchs`, `employees` WHERE `branchs`.`branch_id` = `transaction`.`branch_id` AND `employees`.`id` = `transaction`.`emp_id`");
    $this->stmt->execute();
    $trs = $this->stmt->fetchAll();
    return count($trs)==0 ? false : $trs;
  }
  function getBranch($emp_id){
   $this->stmt = $this->link->prepare("SELECT `branch` FROM `employees` WHERE `id`=?");
    $cond = [$emp_id];
    $this->stmt->execute($cond);
    $brn = $this->stmt->fetchAll();
   return count($brn)==0 ? false : $brn[0];
  }

}
?>