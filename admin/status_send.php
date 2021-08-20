<?php 
		require_once '../database/con_db.php';        
?>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">การจัดส่งสินค้า</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">การจัดส่งสินค้า</li>
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
                      <th class="text-center">วันที่สั่งซื้อ</th>
                      <th class="text-center">เลขที่ใบสั่งซื้อ</th>
                      <th class="text-center">สถานะ</th>
                      <th class="text-center">แจ้งสถานะ</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php

                        $select_opm = $conn->prepare("SELECT o.*, pm.pm_status FROM orders o inner join payment pm ON pm.o_id = o.o_id
                                                                               WHERE pm.pm_status != '0' ORDER BY pm_date DESC");
                        $select_opm->execute();

                        $i = 1;
                        while ($row_opm = $select_opm->fetch(PDO::FETCH_ASSOC)) 
                        {
                          
                    ?>

                        <tr>
                            <td class="text-center" width="5%"><?php echo $i++; ?></td>
                            <td class="text-center" width="25%"><?=  DateThai($row_opm['o_date']); ?></td>
                            <td class="text-center" width="25%"><?=  $row_opm['o_id']; ?></td>
                            <td class="text-center" width="25%">
                              <?php if($row_opm['o_status'] === '0'){ ?><span class="badge badge-danger">รอแจ้งสถานะ</span><?php }?>
                              <?php if($row_opm['o_status'] === '1'){ ?><span class="badge badge-warning">รอจัดส่งสินค้า</span><?php }?>
                              <?php if($row_opm['o_status'] === '2'){ ?><span class="badge badge-primary">จัดส่งสินค้าแล้ว</span><?php }?>
                              <?php if($row_opm['o_status'] === '3'){ ?><span class="badge badge-success">ได้รับสินค้าแล้ว</span><?php }?>
                            </td>
                            <td class="text-center" width="20%">
                                <form action="" method="post" enctype="multipart/form-data">

                                      <?php if($row_opm['o_status'] === '0'){?>

                                        <button class="btn bg-warning" type="submit" name="send" value="<?= $row_opm['o_id']; ?>">
                                          <i class="fas fa-car"></i> รอจัดส่งสินค้า
                                        </button>

                                      <?php } else if($row_opm['o_status'] === '1'){?>

                                        <button class="btn bg-primary" type="submit" name="send1" value="<?= $row_opm['o_id']; ?>">
                                          <i class="fas fa-car-side"></i> จัดส่งสินค้าแล้ว
                                        </button>

                                      <?php } else if($row_opm['o_status'] === '2'){?>

                                        <button class="btn bg-success" type="submit" name="send2" value="<?= $row_opm['o_id']; ?>">
                                          <i class="fas fa-gifts"></i> ได้รับสินค้าแล้ว
                                        </button>

                                      <?php } else {?>

                                        <span>สิ้นสุดขั้นตอน</span>
                                        
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

    if (isset($_POST['send'])) {

      $o_id    =  $_POST['send'];
      $o_status   =  1;

      try {

          $update_o = $conn->prepare("UPDATE orders SET o_status = :o_status WHERE o_id = :o_id");
          $update_o->bindParam(':o_id'  , $o_id);
          $update_o->bindParam(':o_status' , $o_status);

          if ($update_o->execute()) {
              
              echo "<script>alert('แจ้งสถานะ : รอจัดส่งสินค้า เรียบร้อย...!!')</script>";
              echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?status_send\">";
              exit;
          }

      } catch (PDOException $e) {

          echo $e->getMessage();

      } 
        
    }

    if (isset($_POST['send1'])) {

      $o_id    =  $_POST['send1'];
      $o_status   =  2;

      try {

          $update_o = $conn->prepare("UPDATE orders SET o_status = :o_status WHERE o_id = :o_id");
          $update_o->bindParam(':o_id'  , $o_id);
          $update_o->bindParam(':o_status' , $o_status);

          if ($update_o->execute()) {
              
              echo "<script>alert('แจ้งสถานะ : จัดส่งสินค้าแล้ว เรียบร้อย...!!')</script>";
              echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?status_send\">";
              exit;
          }

      } catch (PDOException $e) {

          echo $e->getMessage();

      } 
        
    }

    if (isset($_POST['send2'])) {

      $o_id    =  $_POST['send2'];
      $o_status   =  3;

      try {

          $update_o = $conn->prepare("UPDATE orders SET o_status = :o_status WHERE o_id = :o_id");
          $update_o->bindParam(':o_id'  , $o_id);
          $update_o->bindParam(':o_status' , $o_status);

          if ($update_o->execute()) {
              
              echo "<script>alert('แจ้งสถานะ : ได้รับสินค้าแล้ว เรียบร้อย...!!')</script>";
              echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?status_send\">";
              exit;
          }

      } catch (PDOException $e) {

          echo $e->getMessage();

      } 
        
    }

?>

