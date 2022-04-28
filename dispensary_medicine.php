<?php
   
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
    if (isset($_GET['medicine_name']) && isset($_GET['medicine_cat'])) {
            require_once 'DBConnection.php';   
            $name = $_GET['medicine_name'];
            $category = $_GET['medicine_cat'];

            if(empty($name)){
                header("Location: dispensary.php?medicine=add&error=Please enter Medication Name");

            }
            else  if(empty($category)){
                header("Location: dispensary.php?medicine=add&error=Please enter Medication Category");

            }
            else{
                $sql = "INSERT INTO medicine(name,category)VALUES('$name','$category')";
                $result = mysqli_query($conn,$sql);
                if($result){
                    header("Location: dispensary.php?medicine=add&success=Medication Successfully added");

                }
            }


    }

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Manage Medicine</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <form action="dispensary.php?medicine=add" method="GET">
     	<h2>Add Medicine</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

     	<?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
        <?php } ?>

     	<label>Medicine Name</label>
     	<input type="text" 
     	       name="medicine_name" 
     	       placeholder="medicine name">
     	       <br>

                <select name="medicine_cat" id="medicine_cat" style="height: 45px;">
            <option value="" disabled selected>Select Medicine Category</option>
            <option value="TB">TB</option>
            <option value="HIV">HIV</option>
            </select><br><br>

     	<button type="submit">Save</button>
     </form>
</body>
</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>