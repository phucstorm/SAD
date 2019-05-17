<?php
  header("Content-Type:application/json");
    // init
    require_once __DIR__ . "/../../config/config.php";
    require_once __DIR__ . "/../../lib/lib-branch.php";
    require_once __DIR__ . "/../../lib/lib-customer.php";
    $branch = new Branch();
    $customer = new Customer();

  if (isset($_GET['token'])) {
    switch ($_GET['read']) {
      case 'transaction':
        $ltr = $branch -> getAllTrans();
        echo json_encode($ltr);
        break;
      case 'product':
        $lpd = $branch -> getAllProduct();
        echo json_encode($lpd);
        break;
      case 'customer':
        $ctm = $customer -> getAll();
        echo json_encode($ctm);
        break;
      case 'search':
        $ser = $branch -> getProductCode($_GET['product_code']);
        echo json_encode($ser);
        break;
      case 'payment':
        $getUser = $customer -> ifExis($_GET['phone']);
        if($getUser != false) {
          // insert điểm vào database
          $isr = $customer -> addPoint($_GET['phone'], $_GET['point']);
          // insert dữ liệu vào transaction
          $ins_t = $branch -> createTrans($_GET['emp_id'],$_GET['phone'], $_GET['total']);
        }
        echo json_encode([
          "status1" => $isr,
          "status2" => $ins_t,
        ]);
        break;  
    }
  }

  if(isset($_GET['id']) && $_GET['id'] != ''){
    $cs_inf = $customer -> getID($_GET['id']);
    echo json_encode($cs_inf);
  }

  if($_GET['customer_name'] != '' && $_GET['customer_phone'] != '' && $_GET['customer_bday'] != '' && $_GET['customer_address'] != '' && $_GET['id'] != ''){
    $cs_update = $customer -> update($_GET['customer_name'], $_GET['customer_phone'], $_GET['customer_bday'], $_GET['customer_address'], $_GET['id']);
    echo json_encode([
      "status" => $cs_update
    ]);
  }

  
?>