<?php
    session_start();
	if($_SESSION['token'] == "" && $_SESSION['type'] != 2){
		echo "<script>alert('Đăng nhập lại');location.href='../'</script>";
	}else{
		$_GET['token'] = $_SESSION['token'];
        $_GET['read'] = "product";
		$url = "http://localhost/api/v1/branch/branch.php?token=".isset($_GET['token'])."&read=".urlencode($_GET['read'])."";
		$client = curl_init($url);
    	curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
    	$response = curl_exec($client);
    	$result = json_decode($response);
	}
?> 

<?php require_once __DIR__. "/../layout/header.php";?>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto h-100">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">
                                <i class="far fa-file-alt"></i>
                                Hóa đơn
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="">
                                <i class="fas fa-shopping-cart"></i>
                                Sản phẩm
                            </a>
                        </li><li class="nav-item">
                            <a class="nav-link" href="account.php">
                                <i class="far fa-user"></i>
                                Khách hàng
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../logout.php">
                                <i class="fas fa-sign-out-alt"></i>
                                Đăng xuất
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>               
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="text-white mt-5 mb-5">Welcome back <b><?php echo json_decode($_SESSION['name']) ?></b></p>
                </div>
            </div>
            <!-- row -->
            <div class="row tm-content-row">
                <div class="col-12 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                        <h2 class="tm-block-title">Danh sách sản phẩm
                        </h2>
                        
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Tên sản phẩm</th>
                                    <th scope="col">Mã sản phẩm</th>
                                    <th scope="col">Giá</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($result as $data => $item):?>
                                <tr>                   
                                    <td><b><?php echo $item->product_name?></b></td>
                                    <td><b><?php echo $item->product_code?></b></td>
                                    <td><b><?php echo $item->price?></b></td>
                                </tr>    
                                    <?php endforeach?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once __DIR__. "/../layout/footer.php";?>
