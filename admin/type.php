<?php 
		require_once '../database/con_db.php';        
?>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">ประเภทสินค้า</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">ประเภทสินค้า</li>
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

                <a href="index.php?type_form_add" class="btn btn-app bg-success"><i class="fas fa-plus-square"></i> เพิ่ม</a>

              </div>
              <div class="card-body">
                <table id="mytable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th class="text-center">ลำดับ</th>
                      <th>ชื่อประเภทสินค้า</th>
                      <th class="text-center">action</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php

                        $select_type = $conn->prepare("SELECT * FROM type");
                        $select_type->execute();

                        $i = 1;
                        while ($row_type = $select_type->fetch(PDO::FETCH_ASSOC)) 
                        {
                    ?>

                        <tr>
                            <td class="text-center" width="5%"><?php echo $i++; ?></td>
                            <td><?=  $row_type['t_name']; ?></td>
                            <td class="text-center" width="10%">

                                <a href="index.php?type_form_edit=<?= $row_type['t_id']; ?>" class="btn bg-warning"><i class="fas fa-edit"></i></a>
                                <a href="index.php?type_del=<?= $row_type['t_id']; ?>" class="btn bg-danger"><i class="fas fa-trash-alt"></i></a>

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

    

    