<?php
if (isset($_GET['sync'])) {
  // init
  require_once __DIR__ . "/../../config/config.php";
  require_once __DIR__ . "/../../lib/lib-branch.php";
  require_once __DIR__ . "/../../lib/lib-center.php";
  $branch = new Branch();
  $center = new Center();
  // PROCESS REQUEST
  switch ($_GET['sync']) {
    default:
      echo json_encode([
        "status" => false,
        "message" => "Invalid Request"
      ]);
      break;

    case 'sync-trans':
      $get = $branch -> getAllTrans();
      foreach ($get as $key =>$value) {
        $brnch = $center -> getBranch($value['emp_id']);
        $brn = $brnch['branch'];
        $trs_code = $value['transaction_code'];
        $emp_id = $value['emp_id'];
        $customer_code = $value['customer_phone'];
        $total_price = $value['total_price'];
        $created_at = $value['created_at'];
        $give = $center -> addTrans($brn, $trs_code,$emp_id, $customer_code, $total_price,$created_at);
      }
      echo json_encode([
        'status' => $give,
        'message' => $give ? "Sync Transaction Success" : "Sync Transaction Failed"
      ]);
      break;

    case "sync-product":
      $take = $center-> getAllProduct();
      $del = $branch -> deleteProduct();
      foreach($take as $data => $item){
        $pn = $item['product_name'];
        $pc = $item['product_code'];
        $pr = $item['price'];
        $dow = $branch -> updateProduct($pn, $pc, $pr);
      }
      echo json_encode([
        'status' => $dow,
        'message' => $dow ? "Sync Product Success" : "Sync Product Failed"
      ]);
      break;
  }
}
?>