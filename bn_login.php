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
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="tp-admin-lte/index2.html" class="h1"><b>เข้าสู่ระบบ</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">โปรดลงชื่อ...!! เข้าสู่ระบบการใช้งาน</p>

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

        <div class="row">
          <div class="col-6">
            <button type="submit" name="login" class="btn btn-success btn-block">เข้าสู่ระบบ</button>
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
        <a href="bn_register.php" class="text-center">ไปที่หน้าลงทะเบียน</a>
      </p>
      <p class="mb-0">
        <a href="index.php" class="text-center">กลับไปยังหน้าแรก</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

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

        if (isset($_POST['login'])) {

            $username     =   $_POST['username'];
            $password     =   $_POST['password'];

                try {

                    $select_stmt =  $conn->prepare("SELECT u_id, username, password, status FROM users WHERE username = :username AND password = :password");                                           
                    $select_stmt->bindParam(':username'  ,  $username);
                    $select_stmt->bindParam(':password'  ,  $password);
                    $select_stmt->execute();

                    while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {

                        $dbu_id         =   $row['u_id'];
                        $dbusername     =   $row['username'];
                        $dbpassword     =   $row['password'];
                        $dbstatus       =   $row['status'];

                    }

                    if ($username != null AND $password != null) {

                        if ($select_stmt->rowCount() > 0) {

                            if ($username == $dbusername AND $password == $dbpassword AND $dbstatus != null) {

                                switch ($dbstatus) {

                                    case '0' :                         

                                        $_SESSION['username']  =   $dbusername;
                                        $_SESSION['password']  =   $dbpassword;
                                        $_SESSION['status']    =   $dbstatus;

                                        echo '<script type="text/javascript">
                                                Swal.fire({
                                                    icon: "success",
                                                    title: "เข้าสู่ระบบสำเร็จ ยินดีต้อนรับ ผู้ดูแลระบบ",
                                                    showConfirmButton: false,
                                                    timer: 2000
                                                });
                                            </script>';

                                        echo "<meta http-equiv=\"refresh\" content=\"2; URL=admin/index.php\">";

                                    break;

                                    case '1' :

                                        $lg_date  = date('Y-m-d');
                                        $n_day    = 0;
                                        $update_u = $conn->prepare("UPDATE users SET lg_date = :lg_date, n_day = :n_day WHERE username = :username");
                                        $update_u->bindParam(':username'  , $username);
                                        $update_u->bindParam(':lg_date'   , $lg_date);
                                        $update_u->bindParam(':n_day'     , $n_day);
                                        $update_u->execute();  

                                        $_SESSION['u_id']      =   $dbu_id;
                                        $_SESSION['username']  =   $dbusername;
                                        $_SESSION['password']  =   $dbpassword;
                                        $_SESSION['status']    =   $dbstatus;

                                        echo '<script type="text/javascript">
                                                Swal.fire({
                                                    icon: "success",
                                                    title: "เข้าสู่ระบบสำเร็จ ยินดีต้อนรับ สมาชิก",
                                                    showConfirmButton: false,
                                                    timer: 2000
                                                });
                                            </script>';

                                        echo "<meta http-equiv=\"refresh\" content=\"2; URL=member/index.php\">";

                                    break;

                                    default :

                                        echo '<script type="text/javascript">
                                                Swal.fire({
                                                    icon: "error",
                                                    title: "ไม่สามารถเข้าสู่ระบบได้",
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                });
                                            </script>';

                                        echo "<meta http-equiv=\"refresh\" content=\"5; URL=bn_login.php\">";

                                }

                            }

                        } else {

                            echo '<script type="text/javascript">
                                    Swal.fire({
                                        icon: "error",
                                        title: "ไม่สามารถเข้าสู่ระบบได้",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                </script>';

                            echo "<meta http-equiv=\"refresh\" content=\"5; URL=bn_login.php\">";


                        }

                    } 

                } catch (PDOException $e) {
                    $e->getMessage();
                }
                         

        }

?>

