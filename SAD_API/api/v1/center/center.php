<?php
  header("Content-Type:application/json");
  require_once __DIR__ . "/../../config/config.php";
  require_once __DIR__ . "/../../lib/lib-center.php";
  require_once __DIR__ . "/../../lib/lib-customer.php";

  $center = new Center();
  $customer = new Customer();
  if(isset($_GET['username']) && $_GET['password']!= '' ){
    // PROCESS REQUEST
    $usr = $center->checkLog($_GET['username'],$_GET['password']);
    $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);

    // Create token payload as a JSON string
    $payload = json_encode(['user_id' => 6969]);

    // Encode Header to Base64Url String
    $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));

    // Encode Payload to Base64Url String
    $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

    // Create Signature Hash
    $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, 'abC123!', true);

    // Encode Signature to Base64Url String
    $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

    // Create JWT
    $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
    $token = array(
      "id" => $usr['id'],
      "emp_name" => $usr['emp_name'],
      "emp_user" => $usr['emp_user'],
      "emp_type" => $usr['type']
    );
    echo json_encode([
      "message" => "Successful login.",
      "jwt" => $jwt,
      "secret_data" => $token
    ]);

  }
  if(isset($_GET['id'])){
    $pdi = $center -> getProductID($_GET['id']);
    echo json_encode($pdi);
  }

  if(isset($_GET['token'])){
    switch ($_GET['product']) {
      case 'edit':
        $edit = $center -> updateProduct($_GET['product_name'],$_GET['product_code'],$_GET['product_price'],$_GET['id']);
        echo json_encode($edit);
        break;
      case 'add':
        $add = $center -> addProduct($_GET['product_name'], $_GET['product_code'], $_GET['product_price']);
        echo json_encode($add);
        break;
      case 'delete':
        $del = $center -> deleteProduct($_GET['id']);
        echo $del;
        break;
    }
    switch ($_GET['read']) {
      case 'transaction':
        $trans = $center -> getAlltrans();
        echo json_encode($trans);
        break;
      case 'product':
        $prd = $center -> getAllProduct();
        echo json_encode($prd);
        break;
      case 'employ':
        $emp = $center -> getAllEmp();
        echo json_encode($emp);
        break;
      case 'customer':
        $cst = $customer -> getAll();
        echo json_encode($cst);
        break;
    }
  }



?>