<?php require_once __DIR__ . "/../config/config.php";
class Customer{
  /* database connection */
  private $link = null;
  private $stmt = null;
  public $error = "";
  
  function __construct(){
    try {
      $this->link = new PDO(
        "mysql:host=".DB_HOST.";
         dbname=".DB_CUSTOMER.";
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

  /* user function */
  function getAll(){
    $this->stmt = $this->link->prepare("SELECT * FROM `customer`");
    $this->stmt->execute();
    $users = $this->stmt->fetchAll();
	return count($users)==0 ? false : $users;
  }

  function getID($id){
    $this->stmt = $this->link->prepare("SELECT * FROM `customer` WHERE `id`=?");
	  $cond = [$id];
    $this->stmt->execute($cond);
    $user = $this->stmt->fetchAll();
	 return count($user)==0 ? false : $user[0];
  }

  function getCode($customer_code){
    $this->stmt = $this->link->prepare("SELECT * FROM `customer` WHERE `customer_code`=?");
    $cond = [$customer_code];
    $this->stmt->execute($cond);
    $user = $this->stmt->fetchAll();
  return count($user)==0 ? false : $user[0];
  }

  function ifExis($phone){
    $this->stmt = $this->link->prepare("SELECT * FROM `customer` WHERE `phone_number` =?");
    $cond = [$phone];
    $this->stmt->execute($cond);
    $check = $this->stmt->fetchAll();
    return count($check) == 0 ? false : $check[0];
  }

  function create($full_name, $phone_number, $dob, $address){
    return $this->query(
      "INSERT INTO `customer` (`full_name`, `phone_number`, `dob`, `address`, `point`) VALUES (?,?,?,?,?)",
      [$full_name, $phone_number, $dob, $address,0]
    );
  }

  function update($full_name, $phone_number, $dob, $address, $id){
	$q = "UPDATE `customer` SET `full_name`=?, `phone_number`=?, `dob`=?, `address`=?";
	$cond = [$full_name, $phone_number, $dob, $address];
	$q .= " WHERE `id`=?";
	$cond[] = $id;
    return $this->query($q, $cond);
  }

  function addPoint($phone, $point){
    $q = "UPDATE `customer` SET `point`=?";
  $cond = [$point];
  $q .= " WHERE `phone_number`=?";
  $cond[] = $phone;
    return $this->query($q, $cond);
  }

}
?>