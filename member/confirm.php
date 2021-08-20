<?php      
    
    if($_SESSION['status'] === '1'){

      $select_ad = $conn->prepare("SELECT * FROM users WHERE u_id = :u_id");
      $select_ad->bindParam("u_id"   , $_SESSION['u_id']);
      $select_ad->execute();
      $row_ad = $select_ad->fetch(PDO::FETCH_ASSOC);

      $u_id       =   $row_ad['u_id'];
      $name       =   $row_ad['full_name'];
      $phone      =   $row_ad['phone'];
      $email      =   $row_ad['email'];
      $a_number   =   $row_ad['a_number'];
      $a_tambon   =   $row_ad['a_tambon'];
      $a_ampher   =   $row_ad['a_ampher'];
      $a_privice  =   $row_ad['a_privice'];
      $a_post     =   $row_ad['a_post'];

    } 
    
    if ($_SESSION['status'] === 'facebook'){

      $select_fb = $conn->prepare("SELECT * FROM tb_facebook WHERE NAME = :NAME");
      $select_fb->bindParam("NAME"   , $_SESSION['NAME']);
      $select_fb->execute();
      $row_fb = $select_fb->fetch(PDO::FETCH_ASSOC);
     
      $FB_ID        =   $row_fb['FACEBOOK_ID'];
      $name         =   $row_fb['full_name'];
      $phone        =   $row_fb['a_phone'];
      $email        =   $row_fb['EMAIL'];
      $a_number     =   $row_fb['a_number'];
      $a_tambon     =   $row_fb['a_tambon'];
      $a_ampher     =   $row_fb['a_ampher'];
      $a_privice    =   $row_fb['a_privice'];
      $a_post       =   $row_fb['a_post'];

    } 

    $select_sc = $conn->prepare("SELECT * FROM shipping_cost");
    $select_sc->execute();
    $row_sc = $select_sc->fetch(PDO::FETCH_ASSOC);

?>
    <section class="banner-area bg_cover">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="banner-content">
						<h1 class="text-white">ตรวจสอบข้อมูลและยืนยันการสั่งซื้อ</h1>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php?main">หน้าแรก</a></li>
								<li class="breadcrumb-item" aria-current="page">ตระกร้าสินค้า</li>
								<li class="breadcrumb-item active" aria-current="page">ตรวจสอบข้อมูลและยืนยันการสั่งซื้อ</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</section>

    <section class="product-details-area">
        <div class="container">
            <div class="product-details-wrapper box-style">

            <form action="" method="post">

                <div class="info-wrapper">
                    <div class="showcase-wrapper">
                 
                        <div class="row">
                            <h2>ข้อมูล ที่อยู่การจัดส่ง</h2>
                        </div>

                        <div class="row mt-5">

                            <?php if($_SESSION['status'] === '1'){?>

                                <input type="hidden"  name="u_id" value="<?= $u_id; ?>">

                            <?php } ?>

                            <?php if($_SESSION['status'] === 'facebook'){?>

                                <input type="hidden"  name="FB_ID" value="<?= $FB_ID; ?>">

                            <?php } ?>


                            <div class="col-6">
                                <label for="full_name" class="mb-1">ชื่อ-สกุล</label>
                                <input type="text"  name="full_name" value="<?= $name; ?>" class="px-3 py-2 border rounded" required>
                            </div>
                            <div class="col-6">
                                <label for="phone" class="mb-1">เบอร์โทร</label>
                                <input type="text"  name="phone" value="<?= $phone; ?>" class="px-3 py-2 border rounded" required>
                            </div>
                            <div class="col-6">
                                <label for="email" class="mb-1">E-mail</label>
                                <input type="email" id="email" name="email" value="<?= $email; ?>" class="px-3 py-2 border rounded" required>
                            </div>
                            <div class="col-6">
                                <label for="a_number" class="mb-1">บ้านเลขที่ *</label>
                                <input type="text"  name="a_number" value="<?= $a_number; ?>" class="px-3 py-2 border rounded" required>
                            </div>
                            <div class="col-6">
                                <label for="a_tambon" class="mb-1">ตำบล *</label>
                                <input type="text"  name="a_tambon" value="<?= $a_tambon; ?>" class="px-3 py-2 border rounded" required>
                            </div>
                            <div class="col-6">
                                <label for="a_ampher" class="mb-1">อำเภอ *</label>
                                <input type="text"  name="a_ampher" value="<?= $a_ampher; ?>" class="px-3 py-2 border rounded" required>
                            </div>
                            <div class="col-6">
                                <label for="a_privice" class="mb-1">จังหวัด *</label>
                                <input type="text"  name="a_privice" value="<?= $a_privice; ?>" class="px-3 py-2 border rounded" required>
                            </div>
                            <div class="col-6">
                                <label for="a_post" class="mb-1">ไปรษณีย์ *</label>
                                <input type="text"  name="a_post" value="<?= $a_post; ?>" class="px-3 py-2 border rounded" required>
                            </div>
                        </div>

                        <?php if($_SESSION['status'] === '1'){?>
                        <div class="row mt-3">
                            <div class="col-3">
                                <div class="single-input">
                                    <button type="submit" name="update_ad" value="<?= $id; ?>" class="btn btn-warning btn-lg"><i class="lni lni-checkmark-circle"></i> อัพเดท ข้อมูลที่อยู่</button>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if($_SESSION['status'] === 'facebook'){?>
                        <div class="row mt-3">
                            <div class="col-3">
                                <div class="single-input">
                                    <button type="submit" name="update_FB" value="<?= $id; ?>" class="btn btn-warning btn-lg"><i class="lni lni-checkmark-circle"></i> อัพเดท ข้อมูลที่อยู่</button>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                        <div class="row mt-5"></div>

                        <hr>

                        <div class="row mt-5">
                            <h2>ข้อมูล รายการสั่งซื้อ</h2>
                        </div>

                        <div class="row mt-5">                       
                            <div class="table-wrapper table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">ลำดับ</th>
                                            <th class="text-center">รูปภาพ</th>
                                            <th>ชื่อสินค้า</th>
                                            <th class="text-center">ราคาสินค้า</th>
                                            <th class="text-center">จำนวนสินค้า</th>
                                            <th class="text-center">แต้มสะสม</th>
                                            <th class="text-center">จำนวนเงิน</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                                    $i =  1;
                                                    $k =  0;

                                                    $poits  =  0;
                                                    $sum    =  0;
                                                    $total  =  0;                                               
                                                    
                                                    foreach ($_SESSION['cart'] as $p_id => $qty) 
                                                    {
                                                        $select_p = $conn->prepare("SELECT * FROM product WHERE p_id = :p_id");
                                                        $select_p->bindParam("p_id" , $p_id);
                                                        $select_p->execute();
                                                        $row_p = $select_p->fetch(PDO::FETCH_ASSOC);

                                                        $poits += $row_p['p_poits'];

                                                        $sum = $row_p['p_price'] * $qty;
                                                        $total += $sum;

                                                        
                                        ?>
                                        <tr>
                                            <td class="text-center" width="5%">
                                                <?= $i++; ?>
                                                <input type="hidden"  name="k[]" value="<?= $k++; ?>">
                                            </td>

                                            <td class="text-center" width="15%">
                                                <div class="image">
                                                    <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row_p['p_img']).'" width="100" height="60"/>'; ?>
                                                </div>
                                            </td>

                                            <td>
                                                <h6><?= $row_p['p_name']; ?></h6>
                                                <!-- เก็บค่า -->
                                                <input type="hidden"  name="p_id[]" value="<?= $row_p['p_id']; ?>">
                                            </td>

                                            <td class="text-center" width="15%">
                                                <span><?= $row_p['p_price']; ?></span>
                                            </td>

                                            <td class="text-center" width="15%">
                                                <span><?= $qty; ?></span>
                                                <!-- เก็บค่า -->
                                                <input type="hidden"  name="qty[]" value="<?= $qty; ?>">
                                            </td>

                                            <td class="text-center" width="15%">
                                                <span><?= $row_p['p_poits']; ?></span>
                                            </td>

                                            <td class="text-center" width="15%">
                                                <span><?= $sum; ?></span>
                                                <!-- เก็บค่า -->
                                                <input type="hidden"  name="sum[]" value="<?= $sum; ?>">
                                            </td>
                                            
                                        </tr>
                                        <?php
                                                    }
                                        ?>

                                        <tr> 
                                            <td colspan="5" class="text-right"> 
                                            </td>
                                            <td class="text-center">
                                                <div class="row mt-3">
                                                    <h5>รวมแต้ม = <?= $poits; ?></h5>
                                                </div>
                                                <div class="row mt-3"></div>
                                            </td>
                                            <td class="text-center">
                                                <div class="row mt-3">
                                                    <h5>รวมเงิน = <?= $total; ?></h5>
                                                </div>
                                                <div class="row mt-3"></div>
                                            </td>
                                        </tr>
                                        


                                        <?php
                                                $select_pro = $conn->prepare("SELECT * FROM promotion WHERE check_value <= :total");
                                                $select_pro->bindParam("total"   , $total);
                                                $select_pro->execute();
                                                $row_pro = $select_pro->fetch(PDO::FETCH_ASSOC);

                                                if($row_pro['check_value'] != null){
                            

                                                    $sum_total = 0;
                                                    $sum_poits = 0;

                                                    if ($total >= $row_pro['check_value'] && $row_pro['pr_price'] != 0){
                                    
                                                        $sum_total = $total - $row_pro['pr_price'] + $row_sc['cost']; 
                                                        $sum_poits = $poits + $row_pro['pr_points'];
                                    
                                                    } if ($total >= $row_pro['check_value'] && $row_pro['pr_percentage'] != 0){
                                    
                                                        $sum_total = $total - ($total * $row_pro['pr_percentage'] / 100) + $row_sc['cost'];
                                                        $sum_poits = $poits + $row_pro['pr_points'];
                                    
                                                    } 
                                                    
                                                } 

                                                if($total >= $row_pro['check_value'])
                                                { 
                                        ?>
                                        <tr> 
                                            <td colspan="5"> 
                                                
                                                <!-- เก็บค่า -->
                                                <input type="hidden"  name="pr_id" value="<?= $row_pro['pr_id']; ?>">

                                                <div class="row mt-3">
                                                    <h5><?= $row_pro['pr_name']; ?></h5>
                                                    <p><?= $row_pro['pr_detail']; ?></p>
                                                </div>

                                                <div class="row mt-3"></div>

                                            </td>
                                            <td class="text-center">

                                                <div class="row mt-4">
                                                    <h5 class="text-info">รับแต้ม = <?= $row_pro['pr_points']; ?></h5>
                                                </div>

                                                <div class="row mt-3"></div>

                                            </td>
                                            <td class="text-center">

                                                <div class="row mt-4">
                                                    <?php if($row_pro['pr_price'] != 0){?>
                                                        <h5 class="text-danger">ส่วนลด = <?= $row_pro['pr_price']; ?> บาท</h5>
                                                    <?php } ?>
                                                    <?php if($row_pro['pr_percentage'] != 0){?>
                                                        <h5 class="text-danger">ส่วนลด = <?= $row_pro['pr_percentage']; ?> %</h5>
                                                    <?php } ?>
                                                </div>

                                                <div class="row mt-3"></div> 

                                            </td>
                                        </tr>

                                        
                                        <?php 
                                                } else {

                                                    $sum_total = $total + $row_sc['cost'];
                                                    $sum_poits = $poits;

                                                } 
                                        ?>

                                        <tr> 
                                            <td colspan="5" class="text-right"> 

                                            <div class="row mt-3">
                                                    <h4>ค่าจัดส่งสินค้า</h4>
                                                </div> 

                                                <div class="row mt-3"></div>
                                            </td>
                                            <td colspan="2" class="text-center">
                                                <div class="row mt-3">
                                                    <h5><?= $row_sc['cost']; ?> บาท</h5>
                                                </div>
                                                <div class="row mt-3"></div>
                                            </td>
                                            
                                        </tr>

                                        <tr> 
                                            <td colspan="7" class="text-center">

                                                <div class="row mt-3">
                                                    <h2 class="text-primary">ผลลัพธ์</h2>
                                                </div> 
                                                
                                                <div class="row mt-3"></div> 

                                            </td>
                                        </tr>
  
                                        <tr> 
                                            <td colspan="5" class="text-right"> 

                                                <div class="row mt-3">
                                                    <h4>ได้รับแต้มสะสม รวมทั้งหมด</h4>
                                                </div> 

                                                <div class="row mt-3"></div> 

                                            </td>
                                            <td colspan="2" class="text-center">

                                                <!-- เก็บค่า -->
                                                <input type="hidden"  name="sum_poits" value="<?= $sum_poits; ?>">

                                                <div class="row mt-3">
                                                    <h4 class="text-success">+<?= $sum_poits; ?> แต้ม</h4>
                                                </div> 

                                                <div class="row mt-3"></div> 
                                               
                                            </td>
                                        </tr>

                                        <tr> 
                                            <td colspan="5" class="text-right"> 

                                                <div class="row mt-3">
                                                    <h4>ยอดชำระเงิน รวมทั้งหมด</h4>
                                                </div> 

                                                <div class="row mt-3"></div> 

                                            </td>
                                            <td colspan="2" class="text-center">

                                                <!-- เก็บค่า -->
                                                <input type="hidden"  name="sum_total" value="<?= $sum_total; ?>">

                                                <div class="row mt-3">
                                                    <h4 class="text-success"><?= $sum_total; ?> บาท</h4>
                                                </div> 

                                                <div class="row mt-3"></div> 
                                                
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>    
                        </div>

                        <div class="row mt-5"></div>

                        <hr>

                        <div class="row mt-5">
                            <div class="col-4"></div>
                            <div class="col-3">
                                <div class="single-input">
                                    <button type="submit" name="confirm" class="btn btn-success btn-lg"><i class="lni lni-checkmark-circle"></i> ยืนยัน การสั่งซื้อสินค้า</button>
                                </div>
                            </div>
                        </div>
                    
                    </div>      
                </div>

            </form>

            </div>
        </div>
    </section>

            <div class="row mt-2">
				<div class="col-9"></div>
				<div class="col-2">
					<div class="row">
						<button type="submit" class="btn btn-info" name="back" onclick="history.go(-1)"><i class="lni lni-reply"></i> ย้อนกลับ</button>
					</div>
				</div>
			</div>

            <div class="row mt-5"></div>
 
<?php
             

        if(isset($_POST['confirm'])){
       
            $check      =  $_POST['k'];

            //ข้อมูลที่จะเก็บลงตาราง users
            $points     =  $_POST['sum_poits'];

            //ข้อมูลที่จะเก็บลงตาราง orders
            $o_id       =  rand(1111111,9999999);
            $u_id       =  $_POST['u_id'];
            $FB_ID      =  $_POST['FB_ID'];
            $o_total    =  $_POST['sum_total'];
            $o_status   =  0;
            $o_date     =  date('Y-m-d');
            $o_day      =  0;        
            $pr_id      =  $_POST['pr_id'];

            //ข้อมูลที่จะเก็บลงตาราง order_detail
            //เก็บ $o_id  
            $p_id       =  $_POST['p_id'];
            $od_number  =  $_POST['qty'];
            $od_total   =  $_POST['sum'];

            //ข้อมูลที่จะเก็บลงตาราง payment
            $pm_id      =  rand(1111111,9999999);
            //เก็บ $o_id 
            $pm_status  =  0;

            try {

                if(isset($u_id)){

                    $select_u = $conn->prepare("SELECT u_id, points FROM users WHERE u_id = :u_id");
                    $select_u->bindParam("u_id"   , $u_id);
                    $select_u->execute();
                    $row_u = $select_u->fetch(PDO::FETCH_ASSOC);

                    $total_points = $row_u['points'] + $points;
                    
                    $update_u = $conn->prepare("UPDATE users SET points=:total_points WHERE u_id = :u_id");
                    $update_u->bindParam(':total_points' , $total_points);
                    $update_u->bindParam(':u_id'  , $row_u['u_id']);
                    $update_u->execute();

                }

                if(isset($FB_ID)){

                    $select_fb = $conn->prepare("SELECT FACEBOOK_ID, points FROM tb_facebook WHERE FACEBOOK_ID = :FB_ID");
                    $select_fb->bindParam("FB_ID"   , $FB_ID);
                    $select_fb->execute();
                    $row_fb = $select_fb->fetch(PDO::FETCH_ASSOC);

                    $total_points = $row_fb['points'] + $points;

                    $update_fb = $conn->prepare("UPDATE tb_facebook SET points=:total_points WHERE FACEBOOK_ID = :FACEBOOK_ID");
                    $update_fb->bindParam(':total_points' , $total_points);
                    $update_fb->bindParam(':FACEBOOK_ID'  , $row_fb['FACEBOOK_ID']);
                    $update_fb->execute();

                }

                $insert_o = $conn->prepare("INSERT INTO orders (o_id, u_id, FB_ID, o_total, o_status, o_date, o_day, pr_id) VALUES (:o_id, :u_id, :FB_ID, :o_total, :o_status, :o_date, :o_day, :pr_id)");
                $insert_o->bindParam(':o_id'        ,  $o_id);
                $insert_o->bindParam(':u_id'        ,  $u_id);
                $insert_o->bindParam(':FB_ID'       ,  $FB_ID);
                $insert_o->bindParam(':o_total'     ,  $o_total);
                $insert_o->bindParam(':o_status'    ,  $o_status);
                $insert_o->bindParam(':o_date'      ,  $o_date);
                $insert_o->bindParam(':o_day'       ,  $o_day);
                $insert_o->bindParam(':pr_id'       ,  $pr_id);
                $insert_o->execute();

                foreach($check as $i)
                {
                    $insert_od = $conn->prepare("INSERT INTO order_detail (o_id, p_id, od_number, od_total) VALUES (:o_id, :p_id, :od_number, :od_total)");
                    $insert_od->bindParam(':o_id'        ,  $o_id);
                    $insert_od->bindParam(':p_id'        ,  $p_id[$i]);
                    $insert_od->bindParam(':od_number'   ,  $od_number[$i]);
                    $insert_od->bindParam(':od_total'    ,  $od_total[$i]);
                    $insert_od->execute();
                }     
                
                $insert_pm = $conn->prepare("INSERT INTO payment (pm_id, o_id, pm_status) VALUES (:pm_id, :o_id, :pm_status)");
                $insert_pm->bindParam(':pm_id'       ,  $pm_id);
                $insert_pm->bindParam(':o_id'        ,  $o_id);
                $insert_pm->bindParam(':pm_status'   ,  $pm_status);      

                if ($insert_pm->execute()) {

                    require 'PhpMailer-master/PHPMailer/PHPMailerAutoload.php';
             
                    $mail = new PHPMailer();                  
                    $mail->CharSet = "utf-8";
                    $mail ->IsSmtp();

                    $mailto  = "noreply@gmail.com";
                    $mailSub = "มีรายการสั่งซื้อสินค้ามาใหม่";
                    $mailMsg =  "\r\n".'เลขที่ใบสั่งซื้อ : '.$o_id.
                                "\r\n".'วันที่สั่งซื้อ : '.$o_date.
                                "\r\n".'ยอดชำระทั้งหมด : '.$o_total;
                        
                    $mail ->SMTPAuth = true;
                    $mail ->SMTPSecure = 'tls';
                    $mail ->Host = "smtp.gmail.com";
                    $mail ->Port = 587; // or 587
                    //$mail ->IsHTML(true);
                    $mail ->Username = "watcharapongmufo27@gmail.com";
                    $mail ->Password = "0989193248";
                    $mail ->SetFrom("watcharapongmufo27@gmail.com", "ADMIN");
                    $mail ->Subject = $mailSub;
                    $mail ->Body = $mailMsg;
                    $mail ->AddAddress($mailto);
                    $mail->Send();
                        
                    echo "<script>alert('ส่งการสั่งซื้อสินค้า ไปที่ระบบร้านค้า และ แจ้ง E-mail การสั่งซื้อไปที่บัญชีของผู้ดูแลระบบ เรียบร้อย ขอบคุณที่มาใช้บริการ...!!')</script>"; 
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=backEnd/index.php?order\">";
                    exit;

                } else {

                    echo "<script>alert('error..!!')</script>";
                    echo"<script>window.location='javascript:history.back(-1)';</script>";
                    exit;

                }  
       

            } catch (PDOException $e) {

                echo $e->getMessage();

            }

        }

        if (isset($_POST['update_ad'])) {

            $u_id       =  $_POST['update_ad'];
            $full_name  =  $_POST['full_name'];
            $phone      =  $_POST['phone'];
            $email      =  $_POST['email'];
            $a_number   =  $_POST['a_number'];
            $a_tambon   =  $_POST['a_tambon'];
            $a_ampher   =  $_POST['a_ampher'];
            $a_privice  =  $_POST['a_privice'];
            $a_post     =  $_POST['a_post'];
            $email      =  $_POST['email'];
  
            try {
  
                $update_AD = $conn->prepare("UPDATE users SET  full_name  = :full_name,
                                                               phone      = :phone,
                                                               email      = :email,
                                                               a_number   = :a_number,
                                                               a_tambon   = :a_tambon,
                                                               a_ampher   = :a_ampher,
                                                               a_privice  = :a_privice,
                                                               a_post     = :a_post
  
                                                           WHERE u_id = :u_id
                                            ");
                $update_AD->bindParam(':u_id'       , $u_id);
                $update_AD->bindParam(':full_name'  , $full_name);
                $update_AD->bindParam(':phone'      , $phone);
                $update_AD->bindParam(':email'      , $email);
                $update_AD->bindParam(':a_number'   , $a_number);
                $update_AD->bindParam(':a_tambon'   , $a_tambon);
                $update_AD->bindParam(':a_ampher'   , $a_ampher);
                $update_AD->bindParam(':a_privice'  , $a_privice);
                $update_AD->bindParam(':a_post'     , $a_post);
  
                if ($update_AD->execute()) {
                    
                    echo "<script>alert('อัพเดทข้อมูลที่อยู่ใหม่ เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?confirm\">";
                    exit;
                }
  
            } catch (PDOException $e) {
  
                echo $e->getMessage();
  
            } 
               
        }

        if (isset($_POST['update_FB'])) {

            $FACEBOOK_ID  =  $_POST['update_FB'];
            $full_name    =  $_POST['full_name'];
            $a_phone      =  $_POST['phone'];
            $a_number     =  $_POST['a_number'];
            $a_tambon     =  $_POST['a_tambon'];
            $a_ampher     =  $_POST['a_ampher'];
            $a_privice    =  $_POST['a_privice'];
            $a_post       =  $_POST['a_post'];
  
            try {
  
                $update_FB = $conn->prepare("UPDATE tb_facebook SET full_name  = :full_name,
                                                                    a_phone    = :a_phone,
                                                                    a_number   = :a_number,
                                                                    a_tambon   = :a_tambon,
                                                                    a_ampher   = :a_ampher,
                                                                    a_privice  = :a_privice,
                                                                    a_post     = :a_post
  
                                                           WHERE FACEBOOK_ID = :FACEBOOK_ID
                                            ");
                $update_FB->bindParam(':FACEBOOK_ID'  , $FACEBOOK_ID);
                $update_FB->bindParam(':full_name'    , $full_name);
                $update_FB->bindParam(':a_phone'      , $a_phone);
                $update_FB->bindParam(':a_number'     , $a_number);
                $update_FB->bindParam(':a_tambon'     , $a_tambon);
                $update_FB->bindParam(':a_ampher'     , $a_ampher);
                $update_FB->bindParam(':a_privice'    , $a_privice);
                $update_FB->bindParam(':a_post'       , $a_post);
  
                if ($update_FB->execute()) {
                    
                    echo "<script>alert('อัพเดทข้อมูลที่อยู่ปัจจุบัน เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?confirm\">";
                    exit;
                }
  
            } catch (PDOException $e) {
  
                echo $e->getMessage();
  
            } 
               
        }
?>