<?php require_once('include/header.php');
if (!isset($_SESSION['email'])) {
  header('location: signin.php');
}

$sql1 = ("SELECT count(cust_id) as total from customer");
$result = mysqli_query($con, $sql1);
$data = mysqli_fetch_assoc($result);
//echo $data['total'];

?>
<div class="container-fluid mt-2">
  <div class="row">
    <div class="col-md-3 col-lg-3">
      <?php require_once('include/sidebar.php'); ?>
    </div>

    <?php
    if (!isset($_SESSION['email'])) {
      header('location: signin.php');
    }
    ?>

    <div class="col-md-9 col-lg-9">
      <div class="row">
        <div class="col-md-1">
          <i class="fad fa-users fa-6x text-primary"></i>
        </div>
        <div class="col-md-11 text-left mt-4">
          <h1 class="ml-5 display-4 font-weight-normal">Quản lý thông tin khách hàng</h1>
        </div>
      </div>

      <div class="row">


        <div class="col-md-6">
          <td>
            <?php echo "Tổng thành viên: ";
            echo $data['total'];
            echo " thành viên" ?>
          </td>
        </div>
        <div class="col-md-6">
          <form method="post">
            <div class="input-group">
              <input type="text" class="form-control" name="search" placeholder="Tìm khách hàng">
              <div class="input-group-append">
                <input class="btn btn-primary rounded-left" type="submit" name="sear_cust" value="Tìm kiếm">
              </div>
            </div>
          </form>
        </div>
      </div>
      <hr>
      <table class="table table-responsive table-hover ">
        <thead class="thead-dark">
          <tr>
            <th>#Id</th>
            <th>Tên khách hàng</th>
            <th>Email</th>
            <th>Mật khẩu</th>
            <th>Địa chỉ</th>
            <th>Thành phố</th>
            <th>Mã bưu điện</th>
            <th>Số điện thoại</th>
          </tr>
        </thead>
        <tbody>
          <?php

          if (isset($_POST['sear_cust'])) {
            $search = $_POST['search'];


            $query1 = "SELECT * FROM customer Where cust_id Like '%$search%' or	cust_name Like '%$search%' or 	cust_email Like '%$search%' ";

            if (isset($_GET['page'])) {
              $page_id = $_GET['page'];
            } else {
              $page_id = 1;
            }

            $required_pro = 5;
            $run   = mysqli_query($con, $query1);
            $count_rows = mysqli_num_rows($run);

            $pages = ceil($count_rows / $required_pro);
            $oder_start = ($page_id - 1) * $required_pro;
            $query = "SELECT * FROM customer Where cust_id Like '%$search%' or	cust_name Like '%$search%' or 	cust_email Like '%$search%' ORDER BY cust_id DESC LIMIT $oder_start,$required_pro ";
          } else {

            $query1 = "SELECT * FROM customer";
            if (isset($_GET['page'])) {
              $page_id = $_GET['page'];
            } else {
              $page_id = 1;
            }

            $required_pro = 5;

            $run   = mysqli_query($con, $query1);
            $count_rows = mysqli_num_rows($run);

            $pages = ceil($count_rows / $required_pro);
            $oder_start = ($page_id - 1) * $required_pro;
            $query = "SELECT * FROM customer ORDER BY cust_id DESC LIMIT $oder_start,$required_pro";
          }

          $run   = mysqli_query($con, $query);

          if (mysqli_num_rows($run) > 0) {
            while ($row = mysqli_fetch_array($run)) {
              $cust_id         = $row['cust_id'];
              $cust_name       = $row['cust_name'];
              $cust_email      = $row['cust_email'];
              $cust_pass       = $row['cust_pass'];
              $cust_add        = $row['cust_add'];
              $cust_city       = $row['cust_city'];
              $cust_postalcode = $row['cust_postalcode'];
              $cust_number     = $row['cust_number'];

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

                <td><input type="password" value="<?php echo $cust_pass; ?>" disabled></td>

                <td><?php echo $cust_add; ?> </td>
                <td>
                  <?php echo $cust_city ?>
                </td>
                <td><?php echo $cust_postalcode; ?></td>

                <td> <?php echo $cust_number; ?></td>
              </tr>
          <?php
            }
          } else {
            echo "<h2 class='text-center text-secondary'>Chưa có thành viên nào</h2>";
          }
          ?>

        </tbody>
      </table>
      <ul class="pagination pagination-md mt-5">
        <?php
        echo "Trang:";

        for ($i = 1; $i <= $pages; $i++) {
          echo "<li class='page-item " . ($i == $page_id ? ' active ' : '') . "'><a class='page-link' href='Customers.php?page=$i'>$i</a></li>";
        } ?>
      </ul>

    </div>
  </div>
</div>
<?php
require_once('include/footer.php');
?>