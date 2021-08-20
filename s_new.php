	 <div class="container">
			<div class="row">
				<div class="mx-auto col-lg-6 col-md-10">
					<div class="text-center section-title mb-60">
						<h1>แนะนำสินค้ามาใหม่</h1>
					</div>
				</div>
			</div>

			<div class="product-carousel-wrapper">
				<div class="row feature-product-carousel">
				<?php
						$select_pn = $conn->prepare("SELECT p.*, t.t_name FROM product p inner join type t ON t.t_id = p.t_id WHERE p.p_new = 1 ");
						$select_pn->execute();

						while ($row_pn = $select_pn->fetch(PDO::FETCH_ASSOC)) 
						{
				?>
					<div class="col-lg-3 col-md-6">
						<div class="single-product">
							<div class="product-img">
								<a href="#" class="badge">แนะนำสินค้ามาใหม่</a>
								<?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row_pn['p_img']).'" width="450" height="175"/>'; ?>
							</div>
				
							<div class="product-content">
								<div class="row">
									<div class="col-12 mt-1"><h5>ประเภท : <?= $row_pn['t_name'];?></h5></div>
									<div class="col-12 mt-1"><h5>สินค้า : <?= $row_pn['p_name'];?></h5></div>
									<div class="col-12 mt-1"><h5>ราคา : <?= $row_pn['p_price'];?>.00 บาท</h5></div>
								</div>
								<hr>						
								<p>ได้รับแต้มสะสม : <?= $row_pn['p_poits'];?> แต้ม</p>
								<hr>
								<a href="index.php?product_detail=<?= $row_pn['p_id']; ?>" class="btn btn-success"><i class="lni lni-eye"></i> เพิ่มเติม</a>
								<a href="bn_login.php" class="btn btn-primary"><i class="lni lni-cart-full"></i> หยิบใส่ตะกร้า</a>
							</div>
						</div>
					</div>
				
					<?php 
					 	}
					?>
				
				</div>
			</div>
		</div>