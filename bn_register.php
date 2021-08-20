<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>เว็บไซต์ขายเครื่องสำอางออนไลน์</title>
	<link rel="shortcut icon" href="tp-admin-lte/dist/img/AdminLTELogo.png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="tp-admin-lte/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="tp-admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="tp-admin-lte/dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="tp-admin-lte/index2.html" class="h1"><b>ลงทะเบียน</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">สำหรับผู้ที่ต้องการ สมัครสมาชิกใหม่</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="ชื่อผู้ใช้งาน" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="รหัสผ่าน" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="c_password" class="form-control" placeholder="ยืนยันรหัสผ่าน" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <button type="submit" name="register" class="btn btn-success btn-block">ลงทะเบียน</button>
          </div>
          <div class="col-6">
            <button type="reset" class="btn btn-warning btn-block">รีเซ็ต</button>
          </div>
        </div>
      </form>

      <hr>
      <div class="social-auth-links text-center mt-2 mb-3">

        <?php include('facebook_login.php') ?>
        
      </div>

      <hr>
      <p class="mb-1">
        <a href="index.php" class="text-center">ไปที่หน้าการเข้าสู่ระบบ</a>
      </p>
      <p class="mb-0">
        <a href="index.php" class="text-center">กลับไปยังหน้าแรก</a>
      </p>

    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="tp-admin-lte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="tp-admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="tp-admin-lte/dist/js/adminlte.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>

<?php 

        require_once('database/con_db.php');

        if (isset($_POST['register'])) {

            $username     =   $_POST['username'];
            $password     =   $_POST['password'];
            $c_password   =   $_POST['c_password'];
            $status       =   1;

            if ($password !== $c_password) {

                echo '<script type="text/javascript">
                        Swal.fire({
                            icon: "error",
                            title: "ยืนยันรหัสผ่านไม่ตรงกัน",
                            showConfirmButton: false,
                            timer: 2000
                        });
                    </script>';

                echo "<meta http-equiv=\"refresh\" content=\"5; URL=bn_register.php\">";            

            } else {

                $select_check = $conn->prepare("SELECT username FROM users WHERE username = :username");
                $select_check->bindParam("username" , $username);
				        $select_check->execute();

                while ($row_check = $select_check->fetch(PDO::FETCH_ASSOC)) {
                    
                    $dbusername   =  $row_check['username'];
                }

                if ($select_check->rowCount() > 0) {

                    if ($username == $dbusername){

                        echo '<script type="text/javascript">
                                Swal.fire({
                                    icon: "info",
                                    title: "มีชื่อผู้ใช้งานนี้ อยู่ในระบบแล้ว..!!",
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            </script>';

                        echo "<meta http-equiv=\"refresh\" content=\"5; URL=bn_register.php\">";            

                    } 

                } else {

                    try {

                        $insert_user = $conn->prepare("INSERT INTO users(username, password, status) VALUES (:username, :password, :status)");
                        $insert_user->bindParam(':username' ,  $username);
                        $insert_user->bindParam(':password' ,  $password);
                        $insert_user->bindParam(':status'   ,  $status);

                        if ($insert_user->execute()) {

                            echo '<script type="text/javascript">
                                Swal.fire({
                                    icon: "success",
                                    title: "ลงทะเบียนสมาชิก เรียบร้อย..!!",
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            </script>';

                            echo "<meta http-equiv=\"refresh\" content=\"5; URL=bn_login.php\">";            

                        }

                    } catch (PDOException $e) {
        
                        echo $e->getMessage();
        
                    }
                } 

            } 

        }

?>
