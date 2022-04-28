<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    require_once 'DBConnection.php';
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM `users` WHERE id='".$id."'";
    $info = mysqli_query($conn,$sql);
    $userinfo = mysqli_fetch_row($info);


    if(isset($_GET['comment_mess'])){
        $id = $_GET['id'];
        $response = $_GET['comment_mess'];
    
        $sql = "UPDATE `comments` SET reply='".$response."' WHERE commentid='".$id."'";
        $result = mysqli_query($conn, $sql);
        if($result){
            header("Location: vhw.php?success=Reply sent&notifications=all");
        }
    }
    
    else if(isset($_GET['request_mess'])){
        $id = $_GET['id'];
        $response = $_GET['request_mess'];
    
        $sql = "UPDATE `requests` SET reply='".$response."' WHERE requestid='".$id."'";
        $result = mysqli_query($conn, $sql);
        if($result){
            header("Location: vhw.php?success=Reply sent&notifications=all");
        }
    }
    if($userinfo[11] == 'vhw'){
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Village Health Worker Panel</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php
        require_once 'DBConnection.php';

    $msg = "";
if (!empty($_GET['msg'])) {
    $msg = $_GET['msg'];
    $alert_msg = ($msg == "add") ? "New Record has been added successfully!" : (($msg == "del") ? "Record has been deleted successfully!" :(($msg == "approved") ? "User account has been approved successfully!" : (($msg == "reset") ? "User Password has been reset successfully!" :(($msg == "addDistrict") ? "District has been added successfully!" :(($msg == "delDistrict") ? "District has been deleted successfully!" :(($msg == "addClinic") ? "Clinic has been added successfully!" :(($msg == "delClinic") ? "Clinic has been deleted successfully!" :(($msg == "addVillage") ? "Village has been added successfully!" :(($msg == "delVillage") ? "Village has been deleted successfully!" :(($msg == "posted") ? "Comment Posted!!!" :"Record has been updated successfully!"))))))))));
} else {
    $alert_msg = "";
}
//Count notifications
$sql = "SELECT * FROM `notifications` where userid='".$_SESSION['id']."'";
$results = mysqli_query($conn, $sql);


if($results = mysqli_query($conn, $sql)){
    $rowcount1 =  mysqli_num_rows($results);
}

$sql2 = "SELECT * FROM `requests`";
$results2 = mysqli_query($conn, $sql2);

if($results2 = mysqli_query($conn, $sql2)){

    $rowcount2 =  mysqli_num_rows($results2);
    
}
$rowcount =  $rowcount1 + $rowcount2;


if(isset($_GET['submit'])){
   
    $comment = $_GET['comment'];
    $date = date('d-m-y h:i:s');
    $userid = $_SESSION['id'];

    $sql = "INSERT INTO `comments`(comment,userid,date)VALUES('$comment','$userid','$date')";
    ;
    if($result = mysqli_query($conn,$sql)){
        header('location:patient.php?msg=posted');
    }
    else{
        echo 'Unknown error occured';
    }
}

if(isset($_GET['medicine_request'])){
   
    $request = $_GET['message'];
    $date = date('d-m-y h:i:s');
    $userid = $_SESSION['id'];

    $sql = "INSERT INTO `requests`(request,userid,datemade)VALUES('$request','$userid','$date')";
    ;
    if($result = mysqli_query($conn,$sql)){
        header('location:patient.php?success=Request sent Successfully&patient_request=medicine');
    }
    else{
        echo 'Unknown error occured';
    }
}

if(isset($_GET['visit_request'])){
   
    $request = $_GET['message'];
    $date = date('d-m-y h:i:s');
    $userid = $_SESSION['id'];

    $sql = "INSERT INTO `requests`(request,userid,datemade)VALUES('$request','$userid','$date')";
    ;
    if($result = mysqli_query($conn,$sql)){
        header('location:patient.php?success=Request sent Successfully&patient_request=visit');
    }
    else{
        echo 'Unknown error occured';
    }
}



?>
<?php if (!empty($alert_msg)) {?>
        <div class="alert"><?php echo $alert_msg; ?></div>
        <?php }?>
<div class="header">

                <div class="menu">
                 <img src="images/menu.png" alt="menu_bar">
                 
                    <ul><li><a href="vhw.php?id=<?php echo $_SESSION['id']; ?>profile=edit">View Profile</a></li>
                        <li><a href="vhw.php?notifications=all">Notifications</a></li>
                        <li><a href="vhw.php?change=password">Change Password</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                 </div> 
                 
                 <div class="clinic">
                <h3>Reports</h3>
                    <ul style="margin-top: 100px;">
                        <li><a href="vhw.php?reports=view">View Due Reports</a></li>
                    </ul>
                 </div>

                 
                 <div class="village">
                 <h3 style="color: purple"><?php echo date("l jS \of F Y h:i:s A") . "<br>";?></h3>
                </div>
                 
                 <a href="vhw.php?notifications=all"><div class="district" style="margin-left:970px;">
                 <img src="images/notification.png" alt="">
                 <h3 style="color: red;"><?php if($rowcount > 0)echo $rowcount;?></h3>
                   
                 </div></a>


            <div class="profile" style="margin-left:1150px;">
                    <img src="images/user.png" alt="">
                    <h3><?php echo $_SESSION['firstname']; ?></h3>
                    
                    <ul>
                        <li><a href="vhw.php?id=<?php echo $_SESSION['id']; ?>&profile=edit">Edit Profile</a></li>
                        <li><a href="vhw.php?change=password">Change Password</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
            
            </div>
      
             
            
    </div>


    <?php
    
    if(isset($_GET['medicine'])){
        $op = $_GET['medicine'];
        if($op === 'view'){
            include 'patient_medicine.php'; 
        }
        
    }
    
    else if(isset($_GET['profile'])){
        $op = $_GET['profile'];
        if($op === 'edit'){
            include 'add.php'; 
        }
       
        
        
    }

    else if(isset($_GET['patient_request'])){
        $op = $_GET['patient_request'];
        if($op === 'medicine'){
            include 'patient_medicine_request.php'; 
        }
        else if($op === 'visit'){
            include 'patient_visit_request.php'; 
        }
        
        
    }

    else if(isset($_GET['change'])){
        $op = $_GET['change'];
        if($op === 'password'){
            include 'changepass.php'; 
        }
        else{
            include 'villages.php';
        }
        
    }
    else if(isset($_GET['profile'])){
        $op = $_GET['profile'];
        if($op === 'changepassword'){
            include 'changepass.php'; 
        }
        else{
            include 'add.php';
        }
        
    }

    else if(isset($_GET['notifications'])){
        $op = $_GET['notifications'];
        if($op === 'all'){
            include 'notifications.php'; 
        }
        else  if($op === 'delete'){
            include 'delete.php'; 
        }
        
        
    }
    else if(isset($_GET['comment'])){
        $op = $_GET['comment'];
        if($op === 'reply'){
            include 'response.php'; 
        }
        else  if($op === 'delete'){
            include 'delete.php'; 
        }
        
        
    }

    else if(isset($_GET['request'])){
        $op = $_GET['request'];
        if($op === 'reply'){
            include 'response.php'; 
        }
        else  if($op === 'delete'){
            include 'delete.php'; 
        }
        
        
        
    }

    else if(isset($_GET['reports'])){
        $op = $_GET['reports'];
        if($op === 'view'){
            include 'report.php'; 
        }
       
        
        
        
    }
    
    /*else{
        include 'report.php';
    }*/
    ?>
    

                    
</body>
</html>
<?php
}
else{
    header("Location: index.php");
    exit();
}
}else{
     header("Location: index.php");
     exit();
}
 ?>