<?php
    session_start(); 

    require_once('database/con_db.php');

    $select= $conn->prepare("SELECT * FROM tb_facebook WHERE FACEBOOK_ID = '".$_POST["hdnFbID"]."'");
    $select->execute();
    $objResult = $select->fetch(PDO::FETCH_ASSOC);

	if($objResult)
	{
		$_SESSION["status"]         =  $objResult["status"];
		$_SESSION["strFacebookID"]  =  $objResult["FACEBOOK_ID"];
		$_SESSION["NAME"]           =  $objResult["NAME"];
		$_SESSION["EMAIL"]          =  $objResult["EMAIL"];
		$_SESSION["id"]             =  $objResult["ID"];
		header("location:member/index.php");
		exit();
	}
	else
	{
        
			$strPicture  = "https://graph.facebook.com/".$_POST["hdnFbID"]."/picture?type=large";
			$strLink     = "https://www.facebook.com/app_scoped_user_id/".$_POST["hdnFbID"]."/";

            $FACEBOOK_ID = trim($_POST["hdnFbID"]);
            $NAME        = trim($_POST["hdnName"]);
            $EMAIL       = trim($_POST["hdnEmail"]);
            $PICTURE     = trim($strPicture);
            $LINK        = trim($strLink);
            $REATE_DATE  = trim(date("Y-m-d H:i:s"));
            $status      = 'facebook';

			$strSQL =$conn->prepare("INSERT INTO tb_facebook (FACEBOOK_ID, NAME, EMAIL, PICTURE, LINK, CREATE_DATE, status) 
                                            VALUES (:FACEBOOK_ID, :NAME, :EMAIL, :PICTURE, :LINK, :REATE_DATE, :status)
                                    ");
            $strSQL->bindParam(':FACEBOOK_ID'   ,   $FACEBOOK_ID);
            $strSQL->bindParam(':NAME'          ,   $NAME);
            $strSQL->bindParam(':EMAIL'         ,   $EMAIL);
            $strSQL->bindParam(':PICTURE'       ,   $PICTURE);
            $strSQL->bindParam(':LINK'          ,   $LINK);
            $strSQL->bindParam(':REATE_DATE'    ,   $REATE_DATE);
            $strSQL->bindParam(':status'        ,   $status);
            $strSQL->execute();
            $last_id = $conn->lastInsertId();

			$_SESSION["id"]             =  $last_id ;
			$_SESSION['status']         =  'facebook';
			$_SESSION["strFacebookID"]  =  $_POST["hdnFbID"];
			$_SESSION["NAME"]           =  $_POST["hdnName"];
            $_SESSION["EMAIL"]          =  $_POST["hdnEmail"];
            $_SESSION["pic"]            =  $strPicture;
			header("location:member/index.php");
			exit();
	}
	mysqli_close();
?>