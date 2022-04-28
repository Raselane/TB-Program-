<?php
if (isset($_GET['id']) && $_GET['id'] != '') {
    // require the db connection
    require_once 'DBConnection.php';

    $userid = $_GET['id'];
    $users_query = "SELECT * FROM `users` WHERE id='" . $userid . "'";
    $users_res = mysqli_query($conn, $users_query);
    $results = mysqli_fetch_row($users_res);
    $firstname = $results[3];
    $lastname = $results[13];
    $phone = $results[4];
    $num_of_dependencies = $results[7];
    $address = $results[9];
    $village = $results[8];
    $clinic = $results[14];
    $marital_status = $results[5];
    $usertype = $results[11];
    $kin = $results[10];
    $dob = $results[6];
    $user_name = $results[1];



}

if (isset($_POST['medication'])) {

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
     }
     
     
     $medication = validate($_POST['medication']);
   

 if(empty($medication)){
	if($_SESSION['usertype'] == 'Admin'){
		header("Location: admin.php?medicine=assign&error=Medication is required");
		exit();
	}
	
	else if($_SESSION['usertype'] == 'Dispensary'){
		header("Location: dispensary.php?medicine=assign&error=Medication is required");
		exit();
	}
}
else {

    $sql = "UPDATE `users` SET medication='" . $medication . "' WHERE id ='" . $userid . "'";

	$result = mysqli_query($conn, $sql);

    $description = "Medication Assignment";
    $message = "Congratulations your medication has been assigned";
    $datemade = date('d-m-y h:i:s');
    $message = "INSERT INTO `notifications`(description,message,userid,datemade)values('$description','$message','$userid','$datemade')";
    $result2 = mysqli_query($conn, $message);
	if($result && $result2){
	
		if($_SESSION['usertype'] == 'Dispensary'){
			header("Location: dispensary.php?medicine=assign&success=Medication assigned successfully");
			exit();
		}
	
	}else {
		if($_SESSION['usertype'] == 'Admin'){
			header("Location: admin.php?medicine=assign&error=Unknown error");
			exit();
		}
	
		else if($_SESSION['usertype'] == 'Dispensary'){
			header("Location: dispensary.php?medicine=assign&error=Unknown error");
			exit();
		}
	}

}


}




//fetching medicine info
$query = "SELECT * FROM `medicine`";
$result1 = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Medicine</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <form action="" method="post" style="margin-top: 50px; background: #1690A7">
     	<h2 style="color: #fff;">Assign Medicine</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

     	<?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
        <?php } ?>

     	<label style="color: #fff;">Name</label>
         <?php if (isset($_GET['id'])) { ?>
     	<input type="text" 
     	       name="name" 
     	       placeholder="<?php echo $firstname;?>" value="<?php echo $firstname;?>" disabled>
                <?php }else{ ?>
                    <input type="text" 
     	       name="name" 
     	       placeholder="First Name" value="" disabled required>
                <?php }?>
                            <br>

                <label style="color: #fff;">Surname</label>
                <?php if (isset($_GET['id'])) { ?>
     	<input type="text" 
     	       name="name" 
     	       placeholder="<?php echo $lastname;?>" value="<?php echo $lastname;?>" disabled>
     	       <?php }else{ ?>
                <input type="text" 
     	       name="name" 
     	       placeholder="Last Name" value="" disabled required>
     	       <?php }?>
                            <br>
             
     	<input type="hidden" 
     	       name="id" 
     	       placeholder="<?php echo $userid;?>" value="<?php echo $userid;?>" disabled>
     	       <br>

     	
                <select name="medication" id="medicine_list" style="height: 45px;">
            <option value="" disabled selected>Select Medicine</option>
            <?php while($row1 = mysqli_fetch_array($result1)):;?>
            <option value="<?php echo $row1[0];?>"><?php echo $row1[1];?></option>

            <?php endwhile;?>
            </select><br><br>

              
        
            <?php if (isset($_GET['id'])) { ?>
     	<button type="submit" style="width: 150px; height: 35px; font-size: 20px; cursor: pointer;background: #760ca0; color: #fff; float: right;">Save</button>
         <?php }else{ ?>
            <button type="button" style="width: 150px; height: 35px; font-size: 20px; cursor: pointer;background: #760ca0; color: #fff; float: right;"><a href="dispensary.php" style="outline: none; color: #fff;">Close</a></button>
            <?php }?>
    </form>
</body>
</html>

