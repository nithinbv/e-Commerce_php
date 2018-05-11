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
                <th class="header headerSortDown">Product</th>
                <th class="header">Product name</th>   
                <th class="header">Product Description</th> 
                <th class="header">Price</th>
                <th class="header">ImageUrl</th>
            </tr>
        </thead>
        <tbody>

        <?php
        
            $db = new Db();
            $rows = $db -> select("SELECT `PRODUCT_ID`, `PRODUCT_NAME`, `PRODUCT_DESC`, `PRICE`, `IMAGE_ID` FROM JEWELARY_PRODUCT order by PRODUCT_ID");
        
            //print(count($rows));
            
            if (count($rows) > 0) 
            {
                $productCount = count($rows);
                
                foreach($rows as $tkey => $tval) 
                {
                    $productId1 = $tval['PRODUCT_ID'];
                    $productName1 =  $tval['PRODUCT_NAME']; 
                    $productDesc1 = $tval['PRODUCT_DESC'];
                    $productPrice1 = $tval['PRICE'];
                    $imageURL1 = $tval['IMAGE_ID'];
        ?>
                <tr>                  
                    <td><a href="#view<?php echo $productId1 ?>" data-toggle="modal" >#<?php echo $productId1 ?></a></td>
                    <td><?php echo $productName1 ?></td>
                    <td><?php echo $productDesc1 ?></td>
                    <td><?php echo $productPrice1 ?></td>
                    <td><?php echo $imageURL1 ?></td>               
                    <div class="modal fade" id="view<?php echo $productId1 ?>" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="box">
                                    <form>
                                        <h2>Product no: <?php echo $productId1 ?></h2>
                                        <div class="content">
        
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">                                                    
                                                        <label for="company">Product Name</label>
                                                        <input type="text" class="form-control" id="productName<?php echo $productId1;?>" maxlength="90" value="<?php echo $productName1;?>">
                                                    </div>
                                                </div>
                                            </div>        
        
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="form-group">                                                    
                                                        <label for="company">Price</label>
                                                        <input type="text" class="form-control" id="priceReference<?php echo $productId1;?>" maxlength="15" value="<?php echo $productPrice1;?>">
                                                    </div>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="form-group">                                                    
                                                        <label for="company">Image url</label>
                                                        <input type="text" class="form-control" id="imageReference<?php echo $productId1;?>" maxlength="90" value="<?php echo $imageURL1;?>">
                                                    </div>
                                                </div> 
                                            </div>
        
                                            <div class="row">
                                               <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="lastname">Product Description</label>
                                                        <textarea type="text" class="form-control" id="productDescription<?php echo $productId1;?>"  maxlength="90" 
                                                        value=<?php echo $productDesc1 ?>  placeholder="Product description"><?php echo $productDesc1 ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-footer">     
                                            <div class="pull-right">
                                            <button type="submit" class="btn btn-primary" data-dismiss="modal">Cancel</i>
                                                </button>
                                                <!-- <button type="submit" class="btn btn-primary" id="save_button" >Save</i> -->
                                                <button type='submit' class="btn btn-primary" id="save_button<?php echo $productId1;?>" 
                                                  value="Save" onclick="return save_row('<?php echo $productId1;?>',event);">Save</i>
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
            else 
            {
              echo "0 results";
            }
        ?>

</tbody>
</table>
<div class="pull-right">
<h5>Showing <?php echo $productCount ?> records</h5>
</div>
</div>
</div>

<script>  

function save_row(id,event)
{    
	event.preventDefault();
    var productId =  id;
    var productName = $('#productName'+productId).val();
    var productDescription = $('#productDescription'+productId).val(); 
    var priceReference =  $('#priceReference'+productId).val();
    var imageReference = $('#imageReference'+productId).val();

       if(productId != '')  
       {
            $.ajax(
            {  

                url:"./home.php?page=inventory_save",  
                method:"POST",  
                data: {productId:productId, productName:productName, productDescription:productDescription, priceReference:priceReference, imageReference:imageReference},  

                    success:function(data)  
                     {  
                        if(data == 'Bad')  
                        {  
                            $('#view'+productId).hide();
                            $('#unSuccessfullyModal')
                                .modal('toggle')
                                .delay(2000)
                                .fadeOut("slow", function() {
                                    location.reload();
                                }); 
                        }  
                        else  
                        { 
                            $('#view'+productId).hide();
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
            $('#view'+productId).hide();
            $('#warningModal').modal('toggle');                                        
           }
       return false;
}
      
 </script>
