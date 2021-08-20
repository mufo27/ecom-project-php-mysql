<?php
        require_once '../database/con_db.php';

        if (isset($_GET['type_del'])) {

            $t_id = $_GET['type_del'];
            
            try {

                $delete_type = $conn->prepare("DELETE FROM type WHERE t_id = :t_id");
                $delete_type->bindParam(':t_id' , $t_id);

                if ($delete_type->execute()) {

                    echo "<script>alert('ลบข้อมูลประเภทสินค้า เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?type\">";
                    exit;
                }

            } catch (PDOException $e) {

                echo $e->getMessage();

            }

        }
?>