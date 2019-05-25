<?php  
	session_start();
	error_reporting(0);
	if($_SESSION['token'] == "" && $_SESSION['type'] != 3){
		echo "<script>alert('Đăng nhập lại');location.href='../'</script>";
	}
	$_GET['read'] = "search";
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$url = "http://localhost/api/v1/branch/branch.php?token=".isset($_GET['token'])."&read=".$_GET['read']."&product_code=".$_POST['product_code']."";
		$client = curl_init($url);
    	curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
    	$response = curl_exec($client);
    	$result= json_decode($response);
    	if($result->product_code == 0){
    		echo "<script>alert('Mã sản phẩm này không tồn tại');</script>";
    	}else{
    		if(!isset($_SESSION['bill'][$result->product_code])){
    			$_SESSION['bill'][$result->product_code]['product_code'] = $result->product_code;
    			$_SESSION['bill'][$result->product_code]['product_name'] = $result->product_name;
    			$_SESSION['bill'][$result->product_code]['product_price'] = $result->price;
    			$_SESSION['bill'][$result->product_code]['product_sl'] = 1;
    		}else{
    			$_SESSION['bill'][$result->product_code]['product_sl'] += 1;
    		}	
    	}
	}

?>
<head>
  	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  	<meta name="description" content="">
  	<meta name="author" content="">
  	<title>POST -SYSTEM</title>
  	<link rel="icon" href="../front-end/img/vlu_logo.ico" type="img">
  	<link href="../front-end/vendor/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../front-end/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../front-end/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>
<form action="" method="post">
	<label>Nhập mã sản phẩm :</label>
	<input type="text" name="product_code" class="col-xs-3" required>
	<input type="submit" value="Add"/>
</form>

<div class="col-md-9" >
	<section class="box-main1">
		<h3 class="title-main"><a href="">Hóa đơn mua hàng</a> </h3>
		<table class="table table-hover" id="cart-info">
			<thead>
				<tr>
					<th>STT</th><th>Tên sản phẩm</th><th>Số lượng</th><th>Giá</th><th>Thao tác</th>
				</tr>
			</thead>
			<tbody id="tbody">
				<?php $stt =1;foreach ($_SESSION['bill'] as $key => $value): ?>
				<tr>
					<td><?php echo $stt ?></td>
					<td><?php echo $value['product_name'] ?></td>
					<td>
						<input type="number" value='<?php echo $value['product_sl']?>' min="1" class="form-control" style="width: 80px" readonly>
					</td>
					<td><?php echo $value['product_price'] ?></td>
					<td><a href="remove.php?key=<?php echo $key ?>" class="btn btn-xs btn-danger"> <i class="fa fa-remove"></i></a></td>
				</tr>
				<?php $sum+= $value['product_price'] * $value['product_sl']; 
				$_SESSION['total'] = $sum;
				$_SESSION['point'] = $_SESSION['total']/1000; ?>
				<?php $stt ++;endforeach ?>
			</tbody>
		</table>
		<div class="col-md-5 pull-right">
			<a href="print-bill.php" class="btn btn-success pull-right">Thanh toán</a>
			<a href="index.php" class="btn btn-danger pull-right">Hủy</a>
		</div>
	</section>
</div>