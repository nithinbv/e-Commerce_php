<?php  
 if(isset($_POST["productId"]) && isset($_POST["productName"]) && isset($_POST["productDescription"]) && isset($_POST["priceReference"]) && isset($_POST["imageReference"]))  
 {  
    $db = new Db();
        
            $sql = "UPDATE JEWELARY_PRODUCT
            SET  PRODUCT_NAME='".$_POST['productName']."', PRODUCT_DESC = '".$_POST['productDescription']."', PRICE = ".$_POST['priceReference'].",  IMAGE_ID = '".$_POST["imageReference"]."'
            WHERE PRODUCT_ID = ".$_POST['productId']."";
      
            $result = $db -> query($sql);

      if ($result)
      {   
        echo 'Good';
      }  
      else  
      {        
        echo 'Bad';
      }  
 }  
 ?>