<?php
  header("Content-Type:application/json");
  if(isset($_GET['customer']) && $_GET['id']!=""){
    // init
    require_once __DIR__ . "/../../config/config.php";
    require_once __DIR__ . "/../../lib/lib-customer.php";
    $customer = new Customer();
    // PROCESS REQUEST
    switch ($_GET['customer']) {
      default:
        echo json_encode([
          "status" => false,
          "message" => "Invalid Request"
        ]);
        break;
      case "get-id":
        $usr = $customer->getID($_GET['id']);
        echo json_encode($usr);
        break;
    }
  }
  if($_GET['name'] != '' && $_GET['phone'] != '' && $_GET['bday'] != '' && $_GET['address'] != ''){
    require_once __DIR__ . "/../../config/config.php";
    require_once __DIR__ . "/../../lib/lib-customer.php";
    $status;
    $customer = new Customer();
    $check = $customer -> ifExis($_GET['phone']);
    if($check == false){
      $crt = $customer->create($_GET['name'], $_GET['phone'], $_GET['bday'], $_GET['address']);
      echo json_encode([
        'message' => true
      ]);
    }else{
      echo json_encode([
        'message' => false
      ]);;
    }
  }

?>