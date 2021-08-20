<?php 
		require_once '../database/con_db.php';        
?>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">สินค้าขายดี</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">สินค้าขายดี</li>
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
                      <th></th>
                      <th>ประเภท</th>
                      <th>สินค้า</th>
                      <th  class="text-center">ขายแล้ว (เรียง มาก -> น้อย)</th>
                      <th class="text-center">รูปภาพ</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php

                            $select_p5 = $conn->prepare("SELECT p.p_id, p.p_name, p.p_img, t.t_name, tp.*   FROM product p inner join type t ON t.t_id = p.t_id 
                                                                                                           inner join top5 tp on tp.p_id = p.p_id  
                                                                                            ORDER BY tp.number DESC");
                            $select_p5->execute();

                            $i=1;
                            while ($row_p5 = $select_p5->fetch(PDO::FETCH_ASSOC)) 
                            {

                    ?>

                        <tr>
                            <td class="text-center" width="5%"><?php echo $i++; ?></td>
                            <td class="text-center" width="15%">

                                <form action="" method="post" enctype="multipart/form-data">

                                    <?php 
                                            if($row_p5['top_select'] === '0')
                                            { 
                                    ?>

                                            <button class="btn bg-primary" type="submit" name="s_good" value="<?= $row_p5['top_id']; ?>">
                                                <i class="fas fa-hand-point-right"></i> สินค้าขายดี
                                            </button>
                                            
                                    <?php 
                                            } else {
                                    ?>

                                            <button class="btn bg-danger" type="submit" name="cancel" value="<?= $row_p5['top_id']; ?>">
                                                <i class="fas fa-trash-alt"></i> ยกเลิก
                                            </button>

                                    <?php
                                            }
                                    ?>
                                </form>

                            </td>
                            
                            <td width="15%"><?=  $row_p5['t_name']; ?></td>
                            <td width="20%"><?=  $row_p5['p_name']; ?></td>  
                            <td  class="text-center" width="25%"><?=  $row_p5['number']; ?></td>  
                            <td class="text-center" width="15%">
                                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row_p5['p_img']).'" width="100" height="75"/>'; ?>
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

        if (isset($_POST['s_good'])) {

            $top_id    =  $_POST['s_good'];
            $top_select   =  1;

            try {

                $update_top5= $conn->prepare("UPDATE top5 SET top_select = :top_select WHERE top_id = :top_id");
                $update_top5->bindParam(':top_id'  , $top_id);
                $update_top5->bindParam(':top_select' , $top_select);

                if ($update_top5->execute()) {
                    
                    echo "<script>alert('เลือกสินค้าขายดี เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?top5_product\">";
                    exit;
                }

            } catch (PDOException $e) {

                echo $e->getMessage();

            } 
               
        }

        if (isset($_POST['cancel'])) {

            $top_id    =  $_POST['cancel'];
            $top_select   =  0;

            try {

                $update_cancel = $conn->prepare("UPDATE top5 SET top_select = :top_select WHERE top_id = :top_id");
                $update_cancel->bindParam(':top_id'  , $top_id);
                $update_cancel->bindParam(':top_select' , $top_select);

                if ($update_cancel->execute()) {
                    
                    echo "<script>alert('ยกเลิกสินค้าขายดี เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?top5_product\">";
                    exit;
                }

            } catch (PDOException $e) {

                echo $e->getMessage();

            } 
               
        }

?>
    