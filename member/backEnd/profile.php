<?php 
		require_once '../../database/con_db.php';            
    
    if($_SESSION['status'] === '1'){

      $u_id = $_SESSION['u_id'];

      $select = $conn->prepare("SELECT * FROM users WHERE u_id = :u_id");
      $select->bindParam("u_id"   , $u_id);
      $select->execute();
      $row = $select->fetch(PDO::FETCH_ASSOC);

      $status = 'สมาชิก';

    } else if ($_SESSION['status'] === 'facebook'){

      $NAME = $_SESSION['NAME'];

      $select = $conn->prepare("SELECT * FROM tb_facebook WHERE NAME = :NAME");
      $select->bindParam("NAME"   , $NAME);
      $select->execute();
      $row = $select->fetch(PDO::FETCH_ASSOC);

      $status = 'สมาชิก (Login facebook)';

    } else {
      echo 'error';
    }

?>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">ข้อมูลส่วนตัว</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">ข้อมูลส่วนตัว</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

<?php if($_SESSION['status'] === '1'){?>
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                  <h3>ข้อมูลส่วนตัว</h3>
              </div>
              
              <div class="card-body">
                    <div class="row">
                      <div class="col-sm-12">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                          <div class="form-group row">
                            <label for="u_img" class="col-sm-2 col-form-label">รูปโปร์ไฟล์</label>
                            <div class="col-sm-5">
                              <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($row['u_img']).'" width="175" height="150"/>'; ?>
                            </div>
                            <div class="col-sm-5">
                              <input id="chooseFile" type="file" class="form-control" name="u_img">
                              <br>
                              <div class="imgGallery"></div>
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="username" class="col-sm-2 col-form-label">ชื่อผู้ใช้งาน</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="username" value="<?= $row['username']; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">รหัสผ่าน</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="password" value="<?= $row['password']; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="full_name" class="col-sm-2 col-form-label">ชื่อ-สกุล</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="full_name" value="<?= $row['full_name']; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="day" class="col-sm-2 col-form-label">ว/ด/ป เกิด</label>
                            <div class="col-sm-10">
                              <input type="date" class="form-control" name="b_day" value="<?= $row['b_day']; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="phone" class="col-sm-2 col-form-label">เบอร์โทร</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="phone" value="<?= $row['phone']; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">E-mail</label>
                            <div class="col-sm-10">
                              <input type="email" class="form-control" name="email" value="<?= $row['email']; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="status" class="col-sm-2 col-form-label">สถานะ</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="status" value="<?= $status; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                              <button type="submit" class="btn btn-warning" name="update1" value="<?= $row['u_id'];?>"><i class="fas fa-user-edit"></i> อัพเดทข้อมูลส่วนตัว</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
              </div>

              <div class="card-footer clearfix">
               
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card card-success">
              <div class="card-header">
                <h3>ที่อยู่ปัจจุบัน</h3>
              </div>
              
              <div class="card-body">
                    <div class="row">
                      <div class="col-sm-12">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                          <div class="form-group row">
                            <label for="a_number" class="col-sm-2 col-form-label">บ้านเลขที่</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="a_number" value="<?= $row['a_number']; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="a_tambon" class="col-sm-2 col-form-label">ตำบล</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="a_tambon" value="<?= $row['a_tambon']; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="a_ampher" class="col-sm-2 col-form-label">อำเภอ</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="a_ampher" value="<?= $row['a_ampher']; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="a_privice" class="col-sm-2 col-form-label">จังหวัด</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="a_privice" value="<?= $row['a_privice']; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="a_post" class="col-sm-2 col-form-label">ไปรษณีย์</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="a_post" value="<?= $row['a_post']; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                              <button type="submit" class="btn btn-warning" name="update2" value="<?= $row['u_id'];?>"><i class="fas fa-address-card"></i> อัพเดทข้อมูลที่อยู่อาศัย</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
              </div>

              <div class="card-footer clearfix">
               
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>
<?php } ?>

<?php if($_SESSION['status'] === 'facebook'){?>
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                  <h3>ข้อมูลส่วนตัว</h3>
              </div>
              
              <div class="card-body">
                    <div class="row">
                      <div class="col-sm-12">
                          <div class="form-group row">
                            <label for="img" class="col-sm-2 col-form-label">รูปโปร์ไฟล์</label>
                            <div class="col-sm-10">
                              <img src="<?= $row['PICTURE']; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="id" class="col-sm-2 col-form-label">FB ID</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="id" value="<?= $row['FACEBOOK_ID']; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="username" class="col-sm-2 col-form-label">ชื่อผู้ใช้งาน</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="username" value="<?= $row['NAME']; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">E-mail</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="email" value="<?= $row['EMAIL']; ?>">
                            </div>
                          </div>
                          
                          <div class="form-group row">
                            <label for="phone" class="col-sm-2 col-form-label">ลิงค์ FB</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="phone" value="<?= $row['LINK']; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="status" class="col-sm-2 col-form-label">สถานะ</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="status" value="<?= $status; ?>">
                            </div>
                          </div>
                      </div>
                    </div>
              </div>

              <div class="card-footer clearfix">
               
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card card-success">
              <div class="card-header">
                <h3>ที่อยู่ปัจจุบัน</h3>
              </div>
              
              <div class="card-body">
                    <div class="row">
                      <div class="col-sm-12">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                          <div class="form-group row">
                            <label for="full_name" class="col-sm-2 col-form-label">ชื่อ-สกุล</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="full_name" value="<?= $row['full_name']; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="a_phone" class="col-sm-2 col-form-label">เบอร์โทร</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="a_phone" value="<?= $row['a_phone']; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="a_number" class="col-sm-2 col-form-label">บ้านเลขที่</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="a_number" value="<?= $row['a_number']; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="a_tambon" class="col-sm-2 col-form-label">ตำบล</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="a_tambon" value="<?= $row['a_tambon']; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="a_ampher" class="col-sm-2 col-form-label">อำเภอ</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="a_ampher" value="<?= $row['a_ampher']; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="a_privice" class="col-sm-2 col-form-label">จังหวัด</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="a_privice" value="<?= $row['a_privice']; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="a_post" class="col-sm-2 col-form-label">ไปรษณีย์</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="a_post" value="<?= $row['a_post']; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                              <button type="submit" class="btn btn-warning" name="update_FB" value="<?= $row['FACEBOOK_ID'];?>"><i class="fas fa-address-card"></i> อัพเดทข้อมูลที่อยู่อาศัย</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
              </div>

              <div class="card-footer clearfix">
               
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>
<?php } ?>

<?php

        if (isset($_POST['update1'])) {

            $u_id      =  $_POST['update1'];
            $username  =  $_POST['username'];
            $password  =  $_POST['password'];
            $full_name =  $_POST['full_name'];
            $b_day     =  $_POST['b_day'];
            $phone     =  $_POST['phone'];
            $email     =  $_POST['email'];
            $u_img     =  file_get_contents($_FILES['u_img']['tmp_name']);

            try {

                $update_PF = $conn->prepare("UPDATE users SET username  = :username,
                                                               password  = :password,
                                                               full_name = :full_name,
                                                               b_day     = :b_day,
                                                               phone     = :phone,
                                                               email     = :email,
                                                               u_img     = :u_img

                                                           WHERE u_id = :u_id
                                            ");
                $update_PF->bindParam(':u_id'       , $u_id);
                $update_PF->bindParam(':username'   , $username);
                $update_PF->bindParam(':password'   , $password);
                $update_PF->bindParam(':full_name'  , $full_name);
                $update_PF->bindParam(':b_day'      , $b_day);
                $update_PF->bindParam(':phone'      , $phone);
                $update_PF->bindParam(':email'      , $email);
                $update_PF->bindParam(':u_img'      , $u_img);

                if ($update_PF->execute()) {
                    
                    echo "<script>alert('อัพเดทข้อมูลส่วนตัว เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?profile\">";
                    exit;
                }

            } catch (PDOException $e) {

                echo $e->getMessage();

            } 
               
        }

        if (isset($_POST['update2'])) {

          $u_id       =  $_POST['update2'];
          $a_number   =  $_POST['a_number'];
          $a_tambon   =  $_POST['a_tambon'];
          $a_ampher   =  $_POST['a_ampher'];
          $a_privice  =  $_POST['a_privice'];
          $a_post     =  $_POST['a_post'];

          try {

              $update_AD = $conn->prepare("UPDATE users SET a_number   = :a_number,
                                                             a_tambon   = :a_tambon,
                                                             a_ampher   = :a_ampher,
                                                             a_privice  = :a_privice,
                                                             a_post     = :a_post

                                                         WHERE u_id = :u_id
                                          ");
              $update_AD->bindParam(':u_id'       , $u_id);
              $update_AD->bindParam(':a_number'   , $a_number);
              $update_AD->bindParam(':a_tambon'   , $a_tambon);
              $update_AD->bindParam(':a_ampher'   , $a_ampher);
              $update_AD->bindParam(':a_privice'  , $a_privice);
              $update_AD->bindParam(':a_post'     , $a_post);

              if ($update_AD->execute()) {
                  
                  echo "<script>alert('อัพเดทข้อมูลที่อยู่ปัจจุบัน เรียบร้อย...!!')</script>";
                  echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?profile\">";
                  exit;
              }

          } catch (PDOException $e) {

              echo $e->getMessage();

          } 
             
        }

        if (isset($_POST['update_FB'])) {

          $FACEBOOK_ID  =  $_POST['update_FB'];
          $full_name    =  $_POST['full_name'];
          $a_phone      =  $_POST['a_phone'];
          $a_number     =  $_POST['a_number'];
          $a_tambon     =  $_POST['a_tambon'];
          $a_ampher     =  $_POST['a_ampher'];
          $a_privice    =  $_POST['a_privice'];
          $a_post       =  $_POST['a_post'];

          try {

              $update_FB = $conn->prepare("UPDATE tb_facebook SET   full_name   = :full_name,
                                                                    a_phone    = :a_phone,
                                                                    a_number   = :a_number,
                                                                    a_tambon   = :a_tambon,
                                                                    a_ampher   = :a_ampher,
                                                                    a_privice  = :a_privice,
                                                                    a_post     = :a_post

                                                         WHERE FACEBOOK_ID = :FACEBOOK_ID
                                          ");
              $update_FB->bindParam(':FACEBOOK_ID'  , $FACEBOOK_ID);
              $update_FB->bindParam(':full_name'    , $full_name);
              $update_FB->bindParam(':a_phone'      , $a_phone);
              $update_FB->bindParam(':a_number'     , $a_number);
              $update_FB->bindParam(':a_tambon'     , $a_tambon);
              $update_FB->bindParam(':a_ampher'     , $a_ampher);
              $update_FB->bindParam(':a_privice'    , $a_privice);
              $update_FB->bindParam(':a_post'       , $a_post);

              if ($update_FB->execute()) {
                  
                  echo "<script>alert('อัพเดทข้อมูลที่อยู่ปัจจุบัน เรียบร้อย...!!')</script>";
                  echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?profile\">";
                  exit;
              }

          } catch (PDOException $e) {

              echo $e->getMessage();

          } 
             
        }

?>




    