<?php
// session_start();
include_once('include/dbcon.php'); ?>

<meta charset="UTF-8">
<title>Hien Furniture</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/signin.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap.css.map" rel="stylesheet">
<link rel="shortcut icon" type="image/png" href="img/favicon.ico" />
<!-- <link rel="stylesheet" href="img/favicon.ico"> -->
<link href="css/all.min.css" rel="stylesheet">

<div class="container sign-in-up">
  <div class="row">
    <div class="col-md-6 info">
      <h1>Cửa hàng trang trí nội thất Hien Furniture</h1>
      <p>
        Đăng ký thành viên cùng HiFur để có những trải nghiệm mua sắm tốt nhất.</p>
    </div>

    <div class="col-md-6">
      <div class="card">
        <div class="card-body">

          <form method="post" class="mt-3">

            <?php
            if (isset($_POST['register'])) {

              $fullname = $_POST['fullname'];
              $email = $_POST['email'];
              $password = $_POST['password'];
              $conf_pass = $_POST['confirm-password'];
              $address = $_POST['address'];
              $city = $_POST['city'];
              $postal_code = $_POST['code'];
              $number = $_POST['phone_number'];

              if (!empty($fullname) or !empty($email) or !empty($password) or !empty($conf_pass) or !empty($address) or !empty($city) or !empty($postal_code)  or !empty($number)) {

                if ($password === $conf_pass) {

                  $cust_query = "INSERT INTO customer(`cust_name`,`cust_email`,`cust_pass`,`cust_add`,`cust_city`,`cust_postalcode`,`cust_number`) VALUES('$fullname','$email','$password','$address','$city','$postal_code','$number')";


                  if (mysqli_query($con, $cust_query)) {
                    $message = "Bạn tạo tài khoản thành công!";
                  }
                } else {
                  $error = "Mật khẩu không khớp";
                }
              } else {
                $error = "Vui lòng điền đủ thông tin";
              }
            }

            ?>
            <?php
            if (isset($error)) {

              echo "<div class='alert bg-danger' role='alert'>
                                <span class='text-white text-center'> $error</span>
                              </div>";
            } else if (isset($message)) {

              echo "<div class='alert bg-success' role='alert'>
                                <span class='text-white text-center'> $message</span>
                              </div>";
            }

            ?>
            <h1 class="text-center">Đăng ký thành viên</h1>
            <div class="form-group">
              <input type="text" name="fullname" placeholder="Họ tên" class="form-control">
            </div>

            <div class="form-group">
              <input type="text" name="email" placeholder="Email" class="form-control">
            </div>

            <div class="row">
              <div class="col-md-6 col-sm-6 col-12">
                <div class="form-group">
                  <input type="password" name="password" placeholder="Mật khẩu" class="form-control">
                </div>
              </div>
              <div class="col-sm-6 col-12 col-md-6 ">
                <div class="form-group">
                  <input type="password" name="confirm-password" placeholder="Nhập lại mật khẩu" class="form-control">
                </div>
              </div>
            </div>


            <div class="form-group">
              <input type="text" name="address" placeholder="Địa chỉ" class="form-control">
            </div>

            <div class="row">
              <div class="col-md-6 col-6">
                <div class="form-group">
                  <input type="text" name="city" placeholder="Thành phố" class="form-control">
                </div>
              </div>

              <div class="col-md-6 col-6">
                <div class="form-group">
                  <input type="text" name="code" placeholder="Mã bưu điện" class="form-control">
                </div>
              </div>

            </div>

            <div class="form-group">
              <input type="tel" name="phone_number" placeholder="Số điện thoại" class="form-control">
            </div>

            <div class="form-group text-center mt-4">
              <input type="submit" name="register" class="btn btn-primary" value="Đăng ký">
            </div>

            <div class="text-center mt-4"> Bạn đã có tài khoản? <a href="sign-in.php"> Đăng nhập </a></div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>