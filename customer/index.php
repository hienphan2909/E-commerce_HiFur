<?php include('include/header.php');

if (!isset($_SESSION['email'])) {
  header('location:customer/sign-in.php');
}
?>

<div class="jumbotron bg-secondary">
  <h1 class="text-center text-white mt-5">Tài khoản</h1>
</div>

<div class="container mt-5 mb-5">

  <div class="row">

    <div class="col-md-3">
      <?php include('include/sidebar.php'); ?>
    </div>

    <div class="col-md-9">
      <h3>Thông tin chung:</h3>
      <hr>

      <a href="orders.php">
        <h6 class="text-primary">ĐƠN HÀNG</h6>
      </a>
      <p>Kiểm tra trạng thái và thông tin liên quan đến đơn đặt hàng trực tuyến của bạn</p>

      <a href="personal-detail.php">
        <h6 class="text-primary">THÔNG TIN CÁ NHÂN</h6>
      </a>
      <p>Bạn có thể truy cập và sửa đổi chi tiết cá nhân của mình (tên, địa chỉ thanh toán, số điện thoại, v.v.) để đẩy nhanh việc mua hàng trong tương lai và thông báo cho chúng tôi về những thay đổi trong chi tiết liên hệ của bạn.</p>

      <a href="access-detail.php">
        <h6 class="text-primary">THAY ĐỔI MẬT KHẨU</h6>
      </a>
      <p>Bạn có thể thay đổi mật khẩu.</p>

    </div>
  </div>

</div>



<?php include('include/footer.php') ?>