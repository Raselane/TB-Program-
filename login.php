<?php 
session_start(); 
include "DBConnection.php";

if (isset($_POST['username']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$username = validate($_POST['username']);
	$pass = validate($_POST['password']);
	
		
		if($username == 'Admin' && $pass == 'admin123'){
			header("Location: admin.php");
			exit();
		}else{
				

			
		$sql = "SELECT * FROM users WHERE user_name='$username' AND password='$pass'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['user_name'] === $username && $row['password'] === $pass) {
            	$_SESSION['user_name'] = $row['user_name'];
            	$_SESSION['firstname'] = $row['firstname'];
            	$_SESSION['id'] = $row['id'];
				$_SESSION['usertype'] = $row['usertype'];
			
				if($row['usertype'] === 'Admin' && $row['status'] === 'approved'){
					header("Location: admin.php");
					exit();
				}
				else if($row['usertype'] === 'Patient' && $row['status'] === 'approved'){
					header("Location: patient.php");
					exit();
				}
				else if($row['usertype'] === 'Dispensary' && $row['status'] === 'approved'){
					header("Location: dispensary.php");
					exit();
				}
				else if($row['usertype'] === 'vhw' && $row['status'] === 'approved'){
					header("Location: vhw.php");
					exit();
				}
            	
		        
            }else{
				
				header("Location: index.php?error=Incorrect username or password"); 	        
				 exit();
			}
		}else{
			
			header("Location: index.php?error=Incorrect username or password!!!"); 	        
				 exit();
		}
		}

        
	
	
}else{
	header("Location: index.php");
	exit();
}
?>
