<?php

require_once 'DBConnection.php';

if (isset($_POST['submit']) && $_POST['submit'] != '') {
    // require the db connection
    require_once 'DBConnection.php';
    header('location:admin.php');
    $name = (!empty($_POST['name'])) ? $_POST['name'] : '';
    $district = (!empty($_POST['district'])) ? $_POST['district'] : '';
    $clinic = (!empty($_POST['clinic'])) ? $_POST['clinic'] : '';
    $villageid = (!empty($_POST['villageid'])) ? $_POST['villageid'] : '';

    
    if (!empty($villageid)) {
        // update the record
       header('location:admin.php');
       $sql_query = "UPDATE `villages` SET villagename='" . $name . "', districtid='" . $district . "', clinicid='" . $clinic. "' WHERE villageid ='" . $villageid . "'";
       $result = mysqli_query($conn, $sql_query);

       if ($result) {
           header('location:admin.php?success=Village Updated Successfully&village=all');
          
       }
      
       
    } else {
        // insert the new record
        $sql_query= "INSERT INTO villages(villagename,districtid,clinicid) VALUES('$name','$district',$clinic)";
        
    $result = mysqli_query($conn, $sql_query);

    if ($result) {
        header('location:admin.php?success=Village Added Successfully&village=all');
       
    }
    }


}

if (isset($_GET['villageid']) && $_GET['villageid'] != '') {
    // require the db connection
    require_once 'DBConnection.php';

    $villageid = $_GET['villageid'];
    $villages_query = "SELECT * FROM `villages` WHERE villageid='" . $villageid . "'";
    $villages_res = mysqli_query($conn, $villages_query);
    $results = mysqli_fetch_row( $villages_res);
    $name = $results[1];
    $district = $results[2];
    $clinic = $results[3];
   


} else {
    $name = " ";
    $district = " ";
    $clinic = " ";
   
}
$districts_query = "SELECT * FROM `districts`";
$result1 = mysqli_query($conn, $districts_query);

$villages_query = "SELECT * FROM `clinics`";
$result2 = mysqli_query($conn, $villages_query);
?>

  
<!DOCTYPE html>
<html>
<head>
	<title>Village Details</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="register-form" style="margin-top: 70px;">
    <form action="" method="post">
    <nav class="home" style="background: #1690A7;color: #fff;">
              
              <div class="head" >
                     <h2 style="background: #1690A7;color: #fff;">Village Details</h2>
              </div> 
        
</nav><br>
          <label>Village Name</label>
          <?php if (isset($_GET['villageid'])) { ?>
               <input type="text" 
                      name="name" 
                      placeholder="Village Name"
                      value="<?php echo $name; ?>">
          <?php }else{ ?>
               <input type="text" 
                      name="name" 
                      placeholder="Village Name">
          <?php }?>

         
          <label for="district">District</label><br>
            <select name="district">
            <option value disabled selected>Select District</option>
            <?php while($row1 = mysqli_fetch_array($result1)):;?>

            <option value="<?php echo $row1[0];?>"><?php echo $row1[1];?></option>

            <?php endwhile;?>

             </select><br><br>

             <label for="clinic">Clinic</label><br>
            <select name="clinic">
            <option value disabled selected>Select Clinic</option>
            <?php while($row2 = mysqli_fetch_array($result2)):;?>

            <option value="<?php echo $row2[0];?>"><?php echo $row2[1];?></option>

            <?php endwhile;?>

             </select>


            <input type="hidden" name="villageid" value="<?php if(isset($_GET['villageid'])){echo $villageid; }?>">
            <input type="submit" name="submit" value="Save" />
         
     </form>
    </div>
     
</body>
</html>

       

           