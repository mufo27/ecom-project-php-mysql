<?php
        require_once '../database/con_db.php';

        if (isset($_GET['shipping_cost_del'])) {

            $sc_id = $_GET['shipping_cost_del'];
            
            try {

                $delete_type = $conn->prepare("DELETE FROM shipping_cost WHERE sc_id = :sc_id");
                $delete_type->bindParam(':sc_id' , $sc_id);

                if ($delete_type->execute()) {

                    echo "<script>alert('ลบค่าจัดส่งสินค้านี้ เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?shipping_cost\">";
                    exit;
                }

            } catch (PDOException $e) {

                echo $e->getMessage();

            }

        }
?>