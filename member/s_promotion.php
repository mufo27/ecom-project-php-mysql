<div class="container">
			<div class="row">
				<div class="mx-auto col-xl-6 col-lg-7 col-md-10">
					<div class="text-center section-title mb-60">
						<h1>โปรโมชั่นสินค้า</h1>
					</div>
				</div>
			</div>

			<div class="row">
				<?php
					  $select_pr = $conn->prepare("SELECT * FROM promotion");
					  $select_pr->execute();

					  while ($row_pr = $select_pr->fetch(PDO::FETCH_ASSOC)) 
					  {
				?>
				<div class="col-xl-4 col-lg-6 col-md-6">
					<div class="single-product">
						<div class="product-img">							
							<a href="#" class="badge">โปรโมชั่น</a>
							<?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row_pr['pr_img']).'" width="450" height="300"/>'; ?>						
						</div>

						<div class="product-content">

							<div class="row">
								<div class="col-12">
									<h4 class="text-primary"><?= $row_pr['pr_name'];?><h4>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-12">
									<h5>รายละเอียด :</h5>
									<p><?= $row_pr['pr_detail'];?></p>
								</div>
							</div>
							<hr>
							<p>ได้รับ ราคาส่วนลด : <?= $row_pr['pr_price'];?> บาท</p>
							<p >ได้รับ เปอร์เซ็นต์ส่วนลด : <?= $row_pr['pr_percentage'];?> %</p>
							<p>ได้รับ แต้มสะสม : <?= $row_pr['pr_points'];?> แต้ม</p>
							<hr>
							<h5 class="text-danger">เริ่มโปร <?= DateThai($row_pr['str_date']);?> - <?= DateThai($row_pr['sto_date']);?></h5>
						</div>
					</div>
				</div>

				<?php 
					 	}
				?>

			</div>
		</div>