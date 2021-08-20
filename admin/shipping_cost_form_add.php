<?php 
    require_once '../database/con_db.php'; 
?>

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">เพิ่มค่าจัดส่งสินค้า</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">เค่าจัดส่งสินค้า</li>
              <li class="breadcrumb-item active">เพิ่มค่าจัดส่งสินค้า</li>
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
                <h3 class="card-title">ฟอร์ม เพิ่มค่าจัดส่งสินค้า</h3>
              </div>

              <form action="" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>ค่าจัดส่งสินค้า</label>
                                <input type="text" class="form-control" name="cost" required>
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

    <?php 

        if (isset($_POST['add'])) {

            $cost      =  $_POST['cost'];

            try {

              $insert_sc= $conn->prepare("INSERT INTO shipping_cost (cost) VALUES (:cost)");
              $insert_sc->bindParam(':cost' , $cost);
       
              if ($insert_sc->execute()) {
                  
                  echo "<script>alert('ตั้งค่าจัดส่งสินค้านี้ เรียบร้อย...!!')</script>";
                  echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?shipping_cost\">";
                  exit;

              } else {

                echo "<script>alert('เกิดข้อผิดพลาด..!!')</script>";
                echo"<script>window.location='javascript:history.back(-1)';</script>";

            }

            } catch (PDOException $e) {

                echo $e->getMessage();

            }                    
            
        }

?>

