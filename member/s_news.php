        <div class="container">
			<div class="row">
				<div class="mx-auto col-xl-6 col-lg-7 col-md-10">
					<div class="text-center section-title mb-60">
						<h1>ข่าวประชาสัมพันธ์</h1>
					</div>
				</div>
			</div>

			<div class="row">
				<?php
					  $select_n = $conn->prepare("SELECT * FROM news");
					  $select_n->execute();

					  while ($row_n = $select_n->fetch(PDO::FETCH_ASSOC)) 
					  {
				?>
				<div class="col-xl-6 col-lg-6 col-md-6">
					<div class="single-product">
						<div class="product-img">
							<?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row_n['n_img']).'" width="450" height="300"/>'; ?>						
						</div>

						<div class="product-content">

							<div class="row">
								<div class="col-12">
									<h3 class="text-primary"><?= $row_n['n_name'];?><h6>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-12">
									<h5>รายละเอียด :</h5>
									<p><?= $row_n['n_detail'];?></p>
								</div>
							</div>
							<hr>

						</div>
					</div>
				</div>

				<?php 
					 	}
				?>

			</div>
		</div>