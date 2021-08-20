<?php 
		require_once '../database/con_db.php';        
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

                        $select_pm = $conn->prepare("SELECT * FROM payment ORDER BY pm_status ASC");
                        $select_pm->execute();

                        $i = 1;
                        while ($row_pm = $select_pm->fetch(PDO::FETCH_ASSOC)) 
                        {

                          
                    ?>

                        <tr>
                            <td class="text-center" width="5%"><?php echo $i++; ?></td>                     
                            <td class="text-center" width="12%"><?=  $row_pm['o_id']; ?></td>
                            <td class="text-center" width="12%"><?=  $row_pm['pm_id']; ?></td>
                            <td class="text-center" width="12.5%">

                              <?php if($row_pm['pm_status'] === '0'){ ?><span class="badge badge-danger">ยังไม่ชำระเงิน</span><?php }?>
                              <?php if($row_pm['pm_status'] >= '1'){ ?><span class="badge badge-primary">ชำระเงินแล้ว</span><?php }?>

                            </td>
                            <td class="text-center" width="10%">

                              <?php if($row_pm['pm_status'] >= '1'){ ?><span class="badge badge-success"><?=  DateThai($row_pm['pm_date']); ?></span><?php } ?>

                            </td>
                            <td class="text-center" width="10%">

                              <?php if($row_pm['pm_status'] >= '1'){ ?><span class="badge badge-success"><?=  $row_pm['pm_total']; ?></span><?php } ?>
                             
                            </td> 
                            <td class="text-center" width="21%">

                              <?php if($row_pm['pm_status'] === '2'){ ?><span class="badge badge-success">ชำระเงินผ่าน PAYPAL</span><?php } ?>
                              <?php if($row_pm['pm_status'] === '1' ){ ?><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row_pm['pm_img']).'" width="150" height="100"/>'; ?><?php } ?>
                              <?php if($row_pm['pm_status'] === '0' && isset($row_pm['pm_date'])){ ?><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row_pm['pm_img']).'" width="150" height="100"/>'; ?><?php } ?>
                            
                            </td>
                            <td class="text-center" width="10%">

                                <form action="" method="post" enctype="multipart/form-data">

                                      <?php if($row_pm['pm_status'] === '0' && !isset($row_pm['pm_date'])){ ?>

                                        <span class="badge badge-warning">รอแจ้งหลักฐาน</span>

                                      <?php } ?>

                                      <?php if($row_pm['pm_status'] === '0' && isset($row_pm['pm_date'])){?>

                                        <button class="btn bg-primary" type="submit" name="pay" value="<?= $row_pm['pm_id']; ?>">
                                          <i class="fas fa-donate"></i> ยืนยัน
                                        </button>
                                      
                                      <?php } ?> 

                                      <?php if($row_pm['pm_status'] === '1'){?>
                                        
                                        <button class="btn bg-danger" type="submit" name="cancel" value="<?= $row_pm['pm_id']; ?>">
                                          <i class="fas fa-window-close"></i> ยกเลิก
                                        </button>

                                      <?php } ?>        

                                </form>

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
    

<?php

    if (isset($_POST['pay'])) {

      $pm_id    =  $_POST['pay'];
      $pm_status   =  1;

      try {

          $update_pm = $conn->prepare("UPDATE payment SET pm_status = :pm_status WHERE pm_id = :pm_id");
          $update_pm->bindParam(':pm_id'  , $pm_id);
          $update_pm->bindParam(':pm_status' , $pm_status);

          if ($update_pm->execute()) {
              
              echo "<script>alert('ยืนยันการชำระเงิน เรียบร้อย...!!')</script>";
              echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?status_pay\">";
              exit;
          }

      } catch (PDOException $e) {

          echo $e->getMessage();

      } 
        
    }

    if (isset($_POST['cancel'])) {

      $pm_id    =  $_POST['cancel'];
      $pm_status   =  0;

      try {

          $update_pm = $conn->prepare("UPDATE payment SET pm_status = :pm_status WHERE pm_id = :pm_id");
          $update_pm->bindParam(':pm_id'  , $pm_id);
          $update_pm->bindParam(':pm_status' , $pm_status);

          if ($update_pm->execute()) {
              
              echo "<script>alert('ยกเลิกชำระเงิน เรียบร้อย...!!')</script>";
              echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?status_pay\">";
              exit;
          }

      } catch (PDOException $e) {

          echo $e->getMessage();

      } 
        
    }

?>

