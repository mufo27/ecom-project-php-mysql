<?php 
		require_once '../database/con_db.php';        
?>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">โปรโมชั่น</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">โปรโมชั่น</li>
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

                <a href="index.php?promotion_form_add" class="btn btn-app bg-success"><i class="fas fa-plus-square"></i> เพิ่ม</a>

              </div>
              <div class="card-body">
                <table id="mytable" class="table table-bordered table-striped">
                  <thead>
                    <tr class="text-center">
                      <th>ลำดับ</th>
                      <th>ชื่อโปร</th>
                      <th>รายละเอียด</th>
                      <th>ราคาโปร</th>
                      <th>ราคา ส่วนลด</th>
                      <th>% ส่วนลด</th>
                      <th>แต้มสะสม</th>
                      <th>เริ่มโปร</th>
                      <th>สิ้นสุดโปร</th>
                      <th>รูปภาพ</th>
                      <th>action</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php

                        $select_pr = $conn->prepare("SELECT * FROM promotion");
                        $select_pr->execute();

                        $i = 1;
                        while ($row_pr = $select_pr->fetch(PDO::FETCH_ASSOC)) 
                        {

                    ?>

                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td><?=  $row_pr['pr_name']; ?></td>
                            <td><?=  $row_pr['pr_detail']; ?></td>
                            <td class="text-center" width="5%"><?=  $row_pr['check_value']; ?></td>
                            <td class="text-center" width="5%"><?=  $row_pr['pr_price']; ?></td>
                            <td class="text-center" width="5%"><?=  $row_pr['pr_percentage']; ?></td>
                            <td class="text-center" width="5%"><?=  $row_pr['pr_points']; ?></td>
                            <td class="text-center" width="7.5%"><?=  DateThai($row_pr['str_date']); ?></td>
                            <td class="text-center" width="7.5%"><?=  DateThai($row_pr['sto_date']); ?></td>
                            <td width="10%">
                                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row_pr['pr_img']).'" width="75" height="50"/>'; ?>
                            </td>
                            <td class="text-center" width="10%">
                                <a href="index.php?promotion_form_edit=<?= $row_pr['pr_id']; ?>" class="btn bg-warning"><i class="fas fa-edit"></i></a>
                                <a href="index.php?promotion_del=<?= $row_pr['pr_id']; ?>" class="btn bg-danger"><i class="fas fa-trash-alt"></i></a>
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

    