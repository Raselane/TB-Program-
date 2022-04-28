<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    require_once 'DBConnection.php';
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM `users` WHERE id='".$id."'";
    $info = mysqli_query($conn,$sql);
    $userinfo = mysqli_fetch_row($info);
    if($userinfo[11] == 'Dispensary'){
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
	<title>Dispensary Panel</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>


        <div class="menu">
                
                 </div> 
<div class="header">

<div class="menu">
                 <img src="images/menu.png" alt="menu_bar">
                 
                 
                 <ul>
                     <li><a href="dispensary.php?register=account">Add new Patient</a></li>
                     <li><a href="dispensary.php?selection=Patient">View Patients</a></li>
                     <li><a href="logout.php">Logout</a></li>
                 </ul>
                 </div> 
                 
                 <div class="clinic"> 
                <h3>Manage Medicine</h3>
                    <ul style="margin-top: 100px">
                    <li><a href="dispensary.php?medicine=add">Add Medicine</a></li>

                        <li><a href="dispensary.php?medicine=view">View Medicine</a></li>
                    </ul>
                 </div>

                 
                 <div class="village" style="margin-left: 700px">
                 <h3 style="color: #760ca0; ">Dispensary Panel</h3>
                </div>
                 
                 <div class="district" style="margin-left:900px;">
                 <img src="images/notification.png" alt="">
                 <h3 style="color: yellow;"><?php if($rowcount > 0)echo $rowcount;?></h3>
                   
                 </div>


            <div class="profile" style="margin-left:1150px;">
                    <img src="images/user.png" alt="">
                    <h3><?php echo $_SESSION['firstname']; ?></h3>
                    
                    <ul>
                        <li><a href="dispensary.php?id=<?php echo $_SESSION['id']; ?>&editprofile=user">Edit Profile</a></li>
                        <li><a href="dispensary.php?change=password">Change Password</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
            
            </div>
      
             
            
    
    </div>


    <?php
    
    if(isset($_GET['selection'])){
    include 'patients.php';
    }
    if(isset($_GET['register'])){
        include 'registeration.php';
        }
    else if(isset($_GET['medicine'])){
        if($_GET['medicine'] == 'add'){
            include 'dispensary_medicine_add.php';
        }
        else if($_GET['medicine'] == 'assign'){
            include 'assign_medicine.php';
        }
        else if($_GET['medicine'] == 'view'){
            include 'medicine_table.php';
        }
        else if($_GET['medicine'] == 'edit'){
            include 'dispensary_medicine_edit.php';
        }
        else if($_GET['medicine'] == 'delete'){
            include 'delete.php';
    }
      
    }
    

    else if(isset($_GET['district'])){
        $op = $_GET['district'];
        if($op === 'add'){
            include 'district_add.php'; 
        }
        else{
            include 'districts.php';
        }
        
    }

    else if(isset($_GET['clinic'])){
        $op = $_GET['clinic'];
        if($op === 'add'){
            include 'clinic_add.php'; 
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
        else{
            include 'villages.php';
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
       
        
    }else{
        include 'patients.php';
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