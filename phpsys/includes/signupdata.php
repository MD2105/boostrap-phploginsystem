<?php
 if(isset($_POST['signup-submit'])){
     require 'dbconnect.php';
     $user = $_POST['username'];
     $mail = $_POST['email'];
     $phone = $_POST['tel'];
     $pass = $_POST['password'];
     
     if(empty($user)||empty($mail)||empty($phone)){
         header("Location:../signup.php?error=emptyfields&username=".$user);
         exit();
     }
    
     else if (!filter_var($mail,FILTER_VALIDATE_EMAIL)){
        header("Location:../signup.php?error=invalidemail&username=".$user);
        exit();
     }
     else {

        $sql = "SELECT userid FROM users WHERE userid=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location:../signup.php?error=sqlerror");
            exit();
        }
        else {
          mysqli_stmt_bind_param($stmt,"s",$user);  
          mysqli_stmt_execute($stmt);
          mysqli_stmt_store_result($stmt);
          $resultcheck = mysqli_stmt_num_rows($stmt);
          if($resultcheck > 0 ){
              header("Location:../signup.php?error=usertaken&email=".$mail);
              exit();
          }
          else {
              $sql = "INSERT INTO users (username,email, phoneno,pwd) VALUES (?,?,?,?)";
              $stmt = mysqli_stmt_init($conn);
              if(!mysqli_stmt_prepare($stmt,$sql)){
                  header("Location:../signup.php?error=sqlerror");
                  exit();
              }
              else {
                $hashpwd = password_hash($pass, PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt,"ssis",$user,$mail,$phone,$hashpwd);  
                mysqli_stmt_execute($stmt);
                header("Location:../index.php?signup=success");
               exit();
              }


          }
        }
     }
     mysqli_stmt_close($stmt);
     mysqli_close($conn);
 }
 else {
     header("Location:../signup.php?php=error");
     exit();
 }