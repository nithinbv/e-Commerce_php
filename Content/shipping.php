
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
      <th class="header headerSortDown">Invoice</th>
      <th class="header">Order</th>
      <th class="header">Ship Status</th>
      <th class="header">Ship Reference</th>
      <th class="header">Comments</th>   
      <th class="header">Date Updated</th>
    </tr>
  </thead>
  <tbody>
  <?php


  $db = new Db();


  
  $rows = $db -> select("SELECT INVOICE_ID, od.ORDER_ID as ORDER_ID, ss.STATUS_NAME as STATUS_NAME
                        , id.DATE_UPDATED as DATE_UPDATED, INVOICE_DESC ,SHIP_REF_ID
                        FROM `devrajs1_ecommerce`.`INVOICE_DETAIL` id ,`devrajs1_ecommerce`.`ORDER_DETAIL` od
                        , `devrajs1_ecommerce`.`SHIP_STATUS` ss 
                        where id.ORDER_ID = od.ORDER_ID and ss.STATUS_ID = id.SHIP_STATUS_ID
                        order by INVOICE_ID");
  
  //print(count($rows));

  if (count($rows) > 0) {
            $invoiceCount = count($rows);
            foreach($rows as $tkey => $tval) {
              $invoiceId = $tval['INVOICE_ID'];
              $orderId =  $tval['ORDER_ID']; 
              $shipStatusDesc = $tval['STATUS_NAME'];
              $shipRef = $tval['SHIP_REF_ID'];
              $invoiceDesc = $tval['INVOICE_DESC'];
              $dateUpdated =  $tval['DATE_UPDATED'];
              ?>
              <tr>                  
                <td><a href="#view<?php echo $invoiceId ?>" data-toggle="modal" >#<?php echo $invoiceId ?></a></td>           
                <td><?php echo $orderId ?></td>
                <td><?php echo $shipStatusDesc ?></td>
                <td><?php echo $shipRef ?></td>
                <td><?php echo $invoiceDesc ?></td>               
                <td><?php echo date("m-d-Y h:i", strtotime($dateUpdated)) ?></td>
                <div class="modal fade" id="view<?php echo $invoiceId ?>" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="box">
                                <form>
                                    <h2>Invoice no: <?php echo $invoiceId ?></h2>
                                    <div class="content">
                                    <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">                                                    
                                                    <label for="company">Ship Status</label>
                                                    <select  class="form-control" id="shipSelection<?php echo $invoiceId ?>" >
                                                    <?php                                                     
                                                      $db = new Db();
                                                      $rows = $db -> select("SELECT STATUS_ID,STATUS_NAME as SHIP_DESC FROM devrajs1_ecommerce.SHIP_STATUS");
                                                      if (count($rows) > 0) {
                                                        foreach($rows as $tkey => $tval) {
                                                          $shipStatusId =  $tval['STATUS_ID']; 
                                                          $shipStatus = $tval['SHIP_DESC'];
                                                              if($shipStatusDesc == $shipStatus ) {?>                                                               
                                                              <option value=<?php echo $shipStatusId ?> id="shipstatusId" selected ><?php echo  $shipStatus ?></option>;                                                               
                                                              <?php }
                                                              else {?>
                                                                  <option value=<?php echo $shipStatusId ?> id="shipstatusId" ><?php echo  $shipStatus ?></option>;                                                               
                                                                  <?php  }
                                                               }
                                                              }
                                                        else {
                                                            echo "0 results";
                                                        }
                                                      ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">                                                    
                                                    <label for="company">Ship Reference</label>
                                                    <input type="text" class="form-control" id="shipReference<?php echo $invoiceId;?>" maxlength="15" value="<?php echo $shipRef;?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                           <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="lastname">Invoice Description</label>
                                                    <textarea type="text" class="form-control" id="invoiceDescription<?php echo $invoiceId;?>"  maxlength="90" 
                                                    value=<?php echo $invoiceDesc ?>  placeholder="shipping description"><?php echo $invoiceDesc ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer">     
                                        <div class="pull-right">
                                        <button type="submit" class="btn btn-primary" data-dismiss="modal">Cancel</i>
                                            </button>
                                            <!-- <button type="submit" class="btn btn-primary" id="save_button" >Save</i> -->
                                            <button type='submit' class="btn btn-primary" id="save_button<?php echo $invoiceId;?>" 
                                              value="Save" onclick="return save_row('<?php echo $invoiceId;?>',event);">Save</i>
                                            </button>
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
   else {
      echo "0 results";
  }
?>

</tbody>
</table>
<div class="pull-right">
<h5>Showing <?php echo $invoiceCount ?> records</h5>
</div>
</div>
</div>

<script>  

function save_row(id,event)
{    
		event.preventDefault();
        var invoiceId =  id;
        var shipstatusId = $('#shipSelection'+invoiceId).val();        
        var invoiceDescription = $('#invoiceDescription'+invoiceId).val(); 
        var shipReference =  $('#shipReference'+invoiceId).val();  
       
           if(invoiceId != '' && shipstatusId != '')  
           {
                $.ajax({  
                    url:"./home.php?page=shipping_save",  
                    method:"POST",  
                    data: {invoice: invoiceId,shipstatus:shipstatusId, invoiceDescription:invoiceDescription
                           , shipReference:shipReference},  
                        
                           
                    success:function(data)  
                     {  
                        if(data == 'Bad')  
                        {  
                            $('#view'+invoiceId).hide();
                            $('#unSuccessfullyModal')
                                .modal('toggle')
                                .delay(2000)
                                .fadeOut("slow", function() {
                                    location.reload();
                                }); 
                        }  
                        else  
                        { 
                            $('#view'+invoiceId).hide();
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
            $('#view'+invoiceId).hide();
            $('#warningModal').modal('toggle');                                        
           }
           return false;  
      }
 


 </script>  