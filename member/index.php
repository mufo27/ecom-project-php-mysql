<?php 
        session_start();  
        
        if(isset($_SESSION['status']) == "")
        {
            echo "<meta http-equiv=\"refresh\" content=\"0; URL=../bn_login.php\">";
            exit();
        } 
        else
        {

            
               
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
	
    <?php 
		include('h.php'); 
		
		require_once('../database/con_db.php')
	?>

</head>

<body>

    <?php include('menu_top.php'); ?>

    <?php 
        
        if(empty($_GET)){
          include "main.php";
        }
          if(isset($_GET['main'])) {
            include "main.php";
          }
          if(isset($_GET['product_all'])) {
            include "product_all.php";
          }
          if(isset($_GET['product_detail'])) {
            include "product_detail.php";
          }
          if(isset($_GET['cart'])) {
            include "cart.php";
          }
          if(isset($_GET['confirm'])) {
            include "confirm.php";
          }

            if(isset($_GET['bn_back_end'])) {
              include "bn_back_end.php";
            }
            
      ?>

	  <?php include('f.php'); ?>

</body>

</html>

<?php 
        } 
?>