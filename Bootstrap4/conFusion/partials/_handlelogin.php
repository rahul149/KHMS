<?php
  include '_dbconnect.php';
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        
      
        $mail = $_POST['usermail'];
        $pass = $_POST['password'];

        $sql = "SELECT * FROM `users` WHERE `user_mail` = '$mail'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if($num == 1){
            while($row = mysqli_fetch_assoc($result)){
               
                if(password_verify($pass, $row['password'])){
                    $login = true;
                    session_start();
                    $_SESSION["loggedin"] = true;
                    $_SESSION["username"] = $row['user_name'];
                    $_SESSION["_userid"] = $row['user_id'];
                    $id = $row['user_id'];
                    $n =strpos($row['user_mail'],"@");
                    $str = substr($row['user_mail'],0,$n);
                    if($str == 'KP-2' ||$str == 'KP-1' || $str == 'KP-3'|| $str == 'KP-4')
                    {
                        header("location: \khms\Kitt-management-site\Bootstrap4\conFusion\warden-operating-page.php?loginsuccess=true");    
                        exit();
                    }else{
                     header("location: \khms\Kitt-management-site\Bootstrap4\conFusion\stcomplaint.php?loginsuccess=true");
                     exit();
                    }
                }else{
                      $showError = "Invalid Credentials"; 
                    }
                   
                }
            }
        else{
            $showError = "User Does not exist.";
        }
       header("Location: /khms/Kitt-management-site/Bootstrap4/conFusion/mainpage.php?loginsuccess=false&error=$showError");
}


?>