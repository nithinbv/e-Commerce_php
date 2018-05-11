<?php  
 if(isset($_POST["orderId"]) && isset($_POST["payStatus"]))  
 {  
    $db = new Db();

            $sql = "UPDATE ORDER_DETAIL
            SET  IS_PAYMENT_COMPLETED = '".$_POST["payStatus"]."'
            WHERE ORDER_ID = ".$_POST['orderId']."";
      
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