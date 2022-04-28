<?php

if (isset($_POST['submit']) && $_POST['submit'] != '') {
    // require the db connection
    require_once 'DBConnection.php';
    $name = (!empty($_POST['name'])) ? $_POST['name'] : '';
    $description = (!empty($_POST['description'])) ? $_POST['description'] : '';
    $address = (!empty($_POST['address'])) ? $_POST['address'] : '';
    $districtid = (!empty($_POST['districtid'])) ? $_POST['districtid'] : '';

    if (!empty($districtid)) {
        // update the record
       $sql_query = "UPDATE `districts` SET districtname='" . $name . "', description='" . $description . "',address='" . $address .  "' WHERE districtid ='" . $districtid . "'";
       $result = mysqli_query($conn, $sql_query);

       if ($result) {
           header('location:admin.php?success=District Updated successfully&district=all');
       }
      
       
    } else {
        // insert the new record
        $sql_query= "INSERT INTO districts(districtname,description,address) VALUES('$name','$description','$address')";
        $result = mysqli_query($conn, $sql_query);

        if ($result) {
            header('location:admin.php?success=District Added successfully&district=all');
        }
    }

  

}

if (isset($_GET['districtid']) && $_GET['districtid'] != '') {
    // require the db connection
    require_once 'DBConnection.php';

    $districtid = $_GET['districtid'];
    $districts_query = "SELECT * FROM `districts` WHERE districtid='" . $districtid . "'";
    $districts_res = mysqli_query($conn, $districts_query);
    $results = mysqli_fetch_row($districts_res);
    $name = $results[1];
    $description = $results[2];
    $districtid = $results[0];
    $address = $results[3];
   

} else {
    $name = " ";
    $description = " ";
    $address = " ";
    $districtid = " ";
   
}

?>

  
<!DOCTYPE html>
<html>
<head>
	<title>District Details</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="register-form" style="margin-top: 70px;">
    <form action="" method="post">
    <nav class="home" style="background: #1690A7;color: #fff;">
              
              <div class="head" >
                     <h2 style="background: #1690A7;color: #fff;">District Details</h2>
              </div>
            
        
</nav><br>
          <label>District Name</label>
          <?php if (isset($_GET['districtid'])) { ?>
               <input type="text" 
                      name="name" 
                      placeholder="District Name"
                      value="<?php echo $name; ?>">
          <?php }else{ ?>
               <input type="text" 
                      name="name" 
                      placeholder="District Name">
          <?php }?>

          <label>Description</label>
          <?php if (isset($_GET['districtid'])) { ?>
               <input type="text" 
                      name="description" 
                      placeholder="Description"
                      value="<?php echo $description; ?>">
          <?php }else{ ?>
               <input type="text" 
                      name="description" 
                      placeholder="Description">
          <?php }?>

          <label>Head and Office Address</label>
          <?php if (isset($_GET['districtid'])) { ?>
               <input type="text" 
                      name="address" 
                      placeholder="Address"
                      value="<?php echo $address; ?>">
          <?php }else{ ?>
               <input type="text" 
                      name="address" 
                      placeholder="Address">
          <?php }?>

            <input type="hidden" name="districtid" value="<?php if(isset($_GET['districtid'])){echo $districtid;} ?>">
            <input type="submit" name="submit" value="Save" />
         
     </form>
    </div>
     
</body>
</html>

           