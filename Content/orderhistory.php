<div id="all">    
        <div id="content">
            <div class="container">    
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li><a href="./home.php?page=landing">Home</a>
                            </li>
                            <li><?php echo $_SESSION['parameterName']?></li>
                        </ul>    
                    </div>
                </div>
        </div>
</div>
<div class="container">
<div class="iw">
<table class="ck" data-sort="table">
  <thead>
    <tr>     
      <th class="header headerSortDown">Order</th>
      <th class="header">Product</th>     
      <th class="header">Ship</br>  Type</th>   
      <th class="header">Total</br>  Price($)</th>
      <th class="header">Payment</br>  Type</th>    
      <th class="header">Is Payment</br> Completed</th>
      <th class="header">Invoice</th>  
      <th class="header">Ship</br>  Info</th>    
      <th class="header">Ship</br>  Status</th>     
    </tr>
  </thead>
  <tbody>
  <?php

  $userId =  $_SESSION['username'];
  $db = new Db();
  
  $rows = $db -> select("SELECT OD.ORDER_ID,JP.PRODUCT_NAME,ST.TYPE_NAME,OD.PRICE,PM.METHOD_NAME
                        ,IF(OD.IS_PAYMENT_COMPLETED = 'Y', 'Yes', 'No') as IS_PAYMENT_COMPLETED
                        ,ID.INVOICE_ID,ID.SHIP_REF_ID,SS.STATUS_NAME
                        FROM `devrajs1_ecommerce`.`ORDER_DETAIL` as OD  
                        LEFT JOIN  `devrajs1_ecommerce`.`INVOICE_DETAIL` as ID 
                        ON OD.ORDER_ID = ID.ORDER_ID 
                        INNER JOIN `devrajs1_ecommerce`.`JEWELARY_PRODUCT` as JP ON OD.PRODUCT_ID = JP.PRODUCT_ID 
                        INNER JOIN `devrajs1_ecommerce`.`SHIP_TYPE` as ST ON OD.SHIP_TYPE_ID = ST.TYPE_ID
                        LEFT JOIN `devrajs1_ecommerce`.`SHIP_STATUS` as SS ON SS.STATUS_ID = ID.SHIP_STATUS_ID
                        INNER JOIN `devrajs1_ecommerce`.`PAYMENT_METHOD` as PM ON PM.METHOD_ID = OD.PAYMENT_METHOD_ID
                        where  OD.EMAIL_ID = '$userId' order by OD.ORDER_ID desc");
  
  //print(count($rows));

  if (count($rows) > 0) {
            $orderHistoryCount = count($rows);
            foreach($rows as $tkey => $tval) {   ?>           
              <tr>                  
                <td><?php echo $tval["ORDER_ID"] ?></td>           
                <td><?php echo $tval["PRODUCT_NAME"] ?></td>
                <td><?php echo $tval["TYPE_NAME"] ?></td>
                <td><?php echo $tval["PRICE"] ?></td>               
                <td><?php echo $tval["METHOD_NAME"] ?></td>
                <td><?php echo $tval["IS_PAYMENT_COMPLETED"] ?></td>               
                <td><?php echo $tval["INVOICE_ID"] ?></td>
                <td><?php echo $tval["SHIP_REF_ID"] ?></td>               
                <td><?php echo $tval["STATUS_NAME"] ?></td>
              </tr>
              <?php }
        }
   else {
      echo "0 results";
  }
?>

</tbody>
</table>
<div class="pull-right">
<h5>Showing <?php echo $orderHistoryCount ?> records</h5>
</div>
</div>
</div>
