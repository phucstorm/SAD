<?php
  session_start();
  error_reporting(0);
  if($_SESSION['token'] == "" && $_SESSION['type'] != 1){
    echo "<script>alert('Đăng nhập lại');location.href='../'</script>";
  }else{
    $_GET['product'] = "add";
    $_GET['token'] = $_SESSION['token'];
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $edit = "http://localhost/api/v1/center/center.php?token=".isset($_GET['token'])."&product=".$_GET['product']."&product_name=".urlencode($_POST['product_name'])."&product_code=".urlencode($_POST['product_code'])."&product_price=".urlencode($_POST['product_price'])."";

        $client_edit = curl_init($edit);
        curl_setopt($client_edit,CURLOPT_RETURNTRANSFER,true);
        $response_edit = curl_exec($client_edit);
        $result_edit = json_decode($response_edit);
        if($response_edit == true){
          echo "<script>alert('Thêm sản phẩm thành công');location.href='product.php'</script>";
        }else{
          echo "<script>alert('Thêm sản phẩm không thành công');location.href='product.php'</script>";
        }
    }
  }
?>
<?php require_once __DIR__. "/../layout/header.php";?>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto h-100">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">
                                <i class="far fa-file-alt"></i>
                                Hóa đơn
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="product.php">
                                <i class="fas fa-shopping-cart"></i>
                                Sản phẩm
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="far fa-user"></i>
                                <span>
                                    Tài khoản <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="employ.php">Nhân viên</a>
                                <a class="dropdown-item" href="">Khách hàng</a>
                            </div>
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
    <div class="container tm-mt-big tm-mb-big">
      <div class="row">
        <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12 mx-auto">
          <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
            <div class="row">
              <div class="col-12">
                <h2 class="tm-block-title d-inline-block">Thêm sản phẩm</h2>
              </div>
            </div>
            <div class="row tm-edit-product-row">
              <div class="col-12">
                <form action="" method="post" class="tm-edit-product-form" enctype="multipart/form-data">
                  <div class="form-group mb-3">
                    <label>Tên sản phẩm</label>
                    <input name="product_name" type="text" class="form-control validate" required>
                  </div>
                  <div class="form-group mb-3">
                    <label>Mã sản phẩm</label>
                    <input name="product_code" type="text" class="form-control validate" required>
                  </div>
                  <div class="form-group mb-3">
                    <label>Giá</label>
                    <input name="product_price" type="number" class="form-control validate" data-large-mode="true" required>
                  </div>

                  
              </div>
              <div class="col-12">
                <button type="submit" name="product" value="add" class="btn btn-primary btn-block text-uppercase">Thêm sản phẩm</button>
                <a
              href="product.php"
              class="btn btn-primary btn-block text-uppercase mb-3">Trở về</a>
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
 <?php require_once __DIR__. "/../layout/footer.php";?>