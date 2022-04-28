<?php
require_once 'DBConnection.php';
 $query = "SELECT * FROM `users` where usertype='Patient'";
$results = mysqli_query($conn, $query);
$records = mysqli_num_rows($results);
 

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin Panel</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

     	<?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
        <?php } ?>

     
    
    <div class="container">


    <div class="info"></div>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">UserID</th>
                <th scope="col">Full Name</th>
                <th scope="col">UserName</th>
                <th scope="col">Address</th>
                <th scope="col">Village</th>
                <th scope="col">Phone</th>
                <th scope="col">No. Dependencies</th>
                <th scope="col">Usertype</th>
                <th scope="col">Marital Status</th>
                <th scope="col">DOB</th>
                <th scope="col">Next of Kin</th>
                <th scope="col">Status</th>
                <th scope="col">Clinic</th>
                <th scope="col">Medication</th>
                <th scope="col" colspan="2">Action</th>

                </tr>
            </thead>
            <tbody>
                <?php
if (!empty($records)) {
    while ($row = mysqli_fetch_assoc($results)) {
        ?>
                                <tr>
                                    <td scope="row"><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></td>
                                    <td><?php echo $row['user_name']; ?></td>
                                    <td><?php echo $row['address']; ?></td>
                                    <td><?php echo $row['village']; ?></td>
                                    <td><?php echo $row['phone']; ?></td>
                                    <td><?php echo $row['num_of_dependencies']; ?></td>
                                    <td><?php echo $row['usertype']; ?></td>
                                    <td><?php echo $row['marital_status']; ?></td>
                                    <td><?php echo $row['dob']; ?></td>
                                    <td><?php echo $row['kin']; ?></td>
                                    <td><?php echo $row['status']; ?></td>
                                    <td><?php echo $row['clinic']; ?></td>
                                    <td><?php echo $row['medication']; ?></td>
                                    <td>
                                       
                                    <a href="dispensary.php?id=<?php echo $row['id']; ?>&medicine=assign" ><button>Assign Medicine</button></a>
                                    </td>
                                    
                                    <td>
                                    <a href="dispensary.php?id=<?php echo $row['id']; ?>&account=approve" ><button><?php if($row['status']=='approved'){echo 'Disapprove';}else{echo 'Approve';}?></button></a>
                                    </td>

                                   
                                </tr>

                            <?php
}
}

?>



            </tbody>
        </table>
    </div>
</body>
</html>