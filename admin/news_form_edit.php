<?php 

    require_once '../database/con_db.php'; 

    if (isset($_GET['news_form_edit'])) {

        try {

            $n_id = $_GET['news_form_edit'];
            $select_n = $conn->prepare("SELECT * FROM news WHERE n_id = :n_id");
            $select_n->bindParam(':n_id' , $n_id);
            $select_n->execute();
            $row_n = $select_n->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {

            $e->getMessage();

        }

    }

?>

    <div class="content-header">    
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">แก้ไขข่าวประชาสัมพันธ์</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">ข่าวประชาสัมพันธ์</li>
              <li class="breadcrumb-item active">แก้ไขข่าวประชาสัมพันธ์</li>
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
                <h3 class="card-title">ฟอร์ม ข่าวประชาสัมพันธ์</h3>
              </div>

              <form action="" method="post" enctype="multipart/form-data">
                <div class="card-body">

                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                        <label>ชื่อโปรโมชั่น</label>
                        <input type="text" class="form-control" name="n_name" value="<?= $row_n['n_name']; ?>" >
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                        <label>รายละเอียด</label>
                        <textarea class="form-control" name="n_detail" rows="3" ><?= $row_n['n_detail']; ?></textarea>
                    </div>
                  </div>
                  
                  <div class="col-12">
                    <div class="form-group">
                        <label>รูปภาพ</label>
                        <input id="chooseFile" type="file" class="form-control" name="n_img" value="">
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                        <div class="row">

                          <div class="col-3">
                            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row_n['n_img']).'" width="250" height="150"/>'; ?>
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
                  <button type="submit" class="btn btn-success" name="edit" value="<?= $row_n['n_id']; ?>"><i class="fas fa-save"></i> บันทึกข้อมูล</button>
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

            $n_id      =  $_POST['edit'];
            $n_name    =  $_POST['n_name'];
            $n_detail  =  $_POST['n_detail'];
            $n_img     =  file_get_contents($_FILES['n_img']['tmp_name']);
            
            try {

                $update_pr = $conn->prepare("UPDATE news SET  n_name    = :n_name,
                                                              n_detail  = :n_detail,
                                                              n_img     = :n_img

                                                        WHERE n_id = :n_id"
                                            );

                $update_pr->bindParam(':n_id'      ,  $n_id);
                $update_pr->bindParam(':n_name'    ,  $n_name);
                $update_pr->bindParam(':n_detail'  ,  $n_detail);
                $update_pr->bindParam(':n_img'     ,  $n_img);

                if ($update_pr->execute()) {
                    
                    echo "<script>alert('แก้ไขข่าวประชาสัมพันธ์ เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?news\">";
                    exit;
                }

            } catch (PDOException $e) {

                echo $e->getMessage();

            } 
               
        }

?>


