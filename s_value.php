<?php 

    $sql_t = "SELECT count(*) FROM type";
    $res_t  = $conn->query($sql_t);
    $count_t = $res_t->fetchColumn();

    $sql_p = "SELECT count(*) FROM product";
    $res_p = $conn->query($sql_p);
    $count_p = $res_p->fetchColumn();

	$sql_pn = "SELECT count(*) FROM product WHERE p_new = 1 ";
    $res_pn = $conn->query($sql_pn);
    $count_pn = $res_pn->fetchColumn();

    $sql_pmt = "SELECT count(*) FROM promotion";
    $res_pmt = $conn->query($sql_pmt);
    $count_pmt = $res_pmt->fetchColumn();
    
?>

		
		<div class="container">
			<div class="count-up-wrapper">
				<div class="row">

					<div class="col-lg-3 col-sm-6">
						<div class="single-counter">
							<div class="icon">
								<i class="lni lni-package"></i>
							</div>
							<span>ประเภท</span>
							<span class="count"><?= $count_t;?></span>
							<span>รายการ</span>
						</div>
					</div>

					<div class="col-lg-3 col-sm-6">
						<div class="single-counter">
							<div class="icon">
								<i class="lni lni-gift"></i>
							</div>
							<span>สินค้า</span>
							<span class="count"><?= $count_p;?></span>
							<span>รายการ</span>
						</div>
					</div>

					<div class="col-lg-3 col-sm-6">
						<div class="single-counter">
							<div class="icon">
								<i class="lni lni-thumbs-up"></i>
							</div>
							<span>แนะนำสินค้ามาใหม่</span>
							<span class="count"><?= $count_pn;?></span>
							<span>รายการ</span>
						</div>
					</div>

					<div class="col-lg-3 col-sm-6">
						<div class="single-counter">
							<div class="icon">
								<i class="lni lni-pointer-down"></i>
							</div>
							<span>โปรโมชั่น</span>
							<span class="count"><?= $count_pmt;?></span>
							<span>รายการ</span>
						</div>
					</div>		

				</div>
			</div>
		</div>