<?php 
		require_once '../database/con_db.php';        
?>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">แนะนำสินค้ามาใหม่</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">แนะนำสินค้ามาใหม่</li>
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
                      <th class="text-center"></th>
                      <th class="text-center">วันที่เพิ่มสินค้า</th>
                      <th>ประเภท</th>
                      <th>สินค้า</th>
                      <th class="text-center">รูปภาพ</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php

                        $select_product = $conn->prepare("SELECT p.*, t.t_name FROM product p inner join type t ON t.t_id = p.t_id ORDER BY p_date DESC");
                        $select_product->execute();

                        $i = 1;
                        while ($row_product = $select_product->fetch(PDO::FETCH_ASSOC)) 
                        {

                    ?>

                        <tr>
                            <td class="text-center" width="5%"><?php echo $i++; ?></td>
                            <td class="text-center" width="15%">

                                <form action="" method="post" enctype="multipart/form-data">

                                    <?php 
                                            if($row_product['p_new'] === '0')
                                            { 
                                    ?>

                                            <button class="btn bg-primary" type="submit" name="new" value="<?= $row_product['p_id']; ?>">
                                                <i class="fas fa-hand-point-right"></i> แนะนำ
                                            </button>
                                            
                                    <?php 
                                            } else {
                                    ?>

                                            <button class="btn bg-danger" type="submit" name="cancel" value="<?= $row_product['p_id']; ?>">
                                                <i class="fas fa-trash-alt"></i> ยกเลิก
                                            </button>

                                    <?php
                                            }
                                    ?>
                                </form>

                            </td>
                            <td class="text-center" width="15%"><?=  DateThai($row_product['p_date']); ?></td>
                            <td width="20%"><?=  $row_product['t_name']; ?></td>
                            <td width="30%"><?=  $row_product['p_name']; ?></td>
                            <td class="text-center" width="15%">
                                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row_product['p_img']).'" width="75" height="50"/>'; ?>
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

        if (isset($_POST['new'])) {

            $p_id    =  $_POST['new'];
            $p_new   =  1;

            try {

                $update_new = $conn->prepare("UPDATE product SET p_new = :p_new WHERE p_id = :p_id");
                $update_new->bindParam(':p_id'  , $p_id);
                $update_new->bindParam(':p_new' , $p_new);

                if ($update_new->execute()) {
                    
                    echo "<script>alert('แนะนำสินค้ามาใหม่ เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?r_product\">";
                    exit;
                }

            } catch (PDOException $e) {

                echo $e->getMessage();

            } 
               
        }

        if (isset($_POST['cancel'])) {

            $p_id    =  $_POST['cancel'];
            $p_new   =  0;

            try {

                $update_cancel = $conn->prepare("UPDATE product SET p_new = :p_new WHERE p_id = :p_id");
                $update_cancel->bindParam(':p_id'  , $p_id);
                $update_cancel->bindParam(':p_new' , $p_new);

                if ($update_cancel->execute()) {
                    
                    echo "<script>alert('ยกเลิกสินค้ามาใหม่ เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?r_product\">";
                    exit;
                }

            } catch (PDOException $e) {

                echo $e->getMessage();

            } 
               
        }

?>