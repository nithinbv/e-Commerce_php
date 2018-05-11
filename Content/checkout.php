<?php
 $productId = $_SESSION['parameterId'];
$db = new Db();  
  $rows = $db -> select("SELECT PRODUCT_ID,    PRODUCT_NAME,  PRICE
                          FROM JEWELARY_PRODUCT
                          where PRODUCT_ID = '$productId';");

if (count($rows) > 0) {
    $produtPrice = $rows[0]["PRICE"];
    $productName = $rows[0]["PRODUCT_NAME"]; ?>
<body onload="caluclateTotal()">
<div id="content">
    <div class="container">
        <div class="col-md-9" id="checkout">
            <div class="box">
                <form>
                    <h1>Checkout product: <?php echo $productName ?></h1>
                    <div class="content">           
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company">Address 1</label>
                                    <input type="text"  class="form-control" id="address1" maxlength="40"
                                    placeholder="please enter your address 1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="street">Address 2</label>
                                    <input type="text"   class="form-control" id="address2" maxlength="40"
                                    placeholder="please enter your address 2">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company">Zip</label>
                                    <input type="text" class="form-control" id="zipCode" maxlength="5" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company">Payment Type</label>
                                    <select  class="form-control" id="paymentTypeId" >
                                        <?php                                                     
                                            $db = new Db();;
                                            $rows = $db -> select("SELECT METHOD_ID,METHOD_NAME FROM devrajs1_ecommerce.PAYMENT_METHOD");
                                            if (count($rows) > 0) {
                                            foreach($rows as $tkey => $tval) {
                                                $payTypeId =  $tval['METHOD_ID']; 
                                                $payType = $tval['METHOD_NAME'] ?>                                                                                                 
                                                    <option value=<?php echo $payTypeId ?> ><?php echo  $payType ?></option>;                                                               
                                                    <?php }
                                                    }
                                            else {
                                                echo "0 results";
                                            }
                                            ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="street">Ship Type</label>
                                    <select  class="form-control" id="shipTypeId" onchange="shipTypeChange()" >
                                        <?php                                                     
                                            $db = new Db();
                                            $rows = $db -> select("SELECT TYPE_ID,TYPE_NAME,COST FROM devrajs1_ecommerce.SHIP_TYPE");
                                            if (count($rows) > 0) {
                                                $shipValue = $rows[0]['COST'];
                                                foreach($rows as $tkey => $tval) {
                                                    $shipTypeId =  $tval['TYPE_ID']; 
                                                    $shipType = $tval['TYPE_NAME'] .' -      $'.  $tval['COST'];?>                                                                                                 
                                                        <option value=<?php echo $shipTypeId ?>  ><?php echo  $shipType ?></option>;                                                               
                                                        <?php }
                                                        }
                                                else {
                                                    echo "0 results";
                                                }
                                                ?>
                                            ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="state">Comments</label>
                                    <textarea class="form-control"  maxlength="80" id="comments" placeholder="please enter your comments"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">

                        <div align="center">
                            <button type="submit" class="btn btn-primary" id="submit_button">
                                Place the Order
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box"
                 id="order-summary">
                <div class="box-header">
                    <h3>Order summary</h3>
                </div>
                <p class="text-muted">Shipping costs are calculated based on the ship type you have selected.</p>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Order total</td>
                                <th><label id="orderValue">$<?php echo $produtPrice ?></label></th>
                            </tr>
                            <tr>
                                <td>Shipping and handling</td>
                                <th><label id="shippingValue">$<?php echo $shipValue ?></label></th>
                            </tr>
                            <tr >
                                <td>Total</td>
                                <th><label id="totalValue"></label></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }?>
 &nbsp;              
</body>
 <script>

     function shipTypeChange()
     { 
         var selectItem = document.getElementById("shipTypeId");
         var selectedValue = selectItem.options[selectItem.selectedIndex].text;
         var fields = selectedValue.split('$');         
         document.getElementById("shippingValue").innerText = "$"+fields[1]; 
         caluclateTotal();
     }

     function caluclateTotal(){
       var total =  +document.getElementById("orderValue").innerText.split('$')[1] +  +document.getElementById("shippingValue").innerText.split('$')[1];
       
     
        document.getElementById("totalValue").innerText = "$"+total.toFixed(2);
     }

 $(document).ready(function(){  
      $('#submit_button').click(function(){  
        var productId = "<?php echo $_SESSION['parameterId'];?>";
        var address1 = $('#address1').val(); 
        var address2 = $('#address2').val(); 
        var zipCode =  $('#zipCode').val(); 
        var shipstatus = $('#shipTypeId').val(); 
        var paymentType = $('#paymentTypeId').val(); 
        var comments = $('#comments').val();   
        var totalPrice = $('#totalValue').text().split('$')[1];   
       
           if(productId != '' && address1 != '' && zipCode != '' && totalPrice != '')  
           {    
                $.ajax({  
                    url:"./home.php?page=checkout_save",  
                    method:"POST",  
                    data: {productId: productId,address1:address1, address2:address2,zipCode:zipCode,
                           shipstatus:shipstatus,paymentType:paymentType,
                           comments:comments,totalPrice:totalPrice},                  
                    success:function(data)  
                    {
                        if(data == 'Bad')  
                        {  
                            $('#unSuccessfullyModal')
                            .modal('toggle')
                            .delay(2000)
                            .fadeOut("slow", function() {
                                location.reload();
                            }); 
                        }  
                        else  
                        {   
                            $('#successfullyModal')
                            .modal('toggle')
                            .delay(2000)
                            .fadeOut("slow", function() {
                                window.location.replace('./home.php?page=orderhistory?1?OrderHistory');
                                return false;
                            });                          
                           
                          
                        }  
                    }
                
                      
                });
           }  
           else  
           {  
                $('#warningModal').modal('toggle');                      
           }
           return false;  
      });  
 
 });  

</script>