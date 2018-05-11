<?php  
 if(isset($_POST["emailId"]))  
 {  
    $db = new Db();

            $sql = "DELETE FROM SUBSCRIBE WHERE EMAIL_ID='".$_POST["emailId"]."'";
      
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