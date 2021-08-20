<?php 
        require_once '../../database/con_db.php'; 

        if (isset($_GET['paypal'])) {

            $pm_id      =  $_GET['paypal'];
            $pm_total   =  $_GET['number'];
            $pm_status  =  2;
            $pm_date    =  date('Y-m-d');

            
            try {

                $save_pm = $conn->prepare("UPDATE payment SET pm_total=:pm_total, pm_status=:pm_status, pm_date=:pm_date WHERE pm_id = :pm_id");
                $save_pm->bindParam(':pm_id'     ,   $pm_id);
                $save_pm->bindParam(':pm_total'  ,   $pm_total);
                $save_pm->bindParam(':pm_status' ,   $pm_status);
                $save_pm->bindParam(':pm_date'   ,   $pm_date);
                
                if ($save_pm->execute()) {
                    
                    echo "<script>alert('คุณได้ทำการชำระเงินผ่าน ระบบ PAYPAL เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?status_pay\">";
                    exit;
                }

            } catch (PDOException $e) {

                echo $e->getMessage();

            }   
            
        }

?>
