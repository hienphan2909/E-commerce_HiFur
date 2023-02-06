<?php 
include('include/header.php');

if(!isset($_SESSION['email'])){
    header('location:../sign-in.php');
}

if(isset($_SESSION['email'])){
  $customer_id    = $_SESSION['id'];
}
?>

   <div class="jumbotron bg-secondary">
      <h1 class="text-center text-white mt-5">Đổi mật khẩu</h1>
    </div>

   <div class="container mt-5">
       <div class="row">

        <div class="col-md-3">
          <?php include('include/sidebar.php');?>
        </div>

        <div class="col-md-9">
          <h3>Đổi mật khẩu:</h3><hr>
          <h6>ĐỔI MẬT KHẨU</h6>
           
          
            
              <?php
              if(isset($_POST['update'])){
                $old_pass     = $_POST['old_pass'];
                $new_pass     = $_POST['new_pass'];
                $confirm_pass = $_POST['conf_pass'];

               $query = "SELECT cust_pass FROM customer Where cust_id=$customer_id";
               $run   = mysqli_query($con,$query);

               if(mysqli_num_rows($run) > 0 ){
                  $row = mysqli_fetch_array($run);
                  $cust_pass  = $row['cust_pass'];
                   if(!empty($old_pass) && !empty($new_pass) && !empty($confirm_pass)){
                      if($old_pass === $cust_pass){
                         if($new_pass===$confirm_pass){

                          $up_query = "UPDATE customer SET cust_pass = '$confirm_pass'";
  
                           if(mysqli_query($con,$up_query)){
                             $msg ="<div class='alert alert-success alert-dismissible fade show pt-1 pb-1 pl-3'  role='alert'>
                             <strong><i class='fas fa-check-circle'></i> Xin chúc mừng! </strong> Mật khẩu của bạn đã được thay đổi.
                             <button type='button' class='close p-2' data-dismiss='alert' aria-label='Close'>
                              <span  aria-hidden='true'>&times;</span>
                             </button>
                              </div>";
                           
                                  }
                            } 
                            else {
                           $error="<div class='alert alert-danger alert-dismissible fade show pt-1 pb-1 pl-3'  role='alert'>
                           <strong><i class='fas fa-info-circle'></i> Ooh! </strong>Mật khẩu mới và mật khẩu xác nhận phải khớp nhau.
                           <button type='button' class='close p-2' data-dismiss='alert' aria-label='Close'>
                            <span  aria-hidden='true'>&times;</span>
                           </button>
                            </div>";
                            }
                      }
                      else{
                        $error="<div class='alert alert-danger alert-dismissible fade show pt-1 pb-1 pl-3'  role='alert'>
                           <strong><i class='fas fa-info-circle'></i> Ooh! </strong>Mật khẩu cũ không đúng!.
                           <button type='button' class='close p-2' data-dismiss='alert' aria-label='Close'>
                            <span  aria-hidden='true'>&times;</span>
                           </button>
                            </div>";
                      }


                      



                       }else{
                          $error="<div class='alert alert-danger alert-dismissible fade show pt-1 pb-1 pl-3'  role='alert'>
                          <strong><i class='fas fa-info-circle'></i> Xin lỗi! </strong>Vui lòng điền đủ thông tin.
                          <button type='button' class='close p-2' data-dismiss='alert' aria-label='Close'>
                            <span  aria-hidden='true'>&times;</span>
                          </button>
                            </div>";
                   }
                }
              }

              if(isset($msg)){
                echo $msg;
              }
              else if(isset($error)){
                echo $error;
              }
              ?>
              
            <form  method="post" class="w-50">

                <div class="form-group">
                  <label>Mật khẩu cũ: *</label>
                  <input type="text" name="old_pass" placeholder="Mật khẩu cũ" class="form-control" >
               </div>

                <div class="form-group">
                  <label>Mật khẩu mới: *</label>
                  <input type="text" name="new_pass" placeholder="Mật khẩu mới" class="form-control" >
                </div>

                <div class="form-group">
                  <label>Nhập lại mật khẩu mới: *</label>
                  <input type="text" name="conf_pass" placeholder="Nhập lại mật khẩu mới"  class="form-control" >
              </div>

              <div class="form-group text-center mt-4">
                <input type="submit" name="update" class="btn btn-primary" value="Cập nhật">
              </div>
         
          </form> 
             
            
           
         </div>
       </div>
   </div>
   
   <?php include('include/footer.php');?>