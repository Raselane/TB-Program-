<?php 
if (isset($_POST['op']) && isset($_POST['np'])
&& isset($_POST['c_np'])) {

function validate($data){
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

$op = validate($_POST['op']);
$np = validate($_POST['np']);
$c_np = validate($_POST['c_np']);

if(empty($op)){
	if($_SESSION['usertype'] == 'Admin'){
		header("Location: admin.php?change=password&error=Old Password is required");
		exit();
	}
	else if($_SESSION['usertype'] == 'Patient'){
		header("Location: patient.php?change=password&error=Old Password is required");
		exit();
	}
	else if($_SESSION['usertype'] == 'vhw'){
		header("Location: vhw.php?change=password&error=Old Password is required");
		exit();
	}
	else if($_SESSION['usertype'] == 'Dispensary'){
		header("Location: dispensary.php?change=password&error=Old Password is required");
		exit();
	}

}else if(empty($np)){
	if($_SESSION['usertype'] == 'Admin'){
		header("Location: admin.php?change=password&error=New Password is required");
		exit();
	}
	else if($_SESSION['usertype'] == 'Patient'){
		header("Location: patient.php?change=password&error=New Password is required");
		exit();
	}
	else if($_SESSION['usertype'] == 'vhw'){
		header("Location: vhw.php?change=password&error=New Password is required");
		exit();
	}
	else if($_SESSION['usertype'] == 'Dispensary'){
		header("Location: dispensary.php?change=password&error=New Password is required");
		exit();
	}
}
else if(empty($c_np)){
	if($_SESSION['usertype'] == 'Admin'){
		header("Location: admin.php?change=password&error=Confirmation Password is required");
		exit();
	}
	else if($_SESSION['usertype'] == 'Patient'){
		header("Location: patient.php?change=password&error=Confirmation Password is required");
		exit();
	}
	else if($_SESSION['usertype'] == 'vhw'){
		header("Location: vhw.php?change=password&error=Confirmation Password is required");
		exit();
	}
	else if($_SESSION['usertype'] == 'Dispensary'){
		header("Location: dispensary.php?change=password&error=Confirmation Password is required");
		exit();
	}
}else if($np !== $c_np){
	if($_SESSION['usertype'] == 'Admin'){
		header("Location: admin.php?change=password&error=Passwords unmatch");
		exit();
	}
	else if($_SESSION['usertype'] == 'Patient'){
		header("Location: patient.php?change=password&error=Passwords unmatch");
		exit();
	}
	else if($_SESSION['usertype'] == 'vhw'){
		header("Location: vhw.php?change=password&error=Passwords unmatch");
		exit();
	}
	else if($_SESSION['usertype'] == 'Dispensary'){
		header("Location: dispensary.php?change=password&error=Passwords unmatch");
		exit();
	}
}else {
	

	$id = $_SESSION['id'];

	$sql = "SELECT password
			FROM users WHERE 
			id='$id' AND password='$op'";
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result) === 1){
		
		$sql_2 = "UPDATE users
				  SET password='$np'
				  WHERE id='$id'";
		mysqli_query($conn, $sql_2);
		if($_SESSION['usertype'] == 'Admin'){
			header("Location: admin.php?change=password&success=Your password has been changed successfully");
			exit();
		}
		else if($_SESSION['usertype'] == 'Patient'){
			header("Location: patient.php?change=password&success=Your password has been changed successfully");
			exit();
		}
		else if($_SESSION['usertype'] == 'vhw'){
			header("Location: vhw.php?change=password&success=Your password has been changed successfully");
			exit();
		}
		else if($_SESSION['usertype'] == 'Dispensary'){
			header("Location: dispensary.php?change=password&success=Your password has been changed successfully");
			exit();
		}
	
	}else {
		if($_SESSION['usertype'] == 'Admin'){
			header("Location: admin.php?change=password&error=Incorrect Password");
			exit();
		}
		else if($_SESSION['usertype'] == 'Patient'){
			header("Location: patient.php?change=password&error=Incorrect Password");
			exit();
		}
		else if($_SESSION['usertype'] == 'vhw'){
			header("Location: vhw.php?change=password&error=Incorrect Password");
			exit();
		}
		else if($_SESSION['usertype'] == 'Dispensary'){
			header("Location: dispensary.php?change=password&error=Incorrect Password");
			exit();
		}
	}

}


}


if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <form action="" method="post" style="margin-top: 130px;">
     	<h2 style="color: #760ca0;border-radius:3px;">Change Password</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

     	<?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
        <?php } ?>

     	<label>Old Password</label>
     	<input type="password" 
     	       name="op" 
     	       placeholder="Old Password">
     	       <br>

     	<label>New Password</label>
     	<input type="password" 
     	       name="np" 
     	       placeholder="New Password">
     	       <br>

     	<label>Confirm New Password</label>
     	<input type="password" 
     	       name="c_np" 
     	       placeholder="Confirm New Password">
     	       <br>

     	<button type="submit" style="width: 150px; height: 35px; font-size: 20px; cursor: pointer;background: #760ca0; color: #fff; float: right;">CHANGE</button>
     </form>
</body>
</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>