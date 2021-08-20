<?php
        require_once '../database/con_db.php';

        if (isset($_GET['promotion_del'])) {

            $pr_id = $_GET['promotion_del'];
            
            try {

                $delete_pr = $conn->prepare("DELETE FROM promotion WHERE pr_id = :pr_id");
                $delete_pr->bindParam(':pr_id' , $pr_id);

                if ($delete_pr->execute()) {

                    echo "<script>alert('ลบโปรโมชั่น เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?promotion\">";
                    exit;
                }

            } catch (PDOException $e) {

                echo $e->getMessage();

            }

        }
?>