
<?php 

include "DBConnection.php";

if (isset($_POST['uname']) && isset($_POST['phone']) && isset($_POST['clinic'])
    && isset($_POST['usertype'])&& isset($_POST['year'])&& isset($_POST['month'])
    && isset($_POST['day'])&& isset($_POST['num_of_dependencies'])&& isset($_POST['marital_status'])
    && isset($_POST['kin'])&& isset($_POST['address'])&& isset($_POST['village'])
	&& isset($_POST['firstname'])&& isset($_POST['lastname'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$firstname = validate($_POST['firstname']);
	$lastname = validate($_POST['lastname']);
    $year = validate($_POST['year']);
    $day = validate($_POST['day']);
    $month = validate($_POST['month']);
    $usertype = validate($_POST['usertype']);
    $phone = validate($_POST['phone']);
    $kin = validate($_POST['kin']);
    $marital_status = validate($_POST['marital_status']);
    $num_of_dependencies = validate($_POST['num_of_dependencies']);
    $village = validate($_POST['village']);
    $address = validate($_POST['address']);
	$clinic = validate($_POST['clinic']);
    $dob = $year. '/' .$month. '/' .$day;
	$strpassword = $firstname;
	$pass = strtolower($strpassword);
	


	


	    $sql = "SELECT * FROM users WHERE user_name='$uname' ";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			header("Location: registeration.php?error=The username is taken try another&$user_data");
	        exit();
		}else {
           $sql2 = "INSERT INTO users(user_name,firstname,lastname, password,phone,marital_status,usertype,num_of_dependencies,village,address,kin,dob,clinic) VALUES('$uname','$firstname','$lastname', '$pass','$phone','$marital_status','$usertype','$num_of_dependencies','$village','$address','$kin','$dob','$clinic')";
           $result2 = mysqli_query($conn, $sql2);
           if ($result2) {
                if(isset($_SESSION['id']) && $_SESSION['usertype'] === 'Dispensary'){
                    header("Location: dispensary.php?register=account&success=User Account Created&$user_data");       
                    exit();
                }
                else if(isset($_SESSION['id']) && $_SESSION['usertype'] === 'Admin'){
                    header("Location: Admin.php?register=account&success=User Account Created&$user_data");       
                    exit();
                }
               else{
                    header("Location: registeration.php?success=Your TB Program Account created&$user_data");

               }
               
           }else {
               if(isset($_SESSION['id']) && $_SESSION['usertype'] === 'Dispensary'){
                    header("Location: dispensary.php?register=account&error=An error occured&$user_data");       
                    exit();
                }
                else if(isset($_SESSION['id']) && $_SESSION['usertype'] === 'Admin'){
                    header("Location: Admin.php?register=account&error=An error occured&$user_data");       
                    exit();
                }
               else{
                    header("Location: registeration.php?error=An error occured&$user_data");

               }
           }
		}
	
	
}

$villages_query = "SELECT * FROM `villages`";
$result1 = mysqli_query($conn, $villages_query);

$clinics_query = "SELECT * FROM `clinics`";
$result2 = mysqli_query($conn, $clinics_query);


?>


<!DOCTYPE html>
<html>
    <head>
    <script src="script.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">

    </head>

    <body>
    <div class="registeration-container">
	<div class="registeration-header">
		<h2>Create Account</h2>
	</div>
	<form id="form" class="form" action="" method="POST">
		<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

          <?php if (isset($_GET['success'])) { ?>
               <p class="success"><?php echo $_GET['success']; ?></p>
          <?php } ?>
		  <div class="form-control">
          <label>FirstName</label>
          <?php if (isset($_GET['firstname'])) { ?>
               <input type="text" 
                      name="firstname" 
                      placeholder="First Name"
                      value="<?php echo $_GET['firstname']; ?>" required>
          <?php }else{ ?>
               <input type="text" 
                      name="firstname" 
                      placeholder="First Name" required>
          <?php }?>
		  </div>

		  <div class="form-control">
          <label>LastName</label>
          <?php if (isset($_GET['lastname'])) { ?>
               <input type="text" 
                      name="lastname" 
                      placeholder="Last Name"
                      value="<?php echo $_GET['lastname']; ?>" required>
          <?php }else{ ?>
               <input type="text" 
                      name="lastname" 
                      placeholder="Last Name" required>
          <?php }?>
		  </div><br>

		  <div class="form-control">
          <label>User Name</label>
          <?php if (isset($_GET['uname'])) { ?>
               <input type="text" 
                      name="uname" 
                      placeholder="User Name"
                      value="<?php echo $_GET['uname']; ?>" required><br>
          <?php }else{ ?>
               <input type="text" 
                      name="uname" 
                      placeholder="User Name" required><br>
          <?php }?>
		  </div><br>


		  <div class="form-control">
        <label>DOB</label>
        <select name="year" id="year" style="width: 100px;">
        <option value disabled selected>Year</option>
        <option value="1990">1990</option>
        <option value="1991">1991</option>
        <option value="1992">1992</option>
        <option value="1993">1993</option>
        </select>

        <select name="month" id="month" style="width: 100px;">
        <option value disabled selected>Month</option>
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
        <option value disabled selected>Day</option>
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
        </select>
		  </div><br><br>
		  <div class="form-control">
        <label>Marital Status</label>
          <?php if (isset($_GET['marital_status'])) { ?>
               <input type="text" 
                      name="marital_status" 
                      placeholder="Marital status"
                      value="<?php echo $_GET['marital_status']; ?>" required><br>
          <?php }else{ ?>
               <input type="text" 
                      name="marital_status" 
                      placeholder="Marital Status" required><br>
          <?php }?>
		  </div>


		  <div class="form-control">
          <label>Phone Number</label>
          <?php if (isset($_GET['phone'])) { ?>
               <input type="text" 
                      name="phone" 
                      placeholder="Phone Number"
                      value="<?php echo $_GET['phone']; ?>" required><br>
          <?php }else{ ?>
               <input type="text" 
                      name="phone" 
                      placeholder="Phone Number" required><br>
          <?php }?>
		  </div>

		  <div class="form-control">
          <label>Next Of Kin</label>
          <?php if (isset($_GET['kin'])) { ?>
               <input type="text" 
                      name="kin" 
                      placeholder="Next Of Kin"
                      value="<?php echo $_GET['kin']; ?>" required><br>
          <?php }else{ ?>
               <input type="text" 
                      name="kin" 
                      placeholder="Next Of Kin" required><br>
          <?php }?>
		  </div>

		  <div class="form-control">
          <label>Number Of Dependencies</label>
          <?php if (isset($_GET['num_of_dependencies'])) { ?>
               <input type="number" 
                      name="num_of_dependencies" 
                      placeholder="Number Of Dependencies"
                      value="<?php echo $_GET['num_of_dependencies']; ?>" required><br>
          <?php }else{ ?>
               <input type="number" 
                      name="num_of_dependencies" 
                      placeholder="Number Of Dependencies" required><br>
          <?php }?>
		  </div>

          <div class="form-control">
          <label>Address</label>
          <?php if (isset($_GET['address'])) { ?>
               <input type="text" 
                      name="address" 
                      placeholder="Address"
                      value="<?php echo $_GET['address']; ?>" required><br>
          <?php }else{ ?>
               <input type="text" 
                      name="address" 
                      placeholder="Address" required><br>
          <?php }?>
		  </div><br><br>
               
            <div class="form-control">
            <label for="village">village</label><br>
            <select name="village" style="height: 45px;">
            <option value disabled selected>Select Village</option>
            <?php while($row1 = mysqli_fetch_array($result1)):;?>

            <option value="<?php echo $row1[0];?>"><?php echo $row1[1];?></option>

            <?php endwhile;?>

             </select>
          </div>

          <div class="form-control">
             <label for="clinic">Clinic</label><br>
            <select name="clinic" style="height: 45px;">
            <option value disabled selected>Select Clinic</option>
            <?php while($row2 = mysqli_fetch_array($result2)):;?>

            <option value="<?php echo $row2[0];?>"><?php echo $row2[1];?></option>

            <?php endwhile;?>

             </select>
             </div>

		  <div class="form-control">

          <label for="usertype">UserType</label>
          <select name="usertype" id="usertype" style="height: 45px;">
            <option value disabled selected>Select usertype</option>
            <option value="Patient">Patient</option>
            <option value="Dispensary">Dispensary</option>
            <option value="Admin">Administrator</option>
            <option value="vhw">Village Health Worker</option>
            </select>
		  </div><br><br>

           
     	<button type="submit" class="register-btn">Sign Up</button>
          <?php if(!isset($_SESSION['user_name'])){ echo '<a href="index.php" class="ca">Already have an account?</a>';}?>
          </form>
     </div> 
     <br><br><br>   


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




