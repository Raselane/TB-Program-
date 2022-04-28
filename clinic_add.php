<?php

require_once 'DBConnection.php';

if (isset($_POST['submit']) && $_POST['submit'] != '') {
    // require the db connection
    require_once 'DBConnection.php';
    header('location:admin.php');
    $name = (!empty($_POST['name'])) ? $_POST['name'] : '';
    $district = (!empty($_POST['district'])) ? $_POST['district'] : '';
    $clinicid = (!empty($_POST['clinicid'])) ? $_POST['clinicid'] : '';

  
    
    if (!empty($clinicid)) {
        // update the record
       header('location:admin.php');
       $sql_query = "UPDATE `clinics` SET clinicname='" . $name . "', districtid='" . $district . "' WHERE clinicid ='" . $clinicid . "'";
       $result = mysqli_query($conn, $sql_query);

       if ($result) {
        header('location:admin.php?clinic=all&success=Clinic Updated Successfully');
          
       }
      
       
    } else {
        // insert the new record
        $sql_query= "INSERT INTO clinics(clinicname,districtid) VALUES('$name','$district')";
        $result = mysqli_query($conn, $sql_query);

       if ($result) {
        header('location:admin.php?clinic=all&success=Clinic Added Successfully');
          
       }
    }



}

if (isset($_GET['clinicid']) && $_GET['clinicid'] != '') {
    // require the db connection
    require_once 'DBConnection.php';

    $clinicid = $_GET['clinicid'];
    $clinics_query = "SELECT * FROM `clinics` WHERE clinicid='" . $clinicid . "'";
    $clinics_res = mysqli_query($conn, $clinics_query);
    $results = mysqli_fetch_row($clinics_res);
    $name = $results[1];
    $district = $results[2];
   


} else {
    $name = " ";
    $district = " ";
    $clinicid = " ";
   
}
$query = "SELECT * FROM `districts`";
$result1 = mysqli_query($conn, $query);

?>

  
<!DOCTYPE html>
<html>
<head>
	<title>Clinic Details</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <div class="register-form" style="margin-top: 70px;">
    <form action="" method="post">
    <nav class="home" style="background: #1690A7;color: #fff;">
              
              <div class="head" >
                     <h2 style="background: #1690A7;color: #fff;">Clinic Details</h2>
              </div>
             
        
</nav><br>
<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

     	<?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
        <?php } ?><br><br>
          <label>Clinic Name</label>
          <?php if (isset($_GET['clinicid'])) { ?>
               <input type="text" 
                      name="name" 
                      placeholder="Clinic Name"
                      value="<?php echo $name; ?>">
          <?php }else{ ?>
               <input type="text" 
                      name="name" 
                      placeholder="Clinic Name">
          <?php }?>

         
          <label for="district">District</label><br>
            <select name="district">
            <option value disabled selected>Select District</option>
            <?php while($row1 = mysqli_fetch_array($result1)):;?>

            <option value="<?php echo $row1[0];?>"><?php echo $row1[1];?></option>

            <?php endwhile;?>

             </select>


            <input type="hidden" name="clinicid" value="<?php if(isset($_GET['clinicid'])){echo $clinicid; }?>">
            <input type="submit" name="submit" value="Save" />
         
     </form>
    </div>
     
</body>
</html>

       

           