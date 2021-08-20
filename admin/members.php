<?php 
		require_once '../database/con_db.php'; 

    $check_time = strtotime("23:59:58");

    $time = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
    $show_time = strtotime(date_format($time,"H:i:s"));
    
?>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">สมาชิก</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">สมาชิก</li>
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

              <div class="row">
                <div class="col"><h4><?= $check_time; ?></h4></div>
              </div>
              <div class="row">
                <div class="col"><h4><?= $show_time; ?></h4></div>
              </div>

              </div>
              <div class="card-body">
                <table id="mytable" class="table table-bordered table-striped">
                  <thead>
                    <tr class="text-center">
                      <th>ลำดับ</th>
                      <th>ชื่อผู้ใช้งาน</th>
                      <th>วันที่ เข้าใช้งานล่าสุด</th>
                      <th>จำนวนวัน (ไม่ได้เข้าใช้งาน)</th>
                      <th>action</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php

                        $select_u = $conn->prepare("SELECT * FROM users WHERE status != '0' ");
                        $select_u->execute();

                        $i = 1;
                        while ($row_u = $select_u->fetch(PDO::FETCH_ASSOC)) 
                        {

                    ?>

                        <tr>
                            <td class="text-center" width="5%"><?php echo $i++; ?></td>
                            <td class="text-center" width="30%"><?=  $row_u['username']; ?></td>
                            <td class="text-center" width="25%"><?=  DateThai($row_u['lg_date']); ?></td>
                            <td class="text-center" width="25%"><?= $row_u['n_day']; ?> </td>
                            <td class="text-center" width="15%">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <?php if($row_u['n_day'] >= '30'){?>
                                      <button class="btn bg-danger" type="submit" name="delete" value="<?= $row_u['u_id']; ?>">
                                        <i class="fas fa-trash-alt"></i>
                                      </button>
                                    <?php } ?>
                                </form>
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

<?php    

      if (isset($_POST['delete'])) {

          $u_id    =  $_POST['delete'];

          try {

            $delete_n = $conn->prepare("DELETE FROM users WHERE u_id = :u_id");
            $delete_n->bindParam(':u_id' , $u_id);

            if ($delete_n->execute()) {

                echo "<script>alert('ลบข่าวประชาสัมพันธ์ เรียบร้อย...!!')</script>";
                echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?news\">";
                exit;
            }

          } catch (PDOException $e) {

              echo $e->getMessage();

          }
            
      }

      // $ch_time = strtotime("23:59:58");

      // $t_time = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
      // $s_time = strtotime(date_format($t_time,"H:i:s"));
      
      // if($s_time >= $ch_time && $s_time <= $ch_time){

      //   $select_day = $conn->prepare("SELECT n_day FROM users");
      //   $select_day->execute();

      //   while ($row_day = $select_day->fetch(PDO::FETCH_ASSOC)) 
      //   {

      //       $n_day = $row_day['n_day'] + 1;
      //       $update_n_day = $conn->prepare("UPDATE users SET n_day = :n_day ");
      //       $update_n_day->bindParam(':n_day' , $n_day);  
      //       $update_n_day->execute();     
      //   }

      //   echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?members\">";
      //   exit;
      
      // } 
?>