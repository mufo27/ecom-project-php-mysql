<?php 
		require_once '../database/con_db.php';        
?>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">ข่าวประชาสัมพันธ์</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">ข่าวประชาสัมพันธ์</li>
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

                <a href="index.php?news_form_add" class="btn btn-app bg-success"><i class="fas fa-plus-square"></i> เพิ่ม</a>

              </div>
              <div class="card-body">
                <table id="mytable" class="table table-bordered table-striped">
                  <thead>
                    <tr class="text-center">
                      <th>ลำดับ</th>
                      <th>หัวข้อข่าว</th>
                      <th>รายละเอียด</th>
                      <th>รูปภาพ</th>
                      <th>action</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php

                        $select_n = $conn->prepare("SELECT * FROM news");
                        $select_n->execute();

                        $i = 1;
                        while ($row_n = $select_n->fetch(PDO::FETCH_ASSOC)) 
                        {

                    ?>

                        <tr>
                            <td class="text-center" width="5%"><?php echo $i++; ?></td>
                            <td width="20%"><?=  $row_n['n_name']; ?></td>
                            <td><?=  $row_n['n_detail']; ?></td>
                            <td class="text-center" width="15%">
                                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row_n['n_img']).'" width="75" height="50"/>'; ?>
                            </td>
                            <td class="text-center" width="10%">
                                <a href="index.php?news_form_edit=<?= $row_n['n_id']; ?>" class="btn bg-warning"><i class="fas fa-edit"></i></a>
                                <a href="index.php?news_del=<?= $row_n['n_id']; ?>" class="btn bg-danger"><i class="fas fa-trash-alt"></i></a>
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

    