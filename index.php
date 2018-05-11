<?php  session_start();?>
<!DOCTYPE html>
<html>
    <head>
            <link href="css/bootstrap.min.css" rel="stylesheet">
          
            <!-- theme stylesheet -->
            <link href="css/style.default.css" rel="stylesheet" id="theme-stylesheet">      
            <script src="js/jquery-1.11.0.min.js"></script>
            <script src="js/bootstrap.min.js"></script>
 
    </head>

<body>

<?php $_SESSION['username']  = null?>
<?php $_SESSION['is_logged_in'] = false?>
<?php $_SESSION['userFullName'] = null?>
<div class="modal fade" id="warningModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="alert alert-warning">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Please enter all the requiered values!</h4>
      </div>      
    </div>
  </div>
</div>
<div class="modal fade" id="unSuccessfullyModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="alert alert-danger">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Sorry there was some issue completing your request!</h4>
      </div>      
    </div>
  </div>
</div>
&nbsp;
<div id="all">
        <div id="content">
            <div class="container">         
                <div class="col-sm-3">
                </div>
                <div class="col-sm-6">
                    <div class="box">
                        <h1>Login</h1>

                        <p class="lead">Already our customer?</p>
                       

                        <hr>

                        <form>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" maxlength="29" placeholder="Please enter email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input  class="form-control my-password" id="password" maxlength="38" placeholder="Please enter password">
                                <input type="checkbox" class="showPassword" />
                                Show Password
                            </div>
                            
                            <script type="text/javascript">
                              $(document).ready(function(){
                                $('.showPassword').on('change',function(){
                                  var isChecked = $(this).prop('checked');
                                  if (isChecked) {
                                    $('.my-password').attr('type','text');
                                  } else {
                                    $('.my-password').attr('type','Password');
                                  }
                                });
                              });
                            </script>                              
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" name="login_button"
                                 id="login_button" > Log in</button>                                
                            </div>
                            &nbsp;
                            <!--<div class="text-center">
                            <p class="text-center text-muted"><a href="./home.php"><strong>Continue as Guest</strong>
                            </div> -->
                            <p class="text-center text-muted"><a href="./register.php"><strong>Register now</strong></a>! It is easy and done in 1&nbsp;minute and gives you access to special discounts and much more!</p>
                        </form>
                    </div>
                </div>                
            </div>
            <!-- /.container -->            
        </div>
    </br>
</div>

</body>
<div class="modal fade" id="your-modal" tabindex="-1" role="alert" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">

        </div>
        <div class="modal-body">

        </div>
    </div>
</div>
</div>
</html>
<script>  
 $(document).ready(function(){  
      $('#login_button').click(function(){  
        
           var username = $('#email').val();  
           var password = $('#password').val();  
          
           if(username != '' && password != '')  
           {              
               if(validate())
               {                       
                        $.ajax({  
                            url:"index_save.php",  
                            method:"POST",  
                            data: {username:username, password:password}, 
                            dataType: 'json', 
                            success:function(data)  
                            {            
                                if(data['status'] == 'Bad')  
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
                                   window.location.replace('home.php');
                                }  
                            }  
                    }); 
               }
           }  
           else  
           {    
               $('#warningModal').modal('show');                     
           }
           return false;  
      });  
 
 });  

function validate() {
    var email = $("#email").val();
    if (validateEmail(email)) {
        return true;
    } else {
        $('#warningModal').modal('show');
    }
    return false;
}

function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
}
 </script>  