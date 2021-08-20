<?php 

    require_once '../../database/con_db.php'; 

    if (isset($_GET['payment'])) {

        try {

            $pm_id = $_GET['payment'];
            $select_pm = $conn->prepare("SELECT pm.*, o.o_total FROM payment pm inner join orders o ON o.o_id = pm.o_id WHERE pm_id = :pm_id");
            $select_pm->bindParam(':pm_id' , $pm_id);
            $select_pm->execute();
            $row_pm = $select_pm->fetch(PDO::FETCH_ASSOC);

            $pay_total = $row_pm['o_total'];

        } catch (PDOException $e) {

            $e->getMessage();

        }

    }

?>

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">แจ้งหลักฐาน</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">การชำระเงิน</li>
              <li class="breadcrumb-item active">แจ้งหลักฐาน</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        
        <div class="row">
 
          <div class="col-md-8">

            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">แจ้งหลักฐาน</h3>
              </div>

              <form action="" method="post" enctype="multipart/form-data" >
                <div class="card-body">

                    <div class="row">

                        <div class="col-6">
                            <div class="form-group">
                                <label>เลขที่ใบสั่งซื้อ</label>
                                <input type="text" class="form-control" name="o_id" value="<?= $row_pm['o_id']; ?>">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>เลขที่ใบชำระเงิน</label>
                                <input type="text" class="form-control" name="pm_id" value="<?= $row_pm['pm_id']; ?>">

                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>จำนวนเงินโอน</label>
                                <input type="text" class="form-control" name="pm_total" value="<?= $row_pm['pm_total']; ?>">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>วันที่โอนชำระ</label>
                                <input type="date" class="form-control" name="pm_date" value="<?= $row_pm['pm_date']; ?>">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label>หลักฐาน(สลิปโอน)</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input id="chooseFile" type="file" class="form-control" name="pm_img" value="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <div class="row">

                                <?php if(isset($row_pm['pm_img'])){?>
                                <div class="col-3">
                                    <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row_pm['pm_img']).'" width="250" height="150"/>'; ?>
                                </div>

                                <div class="col-2 mt-5"><h2>เปลียนเป็น</h2></div>

                                <?php } ?>

                                <div class="col-3">
                                    <div class="imgGallery"></div>
                                </div>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="card-footer">

                  <button type="submit" class="btn btn-success" name="save" value="<?= $row_pm['pm_id']; ?>"><i class="fas fa-save"></i> บันทึกข้อมูล</button>
                  <button type="reset" class="btn btn-warning"><i class="fas fa-undo"></i> รีเซ็ต</button>

                </div>

            </form>

            </div>

          </div>

          <div class="col-md-4">

            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">ชำระด้วย Paypal</h3>
              </div>

                <div class="card-body">

                    <div class="row ">
                      <div class="col text-center">

                          <div id="paypal-button-container"></div>

                          <script src="https://www.paypal.com/sdk/js?client-id=AVffUIV1LnVntBSFl41L9-V0R8Qn4FXkZ6Go0qrZPkgEc9BTFVPNnnqhjSQ1emJk54SqBYh_Rc72G6Xb&currency=THB"></script>

                          <script>
                            paypal.Buttons({
                              style: {
                                  layout :'horizontal'
                              },
                              createOrder: function(data, actions) {
                                return actions.order.create({
                                  purchase_units: [{
                                    amount: {
                                      value: '<?= $pay_total; ?>',
                                      currency: 'THB'
                                    }
                                  }]
                                });
                              },
                              onApprove: function(data, actions) {
                                return actions.order.capture().then(function(details) {
                                  window.location.href='index.php?paypal=<?= $row_pm['pm_id']; ?>&number=<?= $pay_total; ?>';
                                });
                                
                              }
                            }).render('#paypal-button-container');
                          </script>


                      
                      </div>
                    </div>

                </div>

                <div class="card-footer"></div>
                
            
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

        if (isset($_POST['save'])) {

            $pm_id      =  $_POST['save'];
            $pm_total   =  $_POST['pm_total'];
            $pm_date    =  $_POST['pm_date'];
            $pm_img     =  file_get_contents($_FILES['pm_img']['tmp_name']);
            
            try {

                $save_pm = $conn->prepare("UPDATE payment SET pm_total=:pm_total, pm_date=:pm_date, pm_img=:pm_img WHERE pm_id = :pm_id");
                $save_pm->bindParam(':pm_id'     ,   $pm_id);
                $save_pm->bindParam(':pm_total'   ,  $pm_total);
                $save_pm->bindParam(':pm_date'   ,   $pm_date);
                $save_pm->bindParam(':pm_img'    ,   $pm_img);
                
                if ($save_pm->execute()) {
                    
                    echo "<script>alert('แจ้งหลักฐานชำระเงิน เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?status_pay\">";
                    exit;
                }

            } catch (PDOException $e) {

                echo $e->getMessage();

            }   
            
        }

?>

