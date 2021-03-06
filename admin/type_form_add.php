    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">เพิ่มประเภทสินค้า</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">ประเภทสินค้า</li>
              <li class="breadcrumb-item active">เพิ่มประเภทสินค้า</li>
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
                <h3 class="card-title">ฟอร์ม เพิ่มประเภทสินค้า</h3>
              </div>

              <form action="" method="post" enctype="multipart/form-data">
                <div class="card-body">

                  <div class="form-group">
                    <label>ชื่อประเภทสินค้า</label>
                    <input type="text" class="form-control" name="t_name" placeholder="" required>
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

        require_once '../database/con_db.php';

        if (isset($_POST['add'])) {

            $t_name   =  $_POST['t_name'];

            if (isset($t_name)) {

                $select_check = $conn->prepare("SELECT t_name FROM type WHERE t_name = :t_name");
                $select_check->bindParam("t_name"   , $t_name);
				        $select_check->execute();

                while ($row_check = $select_check->fetch(PDO::FETCH_ASSOC)) {

                    $dbt_name   =  $row_check['t_name'];

                }

                if ($select_check->rowCount() > 0) {

                    if ($t_name == $dbt_name){

                        echo "<script>alert('มีชื่อประเภทสินค้านี้ อยู่ในระบบแล้ว..!!')</script>";
                        echo"<script>window.location='javascript:history.back(-1)';</script>";
                        exit;

                    } 

                } else {

                    try {

                        $insert_type= $conn->prepare("INSERT INTO type(t_name) VALUES (:t_name)");
                        $insert_type->bindParam(':t_name' , $t_name);
                        
                        if ($insert_type->execute()) {
                            
                            echo "<script>alert('เพิ่มข้อมูลประเภทสินค้า เรียบร้อย...!!')</script>";
                            echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?type\">";
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



