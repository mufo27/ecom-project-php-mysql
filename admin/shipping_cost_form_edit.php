<?php 

    require_once '../database/con_db.php'; 

    if (isset($_GET['shipping_cost_form_edit'])) {

        try {

            $sc_id = $_GET['shipping_cost_form_edit'];
            $select_sc = $conn->prepare("SELECT *FROM shipping_cost sc WHERE sc_id = :sc_id");
            $select_sc->bindParam(':sc_id' , $sc_id);
            $select_sc->execute();
            $row_sc = $select_sc->fetch(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {

            $e->getMessage();

        }

    }

?>

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">แก้ไขค่าจัดส่งสินค้า</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">ค่าจัดส่งสินค้า</li>
              <li class="breadcrumb-item active">แก้ไขค่าจัดส่งสินค้า</li>
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
                <h3 class="card-title">ฟอร์ม แก้ไขค่าจัดส่งสินค้า</h3>
              </div>

              <form action="" method="post" enctype="multipart/form-data">
                <div class="card-body">

                    <div class="row">

                        <div class="col-12">
                            <div class="form-group">
                                <label>ราคา</label>
                                <input type="text" class="form-control" name="cost" value="<?= $row_sc['cost']; ?>">
                            </div>
                        </div>

                    </div>

                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-success" name="edit" value="<?= $row_sc['sc_id']; ?>"><i class="fas fa-save"></i> บันทึกข้อมูล</button>
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

            $sc_id  =  $_POST['edit'];
            $cost   =  $_POST['cost'];
            
            try {

                $update_sc= $conn->prepare("UPDATE shipping_cost SET cost=:cost WHERE sc_id = :sc_id");
                $update_sc->bindParam(':sc_id' , $sc_id);
                $update_sc->bindParam(':cost'  , $cost);

                if ($update_sc->execute()) {
                    
                    echo "<script>alert('แก้ไขค่าจัดส่งสินค้านี้ เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?shipping_cost\">";
                    exit;
                }

            } catch (PDOException $e) {

                echo $e->getMessage();

            }   
            
        }

?>

