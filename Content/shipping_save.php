<?php  
 if(isset($_POST["invoice"]) && isset($_POST["shipstatus"]) && isset($_POST["invoiceDescription"])
    && isset($_POST["shipReference"]))  
 {  
    $db = new Db();

            $sql = "UPDATE devrajs1_ecommerce.INVOICE_DETAIL
            SET  SHIP_STATUS_ID = ".$_POST['shipstatus'].",
            DATE_UPDATED = NOW(),  SHIP_REF_ID = '".$_POST["shipReference"]."', INVOICE_DESC = '".$_POST['invoiceDescription']."'
            WHERE INVOICE_ID = ".$_POST['invoice']."";
      
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