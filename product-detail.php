<?php ob_start();
include('include/header.php'); ?>

<div class="jumbotron" style="background: linear-gradient(120deg, #2980b9, #8e44ad);">
  <h2 class="text-center text-white">Chi tiết sản phẩm</h2>
</div>

<main>

  <div class="container">

    <!--Section: Block Content-->
    <section class="my-5">
      <div class="row">

        <?php
        if (isset($_GET['product_id'])) {
          $p_id = $_GET['product_id'];

          $pdetail_query = "SELECT * FROM furniture_product WHERE pid=$p_id";
          $pdetail_run   = mysqli_query($con, $pdetail_query);

          if (mysqli_num_rows($pdetail_run) > 0) {
            $pdetail_row = mysqli_fetch_array($pdetail_run);
            $pid = $pdetail_row['pid'];
            $title = $pdetail_row['title'];
            $category = $pdetail_row['category'];
            $detail = $pdetail_row['detail'];
            $price = $pdetail_row['price'];
            $size = $pdetail_row['size'];
            $img1 = $pdetail_row['image'];
          }
        }
        ?>


        <div class="col-md-5 mb-4 mb-md-0">
          <div class="view zoom z-depth-2 rounded">
            <img class="img-fluid w-100" src="img/<?php echo $img1; ?>" alt="Chair">

          </div>
        </div>




        <div class="col-md-7">

          <h3><?php echo $title; ?></h3>
          <p class="mb-2 text-muted text-uppercase small">
            <?php
            $cat_query = "SELECT * FROM categories Where id=$category ORDER BY id ASC";
            $cat_run   = mysqli_query($con, $cat_query);
            if (mysqli_num_rows($cat_run) > 0) {
              $cat_row = mysqli_fetch_array($cat_run);
              echo  "Loại sản phẩm: ";
              echo  $cat_name = ucfirst($cat_row['category']);
            }
            ?>
          </p>
          <p><span class="mr-1"><strong>Giá: <?php echo number_format($price); ?></strong></span></p>
          <p class="pt-1"><?php echo $detail; ?></p>
          <div class="table-responsive">
            <table class="table table-borderless mb-0">
              <tbody>
                <tr>
                  <th class="pl-0 w-25" scope="row"><strong>Kích thước:</strong></th>
                  <td><?php echo $size; ?></td>
                </tr>

              </tbody>
            </table>
          </div>
          <hr>
          <form method="post">
            <?php

            if (isset($_SESSION['email'])) {
              $custid = $_SESSION['id'];
              if (isset($_POST['submit'])) {
                $qty = $_POST['qty'];

                $sel_cart = "SELECT * FROM cart WHERE cust_id = $custid and product_id = $p_id ";
                $run_cart    = mysqli_query($con, $sel_cart);

                if (mysqli_num_rows($run_cart) == 0) {
                  $cart_query = "INSERT INTO `cart`(`cust_id`, `product_id`,quantity) VALUES ($custid,$p_id,$qty)";
                  if (mysqli_query($con, $cart_query)) {
                    header("location:product-detail.php?product_id=$p_id");
                    echo "<script>alert('Bạn đã thêm vào giỏ hàng '); </script>";
                  }
                }

                if (mysqli_num_rows($run_cart) > 0) {
                  while ($row = mysqli_fetch_array($run_cart)) {
                    $exist_pro_id = $row['product_id'];
                    if ($p_id == $exist_pro_id) {
                      echo "<script>alert('⚠️ Sản phẩm đã có trong giỏ hàng '); </script>";
                    }
                  }
                }
              }
            } else if (!isset($_SESSION['email'])) {
              echo "<script> function a(){
                        alert('⚠️ Bạn cần đăng nhập trước khi thêm vào giỏ hàng');
                          }</script>";
            }

            ?>
            <div class="form-group">
              <label>Số lượng:</label>
              <input type="number" name="qty" placeholder="Quantity" value="1" class="form-control w-25">
            </div>

            <button type="submit" onclick="a()" name="submit" class="btn btn-light btn-md mt-3 mr-1 mb-2 hover-effect"><i class="fas fa-shopping-cart pr-2"></i>Thêm vào giỏ hàng</button>

          </form>
        </div>

      </div>

    </section>


    <!--Section: New products-->
    <section>

      <h3 class="text-center pt-5 mb-0">Sản phẩm liên quan </h3>

      <!-- Grid row -->
      <div class="row mt-5 mb-4">

        <!-- Grid column -->
        <?php
        $p_query = "SELECT * FROM furniture_product WHERE category LIKE '%$category%' order by title DESC LIMIT 4";
        $p_run   = mysqli_query($con, $p_query);

        if (mysqli_num_rows($p_run) > 0) {
          while ($p_row = mysqli_fetch_array($p_run)) {
            $pid      = $p_row['pid'];
            $ptitle  = $p_row['title'];
            $pcat    = $p_row['category'];
            $p_price = $p_row['price'];
            $size    = $p_row['size'];
            $img1    = $p_row['image'];
        ?>

            <div class="col-md-6 col-lg-3 mb-4">
              <img src="img/<?php echo $img1; ?>" class="hover-effect" width="100%" height="190px">
              <div class="text-center mt-3">
                <h5 title="<?php echo $ptitle; ?>"><?php echo substr($ptitle, 0, 20); ?>...</h5>
                <h6><?php echo number_format($p_price); ?> VND</h6>
              </div>

              <div class="row">
                <div class="col-md-12 col-sm-12 col-12 text-center">

                  <a href="product-detail.php?product_id=<?php echo $pid; ?>" type="submit" onclick="a()" class="btn btn-primary btn-sm hover-effect">
                    <i class="far fa-shopping-cart"></i>
                  </a>
                  <a href="product-detail.php?product_id=<?php echo $pid; ?>" class="btn btn-default btn-sm hover-effect text-dark">
                    <i class="far fa-info-circle"></i> Xem chi tiết
                  </a>

                </div>

              </div>
            </div>

        <?php
          }
        }
        ob_end_flush(); ?>

      </div>
      <!-- Grid row -->

    </section>
    <!--Section: New products-->

  </div>

</main>

<?php include('include/footer.php'); ?>