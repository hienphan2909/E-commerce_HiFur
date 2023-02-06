<?php
session_start();
include_once('include/dbcon.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Hien Furniture</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/png" href="../img/favicon.ico" />
  <link href="css/style.css" rel="stylesheet" type="text/css">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/bootstrap.css.map" rel="stylesheet">
  <link rel="stylesheet" href="/img/favicon.jpg">
  <link href="css/all.min.css" rel="stylesheet">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>

  <header>

    <?php
    if (isset($_SESSION['email'])) {
      $cust_id =  $_SESSION['id'];
      $query = "SELECT * FROM cart Where cust_id=$cust_id";
      $run   = mysqli_query($con, $query);

      $count = mysqli_num_rows($run);
    } else {
      $count = 0;
    }
    ?>
    <!--header --->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a href="" class="navbar-brand">
        <img src="../img/logo.png" width="50px" height="50px">
        <span class="font-weight-bold" href="/" data-animation-role="header-element"> HIEN</span>
        <span class="font-weight-light"> Furniture</span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapisblenav" aria-controls="collapsiblenav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapisblenav">
        <ul class="navbar-nav ml-auto">

          <li class="nav-item">
            <h2 class="nav-link" href="../index.php"></h2>
          </li>
          <li class="nav-item"><a class="nav-link" href="../index.php"></a></li>
          <li class="nav-item"><a class="nav-link" href="../index.php"></a></li>
          <li class="nav-item"><a class="nav-link" href="../index.php">
              <h5>Trang chủ</h5>
            </a></li>
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="../product.php" role="button" id="dropdownMenuLink" aria-haspopup="true" aria-expanded="false">
              <h5 class=" dropdown-toggle">Sản phẩm</h5>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a href='../product.php' class='list-group-item'></i> Tất cả </a>
              <?php
              $cat_query = "SELECT * FROM categories ORDER BY id ASC";
              $cat_run   = mysqli_query($con, $cat_query);
              if (mysqli_num_rows($cat_run) > 0) {
                while ($cat_row = mysqli_fetch_array($cat_run)) {
                  $cid      = $cat_row['id'];
                  $cat_name = ucfirst($cat_row['category']);
                  echo " <a href='product.php?cat_id=$cid' class='list-group-item'></i> $cat_name </a>";
                }
              } else {
                echo " <a class='list-group-item'> Không có sản phẩm </a>";
              }

              ?>
            </div>
          </li>
          <li class="nav-item"><a class="nav-link" href="../about-us.php">
              <h5>Giới thiệu</h5>
            </a></li>
          <li class="nav-item"><a class="nav-link" href="../contact-us.php">
              <h5>Liên hệ</h5>
            </a></li>
          <li class="nav-item"><a class="nav-link" href="../index.php"></a></li>
          <li class="nav-item"><a class="nav-link" href="../index.php"></a></li>
          <li class="nav-item"><a class="nav-link" href="../index.php"></a></li>
          <form method="post">
            <div class="input-group">
              <input type="text" class="form-control mr-sm-2" name="search" placeholder="Tìm sản phẩm">
              <div class="input-group-append">
                <input class="btn btn-outline-primary my-2 my-sm-0" type="submit" name="sear_submit" value="Tìm kiếm">

              </div>
            </div>
          </form>



          <?php if (!isset($_SESSION['email'])) {


          ?>
            <li class="nav-item">
              <h2 class="nav-link" href="index.php"></h2>
            </li>
            <li class="nav-item">
              <h2 class="nav-link" href="index.php"></h2>
            </li>
            <li class="nav-item">
              <h2 class="nav-link" href="index.php"></h2>
            </li>
            <li class="nav-item"><a class="nav-link" href="sign-in.php"><button type="button" class="btn btn-primary wave-effect btn-sm pl-3 pr-3 "> Đăng nhập</button></a></li>
            <!-- <li class="nav-item mr-5"><a class="nav-link" href="register.php"><button type="button" class="btn btn-primary wave-effect btn-sm pl-3 pr-3 "> Đăng ký thành viên</button></a></li> -->
            <li class="nav-item">
              <h2 class="nav-link" href="index.php"></h2>
            </li>
          <?php
          }

          if (isset($_SESSION['email'])) {


          ?>
            <li class="nav-item ml-5"><a class="nav-link" href="index.php"><i class="far fa-user top-icon"></i> Tài khoản</a></li>
          <?php }
          ?>
          <li class="nav-item"><a class="nav-link" href="/HIFUR-shop/cart.php"><i class="fal fa-shopping-cart top-icon"></i><span class="badge badge-primary" style="position:absolute; margin-left:-7px;"><?php echo $count; ?></span></a></li>
        </ul>
      </div>
      </div>

      </div>



    </nav>

  </header>