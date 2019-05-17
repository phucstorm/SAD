<?php
  session_start();
  if($_SESSION['token'] == "" && $_SESSION['type'] != 1){
    echo "<script>alert('Đăng nhập lại');location.href='../'</script>";
  }else{
    $_GET['token'] = $_SESSION['token'];
    $_GET['read'] = "customer";
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
                            <a class="nav-link" href="product.php">
                                <i class="fas fa-shopping-cart"></i>
                                Sản phẩm
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="far fa-user"></i>
                                <span>
                                    Tài khoản <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="employ.php">Nhân viên</a>
                                <a class="dropdown-item active" href="">Khách hàng</a>
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
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="text-white mt-5 mb-5">Have a nice day  <b><?php echo json_decode($_SESSION['name']) ?></b></p>
                </div>
            </div>
            <div class="row tm-content-row">
    <div class="col-12 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                        <h2 class="tm-block-title">Danh sách khách hàng</h2>
                        <table class="table">
                            <thead align="center">
                                <tr>
                                    <th scope="col">Tên KH</th>
                                    <th scope="col">SĐT</th>
                                    <th scope="col">Năm Sinh</th>
                                    <th scope="col">Địa Chỉ</th>
                                    <th scope="col">Điểm</th>
                                </tr>
                            </thead>
                            <tbody align="center">
                              <?php  foreach($result as $data => $value):?>
                                <tr>
                                    <th scope="row"><b><?php echo $value->full_name?></b></th>    
                                    <td><b><?php echo $value->phone_number?></b></td>
                                    <td><b><?php echo $value->dob?></b></td>
                                    <td><b><?php echo $value->address?></b></td>
                                    <td><?php echo $value->point?></td>
                                </tr>
                              <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
              </div>
                </div>
     
    <?php require_once __DIR__. "/../layout/footer.php";?> 