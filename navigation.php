<?php
if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == "Y")
{
    $isAdmin = "'Y','N'";
}
else{
    $isAdmin = "'Y'";
};

      $db = new Db();
      $rows = $db -> select("select jt.TYPE_ID AS TYPE_ID,jt.TYPE_NAME AS TYPE_NAME,jt.IS_SHOWN_FOR_USER as IS_SHOWN_FOR_USER,
       jc.CATEGORY_ID as CATEGORY_ID,jc.CATEGORY_NAME as CATEGORY_NAME,jc.H_REF_LINK as H_REF_LINK from 
       `devrajs1_ecommerce`.`JEWELARY_TYPE` jt, `devrajs1_ecommerce`.`JEWELARY_CATEGORY` jc
        where jt.TYPE_ID = jc.TYPE_ID and jt.IS_SHOWN_FOR_USER in ($isAdmin) order by jt.TYPE_NAME   ");
      
       // print(count($rows));

      if (count($rows) > 0) {
            $last_cat = null;          
            if($rows) {
                foreach($rows as $tkey => $tval) {
                    if ($tval['TYPE_ID'] !== $last_cat ) {
                        $last_cat = $tval['TYPE_ID'];
                        $type[] = $tval;
                    }
                    //if($tval['TYPE_ID'] !== "4"){  // Not loping for home option could be done in a better way
                    $category [] = $tval;        
                    ///}        
                }
           }
      } else {
          echo "0 results";
      }
?>

<div class="navbar navbar-default yamm" role="navigation" id="navbar">
    <div class="container">
        <div class="navbar-header">
        <div class="navbar-collapse collapse" id="navigation">
            <ul class="nav navbar-nav navbar-left">
            <?php $last_type = null; foreach($type as $tkey => $tval) {?>  
                <?php $last_type = $tval['TYPE_ID'];  ?>                 
                <li class="dropdown yamm-fw" >                    
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="200"><?php echo ucwords($tval['TYPE_NAME']);?>      
                <b class="caret"></b>  
                </a> 
                    <ul class="dropdown-menu">                             
                    <li>                  
                        <div class="yamm-content">                    
                            <div class="row">                                
                                <!-- <div class="col-sm-3"> -->
                                  <?php foreach($category as $ckey => $cval) {?>   
                                    <?php if ($cval['TYPE_ID'] === $last_type) { ?>                                                              
                                        <ul>                                                             
                                            <li class="dropdown yamm-fw" >                                       
                                            <a  href="./home.php?page=<?php echo $cval['H_REF_LINK']?>?<?php echo $cval['CATEGORY_ID']?>?<?php echo urlencode($cval['CATEGORY_NAME'])?>">
                                             <?php echo ucwords($cval['CATEGORY_NAME']);?></a>
                                            </li>                                                                           
                                        </ul>
                                        <?php } ?> 
                                    <?php } ?> 
                                <!-- </div> -->
                            </div>
                        </div>
                    <!-- /.yamm-content -->
                    </li>
                    </ul>
                </li>  
                <?php } ?>             
            </ul>            
        </div>
    </div>
</div>