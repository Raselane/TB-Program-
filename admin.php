<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    require_once 'DBConnection.php';
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM `users` WHERE id='".$id."'";
    $info = mysqli_query($conn,$sql);
    $userinfo = mysqli_fetch_row($info);
    if($userinfo[11] == 'Admin'){
        //Count notifications
$sql = "SELECT * FROM `notifications` where userid='".$_SESSION['id']."'";
$results = mysqli_query($conn, $sql);
if($results = mysqli_query($conn, $sql)){
    $rowcount =  mysqli_num_rows($results);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin Panel</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>


        <div class="menu">
                
                 </div> 
<div class="header">

<div class="menu">
                 <img src="images/menu.png" alt="menu_bar">
                 
                 
                 <ul>
                 <li><a href="admin.php?clinic=all">Manage Clinics</a></li>
                 <li><a href="admin.php?village=all">Manage Villages</a></li>
                 <li><a href="admin.php?district=all">Manage Districts</a></li>
                     <li><a href="logout.php">Logout</a></li>
                 </ul>
                 </div> 
                 

                 <div class="clinic" style="margin-left: 50px;">
                <h3>Patients</h3>
                    <ul style="margin-top:100px;">
                    <li><a href="admin.php?register=account">Add new Patient</a></li>
                     <li><a href="admin.php?selection=Patient">View All Patients</a></li>
                    </ul>
                 </div>
                 <div class="clinic" style="margin-left:300px;">
                <h3>Users</h3>
                    <ul style="margin-top:100px;">
                    <li><a href="admin.php?register=account">Add new user</a></li>
                     <li><a href="admin.php?users=all">View All Users</a></li>
                    </ul>
                 </div>

                 <div class="village" style="margin-left: 650px;">
                <h3>Dispensaries</h3>
                    <ul style="margin-top:100px;">
                    <li><a href="admin.php?register=account">Add new Dispensary</a></li>
                     <li><a href="admin.php?selection=Dispensary">View All Dispensaries</a></li>
                    </ul>
                 </div>

                 <div class="district" style="margin-left: 950px;">
                <h3>VHW</h3>
                    <ul style="margin-top:100px;">
                    <li><a href="admin.php?register=account">Add new vhw</a></li>
                     <li><a href="admin.php?selection=vhw">View All VHW</a></li>
                    </ul>
                 </div>

                


            <div class="profile" style="margin-left:1150px;">
                    <img src="images/user.png" alt="">
                    <h3><?php echo $_SESSION['firstname']; ?></h3>
                    
                    <ul>
                        <li><a href="admin.php?id=<?php echo $_SESSION['id']; ?>&editprofile=user">Edit Profile</a></li>
                        <li><a href="admin.php?change=password">Change Password</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
            
            </div>
      
             
            
    
    </div>


    <?php
    
    if(isset($_GET['selection'])){
    include 'users.php';
    }
    if(isset($_GET['register'])){
        include 'registeration.php';
        }
    


    else if(isset($_GET['clinic'])){
        $op = $_GET['clinic'];
        if($op === 'add'){
            include 'clinic_add.php'; 
        }
        else if($op === 'delete'){
            include 'delete.php'; 
        }
        else{
            include 'clinics.php';
        }
        
    }

    else if(isset($_GET['village'])){
        $op = $_GET['village'];
        if($op === 'add'){
            include 'village_add.php'; 
        }
        else if($op === 'edit'){
            include 'village_add.php';
        }
        else if($op === 'delete'){
            include 'delete.php';
        }
        else{
            include 'villages.php';
        }
        
    }

    
    else if(isset($_GET['district'])){
        $op = $_GET['district'];
        if($op === 'add'){
            include 'district_add.php'; 
        }
        else if($op === 'edit'){
            include 'district_add.php';
        }
        else if($op === 'delete'){
            include 'delete.php';
        }
        else{
            include 'districts.php';
        }
        
    }
    else if(isset($_GET['change'])){
        $op = $_GET['change'];
        if($op === 'password'){
            include 'changepass.php'; 
        }
   
        
    }
    else if(isset($_GET['account'])){
        $op = $_GET['account'];
        if($op === 'approve'){
            include 'approve.php'; 
        }
    }  
    else if(isset($_SESSION['id']) && isset($_GET['editprofile'])){
    
            include 'add.php'; 
       
        
    }
    else if(isset($_GET['id']) && isset($_GET['user'])){
        $op = $_GET['user'];
        if($op === 'edit'){
            include 'add.php'; 
        }
        if($op === 'delete'){
            include 'delete.php'; 
        }
        if($op === 'approve'){
            include 'approve.php'; 
        }
        if($op === 'resetpass'){
            include 'resetpassword.php'; 
        }
   
    
}else{
        include 'users.php';
    }
   
    
   
    ?>
    

                    
</body>
</html>
<?php 
}else{
    header("Location: index.php");
    exit();
}
}else{
     header("Location: index.php");
     exit();
}
 ?>