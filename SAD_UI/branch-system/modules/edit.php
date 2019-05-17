<?php 
  session_start();
  error_reporting(0);
  if($_SESSION['token'] == "" && $_SESSION['type'] != 2 && $_GET['id'] != NULL){
    echo "<script>alert('Đăng nhập lại');location.href='../'</script>";
  }else{
    $url = "http://localhost/api/v1/branch/branch.php?id=".isset($_GET['id'])."&id=".$_GET['id']."";
    $client = curl_init($url);
    curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
    $response = curl_exec($client);
    $result = json_decode($response);
  }
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    $id = $_POST['id'];
    $name = $_POST['customer_name'];
    $phone = $_POST['customer_phone'];
    $dob = $_POST['customer_bday'];
    $address = $_POST['customer_address'];

    $edit = "http://localhost/api/v1/branch/branch.php?id=".urlencode($id)."&customer_name=".urlencode($name)."&customer_phone=".urlencode($phone)."&customer_bday=".urlencode($dob)."&customer_address=".urlencode($address)."";
    $cli_edit = curl_init($edit);
    curl_setopt($cli_edit,CURLOPT_RETURNTRANSFER,true);
    $response_edit = curl_exec($cli_edit);
    $result_edit = json_decode($response_edit);
    echo "<script>alert('Chỉnh sửa thông tin Khách hàng thành công');location.href='account.php';</script>";
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
                            <a class="nav-link" href="productList.php">
                                <i class="fas fa-shopping-cart"></i>
                                Sản phẩm
                            </a>
                        </li><li class="nav-item">
                            <a class="nav-link active" href="account.php">
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

<div class="container tm-mt-big tm-mb-big">
      <div class="row">
        <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12 mx-auto">
          <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
            <div class="row">
              <div class="col-12">
                <h2 class="tm-block-title d-inline-block">Chỉnh sửa thông tin khách hàng</h2>
              </div>
            </div>
            <div class="row tm-edit-product-row">
              <div class="col-12">
                <form action="" method="POST" class="tm-edit-product-form" enctype="multipart/form-data">
                  <div class="form-group mb-3" hidden>
                    <label>ID</label>
                    <input
                      name="id"
                      type="text"
                      value="<?php echo $result->id ?>"
                      class="form-control validate"
                    required>
                  </div>
                  <div class="form-group mb-3">
                    <label>Họ và tên</label>
                    <input
                      name="customer_name"
                      type="text"
                      value="<?php echo $result->full_name ?>"
                      class="form-control validate"
                    required>
                  </div>
                  <div class="form-group mb-3">
                    <label>Số điện thoại</label>
                    <input
                      type="number" 
                      value="<?php echo $result->phone_number ?>" 
                      name="customer_phone"
                      class="form-control validate"
                    required>
                  </div>
                  <div class="form-group mb-3">
                    <label>Ngày sinh</label>
                    <input
                      type="date" 
                      name="customer_bday" 
                      value="<?php echo $result->dob ?>" 
                      min="2000-01-02" 
                      class="form-control validate"
                    required>
                  </div>
                  <div class="form-group mb-3">
                    <label>Địa chỉ</label>
                    <input
                      type="text" 
                      value="<?php echo $result->address ?>" 
                      name="customer_address" 
                      class="form-control validate"
                    required>
                  </div>
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block text-uppercase">Cập nhật</button>
                <button type="button" class="btn btn-primary btn-block text-uppercase" onclick="window.location.href='account.php'">Hủy</button>
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php require_once __DIR__. "/../layout/footer.php";?>