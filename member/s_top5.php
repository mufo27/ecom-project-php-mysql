        <div class="container">
			<div class="row">
				<div class="mx-auto col-xl-6 col-lg-7 col-md-10">
					<div class="text-center section-title mb-60">
						<h1>สินค้าขายดี 5 อันดับแรก</h1>
					</div>
				</div>
			</div>

			<div class="row">
				<?php
					  $select_p5 = $conn->prepare("SELECT p.*, t.t_name, tp.number, tp.top_select  FROM product p inner join type t ON t.t_id = p.t_id 
					  																              inner join top5 tp on tp.p_id = p.p_id  
																				    WHERE tp.top_select = 1 ORDER BY tp.number DESC");
					  $select_p5->execute();

					  while ($row_p5 = $select_p5->fetch(PDO::FETCH_ASSOC)) 
					  {
				?>
				<div class="col-xl-3 col-lg-6 col-md-6">
					<div class="single-product">
						<div class="product-img">
								<a href="#" class="badge">สินค้าขายดี</a>
								<?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row_p5['p_img']).'" width="450" height="175"/>'; ?>
						</div>

						<div class="product-content">
							<div class="row">
								<div class="col-12 mt-1"><h5>ประเภท : <?= $row_p5['t_name'];?></h5></div>
								<div class="col-12 mt-1"><h5>สินค้า : <?= $row_p5['p_name'];?></h5></div>
								<div class="col-12 mt-1"><h5>ราคา : <?= $row_p5['p_price'];?>.00 บาท</h5></div>
							</div>
							<hr>						
							<p>ได้รับแต้มสะสม : <?= $row_p5['p_poits'];?> แต้ม</p>
							<hr>
							<a href="index.php?product_detail=<?= $row_p5['p_id']; ?>" class="btn btn-success"><i class="lni lni-eye"></i> เพิ่มเติม</a>
							<a href="index.php?cart=<?= $row_p5['p_id']?>&act=add" class="btn btn-primary"><i class="lni lni-cart-full"></i> หยิบใส่ตะกร้า</a>
						</div>
					</div>
				</div>

				<?php 
					 	}
				?>

			</div>
		</div>