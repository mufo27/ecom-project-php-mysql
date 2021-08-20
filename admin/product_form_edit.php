<?php 

    require_once '../database/con_db.php'; 

    if (isset($_GET['product_form_edit'])) {

        try {

            $p_id = $_GET['product_form_edit'];
            $select_product = $conn->prepare("SELECT p.*, t.t_name FROM product p inner join type t ON t.t_id = p.t_id WHERE p_id = :p_id");
            $select_product->bindParam(':p_id' , $p_id);
            $select_product->execute();
            $row_product = $select_product->fetch(PDO::FETCH_ASSOC);
            

        } catch (PDOException $e) {

            $e->getMessage();

        }

    }

?>

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">แก้ไขสินค้า</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">สินค้า</li>
              <li class="breadcrumb-item active">แก้ไขสินค้า</li>
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
                <h3 class="card-title">ฟอร์ม แก้ไขสินค้า</h3>
              </div>

              <form action="" method="post" enctype="multipart/form-data">
                <div class="card-body">

                    <div class="row">

                        <div class="col-6">
                            <div class="form-group">
                                <label>ประเภทสินค้า</label>
                                <select name="t_id" class="form-control" required>
                                    <option value="<?= $row_product['t_id']; ?>">-- <?= $row_product['t_name']; ?> --</option>
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
                                <input type="text" class="form-control" name="p_name" value="<?= $row_product['p_name']; ?>">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label>รายละเอียด</label>
                                <textarea class="form-control" name="p_detail" rows="3" ><?= $row_product['p_detail']; ?></textarea>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label>ราคา</label>
                                <input type="text" class="form-control" name="p_price" value="<?= $row_product['p_price']; ?>">
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label>จำนวน</label>
                                <input type="text" class="form-control" name="p_number" value="<?= $row_product['p_number']; ?>">
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label>แต้มสะสม</label>
                                <input type="text" class="form-control" name="p_poits" value="<?= $row_product['p_poits']; ?>">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label>รูปภาพ</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input id="chooseFile" type="file" class="form-control" name="p_img" value="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <div class="row">

                                <div class="col-3">
                                    <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row_product['p_img']).'" width="250" height="150"/>'; ?>
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
                  <button type="submit" class="btn btn-success" name="edit" value="<?= $row_product['p_id']; ?>"><i class="fas fa-save"></i> บันทึกข้อมูล</button>
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

            $p_id      =  $_POST['edit'];
            $p_name    =  $_POST['p_name'];
            $p_detail  =  $_POST['p_detail'];
            $p_price   =  $_POST['p_price'];
            $p_number  =  $_POST['p_number'];
            $p_poits   =  $_POST['p_poits'];
            $p_img     =  file_get_contents($_FILES['p_img']['tmp_name']);
            $t_id      =  $_POST['t_id'];
            
            try {

                $update_product= $conn->prepare("UPDATE product SET p_name   = :p_name,
                                                                    p_detail = :p_detail, 
                                                                    p_price  = :p_price, 
                                                                    p_number = :p_number, 
                                                                    p_poits  = :p_poits, 
                                                                    p_img    = :p_img, 
                                                                    t_id     = :t_id
                                                                WHERE p_id = :p_id
                                                ");
                $update_product->bindParam(':p_id'     , $p_id);
                $update_product->bindParam(':p_name'   , $p_name);
                $update_product->bindParam(':p_detail' , $p_detail);
                $update_product->bindParam(':p_price'  , $p_price);
                $update_product->bindParam(':p_number' , $p_number);
                $update_product->bindParam(':p_poits'  , $p_poits);
                $update_product->bindParam(':p_img'    , $p_img);
                $update_product->bindParam(':t_id'     , $t_id);
                
                if ($update_product->execute()) {
                    
                    echo "<script>alert('แก้ไขข้อมูลสินค้า เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?product\">";
                    exit;
                }

            } catch (PDOException $e) {

                echo $e->getMessage();

            }   
            
        }

?>

