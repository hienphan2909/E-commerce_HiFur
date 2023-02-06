<?php include('include/header.php'); ?>

<div class="jumbotron bg-primary" style="background: linear-gradient(120deg, #2980b9, #8e44ad);">
    <h2 class="text-center text-white">Sửa giỏ hàng</h2>
</div>

<div class="container">
    <?php
    if (isset($_SESSION['id'])) {
        $customer_id = $_SESSION['id'];

        if (isset($_GET['cart_id'])) {
            $edit_cart = $_GET['cart_id'];

            //update Query
            if (isset($_POST['update'])) {

                $qty = $_POST['Qty'];

                $up_query = "UPDATE cart SET quantity=$qty  WHERE product_id = $edit_cart";
                $run = mysqli_query($con, $up_query);
                // echo "<script>alert('Đã cập nhật giỏ hàng '); </script>";
    ?>
                <script>
                    Swal.fire({
                        title: 'Cập nhập thành công!',
                        // text: 'Hãy kiểm tra lại giỏ hàng!',
                        icon: 'success',
                        footer: '<a href="cart.php">Quay về giỏ hàng</a>',
                        confirmButtonText: "Tiếp tục chỉnh sửa"
                    })
                </script>
            <?php
            }
            //end update Query

            //cart Query
            $cart = "SELECT * FROM cart WHERE cust_id='$customer_id' and product_id ='$edit_cart'";
            $run  = mysqli_query($con, $cart);


            $sub_total = 0;
            $shipping_cost = 0;
            $total = 0;

            ?>
            <div class="row">

                <div class="col-md-9 p-3">
                    <h5>Giỏ hàng</h5>
                    <p class="text-right" style="margin-top:-30px"><a href="cart.php"><i class="fas fa-shopping-cart"></i> Quay về giỏ hàng</a> </p>
                    <hr>
                    <form method="post">

                        <table class="table table-responsive ">
                            <thead class="thead-light">
                                <tr>
                                    <th colspan="2">Thông tin sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Giá (VND)</th>
                                    <th>Tổng cộng</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php

                                if (mysqli_num_rows($run) > 0) {
                                    while ($cart_row = mysqli_fetch_array($run)) {
                                        $db_cust_id = $cart_row['cust_id'];
                                        $db_pro_id  = $cart_row['product_id'];
                                        $db_pro_qty  = $cart_row['quantity'];

                                        $pr_query = "SELECT * FROM furniture_product WHERE pid=$db_pro_id";
                                        $pr_run   = mysqli_query($con, $pr_query);

                                        if (mysqli_num_rows($pr_run) > 0) {
                                            $pr_row = mysqli_fetch_array($pr_run);

                                            $pid = $pr_row['pid'];
                                            $title = $pr_row['title'];
                                            $price = $pr_row['price'];
                                            $arrPrice = array($pr_row['price']);
                                            $size = $pr_row['size'];
                                            $img1 = $pr_row['image'];

                                            $single_pro_total_price = $db_pro_qty * $price;
                                            $pro_total_price = array($db_pro_qty * $price);

                                            //   $values = array_sum($arrPrice);
                                            $shipping_cost = 0;
                                            $values = array_sum($pro_total_price);
                                            $sub_total += $values;
                                            $total = $sub_total + $shipping_cost;

                                ?>
                                            <tr>
                                                <td width="150px">
                                                    <img src="img/<?php echo $img1; ?>" width="100%">
                                                </td>
                                                <td>
                                                    <h5><?php echo $title; ?></h5>
                                                    <p> Dimension: <?php echo $size; ?></p>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" name="Qty" value="<?php echo $db_pro_qty; ?>">
                                                </td>
                                                <td><?php echo  number_format($pr_row['price']); ?></td>

                                                <td><?php echo number_format($single_pro_total_price); ?> </td>

                                            </tr>
                                <?php


                                        }
                                    }
                                }



                                ?>


                            </tbody>


                        </table>

                        <input type="submit" name="update" class="btn btn-primary float-right" value="Cập nhật">

                    </form>
                </div>
                <!--end cart--->

                <!---total price-->
                <div class="col-md-3 p-3">
                    <h5>Chi tiết đặt hàng</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-6">
                            <h6>Tổng tiền</h6>
                            <h6>Phí ship</h6>
                            <h5 class="font-weight-bold">Tổng cộng: </h5>

                        </div>
                        <div class="col-md-6 col-sm-6 col-6">
                            <h6 class="text-right font-weight-normal"><?php echo number_format($sub_total); ?> VND</h6>
                            <h6 class="text-right font-weight-normal"><?php echo number_format($shipping_cost); ?> VND</h6>
                            <h5 class="text-right font-weight-bold"><?php echo number_format($total); ?> VND</h5>
                        </div>
                    </div>
                </div>
                <!---end total price-->

            </div>
            <!----end Row---->


    <?php  }
    }
    ?>
</div>

<?php include('include/footer.php'); ?>