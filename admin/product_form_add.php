<?php 
    require_once '../database/con_db.php'; 
?>

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">เพิ่มสินค้า</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">สินค้า</li>
              <li class="breadcrumb-item active">เพิ่มสินค้า</li>
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
                <h3 class="card-title">ฟอร์ม เพิ่มสินค้า</h3>
              </div>

              <form action="" method="post" enctype="multipart/form-data">
                <div class="card-body">

                    <div class="row">

                        <div class="col-6">
                            <div class="form-group">
                                <label>ประเภทสินค้า</label>
                                <select name="t_id" class="form-control" required>
                                    <option value="">-- เลือก --</option>
                                    <?php 	
                                          $select_type = $conn->prepare("SELECT * FROM type");
                                          $select_type->execute();
                                          while ($row_type = $select_type->fetch(PDO::FETCH_ASSOC)) 
                                          { 
                                    ?>
                                    <option value="<?= $row_type['t_id']; ?>"> <?= $row_type['t_name']; ?> </option>
                                    <?php } ?>
                                </select>             
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>ชื่อสินค้า</label>
                                <input type="text" class="form-control" name="p_name" placeholder="" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label>รายละเอียด</label>
                                <textarea class="form-control" name="p_detail" rows="3" placeholder="" required></textarea>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label>ราคา</label>
                                <input type="text" class="form-control" name="p_price" placeholder="" required>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label>จำนวน</label>
                                <input type="text" class="form-control" name="p_number" placeholder="" required>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label>แต้มสะสม</label>
                                <input type="text" class="form-control" name="p_poits" placeholder="" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label>รูปภาพ</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input id="chooseFile" type="file" class="form-control" id="exampleInputFile" name="p_img">
                                    </div>
                                </div>
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

        if (isset($_POST['add'])) {

            $p_name    =  $_POST['p_name'];
            $p_detail  =  $_POST['p_detail'];
            $p_price   =  $_POST['p_price'];
            $p_number  =  $_POST['p_number'];
            $p_poits   =  $_POST['p_poits'];
            $p_img     =  file_get_contents($_FILES['p_img']['tmp_name']);
            $t_id      =  $_POST['t_id'];
            $p_new     =  0;

            $number = 0 ;
            $top_select = 0 ;

            if (isset($p_name)) {

                $select_check = $conn->prepare("SELECT p_name FROM product WHERE p_name = :p_name");
                $select_check->bindParam("p_name" , $p_name);
				$select_check->execute();

                while ($row_check = $select_check->fetch(PDO::FETCH_ASSOC)) {

                    $dbp_name   =  $row_check['p_name'];

                }

                if ($select_check->rowCount() > 0) {

                    if ($p_name == $dbp_name){

                        echo "<script>alert('มีชื่อสินค้านี้ อยู่ในระบบแล้ว..!!')</script>";
                        echo"<script>window.location='javascript:history.back(-1)';</script>";
                        exit;

                    } 

                } else {

                    if (isset($_FILES["p_img"])) {

                        try {

                            $insert_product= $conn->prepare("INSERT INTO product(p_name, p_detail, p_price, p_number, p_poits, p_img, t_id, p_new) 
                                                                    VALUES (:p_name, :p_detail, :p_price, :p_number, :p_poits, :p_img, :t_id, :p_new)
                                                            ");
                            $insert_product->bindParam(':p_name'   , $p_name);
                            $insert_product->bindParam(':p_detail' , $p_detail);
                            $insert_product->bindParam(':p_price'  , $p_price);
                            $insert_product->bindParam(':p_number' , $p_number);
                            $insert_product->bindParam(':p_poits'  , $p_poits);
                            $insert_product->bindParam(':p_img'    , $p_img);
                            $insert_product->bindParam(':t_id'     , $t_id);
                            $insert_product->bindParam(':p_new'     , $p_new);
                            $insert_product->execute();
                            $last_id = $conn->lastInsertId();

                            $insert_top5 = $conn->prepare("INSERT INTO top5(p_id, number, top_select) VALUES (:p_id, :number, :top_select)");
                            $insert_top5->bindParam(':p_id'        , $last_id);
                            $insert_top5->bindParam(':number'      , $number);
                            $insert_top5->bindParam(':top_select'  , $top_select);

                            if ($insert_top5->execute()) {
                                
                                echo "<script>alert('เพิ่มข้อมูลประเภทสินค้า เรียบร้อย...!!')</script>";
                                echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?product\">";
                                exit;
                            }

                        } catch (PDOException $e) {
            
                            echo $e->getMessage();
            
                        }
                    }

                } 

            } else {

                echo "<script>alert('เกิดข้อผิดพลาด..!!')</script>";
                echo"<script>window.location='javascript:history.back(-1)';</script>";

            }
            
        }

?>


