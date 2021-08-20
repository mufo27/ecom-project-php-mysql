<?php 
		require_once '../../database/con_db.php'; 
    
    if($_SESSION['status'] === '1'){

      $check = $_SESSION['u_id'];

      $sql_ps = "SELECT points FROM users WHERE u_id = '$check' ";
      $res_ps = $conn->query($sql_ps);
      $count_ps = $res_ps->fetchColumn();

      $sql_o = "SELECT count(*) FROM orders WHERE u_id = '$check' ";
      $res_o = $conn->query($sql_o);
      $count_o = $res_o->fetchColumn();

      $sql_pm0 = "SELECT count(*) FROM payment pm inner join orders o ON o.o_id = pm.o_id WHERE pm_status = '0' AND o.u_id = '$check' ";
      $res_pm0  = $conn->query($sql_pm0);
      $count_pm0  = $res_pm0->fetchColumn();

      $sql_pm1 = "SELECT count(*) FROM payment pm inner join orders o ON o.o_id = pm.o_id WHERE pm_status = '1' AND o.u_id = '$check' ";
      $res_pm1 = $conn->query($sql_pm1);
      $count_pm1 = $res_pm1->fetchColumn();

      $sql_s = "SELECT count(*) FROM orders WHERE o_status = '1' AND u_id = '$check'";
      $res_s = $conn->query($sql_s);
      $count_s = $res_s->fetchColumn();

      $sql_ss = "SELECT count(*) FROM orders WHERE o_status = '2' AND u_id = '$check'";
      $res_ss = $conn->query($sql_ss);
      $count_ss = $res_ss->fetchColumn();

      $sql_sss = "SELECT count(*) FROM orders WHERE o_status = '3' AND u_id = '$check'";
      $res_sss = $conn->query($sql_sss);
      $count_sss = $res_sss->fetchColumn();

    }

    if($_SESSION['status'] === 'facebook'){

      $check = $_SESSION['strFacebookID'];

      $sql_ps = "SELECT points FROM tb_facebook WHERE FACEBOOK_ID = '$check' ";
      $res_ps = $conn->query($sql_ps);
      $count_ps = $res_ps->fetchColumn();

      $sql_o = "SELECT count(*) FROM orders WHERE FB_ID = '$check' ";
      $res_o = $conn->query($sql_o);
      $count_o = $res_o->fetchColumn();

      $sql_pm0 = "SELECT count(*) FROM payment pm inner join orders o ON o.o_id = pm.o_id WHERE pm_status = '0' AND o.FB_ID = '$check' ";
      $res_pm0  = $conn->query($sql_pm0);
      $count_pm0  = $res_pm0->fetchColumn();

      $sql_pm1 = "SELECT count(*) FROM payment pm inner join orders o ON o.o_id = pm.o_id WHERE pm_status = '1' AND o.FB_ID = '$check' ";
      $res_pm1 = $conn->query($sql_pm1);
      $count_pm1 = $res_pm1->fetchColumn();

      $sql_s = "SELECT count(*) FROM orders WHERE o_status = '1' AND FB_ID = '$check'";
      $res_s = $conn->query($sql_s);
      $count_s = $res_s->fetchColumn();

      $sql_ss = "SELECT count(*) FROM orders WHERE o_status = '2' AND FB_ID = '$check'";
      $res_ss = $conn->query($sql_ss);
      $count_ss = $res_ss->fetchColumn();

      $sql_sss = "SELECT count(*) FROM orders WHERE o_status = '3' AND FB_ID = '$check'";
      $res_sss = $conn->query($sql_sss);
      $count_sss = $res_sss->fetchColumn();

    } 

?>

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">

        <div class="row">

          <div class="col-lg-4 col-6">
            <div class="small-box bg-success">
              <div class="inner text-center">
                <p>รายการสั่งซื้อสินค้า ทั้งหมด</p>
                <h3><?= $count_o; ?></h3>
              </div>
              <div class="icon">
                <i class="ion ion-cube"></i>
              </div>
              <a href="index.php?order" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-6">
            <div class="small-box bg-success">
              <div class="inner text-center">
                <p>แต้มสะสม</p>
                <h3><?= $count_ps; ?></h3>
              </div>
              <div class="icon">
                <i class="ion ion-star"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

        </div>

        <div class="row">

          <div class="col-lg-4 col-6">
            <div class="small-box bg-danger">
              <div class="inner text-center">             
                <p>ยังไม่ชำระเงิน</p>
                <h3><?= $count_pm0; ?></h3>
              </div>
              <div class="icon">
                <i class="ion ion-thumbsdown"></i>
              </div>
              <a href="index.php?status_pay" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
              <div class="inner text-center">
                <p>ชำระเงินแล้ว</p>
                <h3><?= $count_pm1; ?></h3>
              </div>
              <div class="icon">
                <i class="ion ion-thumbsup"></i>
              </div>
              <a href="index.php?status_pay" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

        </div>

        <div class="row">

          <div class="col-lg-4 col-6">
            <div class="small-box bg-warning">
              <div class="inner text-center">
                <p>สถานะจัดส่ง : รอจัดส่งสินค้า</p>
                <h3><?= $count_s; ?></h3>
              </div>
              <div class="icon">
                <i class="ion ion-loop"></i>
              </div>
              <a href="index.php?status_send" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-6">
            <div class="small-box bg-warning">
              <div class="inner text-center">
                <p>สถานะจัดส่ง : จัดส่งสินค้าแล้ว</p>
                <h3><?= $count_ss; ?></h3>
              </div>
              <div class="icon">
                <i class="ion ion-paper-airplane"></i>
              </div>
              <a href="index.php?status_send" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-6">
            <div class="small-box bg-warning">
              <div class="inner text-center">
                <p>สถานะจัดส่ง : ได้รับสินค้าแล้ว</p>
                <h3><?= $count_sss; ?></h3>
              </div>
              <div class="icon">
                <i class="ion ion-checkmark-circled"></i>
              </div>
              <a href="index.php?status_send" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

        </div>

      </div>
    </section>