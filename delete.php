<?php
    // require connection
    require_once 'DBConnection.php';
if (!empty($_GET['id'])) {

   
    $userid = $_GET['id'];
    $del_query = "DELETE FROM `users` WHERE id = '" . $userid . "'";
    $result = mysqli_query($conn, $del_query);
    if ($result) {
        if($_SESSION['usertype'] == 'Admin'){
			header("Location: admin.php?success=User deleted successfully&users=all");
			exit();
		}
		else if($_SESSION['usertype'] == 'Dispensary'){
			header("Location: dispensary.php?success=User deleted successfully&users=all");
			exit();
		}
       
    }else{
    if($_SESSION['usertype'] == 'Admin'){
        header("Location: admin.php?error=Error!!! User NOT deleted successfully&users=all");
        exit();
    }
    else if($_SESSION['usertype'] == 'Dispensary'){
        header("Location: dispensary.php?erro=Error!!! User NOT deleted successfully&users=all");
        exit();
    }
}
}

if(isset($_GET['medicineid']) && $_GET['medicine']  === 'delete'){
    $id = $_GET['medicineid'];
    $sql = "DELETE FROM `medicine` where medicineid='".$id."'";
    if($result = mysqli_query($conn, $sql)){

        header("Location: dispensary.php?success=Medicine deleted Successfully&medicine=view");
        exit();
    }
}

if(isset($_GET['clinicid']) && $_GET['clinic']  === 'delete'){
    $id = $_GET['clinicid'];
    $sql = "DELETE FROM `clinics` where clinicid='".$id."'";
    if($result = mysqli_query($conn, $sql)){

        header("Location: admin.php?success=Clinic deleted Successfully&clinic=all");
        exit();
    }
}

if(isset($_GET['villageid']) && $_GET['village']  === 'delete'){
    $id = $_GET['villageid'];
    $sql = "DELETE FROM `villages` where villageid='".$id."'";
    if($result = mysqli_query($conn, $sql)){

        header("Location: admin.php?success=Village deleted Successfully&village=all");
        exit();
    }
}

if(isset($_GET['districtid']) && $_GET['district']  === 'delete'){
    $id = $_GET['districtid'];
    $sql = "DELETE FROM `districts` where districtid='".$id."'";
    if($result = mysqli_query($conn, $sql)){

        header("Location: admin.php?success=District deleted Successfully&district=all");
        exit();
    }
}

if(isset($_GET['notid']) && $_GET['notifications']  === 'delete'){
    $id = $_GET['notid'];
    $sql = "DELETE FROM `notifications` where notificationid='".$id."'";
    if($result = mysqli_query($conn, $sql)){
        if($_SESSION['usertype'] === 'Patient'){
            header("Location: patient.php?success=Notification deleted Successfully&notifications=all");
            exit();
        }

        else  if($_SESSION['usertype'] === 'Admin'){
            header("Location: admin.php?success=Notification deleted Successfully&notifications=all");
            exit();
        }

        else  if($_SESSION['usertype'] === 'vhw'){
            header("Location: vhw.php?success=Notification deleted Successfully&notifications=all");
            exit();
        }
        else  if($_SESSION['usertype'] === 'Dispensary'){
            header("Location: dispensary.php?success=Notification deleted Successfully&notifications=all");
            exit();
        }
        
    }
}

if(isset($_GET['commentid']) && $_GET['comment']  === 'delete'){
    $id = $_GET['commentid'];
    $sql = "DELETE FROM `comments` where commentid='".$id."'";
    if($result = mysqli_query($conn, $sql)){

         if($_SESSION['usertype'] === 'Admin'){
            header("Location: admin.php?success=Comment deleted Successfully&notifications=all");
            exit();
        }

        else  if($_SESSION['usertype'] === 'vhw'){
            header("Location: vhw.php?success=Comment deleted Successfully&notifications=all");
            exit();
        }
      
        
    }
}

if(isset($_GET['requestid']) && $_GET['request']  === 'delete'){
    $id = $_GET['requestid'];
    $sql = "DELETE FROM `requests` where requestid='".$id."'";
    if($result = mysqli_query($conn, $sql)){

        if($_SESSION['usertype'] === 'Admin'){
            header("Location: admin.php?success=Request deleted Successfully&notifications=all");
            exit();
        }

        else  if($_SESSION['usertype'] === 'vhw'){
            header("Location: vhw.php?success=Request deleted Successfully&notifications=all");
            exit();
        }
}
}

?>
