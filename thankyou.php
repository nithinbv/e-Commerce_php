<?php 
session_start();
session_destroy();
unset($_SESSION["username"]); 
unset($_SESSION['isAdmin']);
unset($_SESSION['is_logged_in']);
?>
<!DOCTYPE html>
<html>
    <head>
            <link href="css/bootstrap.min.css" rel="stylesheet">        
            <!-- theme stylesheet -->
            <link href="css/style.default.css" rel="stylesheet" id="theme-stylesheet">      

    </head>

<body>   
    <h1 align="center">See you back soon!!!!!!!<h1>
    <div class="text-center">
    <p class="text-center text-muted"><a href="./index.php"><strong>Login back</strong>
    </div>
</body>
</html>