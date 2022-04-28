<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    require_once 'DBConnection.php';
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM `users` WHERE id='".$id."'";
    $info = mysqli_query($conn,$sql);
    $userinfo = mysqli_fetch_row($info);
    if($userinfo[11] == 'Patient'){
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Patient Panel</title>
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
    $rowcount =  mysqli_num_rows($results);
}

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
                 
                    <ul>
                        <li><a href="patient.php?medicine=view">View Medicine</a></li>
                        <li><a href="patient.php?patient_request=medicine">Request Medicine</a></li>
                        <li><a href="patient.php?patient_request=visit">Request Visit</a></li>
                        <li><a href="patient.php?id=<?php echo $_SESSION['id']; ?>&profile=edit">View Profile</a></li>
                        <li><a href="patient.php?notifications=all">Notifications</a></li>
                        <li><a href="patient.php?change=password">Change Password</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                 </div> 
                 
                 <div class="clinic">
                <h3>Medicine</h3>
                    <ul style="margin-top: 100px;">
                        <li><a href="patient.php?medicine=view">View Medicine</a></li>
                        <li><a href="patient.php?patient_request=medicine">Request for Medicine</a></li>
                    </ul>
                 </div>

                 
                 <div class="village">
                 <h3 style="color: purple"><?php echo date("l jS \of F Y h:i:s A") . "<br>";?></h3>
                </div>
                 
                 <a href="patient.php?notifications=all"><div class="district" style="margin-left:970px;">
                 <img src="images/notification.png" alt="">
                 <h3 style="color: red;"><?php if($rowcount > 0)echo $rowcount;?></h3>
                   
                 </div></a>


            <div class="profile" style="margin-left:1150px;">
                    <img src="images/user.png" alt="">
                    <h3><?php echo $_SESSION['firstname']; ?></h3>
                    
                    <ul>
                        <li><a href="patient.php?id=<?php echo $_SESSION['id']; ?>&profile=edit">Edit Profile</a></li>
                        <li><a href="patient.php?change=password">Change Password</a></li>
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
        if($op === 'delete'){
            include 'delete.php'; 
        }
        
        
    }
    
    else{
        include 'patient_medicine.php';
    }
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