<?php  
 if(isset($_POST["productId"]) && isset($_POST["address1"]) && isset($_POST["zipCode"]) && isset($_POST["comments"])
    && isset($_POST["shipstatus"]) && isset($_POST["paymentType"]) && isset($_POST["totalPrice"])
    && isset($_SESSION['username']))  
 { 
    $db = new Db();
    $totalPrice = $db -> quote($_POST["totalPrice"]);
            $sql = "INSERT INTO ORDER_DETAIL
                    (`PRODUCT_ID`,`EMAIL_ID`,`ADDRESS_1`,`ADDRESS_2`,`ZIP_CODE`,`SHIP_TYPE_ID`,`DATE_CREATED`,
                    `PRICE`,`ORDER_DESC`,`PAYMENT_METHOD_ID`)
                    VALUES (".$_POST['productId'].",'".$_SESSION['username']."','".$_POST['address1']."','".$_POST['address2']."',
                    '".$_POST['zipCode']."',".$_POST['shipstatus'].",NOW(),'$totalPrice','".$_POST['comments']."',
                    ".$_POST['paymentType'].");";
      
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