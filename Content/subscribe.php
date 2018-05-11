<?php $subscribeCount = 0 ?>
<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
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

<!-- <div class="container">
       
        <div class="col-sm-6">
            <div class="input-group">
                <input type="text" class="form-control" name = "subscribeInfo" id="subscribeInfo">
                <span class="input-group-btn" >
                    <button class="btn btn-default" type="search" 
                    ame="subscribeSearch" id= "subscribeSearch" >Search!</button>
                </span>   
            </div>
        </div>
   
  </div> -->
<div class="container">
    <div class="iw">
    <table class="ck" data-sort="table">
    <thead>
        <tr>            
        <th class="header"></th>
        <th class="header">Subscribers Email</th>
        
    </thead>
    <tbody> 
    <?php
            $db = new Db();            
            $rows = $db -> select("SELECT EMAIL_ID FROM SUBSCRIBE ;");
            
            //print(count($rows));

            if (count($rows) > 0) {
                        $subscribeCount = count($rows);
                        foreach($rows as $tkey => $tval) {
                        $emailId = $tval['EMAIL_ID'];
                         ?>
        </tr>
        <tr>             
            <td><button type="submit" class="btn btn-primary" onclick="return save_row('<?php echo $emailId;?>',event);" >Delete</i></button></td>              
            <td><?php echo $emailId ?></td>           
        </tr>
    </tbody>
    <?php }
                         } ?>
    </table>
        <div class="pull-right">
            
            <h5>Showing <?php echo $subscribeCount ?> records</h5>
        </div>
    </div>
</div>
</form>

<script>  

function save_row(id,event)
{   
		 event.preventDefault();
         var emailId =  id;     
       
           if(emailId != '' )  
           {
                $.ajax({  
                    url:"./home.php?page=subscribe_save",  
                    method:"POST",  
                    data: {emailId: emailId},  
                          
                           
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
