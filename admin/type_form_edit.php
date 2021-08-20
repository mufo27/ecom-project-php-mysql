<?php 

    require_once '../database/con_db.php'; 

    if (isset($_GET['type_form_edit'])) {

        try {

            $t_id = $_GET['type_form_edit'];
            $select_type = $conn->prepare("SELECT * FROM type WHERE t_id = :t_id");
            $select_type->bindParam(':t_id' , $t_id);
            $select_type->execute();
            $row_type = $select_type->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {

            $e->getMessage();

        }

    }

?>

    <div class="content-header">    
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">แก้ไขประเภทสินค้า</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">ประเภทสินค้า</li>
              <li class="breadcrumb-item active">แก้ไขประเภทสินค้า</li>
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
                <h3 class="card-title">ฟอร์ม แก้ไขประเภทสินค้า</h3>
              </div>

              <form action="" method="post" enctype="multipart/form-data">
                <div class="card-body">

                  <div class="form-group">
                    <label>ชื่อประเภทสินค้า</label>
                    <input type="text" class="form-control" name="t_name" value="<?= $row_type['t_name']; ?>" placeholder="ชื่อประเภทสินค้า" required>
                  </div>

                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-success" name="edit" value="<?= $row_type['t_id']; ?>"><i class="fas fa-save"></i> บันทึกข้อมูล</button>
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

<?php

        if (isset($_POST['edit'])) {

            $t_id    =  $_POST['edit'];
            $t_name  =  $_POST['t_name'];

            try {

                $update_type= $conn->prepare("UPDATE type SET t_name = :t_name WHERE t_id = :t_id");
                $update_type->bindParam(':t_id'   , $t_id);
                $update_type->bindParam(':t_name' , $t_name);

                if ($update_type->execute()) {
                    
                    echo "<script>alert('อัพเดทข้อมูลปรเภทสินค้า เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?type\">";
                    exit;
                }

            } catch (PDOException $e) {

                echo $e->getMessage();

            } 
               
        }

?>


