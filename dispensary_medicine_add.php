<?php 
if (isset($_POST['name']) && isset($_POST['category'])) {

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
     }
     
     $name = validate($_POST['name']);
     $category = validate($_POST['category']);
   

 if(empty($name)){
	if($_SESSION['usertype'] == 'Admin'){
		header("Location: admin.php?medicine=add&error=Medicine name is required");
		exit();
	}
	
	else if($_SESSION['usertype'] == 'Dispensary'){
		header("Location: dispensary.php?change=medicine=add&error=Medicine name is required");
		exit();
	}
}
else if(empty($category)){
	if($_SESSION['usertype'] == 'Admin'){
		header("Location: admin.php?medicine=add&error=Medicine category is required");
		exit();
	}

	else if($_SESSION['usertype'] == 'Dispensary'){
		header("Location: dispensary.php?medicine=add&error=Medicine category is required");
		exit();
	}
}else {

    $sql = "INSERT INTO `medicine`(name,category)VALUES('$name','$category')";

	$result = mysqli_query($conn, $sql);
	if($result){
	
		if($_SESSION['usertype'] == 'Dispensary'){
			header("Location: dispensary.php?medicine=add&success=Medicine added successfully");
			exit();
		}
	
	}else {
		if($_SESSION['usertype'] == 'Admin'){
			header("Location: admin.php?medicine=add&error=Unknown error");
			exit();
		}
	
		else if($_SESSION['usertype'] == 'Dispensary'){
			header("Location: dispensary.php?medicine=add&error=Unknown error");
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
	<title>Add Medicine</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <form action="" method="post" style="margin-top: 50px; background: #1690A7">
     	<h2 style="color: #fff;">Add Medicine</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

     	<?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
        <?php } ?>

     	<label style="color: #fff;">Name</label>
     	<input type="text" 
     	       name="name" 
     	       placeholder="Medicine name" required>
     	       <br>

     	
                <select name="category" id="medicine_cat" style="height: 45px;">
            <option value="" disabled selected>Select Category</option>
            <option value="TB">TB</option>
            <option value="HIV">HIV</option>
            </select><br><br>

     	<button type="submit" style="width: 150px; height: 35px; font-size: 20px; cursor: pointer;background: #760ca0; color: #fff; float: right;">Save</button>
     </form>
</body>
</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>