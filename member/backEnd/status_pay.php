<?php 
		require_once '../../database/con_db.php';        
?>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">การชำระเงิน</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">การชำระเงิน</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
 
    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">

              </div>
              <div class="card-body">
                <table id="mytable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="text-center">ลำดับ</th>
                      <th class="text-center">เลขที่ใบสั่งซื้อ</th>
                      <th class="text-center">เลขที่ใบชำระ</th>
                      <th class="text-center">สถานะ</th>
                      <th class="text-center">วันที่ชำระ</th>
                      <th class="text-center">ยอดชำระ</th>
                      <th class="text-center">หลักฐาน(สลิปโอน)</th>
                      <th class="text-center"></th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php

                        if($_SESSION['status'] === '1'){

                            $select = $conn->prepare("SELECT pm.* FROM orders o inner join payment pm ON pm.o_id = o.o_id WHERE o.u_id = :u_id ORDER BY pm_status DESC");
                            $select->bindParam("u_id"   , $_SESSION['u_id']);
                            $select->execute();

                        }

                        if($_SESSION['status'] === 'facebook'){

                            $select = $conn->prepare("SELECT pm.* FROM orders o inner join payment pm ON pm.o_id = o.o_id WHERE o.FB_ID = :FB_ID ORDER BY pm_status DESC");
                            $select->bindParam("FB_ID"   , $_SESSION["strFacebookID"]);
                            $select->execute();

                        }

                        $i = 1;
                        while ($row = $select->fetch(PDO::FETCH_ASSOC)) 
                        {
  
                    ?>

                        <tr>
                            <td class="text-center" width="5%"><?php echo $i++; ?></td>
                            <td class="text-center" width="10%"><?=  $row['o_id']; ?></td>
                            <td class="text-center" width="10%"><?=  $row['pm_id']; ?></td>
                            <td class="text-center" width="10%">
                              
                              <?php if($row['pm_status'] >= '1'){ ?><span class="badge badge-primary">ชำระเงินแล้ว</span><?php }?>
                              <?php if($row['pm_status'] === '0'){ ?><span class="badge badge-danger">ยังไม่ชำระเงิน</span><?php }?>

                            </td>
                            <td class="text-center" width="10%">

                              <?php if($row['pm_status'] >= '1'){ ?><span class="badge badge-success"><?=  DateThai($row['pm_date']); ?></span><?php } ?>
                              <?php if($row['pm_status'] === '0' && isset($row['pm_date'])){ ?><span class="badge badge-warning">รอการตรวจสอบ</span><?php } ?>

                            </td>
                            <td class="text-center" width="8%">
                          
                              <?php if($row['pm_status'] >= '1'){ ?><span class="badge badge-success"><?=  $row['pm_total']; ?></span><?php } ?>
                              <?php if($row['pm_status'] === '0' && isset($row['pm_date'])){ ?><span class="badge badge-warning">รอการตรวจสอบ</span><?php } ?>

                            </td>
                            <td class="text-center" width="15%">

                              <?php if($row['pm_status'] === '2'){ ?><span class="badge badge-success">ชำระเงินผ่าน PAYPAL</span><?php } ?>
                              <?php if($row['pm_status'] === '1'){ ?><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['pm_img']).'" width="150" height="100"/>'; ?><?php } ?>
                              <?php if($row['pm_status'] === '0' && isset($row['pm_date'])){ ?><span class="badge badge-warning">รอการตรวจสอบ</span><?php } ?>
                            
                            </td>
                            <td class="text-center" width="20%">

                              <?php if($row['pm_status'] === '0' && !isset($row['pm_date'])){ ?>
                                <a href="index.php?payment=<?= $row['pm_id']; ?>" class="btn bg-success"><i class="fas fa-file-invoice-dollar"></i> ชำระเงินทันที</a>
                              <?php } ?>

                              <?php if($row['pm_status'] === '0' && isset($row['pm_date'])){ ?>
                                <a href="index.php?payment=<?= $row['pm_id']; ?>" class="btn bg-warning"><i class="fas fa-comment-dollar"></i> แก้ไขหลักฐาน</a>
                              <?php } ?>  

                              <?php if($row['pm_status'] === '1' && isset($row['pm_date'])){ ?>
                                <span class="badge badge-success">ตรวจสอบเรียบร้อย</span>
                              <?php } ?>

                            </td>
                        </tr>

                    <?php } ?>

                  </tbody>
                </table>
              </div>

              <div class="card-footer clearfix">
               
              </div>
            </div>

          </div>
        </div>

      </div>
    </section>

    <div class="row mt-5"></div>

   