<?php 
		require_once '../database/con_db.php';        
?>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">สินค้า</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">สินค้า</li>
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

                <a href="index.php?product_form_add" class="btn btn-app bg-success"><i class="fas fa-plus-square"></i> เพิ่ม</a>

              </div>
              <div class="card-body">
                <table id="mytable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="text-center">ลำดับ</th>
                      <th>ประเภท</th>
                      <th>สินค้า</th>
                      <th>รายละเอียด</th>
                      <th class="text-center">ราคา</th>
                      <th class="text-center">จำนวน</th>
                      <th class="text-center">แต้ม</th>
                      <th class="text-center">รูปภาพ</th>
                      <th class="text-center">action</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php

                        $select_product = $conn->prepare("SELECT p.*, t.t_name FROM product p inner join type t ON t.t_id = p.t_id");
                        $select_product->execute();

                        $i = 1;
                        while ($row_product = $select_product->fetch(PDO::FETCH_ASSOC)) 
                        {

                    ?>

                        <tr>
                            <td class="text-center" width="5%"><?php echo $i++; ?></td>
                            <td width="10%"><?=  $row_product['t_name']; ?></td>
                            <td width="15%"><?=  $row_product['p_name']; ?></td>
                            <td><?=  $row_product['p_detail']; ?></td>
                            <td class="text-center" width="5%"><?=  $row_product['p_price']; ?></td>
                            <td class="text-center" width="5%"><?=  $row_product['p_number']; ?></td>
                            <td class="text-center" width="5%"><?=  $row_product['p_poits']; ?></td>
                            <td class="text-center" width="10%">
                                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row_product['p_img']).'" width="75" height="50"/>'; ?>
                            </td>
                            <td class="text-center" width="10%">
                                <a href="index.php?product_form_edit=<?= $row_product['p_id']; ?>" class="btn bg-warning"><i class="fas fa-edit"></i></a>
                                <a href="index.php?product_del=<?= $row_product['p_id']; ?>" class="btn bg-danger"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>

                    <?php } ?>

                  </tbody>
                </table>
              </div>

              <div class="card-footer clearfix">
               
              </div>
            </div>

          </div>
        </div>

      </div>
    </section>

    <div class="row mt-5"></div>
    