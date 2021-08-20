<?php 
		require_once '../database/con_db.php'; 

    $o_id = $_GET['o_detail'];

    $select_o = $conn->prepare("SELECT * FROM orders WHERE o_id = :o_id");
    $select_o->bindParam("o_id" , $o_id);
    $select_o->execute();
    $row_o = $select_o->fetch(PDO::FETCH_ASSOC);

    if(isset($row_o['u_id'])){

      $select_ad = $conn->prepare("SELECT * FROM users WHERE u_id = :u_id");
      $select_ad->bindParam("u_id" , $row_o['u_id']);
      $select_ad->execute();
      $row_ad = $select_ad->fetch(PDO::FETCH_ASSOC);

      $name       =   $row_ad['full_name'];
      $phone      =   $row_ad['phone'];
      $email      =   $row_ad['email'];
      $a_number   =   $row_ad['a_number'];
      $a_tambon   =   $row_ad['a_tambon'];
      $a_ampher   =   $row_ad['a_ampher'];
      $a_privice  =   $row_ad['a_privice'];
      $a_post     =   $row_ad['a_post'];

    }
    if(isset($row_o['FB_ID'])){

      $select_fb = $conn->prepare("SELECT * FROM tb_facebook WHERE FACEBOOK_ID = :FACEBOOK_ID");
      $select_fb->bindParam("FACEBOOK_ID" , $row_o['FB_ID']);
      $select_fb->execute();
      $row_fb = $select_fb->fetch(PDO::FETCH_ASSOC);

      $name       =   $row_fb['full_name'];
      $phone      =   $row_fb['a_phone'];
      $email      =   $row_fb['EMAIL'];
      $a_number   =   $row_fb['a_number'];
      $a_tambon   =   $row_fb['a_tambon'];
      $a_ampher   =   $row_fb['a_ampher'];
      $a_privice  =   $row_fb['a_privice'];
      $a_post     =   $row_fb['a_post'];

    }

    $select_sc = $conn->prepare("SELECT * FROM shipping_cost");
    $select_sc->execute();
    $row_sc = $select_sc->fetch(PDO::FETCH_ASSOC);


?>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">รายละเอียด</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">รายการสั่งซื้อสินค้า</li>
              <li class="breadcrumb-item active">รายละเอียด</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                    <h3>เลขที่ใบสั่งซื้อ : <?= $_GET['o_detail'];?></h3>
              </div>
              <div class="card-body">
                <table id="mytable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="text-center">ลำดับ</th>
                      <th class="text-center">รูปภาพ</th>
                      <th>ชื้อสินค้า</th>
                      <th class="text-center">ราคาสินค้า</th>
                      <th class="text-center">จำนวนสินค้า</th>
                      <th class="text-center">แต้มสะสม</th>
                      <th class="text-center">ราคารวมสินค้า</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    
                        $select_od = $conn->prepare("SELECT o.o_total, o.pr_id, od.*, p.p_name, p.p_price, p.p_poits, p.p_img FROM orders o inner join order_detail od  ON o.o_id = od.o_id
                                                                                                                        inner join product p ON p.p_id = od.p_id 
                                                                                                          WHERE od.o_id = :o_id");
                        $select_od->bindParam("o_id" , $o_id);
                        $select_od->execute();

                        $total = 0;
                        $poits = 0;

                        $i = 1;
                        while ($row_od = $select_od->fetch(PDO::FETCH_ASSOC)) 
                        {
                          $price = $row_od['p_price'] * $row_od['od_number'];  
                          $total += $price; 
                          $poits += $row_od['p_poits']; 
                          $o_total = $row_od['o_total'];
                          $pr_id = $row_od['pr_id'];
                          

                    ?>

                        <tr>
                            <td class="text-center" width="5%"><?php echo $i++; ?></td>    
                            <td class="text-center" width="10%">
                                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row_od['p_img']).'" width="150" height="75"/>'; ?>  
                            </td>                  
                            <td  width="15%"><?=  $row_od['p_name']; ?></td>
                            <td class="text-center" width="8%"><?=  $row_od['p_price']; ?></td>
                            <td class="text-center" width="8%"><?=  $row_od['od_number']; ?></td>
                            <td class="text-center" width="10%"><?=  $row_od['p_poits']; ?></td>
                            <td class="text-center" width="10%"><?=  $price;?></td>
                        </tr>

                    <?php } ?>

                    <?php
                         $select_pro = $conn->prepare("SELECT * FROM promotion WHERE pr_id = :pr_id");
                         $select_pro->bindParam("pr_id" , $pr_id);
                         $select_pro->execute();
                         $row_pro = $select_pro->fetch(PDO::FETCH_ASSOC);

                        if(isset($row_pro['pr_id'])) 
                        {
                           $show_points = $poits + $row_pro['pr_points'];
                    ?>

                        <tr> 
                            <td colspan="5" class="text-right"></td>
                            <td class="text-center">
                                                <div class="row mt-3"></div> 
                              <h5>รวมแต้ม = <?= $poits; ?></h5>
                              <div class="row mt-3"></div> 
                            </td>
                            <td class="text-center">
                                                <div class="row mt-3"></div> 
                              <h5>รวมราคา = <?= $total; ?></h5>
                              <div class="row mt-3"></div> 
                            </td>
                        </tr>

                        <tr> 
                            <td colspan="5">
                            <div class="row mt-3"></div> 

                              <h5><?= $row_pro['pr_name']; ?></h5>
                              <p><?= $row_pro['pr_detail']; ?></p>
                              <div class="row mt-3"></div> 
                            </td>
                            <td class="text-center text-info">
                                                <div class="row mt-4"></div> 
                              <h5>รับแต้ม = <?= $row_pro['pr_points']; ?></h5>
                              <div class="row mt-3"></div> 
                            </td>
                            <td class="text-center text-danger">

                                <div class="row mt-4"></div> 

                                <?php if($row_pro['pr_price'] != 0){?>
                                  <h5 class="text-danger">ส่วนลด = <?= $row_pro['pr_price']; ?> บาท</h5>
                                <?php } ?>
                                <?php if($row_pro['pr_percentage'] != 0){?>
                                  <h5 class="text-danger">ส่วนลด = <?= $row_pro['pr_percentage']; ?> %</h5>
                                <?php } ?>

                                <div class="row mt-3"></div> 

                            </td>
                        </tr>
                        <?php 
                        
                          } else {

                            $show_points = $poits;

                          }
                          
                        ?>

                        <tr> 
                            <td colspan="5" class="text-right">

                                <div class="row mt-3"></div> 
                                  <h5>ค่าจัดส่งสินค้า</h5>
                                <div class="row mt-3"></div> 

                            </td>
                            <td colspan="2" class="text-center">

                                <div class="row mt-4"></div> 

                                  <h5><?= $row_sc['cost'] ?> บาท</h5>

                                <div class="row mt-3"></div> 

                            </td>
                        </tr>

                        <tr> 
                            <td colspan="7" class="text-center">
                              
                              <div class="row mt-3"></div> 
                                <h2 class="text-primary">ผลลัพธ์</h2>
                              <div class="row mt-3"></div>   
                              
                            </td>
                        </tr>

                        <tr> 
                            <td colspan="5" class="text-right">

                                <div class="row mt-3"></div> 
                                  <h4 class="text-success">ได้รับแต้มสะสม รวมทั้งหมด</h4>
                                <div class="row mt-3"></div> 

                            </td>
                            <td colspan="2" class="text-center">

                                <div class="row mt-4"></div> 

                                  <h4 class="text-success">+<?= $show_points; ?> แต้ม</h4>

                                <div class="row mt-3"></div> 

                            </td>
                        </tr>

                        <tr> 
                            <td colspan="5" class="text-right">

                                <div class="row mt-3"></div> 
                                  <h4 class="text-success">ยอดชำระเงิน รวมทั้งหมด</h4>
                                <div class="row mt-3"></div> 

                            </td>
                            <td colspan="2" class="text-center">

                                <div class="row mt-4"></div> 

                                  <h4 class="text-success"><?= $o_total; ?> บาท</h4>

                                <div class="row mt-3"></div> 

                            </td>
                        </tr>

                  </tbody>
                </table>
              </div>
            </div>

          </div>
        </div>

      </div>
    </section>

    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                    <h3>ข้อมูล ที่อยู่การจัดสั่ง</h3>
              </div>
              <div class="card-body">



                    <div class="row">
                      <div class="col-sm-2"></div>
                      <div class="col-sm-6">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                          <div class="form-group row">
                            <label for="full_name" class="col-sm-2 col-form-label">ชื่อ-สกุล</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="full_name" value="<?= $name; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="phone" class="col-sm-2 col-form-label">เบอร์โทร</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="phone" value="<?= $phone; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">E-mail</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="email" value="<?= $email; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="a_number" class="col-sm-2 col-form-label">บ้านเลขที่</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="a_number" value="<?= $a_number; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="a_tambon" class="col-sm-2 col-form-label">ตำบล</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="a_tambon" value="<?= $a_tambon; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="a_ampher" class="col-sm-2 col-form-label">อำเภอ</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="a_ampher" value="<?= $a_ampher; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="a_privice" class="col-sm-2 col-form-label">จังหวัด</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="a_privice" value="<?= $a_privice; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="a_post" class="col-sm-2 col-form-label">ไปรษณีย์</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="a_post" value="<?= $a_post; ?>">
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    


              </div>

              <div class="card-footer clearfix">
               
              </div>
            </div>

          </div>
        </div>

      </div>
    </section>

    <div class="row mt-2">
				<div class="col-10"></div>
				<div class="col-2">
					<div class="row">
						<button type="submit" class="btn btn-danger" name="back" onclick="history.go(-1)"><i class="fas fa-arrow-circle-left"></i> ย้อนกลับ</button>
					</div>
				</div>
			</div>

    <div class="row mt-5"></div>


    
