<?php
        require_once '../database/con_db.php';

        if (isset($_GET['news_del'])) {

            $n_id = $_GET['news_del'];
            
            try {

                $delete_n = $conn->prepare("DELETE FROM news WHERE n_id = :n_id");
                $delete_n->bindParam(':n_id' , $n_id);

                if ($delete_n->execute()) {

                    echo "<script>alert('ลบข่าวประชาสัมพันธ์ เรียบร้อย...!!')</script>";
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?news\">";
                    exit;
                }

            } catch (PDOException $e) {

                echo $e->getMessage();

            }

        }
?>