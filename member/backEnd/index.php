<?php 
        session_start();  
        
        if(isset($_SESSION['status']) == "")
        {
            echo "<meta http-equiv=\"refresh\" content=\"0; URL=../../bn_login.php\">";
            exit();
        } 
        else
        {
               
?>

<!DOCTYPE html>
<html lang="en">
<head>

      <?php include('h.php'); ?>
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">


  <?php include('menu_top.php'); ?>

  <?php include('menu_left.php'); ?>
  
  <div class="content-wrapper">

    <?php 
      
      if(empty($_GET)){
        include "dashboard.php";
      }
        if(isset($_GET['dashboard'])) {
          include "dashboard.php";
        }
        
          if(isset($_GET['profile'])) {
            include "profile.php";
          }

            if(isset($_GET['order'])) {
                include "order.php";
            }
            if(isset($_GET['o_detail'])) {
              include "o_detail.php";
            }

              if(isset($_GET['status_pay'])) {
                include "status_pay.php";
              }
              if(isset($_GET['payment'])) {
                include "payment.php";
              }
              if(isset($_GET['paypal'])) {
                include "paypal.php";
              }

                if(isset($_GET['status_send'])) {
                  include "status_send.php";
                }
        
        
    ?>


  </div>

	<?php include('f.php'); ?>

</body>
</html>

<?php 
        } 
?>