<?php 
		require_once '../database/con_db.php';  
    
    if (isset($_GET['shipping_cost'])) {

      try {

        $select_sc = $conn->prepare("SELECT * FROM shipping_cost");
        $select_sc->execute();
        $row_sc = $select_sc->fetch(PDO::FETCH_ASSOC);

      } catch (PDOException $e) {

          echo $e->getMessage();

      }

    }
    

?>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">ค่าจัดส่งสินค้า</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">ค่าจัดส่งสินค้า</li>
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
             
              </div>
              <div class="card-body">

              <div class="row text-center mt-5">
                <div class="col">
                  <h1><i class="fas fa-car-side fa-3x"></i> </h1>
                </div>
              </div>


                  <div class="row text-center mt-5">
                  <div class="col">

                    <?php if(isset($roq_sc)) {?>

                      <a a href="index.php?shipping_cost_form_add" class="btn bg-success btn-lg"><i class="fas fa-plus-square"></i> เพิ่มค่าจัดส่งสินค้า</a>

                    <?php } else { ?>

                      <h1>ค่าจัดส่งสินค้า : <?=  $row_sc['cost']?> บาท</h1> 


                  </div>
                </div>

                <div class="row text-center mt-5">
                  <div class="col">
                      <a href="index.php?shipping_cost_form_edit=<?= $row_sc['sc_id']; ?>" class="btn bg-warning"><i class="fas fa-edit"></i> แก้ไขค่าจัดส่งสินค้า</a>
                      <!-- <a href="index.php?shipping_cost_del=<?= $row_sc['sc_id']; ?>" class="btn bg-danger"><i class="fas fa-trash-alt"></i> ลบค่าจัดส่งสินค้า</a> -->
                  </div>
                </div>

                <?php } ?>

               


              </div>

              <div class="card-footer clearfix">
               
              </div>
            </div>

          </div>
        </div>

      </div>
    </section>

    