<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">เพิ่มโปรโมชั่น</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">โปรโมชั่น</li>
              <li class="breadcrumb-item active">เพิ่มโปรโมชั่น</li>
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
                <h3 class="card-title">ฟอร์ม เพิ่มโปรโมชั่น</h3>
              </div>

              <form action="" method="post" enctype="multipart/form-data">
                <div class="card-body">

                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                        <label>ชื่อโปรโมชั่น</label>
                        <input type="text" class="form-control" name="pr_name" placeholder="" required>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                        <label>รายละเอียด</label>
                        <textarea class="form-control" name="pr_detail" rows="3" placeholder="" required></textarea>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                        <label>เงื่อนไข เมื่อซื้อสิค้าราคาครบ (ก๊๋บาท)</label>
                        <input type="text" class="form-control" name="check_value" placeholder="" required>
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
                        <input type="text" class="form-control" name="pr_price" >
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                        <label>เปอร์เซ็นต์ ส่วนลด</label>
                        <input type="text" class="form-control" name="pr_percentage">
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                        <label>แต้มสะสม</label>
                        <input type="text" class="form-control" name="pr_points" placeholder="" required>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                        <label>วันที่เริ่มโปรโมชั่น</label>
                        <input type="date" class="form-control" name="str_date"  required>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                        <label>วันที่หมดเขตโปรโมชั่น</label>
                        <input type="date" class="form-control" name="sto_date" required>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                        <label>รูปภาพ</label>
                        <input id="chooseFile" type="file" class="form-control" name="pr_img" required>
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

            $pr_name        =  $_POST['pr_name'];
            $pr_detail      =  $_POST['pr_detail'];	
            $check_value    =  $_POST['check_value'];
            $pr_price       =  $_POST['pr_price'];
            $pr_percentage  =  $_POST['pr_percentage'];
            $pr_points      =  $_POST['pr_points'];
            $pr_img         =  file_get_contents($_FILES['pr_img']['tmp_name']);
            $str_date       =  $_POST['str_date'];
            $sto_date       =  $_POST['sto_date'];

            if (isset($pr_name)) {

                $select_check = $conn->prepare("SELECT pr_name FROM promotion WHERE pr_name = :pr_name");
                $select_check->bindParam("pr_name"   , $pr_name);
				        $select_check->execute();

                while ($row_check = $select_check->fetch(PDO::FETCH_ASSOC)) {

                    $dbpr_name  =  $row_check['pr_name'];

                }

                if ($select_check->rowCount() > 0) {

                    if ($pr_name == $dbpr_name){

                        echo "<script>alert('มีชื่อโปรโมชั่นนี้ อยู่ในระบบแล้ว..!!')</script>";
                        echo"<script>window.location='javascript:history.back(-1)';</script>";
                        exit;

                    } 

                } else {

                    try {

                        $insert_pr = $conn->prepare("INSERT INTO promotion (pr_name, pr_detail, check_value, pr_price, pr_percentage, pr_points, pr_img, str_date, sto_date) 
                                                            VALUES (:pr_name, :pr_detail, :check_value, :pr_price, :pr_percentage, :pr_points, :pr_img, :str_date, :sto_date)
                                                    ");
                        $insert_pr->bindParam(':pr_name'        ,  $pr_name);
                        $insert_pr->bindParam(':pr_detail'      ,  $pr_detail);
                        $insert_pr->bindParam(':check_value'    ,  $check_value);
                        $insert_pr->bindParam(':pr_price'       ,  $pr_price);
                        $insert_pr->bindParam(':pr_percentage'  ,  $pr_percentage);
                        $insert_pr->bindParam(':pr_points'      ,  $pr_points);
                        $insert_pr->bindParam(':pr_img'         ,  $pr_img);
                        $insert_pr->bindParam(':str_date'       ,  $str_date);
                        $insert_pr->bindParam(':sto_date'       ,  $sto_date);
                        
                        if ($insert_pr->execute()) {
                            
                            echo "<script>alert('เพิ่มโปรโมชั่น เรียบร้อย...!!')</script>";
                            echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?promotion\">";
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



