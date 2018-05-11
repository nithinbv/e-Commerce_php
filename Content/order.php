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
                <th class="header">Customer Name</th>   
                <th class="header">Address</th> 
                <th class="header">Product Name</th>
                <th class="header">Price</th>
                <th class="header">Payment Method</th>
                <th class="header">Shipment Carrier</th>
                <th class="header">Payment Status</th>
            </tr>
        </thead>
        <tbody>

        <?php
        
            $db = new Db();
            $rows = $db -> select("SELECT 	od.ORDER_ID as ORDER_ID, 
		CONCAT(u.FIRST_NAME,\" \",u.LAST_NAME) AS NAME, 
		CONCAT(od.ADDRESS_1,\" \",od.ADDRESS_2) AS ADDRESS, 
		jp.PRODUCT_NAME AS PRODUCT_NAME, 
		jp.PRICE AS PRICE, 
		pm.METHOD_NAME AS PAYMENT_METHOD, 
		st.TYPE_NAME AS SHIPMENT_CARRIER, 
		od.IS_PAYMENT_COMPLETED AS PAYMENT_STATUS
FROM 	ORDER_DETAIL od, 
		JEWELARY_PRODUCT jp, 
		USERS u, 
		SHIP_TYPE st, 
		PAYMENT_METHOD pm
WHERE 	od.PRODUCT_ID=jp.PRODUCT_ID
		AND od.EMAIL_ID=u.EMAIL_ID
		AND od.SHIP_TYPE_ID=st.TYPE_ID
		AND od.PAYMENT_METHOD_ID=pm.METHOD_ID
ORDER BY od.ORDER_ID");
        
            //print(count($rows));
            
            if (count($rows) > 0) 
            {
                $orderCount = count($rows);
                
                foreach($rows as $tkey => $tval) 
                {
                    $orderId = $tval['ORDER_ID'];
                    $custName =  $tval['NAME']; 
                    $custAdd = $tval['ADDRESS'];
                    $prodName = $tval['PRODUCT_NAME'];
                    $prodPrice = $tval['PRICE'];
                    $payMeth = $tval['PAYMENT_METHOD'];
                    $shipCarrier = $tval['SHIPMENT_CARRIER'];
                    $payStatus = $tval['PAYMENT_STATUS'];
        ?>
                <tr>                  
                    <td><a href="#view<?php echo $orderId ?>" data-toggle="modal" >#<?php echo $orderId ?></a></td>
                    <td><?php echo $custName ?></td>
                    <td><?php echo $custAdd ?></td>
                    <td><?php echo $prodName ?></td>
                    <td><?php echo $prodPrice ?></td> 
                    <td><?php echo $payMeth ?></td>
                    <td><?php echo $shipCarrier ?></td>
                    <td><?php echo $payStatus ?></td>                      
                    <div class="modal fade" id="view<?php echo $orderId ?>" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="box">
                                    <form>
                                        <h2>Order no: <?php echo $orderId ?></h2>
                                        <div class="content">
                                            
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">                                                    
                                                        <label for="company">Payment Status</label>                                           
            
                                                            <select  class="form-control" id="payStatus<?php echo $orderId ?>" >
                                                               <?php if($payStatus == "Y" ) {?>    
                                                                <option value="Y" selected>Yes</option>
                                                                <option value="N" >No</option>
                                                                <?php } else { ?>
                                                                  <option value="Y" >Yes</option>
                                                                <option value="N" selected>No</option>
                                                               
                                                                <?php }?>
                                                            </select>
                                                    </div>
                                                </div>
                                            </div>                                                        
                                                    
                                            <div class="box-footer">     
                                                <div class="pull-right">
                                                <button type="submit" class="btn btn-primary" data-dismiss="modal">Cancel</i>
                                                    </button>
                                                    <!-- <button type="submit" class="btn btn-primary" id="save_button" >Save</i> -->
                                                    <button type='submit' class="btn btn-primary" id="save_button<?php echo $orderId;?>" 
                                                      value="Save" onclick="return save_row('<?php echo $orderId;?>',event);">Save</i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>                                           
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>                        
                </tr>
                  <?php }
            }
            else 
            {
              echo "0 results";
            }
        ?>

</tbody>
</table>
<div class="pull-right">
<h5>Showing <?php echo $orderCount ?> records</h5>
</div>
</div>
</div>

<script>  

function save_row(id,event)
{    
	event.preventDefault();
    var orderId =  id;      
    var payStatus = $('#payStatus'+orderId).val(); 
   //alert("I am here");
    //alert(orderId);
    //alert(payStatus);
       if(orderId != '')  
       {
            $.ajax(
            {  

                url:"./home.php?page=order_save",  
                method:"POST",  
                data: {orderId:orderId, payStatus:payStatus},  

                    success:function(data)  
                     {  
                        if(data == 'Bad')  
                        {  
                            $('#view'+orderId).hide();
                            $('#unSuccessfullyModal')
                                .modal('toggle')
                                .delay(2000)
                                .fadeOut("slow", function() {
                                    location.reload();
                                }); 
                        }  
                        else  
                        { 
                            $('#view'+orderId).hide();
                            $('#successfullyModal')
                               .modal('toggle')
                               .delay(2000)
                               .fadeOut("slow", function() {
                                   location.reload();
                               });  
                        }                          
                    }

            }); 
           
       }  
           else  
           {  
            $('#view'+orderId).hide();
            $('#warningModal').modal('toggle');                                        
           }
       return false;
}
      
 </script>
