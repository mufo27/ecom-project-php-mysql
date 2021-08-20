<?php 
    
        $p_id = $_GET['cart'];
        $act = $_GET['act'];

        if ($act == 'add' && !empty($p_id)) 
        {

            if (isset($_SESSION['cart'][$p_id])) {

                $_SESSION['cart'][$p_id]++;

            } else {
 
                $_SESSION['cart'][$p_id] = 1;

            }

        }

        if ($act == 'remove' && !empty($p_id)) 
        {
            unset($_SESSION['cart'][$p_id]);
        }

        
 

?>
    <section class="banner-area bg_cover">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="banner-content">
						<h1 class="text-white">ตระกร้าสินค้า</h1>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php?main">หน้าแรก</a></li>
								<li class="breadcrumb-item active" aria-current="page">ตระกร้าสินค้า</li>
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

                <div class="info-wrapper">
                    <div class="showcase-wrapper">

                        <div class="row">
                                <h2>รายการ หยิบใส่ตระกร้าสินค้า</h2>
                        </div>

                        <?php 
                                if (empty($_SESSION['cart'])) 
                                {  
                        ?>
                                    <div class="row text-center mt-5">
                                        <h2 class="text-primary"><i class="lni lni-cart-full"></i> ยังไม่มี สินค้าในตระกล้า</h2>
                                    </div>

                        <?php
                                } else {
                        ?>
                    <form action="" method="post">
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
                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                                    $i  =  1;

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
                                            <td class="text-center" width="5%"><?= $i++; ?></td>
                                            <td class="text-center" width="15%">
                                                <div class="image"><?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row_p['p_img']).'" width="100" height="60"/>'; ?></div>
                                            </td>
                                            <td><h6><?= $row_p['p_name']; ?></h6></td>
                                            <td class="text-center" width="15%"><span><?= $row_p['p_price']; ?></span></td>
                                            <td class="text-center" width="15%">
                                                <span>
                                                    <input type="number" name="amount[<?= $p_id?>];" value="<?= $qty; ?>" min="1" max="100" class="px-3 py-2 border rounded">
                                                </span>
                                            </td>
                                            <td class="text-center" width="15%"><span><?= $row_p['p_poits']; ?></span></td>
                                            <td class="text-center" width="15%"><span><?= $sum; ?></span></td>

                                            <td class="text-center" width="8%">
                                                <a href="index.php?cart=<?= $row_p['p_id']?>&act=remove" class="btn btn-danger"><i class="lni lni-close"></i> </a>
                                            </td>
                                        </tr>
                                        <?php
                                                    }
                                        ?>

                                        <tr> 
                                            <td colspan="5" class="text-right"> 
                                                <h4>ได้รับแต้มสะสม รวมทั้งหมด</h4>
                                            </td>
                                            <td colspan="3" class="text-center">
                                                <h4><?= $poits; ?></h4>
                                                <!-- เก็บราคารวมสินค้า sum -->
                                                <input type="hidden"  name="total" value="<?= $total; ?>">
                                            </td>
                                        </tr>

                                        <tr> 
                                            <td colspan="5" class="text-right">
                                                <h4>ยอดชำระเงิน รวมทั้งหมด</h4>
                                            </td>
                                            <td colspan="3" class="text-center">
                                                <h4><?= $total; ?></h4>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>    
                        </div>

                        <div class="row mt-5">
                            <div class="col-6"></div>
                            <div class="col-3">
                                <div class="single-input">
                                    <button  type="submit" name="update" value="update" class="btn btn-warning btn-lg"><i class="lni lni-pencil-alt"></i> อัพเดท ตระกร้าสินค้า</button>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="single-input">
                                    <button type="submit" name="send" value="<?= $_SESSION['cart']; ?>" class="btn btn-success btn-lg"><i class="lni lni-telegram-original"></i> สั่งซื้อสินค้า ตอนนี้</button>
                                </div>
                            </div>
                        </div>
                    </form>
                        <?php 
                                } 
                        ?>

                    </div>      
                </div>

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

        if(isset($_POST['update'])){

            $act = $_POST['update'];

            if ($act === 'update') 
            {
                $amount_array = $_POST['amount'];
                foreach ($amount_array as $p_id => $amount) 
                {
                    $_SESSION['cart'][$p_id] = $amount;
                }
            }

            echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?cart&act=add\">";

        }


        if(isset($_POST['send'])){

            $_POST['send'];
        
            echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?confirm\">";
            
        }
?>