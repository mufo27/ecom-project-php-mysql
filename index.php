<!doctype html>
<html class="no-js" lang="en">

<head>
	
    <?php 
		include('h.php'); 
		
		require_once('database/con_db.php')
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
      ?>

	  <?php include('f.php'); ?>

</body>

</html>