<?php
if (!empty($_GET['id'])) {
    // require connection
    require_once 'DBConnection.php';
   
    $userid = $_GET['id'];
    $select_query = "SELECT * FROM `users` WHERE id = '" . $userid . "'";
    $result = mysqli_query($conn, $select_query);
    $userDataFetch = mysqli_fetch_row($result);
    if ($userDataFetch) {
    $firstname = $userDataFetch['3'];
    $lastname = $userDataFetch['13'];
    $str = $firstname;
    $pass = strtolower($str);
   
    $updatePass_query = "UPDATE users SET password='$pass' WHERE id='$userid'";
    $resetSuccess = mysqli_query($conn, $updatePass_query);

    $description = "Password Reset";
    $message = "Your password has been reset, please set a new password for security";
    $datemade = date('d-m-y h:i:s');
    $message = "INSERT INTO `notifications`(description,message,userid,datemade)values('$description','$message','$userid','$datemade')";
    $result2 = mysqli_query($conn, $message);
    
        if($resetSuccess && $result2){
            if($_SESSION['usertype'] == 'Admin'){
                header("Location: admin.php?success=User Password has been RESET successfully&users=all");
                exit();
            }
            else if($_SESSION['usertype'] == 'Dispensary'){
                header("Location: dispensary.php?success=User Password has been RESET successfully&users=all");
                exit();
            }
        }
        
    }
    else{
        if($_SESSION['usertype'] == 'Admin'){
            header("Location: admin.php?error=Reset Password not successful&users=all");
            exit();
        }
        else if($_SESSION['usertype'] == 'Dispensary'){
            header("Location: dispensary.php?error=Reset Password not successful&users=all");
            exit();
        }
    }
}