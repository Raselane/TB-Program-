<?php
if (!empty($_GET['id'])) {
    // require connection
    require_once 'DBConnection.php';
   $sql = "SELECT * FROM `users` WHERE id='".$_GET['id']."'";
   $info = mysqli_query($conn,$sql);
   $result = mysqli_fetch_row($info);
   if($result){
       if($result[12] == 'pending'){
        $userid = $_GET['id'];
        $approve_query = "UPDATE `users` SET status='approved' WHERE id = '" . $userid . "'";
        $result1 = mysqli_query($conn, $approve_query);
        
    
        $description = "Account Approval";
        $message = "Congratulations, your account has been approved";
        $datemade = date('d-m-y h:i:s');
        $message = "INSERT INTO `notifications`(description,message,userid,datemade)values('$description','$message','$userid','$datemade')";
        $result2 = mysqli_query($conn, $message);
        if ($result1 && $result2) {
    
            if(isset($_SESSION['id']) && $_SESSION['usertype'] === 'Dispensary'){
                header("Location: dispensary.php?success=User Account Approved Successfully");       
                exit();
            }
            else if(isset($_SESSION['id']) && $_SESSION['usertype'] === 'Admin'){
                header("Location: Admin.php?success=User Account Approved Successfully");       
                exit();
            }
        }
        else{
            echo 'unknown error';
        }
       } else{
        $userid = $_GET['id'];
        $disapprove_query = "UPDATE `users` SET status='pending' WHERE id = '" . $userid . "'";
        $result1 = mysqli_query($conn, $disapprove_query);
    
        $description = "Account Disapproval";
        $message = "Your TB Program Account has been disapproved, please contact Admin for further details";
        $datemade = date('d-m-y h:i:s');
        $message = "INSERT INTO `notifications`(description,message,userid,datemade)values('$description','$message','$userid','$datemade')";
        $result2 = mysqli_query($conn, $message);
        if ($result1 && $result2) {
    
            if(isset($_SESSION['id']) && $_SESSION['usertype'] === 'Dispensary'){
                header("Location: dispensary.php?success=User Account Disapproved Successfully");       
                exit();
            }
            else if(isset($_SESSION['id']) && $_SESSION['usertype'] === 'Admin'){
                header("Location: Admin.php?success=User Account Disapproved Successfully");       
                exit();
            }
        }
        else{
            echo 'unknown error';
        }
       }
   }
    
}

if (isset($_GET['error'])) { 
   echo  '<p class="error">';
   echo $_GET['error']; 
   echo '</p>';
} 

if (isset($_GET['success'])) { 
      echo '<p class="success">';
      echo $_GET['success']; 
      echo '</p>';} 
?>