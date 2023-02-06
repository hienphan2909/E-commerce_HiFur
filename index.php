<?php include('include/header.php');

if (isset($_SESSION['email'])) {
  $custid = $_SESSION['id'];

  if (isset($_GET['cart_id'])) {
    $p_id = $_GET['cart_id'];

    $sel_cart = "SELECT * FROM cart WHERE cust_id = $custid and product_id = $p_id ";
    $run_cart    = mysqli_query($con, $sel_cart);

    if (mysqli_num_rows($run_cart) == 0) {
      $cart_query = "INSERT INTO `cart`(`cust_id`, `product_id`,quantity) VALUES ($custid,$p_id,1)";
      if (mysqli_query($con, $cart_query)) {
        // header('location:index.php');
        echo '<script>window.location.href="index.php"</script>';
      }
    }
    if (mysqli_num_rows($run_cart) > 0) {
      while ($row = mysqli_fetch_array($run_cart)) {
        $exist_pro_id = $row['product_id'];
        if ($p_id == $exist_pro_id) {
          $error = "<script> alert('⚠️ Sản phẩm này đã có trong giỏ hàng của bạn  ');</script>";
        }
      }
    }
  }
} else if (!isset($_SESSION['email'])) {
  echo "<script> function a(){alert('⚠️ Cần đăng nhập để thêm sản phẩm này vào giỏ hàng');}</script>";
}
?>
<!--Carousel Wrapper-->
<div class="carousel slide" id="slider" data-ride="carousel">
  <!---Indicators-->
  <ol class="carousel-indicators">
    <li data-target="#slider" data-slide-to="0" class="active"></li>
    <li data-target="#slider" data-slide-to="1"></li>
    <li data-target="#slider" data-slide-to="2"></li>
  </ol>

  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/slide_2.jpeg" class="d-block w-100">
    </div>
    <div class="carousel-item">
      <img src="img/slide_3.jpeg" class="d-block w-100">
    </div>
    <div class="carousel-item">
      <img src="img/slide_9.jpeg" class="d-block w-100">
    </div>

    <!---Controlers-->
    <a class="carousel-control-prev" data-slide="prev" href="#slider">
      <span class="carousel-control-prev-icon"></span>
    </a>

    <a class="carousel-control-next" href="#slider" data-slide="next">
      <span class="carousel-control-next-icon"></span>
    </a>

  </div>

</div>
<!--/.Carousel Wrapper-->



<!--Latest product---->
<section>
  <div class="container pt-5 pb-5">
    <div>
      <?php
      if (isset($msg)) {
        echo $msg;
      } else if (isset($error)) {
        echo $error;
      }
      ?>
    </div>

    <h1 class="text-center">Sản phẩm mới nhất</h1>

    <div class="row mt-4">

      <?php
      $p_query = "SELECT * FROM furniture_product ORDER BY pid DESC LIMIT 4";
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

          <div class="col-md-3 mt-3">
            <img src="img/<?php echo $img1; ?>" class="hover-effect" width="100%" height="190px">
            <div class="text-center mt-3">
              <h5 title="<?php echo $ptitle; ?>"><?php echo substr($ptitle, 0, 30); ?></h5>
              <h6><?php echo number_format($p_price); ?> VND</h6>
            </div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-12 text-center">

                <a href="index.php?cart_id=<?php echo $pid; ?>" type="submit" onclick="a()" class="btn btn-primary btn-sm hover-effect">
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
      } else {
        echo "<h3 class='text-center'> No Product Available Yet </h3>";
      }

      ?>

    </div>
  </div>
</section>
<!---end latest Products-->

<!---We deal with-->
<section class="bg-white">
  <div class="container pt-4 pb-5">
    <h1 class="text-center pt-4">Các sản phẩm </h1>

    <!---Row 1-->
    <div class="row mt-5">
      <div class="col-md-4">
        <img src="img/bedset.jpg" class="hover-effect" width="100%" alt="bedset">
        <div class="mt-3">
          <h4 class="text-center">Kiểu dáng giường ngủ hiện đại</h4>
          <p class="text-center">Chúng tôi cung cấp thiết kế bộ trải giường hiện đại được làm từ gỗ sản xuất với vân gỗ nguyên khối. Giá cả phải chăng với sản phẩm chất lượng cao..</p>
        </div>
      </div>
      <div class="col-md-4">
        <img src="img/dining-set1.jpg" class="hover-effect" width="100%" alt="bedset">
        <div class="mt-3">
          <h4 class="text-center">Bộ bàn ăn hiện đại</h4>
          <p class="text-center">Chúng tôi đối phó với Bàn ăn Nó thể hiện đẳng cấp và phong cách và rất sang trọng và hiện đại trong thiết kế. Bàn ăn làm từ gỗ nguyên khối bền đẹp.</p>
        </div>
      </div>

      <div class="col-md-4">
        <img src="img/chairyellow2.jpg" class="hover-effect" width="100%" alt="bedset">
        <div class="mt-3">
          <h4 class="text-center">Thiết kế Ghế bành hiện đại</h4>
          <p class="text-center">Chúng tôi đối phó với Tất cả Ghế tay Phong cách Hiện đại Nó thể hiện đẳng cấp và phong cách, đồng thời rất sang trọng và hiện đại trong thiết kế, được làm từ một loại gỗ cứng bền.</p>
        </div>
      </div>

    </div>
    <!---end-->

    <!---row 2-->
    <div class="row mt-5">
      <div class="col-md-4">
        <img src="img/table1.jpg" class="hover-effect" width="100%" alt="bedset">
        <div class="mt-3">
          <h4 class="text-center">Bàn được thiết kế hiện đại</h4>
          <p class="text-center">Chúng tôi giao dịch với Tất cả các loại bàn Phong cách Hiện đại Nó thể hiện đẳng cấp và phong cách đồng thời rất sang trọng và hiện đại trong thiết kế, được làm từ một loại gỗ nguyên khối bền.</p>
        </div>
      </div>
      <div class="col-md-4">
        <img src="img/modern-contemp1.jpg" class="hover-effect" width="100%" alt="bedset">
        <div class="mt-3">
          <h4 class="text-center">Kiểu dáng ghế sofa hiện đại</h4>
          <p class="text-center">Chúng tôi cung cấp Tất cả các loại Ghế sofa / Đi văng phong cách hiện đại, có thiết kế rất sang trọng và hiện đại, được làm từ gỗ nguyên khối bền.</p>
        </div>
      </div>

      <div class="col-md-4">
        <img src="img/newcupboard.jpg" class="hover-effect" width="100%" alt="bedset">
        <div class="mt-3">
          <h4 class="text-center">Thiết kế tủ sành điệu</h4>
          <p class="text-center">Chúng tôi đối phó với Tất cả các loại tủ phong cách hiện đại, tủ tích hợp là không gian lưu trữ tạo thành một phần của thiết kế của căn phòng.</p>
        </div>
      </div>

    </div>

  </div>
</section>
<!--end deal with-->

<!---How to Shop -->
<section class="back-gray pt-4 pb-4" style="background-image: url('img/br_4.jpg');">
  <div class="container">
    <h2 class="text-center text-dark font-weight-bold">Phương thức mua sắm</h2>
    <div class="row">

      <!--choose product card-->
      <div class="col-md-4 p-5">
        <div class="card hover-effect" id="border-less">
          <div class="card-body mt-3 text-center">
            <i class="fal fa-phone-laptop fa-3x"></i>
            <div class="heading mt-2">
              <h4>Sản phẩm</h4>
              <h6 class="text-secandary">Chọn sản phẩm của riêng bạn</h6>
            </div>
            <p class="mt-2">Thêm sản phẩm vào giỏ hàng, tiến hành thanh toán và nhập địa chỉ giao hàng</p>

          </div>
        </div>
      </div>
      <!---end choose product-->


      <!--cash on deliver-->
      <div class="col-md-4 p-5">
        <div class="card hover-effect" id="border-less">
          <div class="card-body mt-3 text-center">
            <i class="fal fa-hand-holding-box fa-3x"></i>
            <div class="heading mt-2">
              <h4>Nhận hàng</h4>
              <h6 class="text-secandary">Nhận hàng</h6>
            </div>
            <p class="mt-2">Sản phẩm của bạn sẽ được giao tận nơi trong vòng tối đa 7 ngày làm việc.</p>

          </div>
        </div>
      </div>
      <!---end cash on delivery-->


      <!--cash on deliver-->
      <div class="col-md-4 p-5">
        <div class="card hover-effect" id="border-less">
          <div class="card-body mt-3 text-center">
            <i class="fal fa-wallet fa-3x"></i>
            <div class="heading mt-2">
              <h4>Thanh toán</h4>
              <h6 class="text-secandary">Thanh toán khi giao hàng</h6>
            </div>
            <p class="mt-2">Sau khi nhận hàng và kiểm tra hàng bạn sẽ tiến hành thanh toán hóa đơn.</p>

          </div>
        </div>
      </div>
      <!---end cash on delivery-->

    </div>
  </div>
</section>
<!---end How to shop-->

<!-- to on top -->
<a href="#" class="to_top">
  <i class="fas fa-chevron-up"></i>
</a>

<!-- <div>
  <body id="top">
    <button class="to_top" id="myBtn" type="button" onclick="scrollToTop();return false">
      <a href="#top"><i class="fas fa-sort-up"></i></a>
    </button>
  </body>
</div> -->

<?php include('include/footer.php'); ?>