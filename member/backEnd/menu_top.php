<?php 
          if($_SESSION['status'] === '1'){

            $name = $_SESSION['username'];

          } else {

            $name = $_SESSION['NAME'];

          }
?>

<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="h4 nav-link">ระบบขายเครื่องสำอางออนไลน์</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

    </ul>
    
    <h5>ชื่อผู้ใช้งาน : <?= $name;?></h5>

  </nav>
  <!-- /.navbar -->