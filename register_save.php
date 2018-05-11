<?php  

$_SESSION['username'] =null; 
$_SESSION['isAdmin'] = 'N';
$_SESSION['is_logged_in'] = false;         
$_SESSION['userFullName'] = null;

 if(isset($_POST["firstName"]) && isset($_POST["lastName"]) 
     && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["phonenumber"])) 
 {  
    include("db.php");
    $db = new Db();
      
    $sql = "DELETE FROM SUBSCRIBE WHERE EMAIL_ID='".$_POST["email"]."'";
    $SubDelete = $db -> query($sql);      

    $firstName = $db -> quote($_POST["firstName"]);
    $lastName = $db -> quote($_POST["lastName"]);
    $email = $db -> quote($_POST["email"]);
    $password = $db -> quote($_POST["password"]);
    $isAdmin = 'N';
    $dateCreated = date("Y-m-d h:i:s");
    $phonenumber = $db -> quote($_POST["phonenumber"]);
    
    $stmt = $db -> connect();
    $stmt = $stmt -> prepare("INSERT INTO USERS(FIRST_NAME, LAST_NAME, EMAIL_ID, IS_ADMIN, PHONE_NO, DATE_CREATED,PASS_WORD) 
    VALUES (?,?,?,?,?,?,?)");
    $stmt-> bind_param("sssssss", $firstName, $lastName,$email,$isAdmin,$phonenumber,$dateCreated,$password);
    $stmt -> execute();

    session_start();  
    if ($stmt->affected_rows > 0)
     {
          $_SESSION['username'] = $_POST['email']; 
          $_SESSION['is_logged_in'] = true;         
          $_SESSION['userFullName'] = 'Welcome ' .$_POST["firstName"] .'; '.$_POST["lastName"];
          echo(json_encode(array(
           'status' => 'Good'
         )));
     }  
     else  
     {    
         echo(json_encode(array(
           'status' => 'Bad'
       )));
     }  
     $stmt -> close();   
 }  
 ?>