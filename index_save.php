<?php  

$_SESSION['username'] =null; 
$_SESSION['isAdmin'] = '0';
$_SESSION['is_logged_in'] = false;         
$_SESSION['userFullName'] = null;

 if(isset($_POST["username"]) && isset($_POST["password"]))  
 {  
      include("db.php");
      $db = new Db();
      $userName = $db -> quote($_POST["username"]);
      $password = $db -> quote($_POST["password"]);

 
      $stmt = $db -> connect();
      $stmt = $stmt -> prepare("SELECT count(*) , IS_ADMIN,FIRST_NAME,LAST_NAME FROM devrajs1_ecommerce.USERS  
      WHERE EMAIL_ID = ?  AND BINARY PASS_WORD = ? having count(*) = 1 ");
      $stmt-> bind_param("ss",$userName,$password);
      $stmt -> execute();
      $stmt->store_result();
      $result = $stmt->get_result();

      session_start();
      if($stmt->num_rows === 0) 
      {
        $_SESSION['is_logged_in'] = false;
          echo(json_encode(array(
            'status' => 'Bad'
        )));
      }
      else{
        $stmt->bind_result($count, $isAdmin, $firstName,$lastName);

        $stmt->fetch();
        
        $_SESSION['username'] = $_POST['username']; 
        $_SESSION['isAdmin'] = $isAdmin;
        $_SESSION['is_logged_in'] = true;         
        $_SESSION['userFullName'] = 'Welcome ' .$firstName .'; '.$lastName;
        echo(json_encode(array(
         'status' => 'Good'
       )));
      }     
      $stmt -> close();   
 }  
 ?>