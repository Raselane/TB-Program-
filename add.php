
<?php

if (isset($_POST['submit']) && $_POST['submit'] != '') {
    // require the db connection
    require_once 'DBConnection.php';
    header('location:admin.php');
    $firstname = (!empty($_POST['firstname'])) ? $_POST['firstname'] : '';
    $lastname = (!empty($_POST['lastname'])) ? $_POST['lastname'] : '';
    $phone = (!empty($_POST['phone'])) ? $_POST['phone'] : '';
    $num_of_dependencies = (!empty($_POST['num_of_dependencies'])) ? $_POST['num_of_dependencies'] : '';
    $address = (!empty($_POST['address'])) ? $_POST['address'] : '';
    $userid = (!empty($_POST['id'])) ? $_POST['id'] : '';
    $village = (!empty($_POST['village'])) ? $_POST['village'] : '';
    $year = (!empty($_POST['year'])) ? $_POST['year'] : '';
    $day = (!empty($_POST['day'])) ? $_POST['day'] : '';
    $month = (!empty($_POST['month'])) ? $_POST['month'] : '';
    $clinic = (!empty($_POST['clinic'])) ? $_POST['clinic'] : '';
    $marital_status = (!empty($_POST['marital_status'])) ? $_POST['marital_status'] : '';
    $usertype = (!empty($_POST['usertype'])) ? $_POST['usertype'] : '';
    $kin = (!empty($_POST['kin'])) ? $_POST['kin'] : '';
    $dob = $year. '/' .$month. '/' .$day;
    
    if (!empty($userid)) {
        // update the record
       header('location:admin.php');
       $sql_query = "UPDATE `users` SET firstname='" . $firstname . "', lastname='" . $lastname . "',phone='" . $phone . "',num_of_dependencies= '" . $num_of_dependencies . "', village='" . $village . "', address='" . $address . "', clinic='" . $clinic . "', dob='" . $dob . "', usertype='" . $usertype . "', kin='" . $kin. "', marital_status='" . $marital_status . "' WHERE id ='" . $userid . "'";
      
      if($result = mysqli_query($conn,$sql_query)){
       if(isset($_SESSION['id']) && $_SESSION['usertype'] === 'Dispensary'){
              header("Location: dispensary.php?register=account&success=Your Account has been Updated Successfully&$user_data");       
              exit();
          }
          else if(isset($_SESSION['id']) && $_SESSION['usertype'] === 'Admin'){
              header("Location: Admin.php?register=account&success=Your Account has been Updated Successfully&$user_data");       
              exit();
          }
          else if(isset($_SESSION['id']) && $_SESSION['usertype'] === 'Patient'){
              header("Location: patient.php?register=account&success=Your Account has been Updated Successfully&$user_data");       
              exit();
          }
          else if(isset($_SESSION['id']) && $_SESSION['usertype'] === 'vhw'){
              header("Location: vhw.php?register=account&error=success=Your Account has been Updated Successfully&$user_data");       
              exit();
          
      
      
      
       }
       }
       
    } else {
        // insert the new record
        $sql_query= "INSERT INTO users(user_name,firstname,lastname, password,phone,marital_status,usertype,num_of_dependencies,village,address,kin,dob) VALUES('$uname','$firstname','$lastname', '$pass','$phone','$marital_status','$usertype','$num_of_dependencies','$village','$address','$kin','$dob')";
        $msg = "add";
    }

    $result = mysqli_query($conn, $sql_query);

    if ($result) {
        header('location:admin.php?msg=' . $msg);
    }

}

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

} else {
    $firstname = " ";
    $lastname = " ";
    $phone = " ";
    $num_of_dependencies = " ";
    $address = " ";
    $userid = " ";
    $village = " ";
    $year = " ";
    $day = " ";
    $month = " ";
    $clinic = " ";
    $marital_status = " ";
    $usertype = " ";
    $kin = " ";
    $dob = " ";
}
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
       $id = $_SESSION['id'];
       $sql = "SELECT * FROM `users` WHERE id='".$id."'";
       $info = mysqli_query($conn,$sql);
       $userinfo = mysqli_fetch_row($info);
}
$villages_query = "SELECT * FROM `villages`";
$result1 = mysqli_query($conn, $villages_query);

$clinics_query = "SELECT * FROM `clinics`";
$result2 = mysqli_query($conn, $clinics_query);
?>

  
<!DOCTYPE html>
<html>
<head>
	<title>Account Details</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="registeration-container">
	<div class="registeration-header">
		<h2>  <?php if (isset($_GET['id'])) {echo 'Update Account Details';}else{echo 'Create User Account';} ?></h2>
	</div>
	<form id="form" class="form" action="" method="POST">

          <div class="form-control">
          <label>FirstName</label>
          <?php if (isset($_GET['id'])) { ?>
               <input type="text" 
                      name="firstname" 
                      placeholder="First Name"
                      value="<?php echo $firstname; ?>" required>
          <?php }else{ ?>
               <input type="text" 
                      name="firstname" 
                      placeholder="First Name" required>
          <?php }?>
		  </div>
              <div class="form-control">
          <label>LastName</label>
          <?php if (isset($_GET['id'])) { ?>
               <input type="text" 
                      name="lastname" 
                      placeholder="Last Name"
                      value="<?php echo $lastname; ?>">
          <?php }else{ ?>
               <input type="text" 
                      name="lastname" 
                      placeholder="Last Name">
          <?php }?>
          </div>

          <div class="form-control">
        
          <?php if (isset($_GET['id'])) { ?>
               <input type="hidden" 
                      name="uname" 
                      placeholder="User Name"
                      value="<?php echo $user_name; ?>" disabled><br>
          <?php }else{ ?>
               <input type="hidden" 
                      name="uname" 
                      placeholder="User Name"><br>
          <?php }?>
          </div>

          <div class="form-control">       

        <label>DOB</label>
        <select name="year" id="year" style="width: 100px;">
        <option value="">Year</option>
        <option value="1990">1990</option>
        <option value="1991">1991</option>
        <option value="1992">1992</option>
        <option value="1993">1993</option>
        </select>

        <select name="month" id="month" style="width: 100px;">
        <option value="">Month</option>
        <option value="Jan">January</option>
        <option value="Feb">February</option>
        <option value="Mar">March</option>
        <option value="Apr">April</option>
        <option value="May">May</option>
        <option value="Jun">June</option>
        <option value="Jul">July</option>
        <option value="Aug">August</option>
        <option value="Sep">September</option>
        <option value="Oct">October</option>
        <option value="Nov">November</option>
        <option value="Dec">December</option>
        </select>

        <select name="day" id="day" style="width: 100px;">
        <option value="">Day</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">6</option>
        <option value="7">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>
        <option value="15">16</option>
        <option value="17">18</option>
        <option value="19">19</option>
        <option value="20">20</option>
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
        <option value="24">24</option>
        <option value="25">26</option>
        <option value="27">28</option>
        <option value="29">29</option>
        <option value="30">30</option>
        </select></div><br><br>

        <div class="form-control">
        <label>Marital Status</label>
          <?php if (isset($_GET['id'])) { ?>
               <input type="text" 
                      name="marital_status" 
                      placeholder="Marital status"
                      value="<?php echo $marital_status; ?>"><br>
          <?php }else{ ?>
               <input type="text" 
                      name="marital_status" 
                      placeholder="Marital Status"><br>
          <?php }?>
          </div>

          <div class="form-control">
          <label>Phone Number</label>
          <?php if (isset($_GET['id'])) { ?>
               <input type="text" 
                      name="phone" 
                      placeholder="Phone Number"
                      value="<?php echo $phone; ?>"><br>
          <?php }else{ ?>
               <input type="text" 
                      name="phone" 
                      placeholder="Phone Number"><br>
          <?php }?>
          </div>

          <div class="form-control">
          <label>Next Of Kin</label>
          <?php if (isset($_GET['id'])) { ?>
               <input type="text" 
                      name="kin" 
                      placeholder="Next Of Kin"
                      value="<?php echo $kin; ?>"><br>
          <?php }else{ ?>
               <input type="text" 
                      name="kin" 
                      placeholder="Next Of Kin"><br>
          <?php }?>
          </div>

          <div class="form-control">
          <label>Number Of Dependencies</label>
          <?php if (isset($_GET['id'])) { ?>
               <input type="text" 
                      name="num_of_dependencies" 
                      placeholder="Number Of Dependencies"
                      value="<?php echo $num_of_dependencies; ?>"><br>
          <?php }else{ ?>
               <input type="text" 
                      name="num_of_dependencies" 
                      placeholder="Number Of Dependencies"><br>
          <?php }?>
          </div>

          
        
          <div class="form-control">
          <label>Address</label>
          <?php if (isset($_GET['id'])) { ?>
               <input type="text" 
                      name="address" 
                      placeholder="Address"
                      value="<?php echo $address; ?>" required><br>
          <?php }else{ ?>
               <input type="text" 
                      name="address" 
                      placeholder="Address" required><br>
          <?php }?>
		  </div><br><br>
               
            <div class="form-control">
            <label for="village">Village</label><br>
            <select name="village" style="height: 45px;">
            <?php while($row1 = mysqli_fetch_array($result1)):;?>

            <?php if($row1[0]==$results[8]){?>
              <option value="<?php echo $row1[0];?>" selected="selected"><?php echo $row1[1];?></option>

              <?php}else{?>
                     <option value="<?php echo $row1[0];?>"><?php echo $row1[1];?></option>


             <?php }?>


            <?php endwhile;?>

             </select>
          </div>

          <div class="form-control">
             <label for="clinic">Clinic</label><br>
            <select name="clinic" style="height: 45px;">
            <?php while($row2 = mysqli_fetch_array($result2)):;?>

            <?php if($row2[0]==$results[14]){?>
              <option value="<?php echo $row2[0];?>" selected="selected"><?php echo $row2[1];?></option>

              <?php}else{?>
                     <option value="<?php echo $row2[0];?>"><?php echo $row2[1];?></option>


             <?php }?>
            <?php endwhile;?>

             </select>
             </div>

         



          <div class="form-control">
                 <label for="usertype">UserType</label>

            <select name="usertype" id="usertype" style="height: 45px;">
            <option value="Patient">Patient</option>
            <option value="Dispensary">Dispensary</option>
            <option value="Admin">Administrator</option>
            <option value="vhw">Village Health Worker</option>
            </select>
          </div><br><br>

            <input type="hidden" name="id" value="<?php echo $userid; ?>">
            <input type="submit" name="submit" value="Save" />
            <a href="index.php"><?php if(!isset($_SESSION['id'])){echo 'Back';}?></a>
     </form>
    </div>
     

    <style>

@import url('https://fonts.googleapis.com/css?family=Muli&display=swap');
@import url('https://fonts.googleapis.com/css?family=Open+Sans:400,500&display=swap');

* {
	box-sizing: border-box;
}



.registeration-container {
	background-color: #fff;
	border-radius: 5px;
	box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
	overflow: hidden;
	width: 800px;
	max-width: 100%;
     margin-top: 130px;
 
}

.registeration-header {
	border-bottom: 1px solid #f0f0f0;
	background-color: #f7f7f7;
	padding: 20px 40px;
}

.registeration-header h2 {
	margin: 0;
}

.form {
	padding: 30px 40px;	
	width: 100%;
}

.form-control {
	margin-bottom: 5px;
	padding-bottom: 6px;
	position: relative;
	display: inline-block;
}

.form-control label {
	display: inline-block;
	margin-bottom: 5px;
}

.form-control input {
	border: 2px solid #f0f0f0;
	border-radius: 4px;
	display: block;
	font-family: inherit;
	font-size: 14px;
	padding: 10px;
	width: 200px;
}

.form-control input:focus {
	outline: 0;
	border-color: #777;
}

.form-control.success input {
	border-color: #2ecc71;
}

.form-control.error input {
	border-color: #e74c3c;
}

.form-control i {
	visibility: hidden;
	position: absolute;
	top: 40px;
	right: 10px;
}

.form-control.success i.fa-check-circle {
	color: #2ecc71;
	visibility: visible;
}

.form-control.error i.fa-exclamation-circle {
	color: #e74c3c;
	visibility: visible;
}

.form-control small {
	color: #e74c3c;
	position: absolute;
	bottom: 0;
	left: 0;
	visibility: hidden;
}

.form-control.error small {
	visibility: visible;
}

.form button {
	background-color: #8e44ad;
	border: 2px solid #8e44ad;
	border-radius: 4px;
	color: #fff;
	display: block;
	font-family: inherit;
	font-size: 16px;
	padding: 10px;
	margin-top: 20px;
	width: 100%;
}




          </style>

</body>
</html>

           