    <section class="banner-area bg_cover">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="banner-content">
						<h1 class="text-white">สินค้า</h1>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="index.php?main">หน้าแรก</a></li>
								<li class="breadcrumb-item active" aria-current="page">สินค้า</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</section>

    <section class="category-area pb-110">
		<div class="container">
			<!-- category top -->
			<div class="category-top box-style">
				<form action="" method="post" enctype="multipart/form-data">
				<div class="row align-items-center">
					<div class="col-md-2">
						<div class="left-wrapper">
							<div class="sorting">
								<div class="selectr-container selectr-desktop has-selected">
									<select name="id" id="sort"  class="selectr-hidden">
										<option value="">-- เลือกประเภท --</option>
									<?php 
                                        $select_t = $conn->prepare("SELECT * FROM type");
                                        $select_t->execute();

                                        while ($row_t = $select_t->fetch(PDO::FETCH_ASSOC)) 
                                        {
                                    ?>
										<option value="<?= $row_t['t_id']; ?>"> <?= $row_t['t_name']; ?> </option>
										<?php } ?>
									</select>
								</div>
							</form>
							</div>
						</div>
					</div>
					<div class="col-md-2">
						<button class="btn btn-warning" type="submit" name="search"> ค้นหา</button>
					</div>
					</form>
					
					<div class="col-md-8">
						<div class="right-wrapper">			
							<form action="" method="post" enctype="multipart/form-data">
								<input type="text" name="name"  placeholder="Search">
								<button type="submit" name="search"><i class="lni lni-search-alt"></i></button>
							</form>
						</div>
					</div>

				</div>

			</div>

			<div class="category-wrapper">
				<div class="row">

					<div class="col-lg-12">
						<div class="left-wrapper">


							<div class="tab-content" id="myTabContent">
								<div class="tab-pane fade show active" id="grid" role="tabpanel" aria-labelledby="grid-tab">

									<?php if(!isset($_POST['search'])) { ?>
										
									<div class="row">
                                        <?php
                                                $select_p1= $conn->prepare("SELECT p.*, t.t_name FROM product p inner join type t ON t.t_id = p.t_id ");
                                                $select_p1->execute();
                        
                                                $i = 1;
                                                while ($row_p1 = $select_p1->fetch(PDO::FETCH_ASSOC))
                                                {
                                        ?>
										<div class="col-lg-3 col-md-3">
											<div class="single-product">
												<div class="product-img">
														<?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row_p1['p_img']).'" width="450" height="175"/>'; ?>
												</div>

												<div class="product-content">
													<div class="row">
														<div class="col-12 mt-1"><h5>ประเภท : <?= $row_p1['t_name'];?></h5></div>
														<div class="col-12 mt-1"><h5>สินค้า : <?= $row_p1['p_name'];?></h5></div>
														<div class="col-12 mt-1"><h5>ราคา : <?= $row_p1['p_price'];?>.00 บาท</h5></div>
													</div>
													<hr>						
													<p>ได้รับแต้มสะสม : <?= $row_p1['p_poits'];?> แต้ม</p>
													<hr>
													<a href="index.php?product_detail=<?= $row_p1['p_id']; ?>" class="btn btn-success"><i class="lni lni-eye"></i> เพิ่มเติม</a>
													<a href="index.php?cart=<?= $row_p1['p_id']?>&act=add" class="btn btn-primary"><i class="lni lni-cart-full"></i> หยิบใส่ตะกร้า</a>
												</div>
											</div>
										</div>								
                                        <?php
                                                }
                                        ?>
									</div>

									<?php } else { ?>

									<div class="row">
                                        <?php
												//ค้นหาตามชื่อข้อความ
												if(isset($_POST['name'])){
													$check = $_POST['name'];
													$select_tn = $conn->prepare("SELECT p.*, t.t_name FROM product p inner join type t ON t.t_id = p.t_id WHERE t.t_name LIKE '%$check%' ");
                                                	$select_tn->execute();
												}

												//ค้นหาตามประเภท
												if(isset($_POST['id'])){
													$check = $_POST['id'];
													$select_tn = $conn->prepare("SELECT p.*, t.t_name, t.t_id FROM product p inner join type t ON t.t_id = p.t_id WHERE t.t_id LIKE '%$check%' ");
                                                	$select_tn->execute();
												}
   
                        
                                                $i = 1;
                                                while ($row_tn = $select_tn->fetch(PDO::FETCH_ASSOC))
                                                {
                                        ?>
										<div class="col-lg-3 col-md-3">
											<div class="single-product">
												<div class="product-img">
														<?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row_tn['p_img']).'" width="450" height="175"/>'; ?>
												</div>

												<div class="product-content">
													<div class="row">
														<div class="col-12 mt-1"><h5>ประเภท : <?= $row_tn['t_name'];?></h5></div>
														<div class="col-12 mt-1"><h5>สินค้า : <?= $row_tn['p_name'];?></h5></div>
														<div class="col-12 mt-1"><h5>ราคา : <?= $row_tn['p_price'];?>.00 บาท</h5></div>
													</div>
													<hr>						
													<p>ได้รับแต้มสะสม : <?= $row_tn['p_poits'];?> แต้ม</p>
													<hr>
													<a href="index.php?product_detail=<?= $row_tn['p_id']; ?>" class="btn btn-success"><i class="lni lni-eye"></i> เพิ่มเติม</a>
													<a href="index.php?cart=<?= $row_tn['p_id']?>&act=add" class="btn btn-primary"><i class="lni lni-cart-full"></i> หยิบใส่ตะกร้า</a>
												</div>
											</div>
										</div>								
                                        <?php
                                                }
                                        ?>
									</div>

									<?php } ?>

								</div>

							</div>


							
						</div>
					</div>					

				</div>
			</div>

		</div>
	</section>