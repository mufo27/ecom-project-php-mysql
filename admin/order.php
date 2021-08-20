<?php 
		require_once '../database/con_db.php';        
?>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">รายการสั่งซื้อสินค้า</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">รายการสั่งซื้อสินค้า</li>
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
                      <th class="text-center">สถานะจัดส่ง</th>
                      <th class="text-center">รายละเอียด</th>
                      <th class="text-center">เลขที่ใบชำระ</th>
                      <th class="text-center">สถานะชำระ</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php

                        $select_oupm= $conn->prepare("SELECT o.*, pm.pm_id, pm.pm_status FROM orders o inner join payment pm ON pm.o_id = o.o_id ORDER BY o_status DESC");
                        $select_oupm->execute();

                        $i = 1;
                        while ($row_oupm = $select_oupm->fetch(PDO::FETCH_ASSOC)) 
                        {

                    ?>

                        <tr>
                            <td class="text-center" width="5%"><?php echo $i++; ?></td>  
                            <td class="text-center" width="20%"><?=  $row_oupm['o_id']; ?></td>
                            <td class="text-center" width="15%">

                              <?php if($row_oupm['o_status'] === '0' && $row_oupm['pm_status'] == '0'){ ?><span class="badge badge-danger">รอการชำระเงิน</span><?php }?>
                              <?php if($row_oupm['o_status'] === '0' && $row_oupm['pm_status'] >= '1'){ ?><span class="badge badge-danger">รอแจ้งสถานะ</span><?php }?>
                              <?php if($row_oupm['o_status'] === '1'){ ?><span class="badge badge-warning">รอจัดส่งสินค้า</span><?php }?>
                              <?php if($row_oupm['o_status'] === '2'){ ?><span class="badge badge-primary">จัดส่งสินค้าแล้ว</span><?php }?>
                              <?php if($row_oupm['o_status'] === '3'){ ?><span class="badge badge-success">ได้รับสินค้าแล้ว</span><?php }?>
                            
                            </td>
                            <td class="text-center" width="20%">

                                <a href="index.php?o_detail=<?= $row_oupm['o_id']; ?>" class="btn bg-success"><i class="fas fa-eye"></i> ตรวจสอบ</a>
                            
                              </td>
                            <td class="text-center" width="20%"><?=  $row_oupm['pm_id']; ?></td>                                                   
                            <td class="text-center" width="15%">

                              <?php if($row_oupm['pm_status'] === '0'){ ?><span class="badge badge-danger">ยังไม่ชำระเงิน</span><?php }?>
                              <?php if($row_oupm['pm_status'] >= '1'){ ?><span class="badge badge-primary">ชำระเงินแล้ว</span><?php }?>
                            
                            </td>
                            <td class="text-center" width="5%">

                                <form action="" method="post" enctype="multipart/form-data">
                                    <?php if($row_oupm['o_day'] >= '7' && $row_oupm['pm_status']  === '0' || $row_oupm['o_status'] === '3'){?>
                                      <button class="btn bg-danger" type="submit" name="delete" value="<?= $row_oupm['o_id']; ?>">
                                        <i class="fas fa-trash-alt"></i>
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

      if (isset($_POST['delete'])) {

        $o_id    =  $_POST['delete'];
        
        try {

          $select_opmod = $conn->prepare("SELECT o_id FROM orders WHERE o_id = :o_id");
          $select_opmod->bindParam("o_id" , $o_id);
          $select_opmod->execute();

              while($row_opmod = $select_opmod->fetch(PDO::FETCH_ASSOC))
              {
                $delete_od = $conn->prepare("DELETE FROM order_detail WHERE o_id = :o_id");
                $delete_od->bindParam(':o_id' , $row_opmod['o_id']);
                $delete_od->execute();
              }

              $delete_pm = $conn->prepare("DELETE FROM payment WHERE o_id = :o_id");
              $delete_pm->bindParam(':o_id' , $o_id);
              $delete_pm->execute();

              $delete_o = $conn->prepare("DELETE FROM orders WHERE o_id = :o_id");
              $delete_o->bindParam(':o_id' , $o_id);

              if ($delete_o->execute()) {

                  echo "<script>alert('ลบรายการสั่งซื้อ เรียบร้อย...!!')</script>";
                  echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?order\">";
                  exit;
              }

        } catch (PDOException $e) {

            echo $e->getMessage();

        }
          
    }

?>

