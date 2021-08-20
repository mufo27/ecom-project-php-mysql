<?php
        require_once '../database/con_db.php';

        if (isset($_GET['product_del'])) {

            $p_id = $_GET['product_del'];
            
            try {

                $delete_product = $conn->prepare("DELETE FROM product WHERE p_id = :p_id");
                $delete_product->bindParam(':p_id' , $p_id);

                if ($delete_product->execute()) {

                    echo "<script>alert('ลบข้อมูลสินค้า เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?product\">";
                    exit;
                }

            } catch (PDOException $e) {

                echo $e->getMessage();

            }

        }
?>