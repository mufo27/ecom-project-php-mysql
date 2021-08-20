<?php 
		require_once '../database/con_db.php'; 

    $sql_m = "SELECT count(*) FROM users WHERE status = '1'";
    $res_m = $conn->query($sql_m);
    $count_m = $res_m->fetchColumn();

    $sql_t = "SELECT count(*) FROM type";
    $res_t  = $conn->query($sql_t);
    $count_t = $res_t->fetchColumn();

    $sql_p = "SELECT count(*) FROM product";
    $res_p = $conn->query($sql_p);
    $count_p = $res_p->fetchColumn();

    $sql_pmt = "SELECT count(*) FROM promotion";
    $res_pmt = $conn->query($sql_pmt);
    $count_pmt = $res_pmt->fetchColumn();

    $sql_o = "SELECT count(*) FROM orders";
    $res_o = $conn->query($sql_o);
    $count_o = $res_o->fetchColumn();

    $sql_o1 = "SELECT count(*) FROM orders WHERE o_status = '1' ";
    $res_o1 = $conn->query($sql_o1);
    $count_o1 = $res_o1->fetchColumn();

    $sql_o2 = "SELECT count(*) FROM orders WHERE o_status = '2' ";
    $res_o2 = $conn->query($sql_o2);
    $count_o2 = $res_o2->fetchColumn();

    $sql_o3 = "SELECT count(*) FROM orders WHERE o_status = '3' ";
    $res_o3 = $conn->query($sql_o3);
    $count_o3 = $res_o3->fetchColumn();

    $sql_pm0 = "SELECT count(*) FROM payment WHERE pm_status = '0' ";
    $res_pm0  = $conn->query($sql_pm0);
    $count_pm0  = $res_pm0->fetchColumn();

    $sql_pm1 = "SELECT count(*) FROM payment WHERE pm_status = '1' ";
    $res_pm1 = $conn->query($sql_pm1);
    $count_pm1 = $res_pm1->fetchColumn();
    
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

          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <p>สมาชิก ทั้งหมด</p>
                <h3><?= $count_m; ?></h3>
              </div>
              <div class="icon">
                <i class="ion ion-person-stalker"></i>
              </div>
              <a href="index.php?members" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <p>ประเภทสินค้า ทั้งหมด</p>
                <h3><?= $count_t; ?></h3>
              </div>
              <div class="icon">
                <i class="ion ion-cube"></i>
              </div>
              <a href="index.php?type" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <p>สินค้า ทั้งหมด</p>
                <h3><?= $count_p; ?></h3>
              </div>
              <div class="icon">
                <i class="ion ion-cube"></i>
              </div>
              <a href="index.php?product" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <p>โปรโมชั่น ทั้งหมด</p>
                <h3><?= $count_pmt; ?></h3>
              </div>
              <div class="icon">
                <i class="ion ion-alert"></i>
              </div>
              <a href="index.php?promotion" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

        </div>

        <div class="row">

          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <p>รายการสั่งซื้อ ทั้งหมด</p>
                <h3><?= $count_o; ?></h3>
              </div>
              <div class="icon">
                <i class="ion ion-clipboard"></i>
              </div>
              <a href="index.php?order" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <p>สถานะจัดส่ง : รอจัดส่งสินค้า</p>
                <h3><?= $count_o1; ?></h3>
              </div>
              <div class="icon">
                <i class="ion ion-loop"></i>
              </div>
              <a href="index.php?status_send" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <p>สถานะจัดส่ง : จัดส่งสินค้าแล้ว</p>
                <h3><?= $count_o2; ?></h3>
              </div>
              <div class="icon">
                <i class="ion ion-paper-airplane"></i>
              </div>
              <a href="index.php?status_send" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <p>สถานะจัดส่ง : ได้รับสินค้าแล้ว</p>
                <h3><?= $count_o3; ?></h3>
              </div>
              <div class="icon">
                <i class="ion ion-checkmark-circled"></i>
              </div>
              <a href="index.php?status_send" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

        </div>

        <div class="row">

          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">             
                <p>ยังไม่ชำระเงิน</p>
                <h3><?= $count_pm0; ?></h3>
              </div>
              <div class="icon">
                <i class="ion ion-thumbsdown"></i>
              </div>
              <a href="index.php?status_pay" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
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

      </div>
    </section>