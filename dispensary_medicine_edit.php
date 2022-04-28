<?php 
if (isset($_POST['name']) && isset($_POST['category']) && isset($_POST['medicineid'])) {

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
     }
     $medicineid = validate($_POST['medicineid']);
     $name = validate($_POST['name']);
     $category = validate($_POST['category']);
   

 if(empty($name)){
	if($_SESSION['usertype'] == 'Admin'){
		header("Location: admin.php?medicine=edit&error=Medicine name is required");
		exit();
	}
	
	else if($_SESSION['usertype'] == 'Dispensary'){
		header("Location: dispensary.php?medicine=edit&error=Medicine name is required");
		exit();
	}
}
else if(empty($category)){
	if($_SESSION['usertype'] == 'Admin'){
		header("Location: admin.php?medicine=edit&error=Medicine category is required");
		exit();
	}

	else if($_SESSION['usertype'] == 'Dispensary'){
		header("Location: dispensary.php?medicine=edit&error=Medicine category is required");
		exit();
	}
}else {

    $sql = "UPDATE `medicine` SET name='".$name."', category='".$category."' WHERE medicineid ='".$medicineid."'";

	$result = mysqli_query($conn, $sql);
	if($result){
	
		if($_SESSION['usertype'] == 'Dispensary'){
			header("Location: dispensary.php?medicine=edit&success=Medicine updated successfully");
			exit();
		}
	
	}else {
		if($_SESSION['usertype'] == 'Admin'){
			header("Location: admin.php?medicine=edit&error=Unknown error occured");
			exit();
		}
	
		else if($_SESSION['usertype'] == 'Dispensary'){
			header("Location: dispensary.php?medicine=edit&error=Unknown error occured");
			exit();
		}
	}

}


}

if(isset($_GET['medicineid'])){

    $medicineid = $_GET['medicineid'];

    $sql = "SELECT * FROM `medicine` WHERE medicineid='".$medicineid."'";
    $medicine_res = mysqli_query($conn,$sql);
    $result = mysqli_fetch_row($medicine_res);

    if($result){
        $id = $result[0];
        $name = $result[1];
        $category = $result[2];
    }
}
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Update Medicine</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <form action="" method="post" style="margin-top: 50px; background: #1690A7">
     	<h2 style="color: #fff;">Update Medicine</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

     	<?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
        <?php } ?>

     	<label style="color: #fff;">Name</label>
        <?php if(isset($_GET['medicineid'])){?>
     	<input type="text" 
     	       name="name" 
     	       placeholder="Medicine name" value="<?php echo $name;?>" required>
     	       <?php }else{?>

                <input type="text" 
     	       name="name" 
     	       placeholder="Medicine name" value="" required disabled>
               <?php } ?>

             
     	<input type="hidden" 
     	       name="medicineid" 
     	       placeholder="Medicine id" value="<?php echo $id;?>" required>
     	       <br>

     	
                <select name="category" id="medicine_cat" style="height: 45px;">
            <option value="" disabled selected>Select Category</option>
            <option value="TB">TB</option>
            <option value="HIV">HIV</option>
            </select><br><br>

            <?php if (isset($_GET['medicineid'])) { ?>
     	<button type="submit" style="width: 150px; height: 35px; font-size: 20px; cursor: pointer;background: #760ca0; color: #fff; float: right;">Save</button>
         <?php }else{ ?>
            <button type="button" style="width: 150px; height: 35px; font-size: 20px; cursor: pointer;background: #760ca0; color: #fff; float: right;"><a href="dispensary.php?medicine=view" style="outline: none; color: #fff;">Close</a></button>
            <?php }?>     </form>
</body>
</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>