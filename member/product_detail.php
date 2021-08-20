<?php 

    if (isset($_GET['product_detail'])) {

        try {

            $p_id = $_GET['product_detail'];
            $select_product = $conn->prepare("SELECT p.*, t.t_name FROM product p inner join type t ON t.t_id = p.t_id WHERE p_id = :p_id");
            $select_product->bindParam(':p_id' , $p_id);
            $select_product->execute();
            $row_product = $select_product->fetch(PDO::FETCH_ASSOC);


            

        } catch (PDOException $e) {

            $e->getMessage();

        }

    }

?>
    <section class="banner-area bg_cover">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="banner-content">
						<h1 class="text-white">รายละเอียด</h1>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php?main">หน้าแรก</a></li>
								<li class="breadcrumb-item" aria-current="page">สินค้า</li>
								<li class="breadcrumb-item active" aria-current="page">รายละเอียด</li>
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

                            <div class="col-lg-6 col-xl-6">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-tab-1">
                                        <div class="showcase-img">
                                            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row_product['p_img']).'" width="400" height="400"/>'; ?>
                                        </div>
                                    </div>
                                
                                </div>
                            </div>
                            
                            <div class="col-lg-6 col-xl-6">
                                <div class="text-wrapper">

                                    <h4 class="title mb-25">ประเภท : <?= $row_product['t_name']; ?></h4>
                                    <h4 class="title mb-25">สินค้า : <?= $row_product['p_name']; ?></h4>
                                    <span class="description mb-30">รายละเอียด : <?= $row_product['p_detail']; ?></span>

                                    <hr>                                  
                                    <div class="row mt-5">
                                        <div class="col-6">
                                            <h5 class="title mb-25">ราคา : <?= $row_product['p_price']; ?> บาท</h5>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="title mb-25">ได้รับแต้มสะสม : <?= $row_product['p_poits']; ?> แต้ม</h5>
                                        </div>
                                    </div>
                                    <hr>    
                                    
                                    <div class="row mt-5">
                                        <div class="col-6">
                                            <a href="index.php?cart=<?= $row_product['p_id']?>&act=add" class="btn btn-primary"><i class="lni lni-cart-full"></i> หยิบใส่ตะกร้า</a>
                                        </div>
                                        <div class="col-6">
                                            <a href="#" class="btn btn-warning"><i class="lni lni-coin"></i> ตระกร้าสินค้า</a>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
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