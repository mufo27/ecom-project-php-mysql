<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">เพิ่มข่าวประชาสัมพันธ์</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">ข่าวประชาสัมพันธ์</li>
              <li class="breadcrumb-item active">เพิ่มข่าวประชาสัมพันธ์</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
 
          <div class="col-md-12">

            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">ฟอร์ม เพิ่มข่าวประชาสัมพันธ์</h3>
              </div>

              <form action="" method="post" enctype="multipart/form-data">
                <div class="card-body">

                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                        <label>หัวข้อข่าวประชาสัมพันธ์</label>
                        <input type="text" class="form-control" name="n_name" required>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                        <label>รายละเอียด</label>
                        <textarea class="form-control" name="n_detail" rows="3" required></textarea>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                        <label>รูปภาพ</label>
                        <input id="chooseFile" type="file" class="form-control" name="n_img" required>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                        <div class="imgGallery"></div>
                    </div>
                  </div>
                </div>
                
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-success" name="add"><i class="fas fa-save"></i> บันทึกข้อมูล</button>
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

        require_once '../database/con_db.php';

        if (isset($_POST['add'])) {

            $n_name        =  $_POST['n_name'];
            $n_detail      =  $_POST['n_detail'];
            $n_img         =  file_get_contents($_FILES['n_img']['tmp_name']);

            if (isset($n_name)) {

                $select_check = $conn->prepare("SELECT n_name FROM news WHERE n_name = :n_name");
                $select_check->bindParam("n_name"   , $n_name);
				        $select_check->execute();

                while ($row_check = $select_check->fetch(PDO::FETCH_ASSOC)) {

                    $dbn_name =  $row_check['n_name'];

                }

                if ($select_check->rowCount() > 0) {

                    if ($n_name == $dbn_name){

                        echo "<script>alert('มีหัวข้อข่าวประชาสัมพันธ์นี้ อยู่ในระบบแล้ว..!!')</script>";
                        echo"<script>window.location='javascript:history.back(-1)';</script>";
                        exit;

                    } 

                } else {

                    try {

                        $insert_n = $conn->prepare("INSERT INTO news (n_name, n_detail, n_img) VALUES (:n_name, :n_detail, :n_img)");
                        $insert_n->bindParam(':n_name'     ,  $n_name);
                        $insert_n->bindParam(':n_detail'   ,  $n_detail);
                        $insert_n->bindParam(':n_img'      ,  $n_img);

                        if ($insert_n->execute()) {
                            
                            echo "<script>alert('เพิ่มหัวข้อข่าวประชาสัมพันธ์ เรียบร้อย...!!')</script>";
                            echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?news\">";
                            exit;
                        }

                    } catch (PDOException $e) {
        
                        echo $e->getMessage();
        
                    }
                } 

            } else {

                echo "<script>alert('เกิดข้อผิดพลาด..!!')</script>";
                echo"<script>window.location='javascript:history.back(-1)';</script>";

            }
            
        }

?>



