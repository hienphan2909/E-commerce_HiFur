<?php include("include/header.php"); ?>
<?php
if (!isset($_SESSION['email'])) {
    header('location: signin.php');
}

if (isset($_GET['del'])) {
    $del   = $_GET['del'];
    $query = "DELETE FROM `furniture_product` WHERE pid = $del";
    if (mysqli_query($con, $query)) {
        echo "<script> alert('Sản phẩm đã được xóa');</script>";
    }
}

if (isset($_GET['status'])) {
    $status   = $_GET['status'];
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
                    <i class="fad fa-th-list fa-6x text-primary"></i>
                </div>

                <div class="col-md-11 text-left mt-4">
                    <h1 class="ml-5 display-4 font-weight-normal">Quản lý sản phẩm</h1>
                </div>
                <!-- <div class="col-md-4">
                    <div class="font-weight-bold mt-5 text-right" style="font-size:24px;">
                        <h3>Trạng thái đăng: </h3>
                        <a href="furniture_pro_view.php?status=Công khai">Công khai</a> | <a href="furniture_pro_view.php?status=Bản nháp">Bản lưu nháp</a>
                    </div>
                </div> -->

            </div>
            <div class="row">
                <div class="col-md-6">
                    <td>
                        <?php
                        $sql1 = ("SELECT count(pid) as total from furniture_product");
                        $result = mysqli_query($con, $sql1);
                        $data = mysqli_fetch_assoc($result);
                        echo "Tổng sản phẩm: ";
                        echo $data['total'];
                        echo " sản phẩm" ?>
                    </td>
                </div>
                <div class="col-md-6">
                    <form method="post">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Tìm sản phẩm">
                            <div class="input-group-append">
                                <input class="btn btn-primary rounded-left" type="submit" name="sear_verified_furiture_pro" value="Tìm kiếm">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            <table class="table table-responsive table-hover ">
                <thead class="thead-dark">
                    <tr>
                        <th>Mã sản phẩm </th>
                        <th>Ảnh sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Loại sản phẩm</th>
                        <th>Kích thước</th>
                        <th>Giá (VND))</th>
                        <!-- <th>Mô tả</th> -->
                        <th>Trạng thái đăng</th>
                        <th>Ngày đăng</th>
                        <th colspan="4">Hành động (Sửa/Xóa)</th>
                        <th colspan="4"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    if (isset($status)) {

                        if (isset($_POST['sear_verified_furiture_pro'])) {
                            $search = $_POST['search'];


                            $order_query = "SELECT * FROM customer_order WHERE order_status='Đã xác nhận' and (order_id Like '%$search%' or invoice_no Like '%$search%') ";

                            if (isset($_GET['page'])) {
                                $page_id = $_GET['page'];
                            } else {
                                $page_id = 1;
                            }

                            $required_pro = 2;
                            $run   = mysqli_query($con, $order_query);
                            $count_rows = mysqli_num_rows($run);

                            $pages = ceil($count_rows / $required_pro);
                            $oder_start = ($page_id - 1) * $required_pro;
                        } else {

                            $pr_query1 = "SELECT * FROM furniture_product WHERE status = '$status'";
                            if (isset($_GET['page'])) {
                                $page_id = $_GET['page'];
                            } else {
                                $page_id = 1;
                            }

                            $required_pro = 5;

                            $run   = mysqli_query($con, $pr_query1);
                            $count_rows = mysqli_num_rows($run);

                            $pages = ceil($count_rows / $required_pro);
                            $oder_start = ($page_id - 1) * $required_pro;
                            $pr_query = "SELECT * FROM furniture_product fp INNER JOIN categories cat ON fp.category = cat.id DESC LIMIT $oder_start,$required_pro";
                        }
                    } else {
                        if (isset($_POST['sear_verified_furiture_pro'])) {
                            $search = $_POST['search'];

                            //$pr_query = "SELECT * FROM furniture_product fp INNER JOIN categories cat ON fp.category = cat.id order by pid DESC LIMIT $oder_start,$required_pro";
                            $pr_query1 = "SELECT * FROM furniture_product fp WHERE fp.pid Like '%$search%' or title like  '%$search%'";

                            if (isset($_GET['page'])) {
                                $page_id = $_GET['page'];
                            } else {
                                $page_id = 1;
                            }

                            $required_pro = 5;
                            $run   = mysqli_query($con, $pr_query1);
                            $count_rows = mysqli_num_rows($run);

                            $pages = ceil($count_rows / $required_pro);
                            $oder_start = ($page_id - 1) * $required_pro;
                            $pr_query = "SELECT * FROM furniture_product fp  WHERE fp.pid Like '%$search%' or title like  '%$search%' order by pid DESC LIMIT $oder_start,$required_pro";
                        } else {

                            $pr_query1 = "SELECT * FROM furniture_product";
                            if (isset($_GET['page'])) {
                                $page_id = $_GET['page'];
                            } else {
                                $page_id = 1;
                            }

                            $required_pro = 5;

                            $run   = mysqli_query($con, $pr_query1);
                            $count_rows = mysqli_num_rows($run);

                            $pages = ceil($count_rows / $required_pro);
                            $oder_start = ($page_id - 1) * $required_pro;
                            $pr_query = "SELECT * FROM furniture_product fp INNER JOIN categories cat ON fp.category = cat.id order by pid DESC LIMIT $oder_start,$required_pro";
                            // $pr_query = "SELECT * FROM furniture_product fp INNER JOIN categories cat ON fp.category = cat.id WHERE status = '$status' ORDER BY pid DESC LIMIT $oder_start,$required_pro";
                        }
                    }
                    $pr_run   = mysqli_query($con, $pr_query);

                    if (mysqli_num_rows($pr_run) > 0) {
                        while ($pr_row = mysqli_fetch_array($pr_run)) {
                            $pid   = $pr_row['pid'];
                            $title = $pr_row['title'];
                            $category = $pr_row['category'];
                            $size = $pr_row['size'];
                            $price = $pr_row['price'];
                            $detail  = $pr_row['detail'];
                            $image = $pr_row['image'];
                            $status = $pr_row['status'];
                            $date = $pr_row['date'];
                    ?>
                            <tr>
                                <td>
                                    <?php echo $pid; ?>
                                </td>
                                <td width="120px">
                                    <img src="img/<?php echo $image; ?>" width="100%">
                                </td>

                                <td width="150px">
                                    <?php echo $title; ?>
                                </td>

                                <td>
                                    <?php echo $category; ?>
                                </td>

                                <td><?php echo $size; ?></td>

                                <td><?php echo number_format($price); ?> </td>
                                <!-- <td>
                                    <?php echo $detail ?>
                                </td> -->
                                <td><?php echo $status; ?></td>
                                <td><?php echo $date; ?></td>
                                <td colspan="20" class="text-center">
                                    <?php


                                    ?>
                                    <a title="Cập nhật sản phẩm" href="furniture_pro_edit.php?pid=<?php echo $pid; ?> " class="btn btn-primary btn-sm">
                                        <i class="fal fa-edit"></i>
                                    </a>

                                    <a title="Xóa sản phẩm" href="furniture_pro_view.php?del=<?php echo $pid; ?>" class="btn btn-danger btn-sm">X </a>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<h2 class='text-center text-secondary'>Chưa có sản phẩm</h2>";
                    }



                    ?>


                </tbody>

            </table>
            <ul class="pagination pagination-md mt-5">
                <?php
                echo "Trang:";

                for ($i = 1; $i <= $pages; $i++) {
                    echo "<li class='page-item " . ($i == $page_id ? ' active ' : '') . "'><a class='page-link' href='furniture_pro_view.php?page=$i'>$i</a></li>";
                } ?>
            </ul>
        </div>



    </div>
</div>
<?php include("include/footer.php"); ?>