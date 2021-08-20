  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="../tp-admin-lte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">ผู้ดูแลระบบ</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


        <li class="nav-header">MENU</li>

          <li class="nav-item menu-open">
            <a href="index.php?dashboard" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th-list text-info"></i>
              <p>
                จัดการ ข้อมูลทั่วไป
                <i class="fas fa-angle-left right text-warning"></i>
              </p>
            </a>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="index.php?profile" class="nav-link">
                    <i class="fas fa-user nav-icon"></i>
                    <p>ข้อมูลส่วนตัว</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="index.php?news" class="nav-link">
                    <i class="fas fa-newspaper nav-icon"></i>
                    <p>ข่าวประชาสัมพันธ์</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="index.php?members" class="nav-link">
                    <i class="fas fa-users nav-icon"></i>
                    <p>สมาชิก</p>
                  </a>
                </li>
              </ul>

          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th-list text-info"></i>
              <p>
                จัดการ ข้อมูลสินค้า
                <i class="fas fa-angle-left right text-warning"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="index.php?type" class="nav-link">
                    <i class="fas fa-box nav-icon"></i>
                    <p>ประเภทสินค้า</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="index.php?product" class="nav-link">
                    <i class="fas fa-box-open nav-icon"></i>
                    <p>สินค้า</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="index.php?r_product" class="nav-link">
                    <i class="fas fa-people-carry nav-icon"></i>
                    <p>แนะนำสินค้ามาใหม่</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="index.php?top5_product" class="nav-link">
                    <i class="fas fa-boxes nav-icon"></i>
                    <p>สินค้าขายดี</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="index.php?shipping_cost" class="nav-link">
                    <i class="fas fa-car nav-icon"></i>
                    <p>ค่าจัดส่งสินค้า</p>
                  </a>
                </li>               
                <li class="nav-item">
                  <a href="index.php?promotion" class="nav-link">
                    <i class="fas fa-percentage nav-icon"></i>
                    <p>โปรโมชั่นสินค้า</p>
                  </a>
                </li>
              </ul>

          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart text-info"></i>
              <p>
                จัดการ ข้อมูลการสั่งซื้อ
                <i class="fas fa-angle-left right text-warning"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">            
                <li class="nav-item">
                  <a href="index.php?order" class="nav-link">
                    <i class="fas fa-list-ol nav-icon"></i>
                    <p>รายการสั่งซื้อ</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="index.php?status_pay" class="nav-link">
                    <i class="fas fa-donate nav-icon"></i>
                    <p>การชำระเงิน</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="index.php?status_send" class="nav-link">
                    <i class="fas fa-car-side nav-icon"></i>
                    <p>การจัดส่งสินค้า</p>
                  </a>
                </li>
              </ul>
              
          </li>

          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file-alt text-info"></i>
              <p>
                รายงาน
                <i class="fas fa-angle-left right text-warning"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">            
                <li class="nav-item">
                  <a href="index.php?order" class="nav-link">
                    <i class="fas fa-file-import nav-icon"></i>
                    <p>ใบรับเสร็จรับเงิน</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="index.php?order" class="nav-link">
                    <i class="fas fa-file-import nav-icon"></i>
                    <p>ใบสั่งซื้อ</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="index.php?order" class="nav-link">
                    <i class="fas fa-file-import nav-icon"></i>
                    <p>การชำระเงินของลูกค้า</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="index.php?order" class="nav-link">
                    <i class="fas fa-file-import nav-icon"></i>
                    <p>ใบส่งสินค้า</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="index.php?order" class="nav-link">
                    <i class="fas fa-file-import nav-icon"></i>
                    <p>สินขายดี</p>
                  </a>
                </li>
              </ul>
              
          </li> -->



          <li class="nav-header"></li>
          <li class="nav-item">
            <a href="../bn_logout.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
              <p class="text">ออกจากระบบ</p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>