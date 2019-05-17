<?php
session_start();
  if($_SESSION['token'] == "" && $_SESSION['type'] != 1){
    echo "<script>alert('Đăng nhập lại');location.href='../'</script>";
  }else{
    $_GET['token'] = $_SESSION['token'];
    $_GET['read'] = "product";
    $url = "http://localhost/api/v1/center/center.php?token=".isset($_GET['token'])."&read=".$_GET['read']."";
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
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="">
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
                                <a class="dropdown-item" href="customer.php">Khách hàng</a>
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
    <div class="container mt-5">
      <div class="row tm-content-row">
        <div class="col-12 tm-block-col">
          <div class="tm-bg-primary-dark tm-block tm-block-products">
            <div class="tm-product-table-container">
              <h2 class="tm-block-title">Danh sách sản phẩm</h2>
              <table class="table table-hover tm-table-small tm-product-table">
                <thead>
                  <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Mã sản phẩm</th>
                    <th scope="col">Giá</th>
                    <th>&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $stt = 1;foreach ($result as $key => $item):?>
                  <tr>
                    <td scope="row"><?php echo $stt?></td>
                    <td class="tm-product-name"><?php echo $item->product_name ?></td>
                    <td><?php echo $item->product_code ?></td>
                    <td><?php echo $item->price?></td>
                    <td>
                      <a href="edit.php?id=<?php echo $item->id?>" class="tm-product-edit-link">
                        <i class="fas fa-pencil-alt tm-product-edit-icon"></i>
                      </a>
                      <a href="delete.php?id=<?php echo $item->id?>" class="tm-product-delete-link">
                        <i class="far fa-trash-alt tm-product-delete-icon"></i>
                      </a>
                    </td>
                  </tr>
                  <?php  $stt++;endforeach?>
                </tbody>
              </table>

            </div>
            <!-- table container -->
            <a
              href="add.php"
              class="btn btn-primary btn-block text-uppercase mb-3">Thêm sản phẩm mới</a>
              <a
              href="sync.php"
              class="btn btn-primary btn-block text-uppercase mb-3">Đồng bộ sản phẩm</a>
          </div>
        </div>
      </div>
    </div>
     
    <?php require_once __DIR__. "/../layout/footer.php";?>