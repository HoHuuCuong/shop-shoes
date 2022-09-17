<?php
    session_start();
    require '../connectdb/connect.php';
    require '../model/cart_model1.php';
    require '../model/bill_model.php';
    require '../model/detailbill_model.php';
    require '../model/encrypt.php';
    if(!isset($_SESSION['email'])){
        header('location:index.php');
    }else{
        $con = ketnoi();
        $user_id = $_SESSION['id'];
        $orderid = $_SESSION['orderid'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $_SESSION['paymenttime'] = date("Y-m-d H:i:s");
        $payment_time = $_SESSION['paymenttime'];
        $rcname = mysqli_real_escape_string($con,$_POST['rcname']);
        $rccontact = mysqli_real_escape_string($con,$_POST['rccontact']);
        $rcadd = mysqli_real_escape_string($con,$_POST['rcadd']);
        
             //$encryptmodel = new encrypt();
    //$tam = $encryptmodel->vn_to_str($rcname);
     //$tam2 = $encryptmodel->vn_to_str($rcadd);
    //$mahoa_name = $encryptmodel->apphin_mahoa($tam);
   // $mahoa_sdt=$encryptmodel->apphin_mahoa($rccontact);
    //$mahoa_diachi=$encryptmodel->diachi_mahoa($tam2);
        
        //$total=$encryptmodel->mahoathongke($total_tam);
       //  $tam = $encryptmodel->mahoathongke(1800);
      
        $bill = new bill_model();
        $bill->payorder($orderid, $payment_time,$rcname,$rccontact,$rcadd);
        if(mysqli_affected_rows($con) != 0){
            
    
?>
                
                     <script>alert("Đơn hàng của bạn đã được thanh toán. Cám ơn bạn đã mua sắm!");
                      window.location='../giaodien/products.php';
                     </script> 
                       
    <?php 
        }
        else{
          
    ?>
                      <script>alert("Đã xảy ra sự cố! Đơn hàng không thể thanh toán");
                      window.location='../giaodien/cart.php';
                      </script> 
    <?php }
    
        } ?>

