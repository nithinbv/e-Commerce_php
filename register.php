<?php
include("db.php");
?>

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
&nbsp;
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
<div id="all">

        <div id="content">
            <div class="container">               
            <div class="col-md-3">
            </div>
                <div class="col-md-6">
                    <div class="box">
                        <h1>New account</h1>

                        <p class="lead">Not our registered customer yet?</p>
                        <p>With registration with us new world of fashion, fantastic discounts and much more opens to you! The whole process will not take you more than a minute!</p>
                        <p class="text-muted">If you have any questions, please feel free to <a href="/home.php?page=contact">contact us</a>, our customer service center is working for you 24/7.</p>

                        <hr>

                        <form>
                            <div class="form-group">
                                <label for="name">First Name</label>
                                <input type="text" class="form-control" id="firstName" maxlength="29" placeholder="Please enter first name">
                            </div>
                            <div class="form-group">
                                <label for="name">Last Name</label>
                                <input type="text" class="form-control" id="lastName" maxlength="29" placeholder="Please enter last name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" maxlength="29" placeholder="Please enter email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input  class="form-control my-password" id="password" maxlength="29"  placeholder="Please enter password">
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

                            <div class="form-group">
                                <label for="phonenumber">Phone no</label>
                                <input  class="form-control" id="phonenumber" maxlength="10"  onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Please enter phone number">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" id="register_button">Register</button>
                            </div>
                            &nbsp;
                            <!--<div class="text-center">
                            <p class="text-center text-muted"><a href="./home.php"><strong>Continue as Guest</strong>
                            </div> -->
                        </form>
                    </div>
                </div>  
            </div>
            <!-- /.container -->
        </div>
</body>
</html>
<script>  
 $(document).ready(function(){  
      $('#register_button').click(function(){  
           var firstName = $('#firstName').val();  
           var lastName = $('#lastName').val();  
           var email = $('#email').val();
           var password = $('#password').val();
           var phonenumber = $('#phonenumber').val();
           if(firstName != '' && lastName != '' && email != '' && password != '' && phonenumber != '')  
           {  
               if(validate())
               {
                    $.ajax({  
                        url:"register_save.php",  
                        method:"POST",  
                        data: {firstName:firstName, lastName:lastName, email:email
                        , password:password,phonenumber:phonenumber},   
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