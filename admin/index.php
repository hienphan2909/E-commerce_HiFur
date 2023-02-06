<?php

include('include/header.php');
if (!isset($_SESSION['email'])) {
  header('location:signin.php');
}
if (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];
}

?>

<div class="container-fluid mt-3">

  <div class="row">

    <!---sidenavbar Column-->
    <div class="col-md-3 col-lg-3">
      <?php require_once('include/sidebar.php'); ?>
    </div>
    <!---Main Column -->
    <div class="col-md-9 col-lg-9">
      <!-- Icon Cards-->
      <div class="jumbotron" style="background: linear-gradient(120deg, #2980b9, #8e44ad);">
        <h1 class="text-center text-white">QUẢN LÝ HIEN FURNITURE</h1>
      </div>


      <!-- <div class="col-md-11 text-left mt-4">
        <h5 class="ml-5 display-4 font-weight-normal">QUẢN LÝ CHUNG</h5>
      </div> -->

      <hr>
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-info o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fad fa-shopping-cart fa-2x"></i>
              </div>
              <?php
              $query = "SELECT * FROM customer_order WHERE order_status='Chờ xác nhận'";
              $run   = mysqli_query($con, $query);
              $num_new_orders = mysqli_num_rows($run);
              ?>
              <div class="mr-3"> <span style="font-size:24px;"><?php echo $num_new_orders; ?></span> Đơn chờ xác nhận</div>

            </div>
            <a class="card-footer text-white clearfix small z-1" href="pending_furniture_pro.php">
              <span class="float-left">Xem chi tiết</span>
              <span class="float-right">
                <i class="fas fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-info o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fad fa-truck fa-2x"></i>
              </div>
              <div class="mr-3">
                <?php
                $query = "SELECT * FROM customer_order WHERE order_status='Đã giao hàng'";
                $run   = mysqli_query($con, $query);
                $num_delivered_orders = mysqli_num_rows($run);
                ?>
                <span style="font-size:24px;"><?php echo $num_delivered_orders; ?> </span> Đơn hàng đã giao
              </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="delivered_furniture_pro.php">
              <span class="float-left">Xem chi tiết</span>
              <span class="float-right">
                <i class="fas fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-info o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fad fa-fw fa-users fa-2x"></i>
              </div>
              <div class="mr-3">
                <?php
                $query = "SELECT * FROM customer";
                $run   = mysqli_query($con, $query);
                $num_customer = mysqli_num_rows($run);
                ?>
                <span style="font-size:24px;"><?php echo $num_customer; ?></span> Thông tin khách hàng
              </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="customers.php">
              <span class="float-left">Xem chi tiết</span>
              <span class="float-right">
                <i class="fas fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-info o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fad fa-sack fa-2x"></i>
              </div>
              <div class="mr-3">
                <?php
                $query = "SELECT SUm(product_amount) as 'earn' FROM customer_order";
                $run   = mysqli_query($con, $query);
                $row = mysqli_fetch_array($run);
                $earning = $row['earn'];

                ?>
                <span style="font-size:24px;">Doanh thu: <?php echo number_format($earning); ?></span> VND
              </div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
              <span class="float-left">Xem chi tiết</span>
              <span class="float-right">
                <i class="fas fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
      </div>

      <h3 class="mt-5"><i class="fas fa-file-invoice"></i> Đơn hàng mới</h3>
      <table class="table table-responsive table-hover ">
        <thead class="thead-dark">
          <tr>
            <th>#Mã đơn</th>
            <th>Id đặt</th>
            <th>Mã sản phẩm</th>
            <th>Ảnh sản phẩm</th>
            <th>Danh mục </th>
            <th>Id khách hàng</th>
            <th>Email khách hàng</th>
            <th>Giá (VND)</th>
            <th>Số lượng</th>
            <th>Ngày đăng ký</th>
            <th class="text-center">Tình trạng</th>
          </tr>
        </thead>
        <tbody class="text-center">
          <?php

          $order_query = "SELECT * FROM customer_order WHERE order_status='Chờ xác nhận' ORDER BY order_id LIMIT 5";
          $run = mysqli_query($con, $order_query);

          if (mysqli_num_rows($run) > 0) {
            while ($order_row = mysqli_fetch_array($run)) {
              $order_invoice = $order_row['invoice_no'];
              $order_id      = $order_row['order_id'];
              $cust_id       = $order_row['customer_id'];
              $cust_email    = $order_row['customer_email'];
              $order_pro_id  = $order_row['product_id'];
              $order_qty     = $order_row['products_qty'];
              $order_amount  = $order_row['product_amount'];
              $order_date    = $order_row['order_date'];
              $order_status  = $order_row['order_status'];

              $pr_query = "SELECT * FROM furniture_product fp INNER JOIN categories cat ON fp.category = cat.id WHERE pid = $order_pro_id ";
              $pr_run   = mysqli_query($con, $pr_query);

              if (mysqli_num_rows($pr_run) > 0) {
                while ($pr_row = mysqli_fetch_array($pr_run)) {
                  $pid   = $pr_row['pid'];
                  $image = $pr_row['image'];
                  $category = $pr_row['category'];

          ?>
                  <tr>
                    <td>
                      <?php echo $order_invoice; ?>
                    </td>
                    <td>
                      <?php echo $order_id; ?>
                    </td>
                    <td>
                      <?php echo $order_pro_id; ?>
                    </td>
                    <td width="120px">
                      <img src="img/<?php echo $image; ?>" width="100%">
                    </td>
                    <td>
                      <?php echo $category; ?>
                    </td>
                    <td>
                      <?php echo $cust_id; ?>
                    </td>
                    <td>
                      <?php echo $cust_email; ?>
                    </td>
                    <td>
                      <?php echo $order_amount; ?>
                    </td>

                    <td><?php echo $order_qty; ?></td>

                    <td><?php echo $order_date; ?></td>
                    <td><a href="pending_furniture_pro.php"><button class="btn btn-primary btn-sm">Xem chi tiết</button></td>
                  </tr>
          <?php
                }
              }
            }
          } else {
            echo "<tr><td colspan='12'><h2 class='text-center text-secondary'>Bạn chưa có đơn chờ xác nhận</h2></td></tr>";
          }



          ?>


        </tbody>
      </table>

      <h3 class="mt-5"><i class="fas fa-users"></i> Tài khoản khách hàng</h3>
      <table class="table table-responsive table-hover mt-3">
        <thead class="thead-dark">
          <tr>
            <th>#Id</th>
            <th class="text-center">Họ Tên</th>
            <th>Email</th>
            <th>Thành phố</th>
            <th>Mã bưu điện</th>
            <th class="text-center">Chi tiết</th>

          </tr>
        </thead>
        <tbody>
          <?php
          $query = "SELECT * FROM customer ORDER BY cust_id DESC LIMIT 5";
          $run   = mysqli_query($con, $query);

          if (mysqli_num_rows($run) > 0) {
            while ($row = mysqli_fetch_array($run)) {
              $cust_id         = $row['cust_id'];
              $cust_name       = $row['cust_name'];
              $cust_email      = $row['cust_email'];
              $cust_city       = $row['cust_city'];
              $cust_postalcode = $row['cust_postalcode'];

          ?>
              <tr>
                <td>
                  <?php echo $cust_id; ?>
                </td>

                <td width="150px">
                  <?php echo $cust_name; ?>
                </td>

                <td>
                  <?php echo $cust_email; ?>
                </td>

                <td>
                  <?php echo $cust_city ?>
                </td>
                <td><?php echo $cust_postalcode; ?></td>
                <td><a href="customers.php"><button class="btn btn-primary btn-sm">Chi tiết</button></td>

              </tr>
          <?php
            }
          } else {
            echo "<tr><td colspan='12'><h2 class='text-center text-secondary'>Chưa có khách hàng thành viên</h2></td></tr>";
          }
          ?>

        </tbody>
      </table>

    </div>
  </div>
</div>






<!-- /.container-fluid -->
<?php include('include/footer.php'); ?>