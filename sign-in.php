<?php session_start();
include('customer/include/dbcon.php');
?>

<meta charset="UTF-8">
<title>Hien Furniture</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" type="image/png" href="img/favicon.ico" />
<!-- <link href="css/style.css" rel="stylesheet" type="text/css"> -->
<link href="css/signin.css" rel="stylesheet" type="text/css">
<!-- <link rel="stylesheet" href="/img/favicon.jpg"> -->
<!-- <link href="css/all.min.css" rel="stylesheet"> -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<body>
  <div class="center">
    <form method="post">
      <?php if (isset($_POST['signin'])) {

        $email     = mysqli_real_escape_string($con, $_POST['email']);
        $password  = mysqli_real_escape_string($con, $_POST['password']);

        $query = "SELECT * FROM customer";
        $run   = mysqli_query($con, $query);

        if (mysqli_num_rows($run) > 0) {
          while ($row = mysqli_fetch_array($run)) {

            $db_cust_id    = $row['cust_id'];
            $db_cust_name  = $row['cust_name'];
            $db_cust_email = $row['cust_email'];
            $db_cust_pass  = $row['cust_pass'];
            $db_cust_add   = $row['cust_add'];
            $db_cust_pcode = $row['cust_postalcode'];
            $db_cust_city  = $row['cust_city'];
            $db_cust_number = $row['cust_number'];

            if ($email == $db_cust_email && $password == $db_cust_pass) {

              $_SESSION['id']    = $db_cust_id;
              $_SESSION['name']  = $db_cust_name;
              $_SESSION['email'] = $db_cust_email;
              $_SESSION['add']   = $db_cust_add;
              $_SESSION['pcode'] = $db_cust_pcode;
              $_SESSION['city']  = $db_cust_city;
              $_SESSION['number'] = $db_cust_number;
              header('location:index.php');
            } else {
              $error = "Tài khoản hoặc mật khẩu sai";
            }
          }
        } else {
          $error = "Tài khoản không tồn tại";
        }
      }
      ?>

      <?php
      if (isset($error)) {

        echo "<div class='alert bg-danger' role='alert'>
                                  <span class='text-white text-center'> $error</span>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                      <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div>";
      }

      ob_end_flush(); ?>

      <h1 class="text-center">HiFur Xin Chào!</h1>
      <div class="txt_field">
        <input type="text" name="email" class="form-control" required>
        <label>Tên tài khoản (Email)</label>
      </div>
      <div class="txt_field">
        <input type="password" name="password" class="form-control" required>
        <label>Mật khẩu</label>
      </div>
      <div class="pass" href="#">Quên mật khẩu?</div>
      <input type="submit" name="signin" class="btn btn-primary" value="Đăng nhập">
      <div class="signup_link">
        Chưa là thành viên? <a href="register.php"> Đăng ký ngay</a>
      </div>
    </form>
  </div>
</body>