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
          if(isset($_GET['profile_update'])) {
            include "profile_update.php";
          }

          if(isset($_GET['news'])) {
            include "news.php";
          }
          if(isset($_GET['news_form_add'])) {
            include "news_form_add.php";
          }
          if(isset($_GET['news_form_edit'])) {
            include "news_form_edit.php";
          }
          if(isset($_GET['news_del'])) {
            include "news_del.php";
          }

          if(isset($_GET['members'])) {
            include "members.php";
          }

            if(isset($_GET['type'])) {
              include "type.php";
            }
            if(isset($_GET['type_form_add'])) {
              include "type_form_add.php";
            }
            if(isset($_GET['type_form_edit'])) {
              include "type_form_edit.php";
            }
            if(isset($_GET['type_del'])) {
              include "type_del.php";
            }

            if(isset($_GET['product'])) {
              include "product.php";
            }
            if(isset($_GET['product_form_add'])) {
              include "product_form_add.php";
            }
            if(isset($_GET['product_form_edit'])) {
              include "product_form_edit.php";
            }
            if(isset($_GET['product_del'])) {
              include "product_del.php";
            }
            
            if(isset($_GET['shipping_cost'])) {
              include "shipping_cost.php";
            }
            if(isset($_GET['shipping_cost_form_add'])) {
              include "shipping_cost_form_add.php";
            }
            if(isset($_GET['shipping_cost_form_edit'])) {
              include "shipping_cost_form_edit.php";
            }
            if(isset($_GET['shipping_cost_del'])) {
              include "shipping_cost_del.php";
            }

            if(isset($_GET['r_product'])) {
              include "r_product.php";
            }
            if(isset($_GET['r_product_form_add'])) {
              include "r_promotion_form_add.php";
            }
            if(isset($_GET['r_promotion_form_edit'])) {
              include "r_promotion_form_edit.php";
            }
            if(isset($_GET['r_promotion_del'])) {
              include "r_promotion_del.php";
            }
            
            if(isset($_GET['top5_product'])) {
              include "top5_product.php";
            }

            if(isset($_GET['promotion'])) {
              include "promotion.php";
            }
            if(isset($_GET['promotion_form_add'])) {
              include "promotion_form_add.php";
            }
            if(isset($_GET['promotion_form_edit'])) {
              include "promotion_form_edit.php";
            }
            if(isset($_GET['promotion_del'])) {
              include "promotion_del.php";
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
              if(isset($_GET['status_pay_ok'])) {
                include "status_pay_ok.php";
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