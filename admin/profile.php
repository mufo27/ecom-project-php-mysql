<?php 
		require_once '../database/con_db.php'; 
        
            $select = $conn->prepare("SELECT * FROM users WHERE username = :username");
            $select->bindParam("username"   , $_SESSION['username']);
            $select->execute();
            $row = $select->fetch(PDO::FETCH_ASSOC);

            if($row['status'] === '0'){
                $show = 'ผู้ดูแลระบบ';
            } else {
                $show = 'error';
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

    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
              
              </div>
              
              <div class="card-body">
                    <div class="row">
                      <div class="col-sm-2"></div>
                      <div class="col-sm-8">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
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
                              <input type="text" class="form-control" name="status" value="<?= $show; ?>">
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                              <button type="submit" class="btn btn-warning" name="update" value="<?= $row['u_id'];?>"><i class="fas fa-user-edit"></i> อัพเดทข้อมูลส่วนตัว</button>
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


<?php

        if (isset($_POST['update'])) {

            $u_id      =  $_POST['update'];
            $username  =  $_POST['username'];
            $password  =  $_POST['password'];
            $full_name =  $_POST['full_name'];
            $phone     =  $_POST['phone'];
            $email     =  $_POST['email'];

            try {

                $update_type= $conn->prepare("UPDATE users SET username  = :username,
                                                               password  = :password,
                                                               full_name = :full_name,
                                                               phone     = :phone,
                                                               email     = :email

                                                           WHERE u_id = :u_id
                                            ");
                $update_type->bindParam(':u_id'   , $u_id);
                $update_type->bindParam(':username' , $username);
                $update_type->bindParam(':password'   , $password);
                $update_type->bindParam(':full_name' , $full_name);
                $update_type->bindParam(':phone'   , $phone);
                $update_type->bindParam(':email' , $email);

                if ($update_type->execute()) {
                    
                    echo "<script>alert('อัพเดทข้อมูลส่วนตัว เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?profile\">";
                    exit;
                }

            } catch (PDOException $e) {

                echo $e->getMessage();

            } 
               
        }

?>




    