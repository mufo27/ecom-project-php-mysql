<?php 

    require_once '../database/con_db.php'; 

    if (isset($_GET['promotion_form_edit'])) {

        try {

            $pr_id = $_GET['promotion_form_edit'];
            $select_pr = $conn->prepare("SELECT * FROM promotion WHERE pr_id = :pr_id");
            $select_pr->bindParam(':pr_id' , $pr_id);
            $select_pr->execute();
            $row_pr = $select_pr->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {

            $e->getMessage();

        }

    }

?>

    <div class="content-header">    
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">แก้ไขโปรโมชั่น</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">โปรโมชั่น</li>
              <li class="breadcrumb-item active">แก้ไขโปรโมชั่น</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
 
          <div class="col-md-12">

            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">ฟอร์ม แก้ไขโปรโมชั่น</h3>
              </div>

              <form action="" method="post" enctype="multipart/form-data">
                <div class="card-body">

                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                        <label>ชื่อโปรโมชั่น</label>
                        <input type="text" class="form-control" name="pr_name" value="<?= $row_pr['pr_name']; ?>" >
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                        <label>รายละเอียด</label>
                        <textarea class="form-control" name="pr_detail" rows="3" ><?= $row_pr['pr_detail']; ?></textarea>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                        <label>เงื่อนไข เมื่อซื้อสิค้าราคาครบ (ก๊๋บาท)</label>
                        <input type="text" class="form-control" name="check_value" value="<?= $row_pr['check_value']; ?>">
                    </div>
                  </div>
                  <div class="col-12 text-center">
                    <div class="form-group">
                        <h1 class="text-info">รับส่วนลด</h1>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                        <label>ราคา ส่วนลด</label>
                        <input type="text" class="form-control" name="pr_price" value="<?= $row_pr['pr_price']; ?>">
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                        <label>เปอร์เซ็นต์ ส่วนลด</label>
                        <input type="text" class="form-control" name="pr_percentage" value="<?= $row_pr['pr_percentage']; ?>">
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                        <label>แต้มสะสม</label>
                        <input type="text" class="form-control" name="pr_points" value="<?= $row_pr['pr_points']; ?>">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                        <label>วันที่เริ่มโปรโมชั่น</label>
                        <input type="date" class="form-control" name="str_date" value="<?= $row_pr['str_date']; ?>">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                        <label>วันที่หมดเขตโปรโมชั่น</label>
                        <input type="date" class="form-control" name="sto_date" value="<?= $row_pr['sto_date']; ?>">
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                        <label>รูปภาพ</label>
                        <input id="chooseFile" type="file" class="form-control" name="pr_img" value="">
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                        <div class="row">

                          <div class="col-3">
                            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row_pr['pr_img']).'" width="250" height="150"/>'; ?>
                          </div>

                          <div class="col-2 mt-5"><h2>เปลียนเป็น</h2></div>

                          <div class="col-3">
                            <div class="imgGallery"></div>
                          </div>

                        </div>
                    </div>
                  </div>
                </div>

                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-success" name="edit" value="<?= $row_pr['pr_id']; ?>"><i class="fas fa-save"></i> บันทึกข้อมูล</button>
                  <button type="reset" class="btn btn-warning"><i class="fas fa-undo"></i> รีเซ็ต</button>
                </div>
              </form>

            </div>

          </div>

        </div>

      <div class="row mt-2">
				<div class="col-10"></div>
				<div class="col-2">
					<div class="row">
						<button type="submit" class="btn btn-danger" name="back" onclick="history.go(-1)"><i class="fas fa-arrow-circle-left"></i> ย้อนกลับ</button>
					</div>
				</div>
			</div>

      </div>
    </section>

    <div class="row mt-5"></div>


<?php

        if (isset($_POST['edit'])) {

            $pr_id          =  $_POST['edit'];
            $pr_name        =  $_POST['pr_name'];
            $pr_detail      =  $_POST['pr_detail'];
            $check_value    =  $_POST['check_value'];
            $pr_price       =  $_POST['pr_price'];
            $pr_percentage  =  $_POST['pr_percentage'];
            $pr_points      =  $_POST['pr_points'];
            $str_date       =  $_POST['str_date'];
            $sto_date       =  $_POST['sto_date'];
            
            $pr_img         =  file_get_contents($_FILES['pr_img']['tmp_name']);
            
            try {

                $update_pr = $conn->prepare("UPDATE promotion SET pr_name       = :pr_name,
                                                                  pr_detail     = :pr_detail,
                                                                  check_value   = :check_value,
                                                                  pr_price      = :pr_price,
                                                                  pr_percentage = :pr_percentage,
                                                                  pr_points     = :pr_points,
                                                                  pr_img        = :pr_img,
                                                                  str_date      = :str_date,
                                                                  sto_date      = :sto_date

                                                              WHERE pr_id = :pr_id"
                                            );

                $update_pr->bindParam(':pr_id'          ,  $pr_id);
                $update_pr->bindParam(':pr_name'        ,  $pr_name);
                $update_pr->bindParam(':pr_detail'      ,  $pr_detail);
                $update_pr->bindParam(':check_value'    ,  $check_value);
                $update_pr->bindParam(':pr_price'       ,  $pr_price);
                $update_pr->bindParam(':pr_percentage'  ,  $pr_percentage);
                $update_pr->bindParam(':pr_points'      ,  $pr_points);
                $update_pr->bindParam(':pr_img'         ,  $pr_img);
                $update_pr->bindParam(':str_date'       ,  $str_date);
                $update_pr->bindParam(':sto_date'       ,  $sto_date);

                if ($update_pr->execute()) {
                    
                    echo "<script>alert('แก้ไขข้อมูลโปรโมชั่น เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?promotion\">";
                    exit;
                }

            } catch (PDOException $e) {

                echo $e->getMessage();

            } 
               
        }

?>


