<?php 
		require_once '../../database/con_db.php';  

    $o_id = $_GET['o_detail'];

    $select_pm = $conn->prepare("SELECT pm_id, pm_status FROM payment WHERE o_id = :o_id");
    $select_pm->bindParam("o_id" , $o_id);
    $select_pm->execute();
    $row_pm = $select_pm->fetch(PDO::FETCH_ASSOC);

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

              <div class="card-footer clearfix">
                  <?php if($row_pm['pm_status'] === '0'){ ?>
                    <a href="index.php?payment=<?= $row_pm['pm_id']; ?>" class="btn bg-success"><i class="fas fa-comment-dollar"></i> ชำระเงินทันที</a>     
                  <?php } ?>      
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


    
