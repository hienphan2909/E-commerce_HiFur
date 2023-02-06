<?php include("include/header.php");
if (!isset($_SESSION['email'])) {
  header('location: signin.php');
}

?>

<div class="container-fluid mt-2">
  <div class="row">
    <div class="col-md-3">
      <?php include("include/sidebar.php"); ?>
    </div>

    <div class="col-md-9">
      <div class="row">
        <div class="col-md-1">
          <i class="fad fa-box-alt fa-6x text-warning"></i>
        </div>
        <div class="col-md-11 text-left mt-4 ">
          <h1 class="ml-3 display-4 font-weight-normal">Đơn hàng chờ xác nhận</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <td>
            <?php
            $sql1 = ("SELECT count(order_id) as total from customer_order where order_status ='Chờ xác nhận'");
            $result = mysqli_query($con, $sql1);
            $data = mysqli_fetch_assoc($result);
            echo "Tổng đơn chờ xác nhận: ";
            echo $data['total'];
            echo " đơn hàng" ?>
          </td>
        </div>
        <div class="col-md-6">
          <form method="post">
            <div class="input-group">
              <input type="text" class="form-control" name="search" placeholder="Tìm đơn hàng">
              <div class="input-group-append">
                <input class="btn btn-primary rounded-left" type="submit" name="sear_pending_furiture_pro" value="Tìm kiếm">
              </div>
            </div>
          </form>
        </div>
      </div>

      <hr>
      <form method="post">
        <table class="table table-responsive table-hover ">
          <thead class="thead-dark">
            <tr>
              <th>#Mã đơn hàng</th>
              <th>Id đặt</th>
              <th>Mã sản phẩm</th>
              <th>Ảnh sản phẩm</th>
              <th>Danh mục </th>
              <th>Id khách hàng</th>
              <th>Email khách hàng</th>
              <th>Giá (VND))</th>
              <th>Số lượng</th>
              <th>Trạng thái</th>
              <th>Ngày đăng ký</th>

              <th>Cập nhật trạng thái</th>

            </tr>
          </thead>
          <tbody class="text-center">
            <?php

            if (isset($_POST['sear_pending_furiture_pro'])) {
              $search = $_POST['search'];


              $order_query = "SELECT * FROM customer_order WHERE order_status='Chờ xác nhận' and (order_id Like '%$search%' or invoice_no Like '%$search%') ";

              if (isset($_GET['page'])) {
                $page_id = $_GET['page'];
              } else {
                $page_id = 1;
              }

              $required_pro = 5;
              $run   = mysqli_query($con, $order_query);
              $count_rows = mysqli_num_rows($run);

              $pages = ceil($count_rows / $required_pro);
              $oder_start = ($page_id - 1) * $required_pro;
            } else {

              $order_query1 = "SELECT * FROM customer_order WHERE order_status='Chờ xác nhận' ";
              if (isset($_GET['page'])) {
                $page_id = $_GET['page'];
              } else {
                $page_id = 1;
              }

              $required_pro = 5;

              $run   = mysqli_query($con, $order_query1);
              $count_rows = mysqli_num_rows($run);

              $pages = ceil($count_rows / $required_pro);
              $oder_start = ($page_id - 1) * $required_pro;
              $order_query = "SELECT * FROM customer_order WHERE order_status='Chờ xác nhận'  ORDER BY order_id DESC LIMIT $oder_start,$required_pro";
            }
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
                        <?php echo number_format($order_amount); ?>
                      </td>

                      <td><?php echo $order_qty; ?></td>

                      <td>

                        <?php
                        if ($order_status == 'Chờ xác nhận') {
                          echo "<i class='fas fa-exclamation-circle text-warning'></i> $order_status";
                        }
                        ?>

                      </td>
                      <td><?php echo $order_date; ?></td>
                      <td><a href="edit_furn_verify_pen.php?order_id=<?php echo $order_id; ?>"><button type="button" class="btn btn-primary btn-sm"> Cập nhật</button></a></td>
                    </tr>
            <?php
                  }
                }
              }
            } else {
              echo "<tr><td colspan='12'><h2 class='text-center text-secondary'>Không tìm thấy đơn hàng chờ xác nhận</h2></td></tr>";
            }

            ?>


          </tbody>
        </table>

        <div class="text-right">

        </div>

      </form>

      <ul class="pagination pagination-md mt-5">
        <?php echo "Trang:";
        echo "     ";
        for ($i = 1; $i <= $pages; $i++) {
          echo "<li class='page-item " . ($i == $page_id ? ' active ' : '') . "'><a class='page-link' href='pending_furniture_pro.php?page=$i'>$i</a></li>";
        } ?>
      </ul>

    </div>



  </div>
</div>
<?php include("include/footer.php"); ?>