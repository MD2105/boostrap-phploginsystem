<?php

if(isset($_POST['login-submit']))
{
    require"dbconnect.php";
    $user = $_POST['username'];
    $pwdss  = $_POST['passw'];

    if(empty($user)||empty($pwdss)){
        header("Location:../login.php?error=invaliduserorpass");
        exit();
    }
    else {

        $sql = "SELECT * FROM users WHERE username=?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("Location:../login.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt,"s",$user);  
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result) ){
                $passcheck = password_verify($pwdss, $row['pwd']);
                if($passcheck == false){
                    header("Location:../index.php?error=wrongpass");
                exit();
            }
            else if($passcheck==true){
                session_start();
                $_SESSION['userid']=$row['username'];
                header("Location: ../index.php?login=success");

              }

         else 
        {
            header("Location: ../login.php?error=nouser");
            exit();
        }

          }

        }
    }
}