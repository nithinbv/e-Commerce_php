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
  <div id="content">
           <div class="container">              
                <div class="col-md-12">      
                    <div class="row products">
                    <?php
                      $catagoryId = $_SESSION['parameterId'];
                      $db = new Db();
                      $rows = $db -> select("SELECT jt.TYPE_NAME TYPE_NAME, jc.CATEGORY_NAME CATEGORY_NAME,jp.PRODUCT_ID PRODUCT_ID,jp.PRODUCT_NAME PRODUCT_NAME,jp.PRODUCT_DESC PRODUCT_DESC,jp.PRICE PRICE,jp.IMAGE_ID IMAGE_ID
FROM JEWELARY_CATEGORY jc, JEWELARY_TYPE jt, JEWELARY_PRODUCT jp
where jp.CATEGORY_ID = '$catagoryId'
and jp.CATEGORY_ID=jc.CATEGORY_ID
and jp.TYPE_ID=jt.TYPE_ID
order by jp.PRODUCT_NAME");
                      
               

                      if (count($rows) > 0) {
                                foreach($rows as $tkey => $tval){?>
                        
                        <div class="col-md-3">
                            <div class="product">
                                                  
                                    <img src=<?php echo "img/".$tval['TYPE_NAME']."/".$tval['CATEGORY_NAME']."/".$tval['IMAGE_ID']?> alt="" class="img-responsive">
                               <div class="text">
                                    <h3><?php echo $tval['PRODUCT_NAME'] ?></h3>
                                    <p class="price">$<?php echo $tval['PRICE'] ?></p>
                                    <p><?php echo $tval['PRODUCT_DESC'] ?></p>                                    
                                    <p class="buttons">  
                                    <?php if(isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']) {?>                                       
                                        <a  class="btn btn-primary" id="add_button" href="./home.php?page=checkout?<?php echo $tval['PRODUCT_ID'] ?>?Checkout">
                                        <i class="fa fa-shopping-cart" >  Add to cart</i></a>
                                    <?php } ?>
                                    </p>
                                    
                                </div>
                                <!-- /.text -->
                            </div>
                            <!-- /.product -->
                        </div>

                        <?php }
                              }
                        else {
                            echo "0 results";
                        }
                    ?>
                        
                        <!-- /.col-md-4 -->
                    </div>
                    <!-- /.products -->
                </div>
                <!-- /.col-md-9 -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->
