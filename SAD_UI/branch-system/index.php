<?php
session_start();
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $url = "http://localhost/api/v1/center/center.php?username=".$user."&password=".$pass;
        $client = curl_init($url);
        curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
        $response = curl_exec($client);
        $result = json_decode($response);
        echo $response;
        $_SESSION['token'] = $result->jwt;
        $_SESSION['secret_data'] = json_encode($result->secret_data);
        $_SESSION['name'] = json_encode($result->secret_data->emp_name);
        $_SESSION['type'] = json_encode($result->secret_data->emp_type);
        $_SESSION['id'] = json_encode($result->secret_data->id);

        if($_SESSION['type'] == 2){
            echo "<script>alert('Đăng nhập thành công');location.href='modules/' </script>";
        }else{
            echo "<script>alert('Đăng nhập thất bại');</script>";
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>BRANCH - SYSTEM</title>
    <link rel="icon" href="front-end/img/vlu_logo.ico" type="img">
    <link rel="stylesheet" type="text/css" href="front-end/css/main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
</head>
<body>
    <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="front-end/img/VLU-Logo.png" class="brand_logo" alt="Logo">
                    </div>
                </div>
                <div class="d-flex justify-content-center form_container">
                    <form method="POST" action="">
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="username" name="username" class="form-control input_user" placeholder="username" required>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="password" class="form-control input_pass" placeholder="password" required>
                        </div>
                        <div class="d-flex justify-content-center mt-3 login_container">
                            <button type="submit" name="button" class="btn login_btn">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>