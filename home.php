<?php
session_start();
include("db.php");
?>
<!DOCTYPE html>
<html>
    <head>
            <link href="css/font-awesome.css" rel="stylesheet">
            <link href="css/bootstrap.min.css" rel="stylesheet">
            <link href="css/animate.min.css" rel="stylesheet">
            <link href="css/owl.carousel.css" rel="stylesheet">
        
            <!-- theme stylesheet -->
            <link href="css/style.default.css" rel="stylesheet" id="theme-stylesheet">
        
      
        
            <script src="js/respond.min.js"></script>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.js"></script>
            <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100' rel='stylesheet' type='text/css'>
             <!-- *** SCRIPTS TO INCLUDE ***
 _________________________________________________________ -->
            <script src="js/jquery-1.11.0.min.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="js/jquery.cookie.js"></script>
            <script src="js/waypoints.min.js"></script>
            <script src="js/modernizr.js"></script>
            <script src="js/bootstrap-hover-dropdown.js"></script>
            <script src="js/owl.carousel.min.js"></script>
            <script src="js/front.js"></script>
    </head>

<body>
<div class="modal fade" id="successfullyModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="alert alert-success">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Your request was successfully completed!</h4>
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
<div class="modal fade" id="warningModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="alert alert-warning">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Please enter all the requiered values and in right format!</h4>
      </div>      
    </div>
  </div>
</div>
<?php $_SESSION['parameterId']  = null?>
<?php $_SESSION['parameterName']  = null?>

<?php include 'header.php';?>
<?php include 'navigation.php';?>  
<?php 
      if(isset($_GET['page'])){             
            $page = $_GET['page'];            
            if(strpos($page,'?')){
                $param = explode("?",$page); 
                $display = 'content/'.$param[0].'.php'; 
                $_SESSION['parameterId'] = $param[1];
                $_SESSION['parameterName'] = $param[2];
            }        
            else{
                $display = 'content/'.$page.'.php';
            }    
            include($display);
      }
      else{
        include('content/landing.php');
      };
?>
<?php include 'footer.php';?>
</body>
