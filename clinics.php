<?php
// mysql connection
require_once 'DBConnection.php';



 $query = "SELECT clinics.clinicid, clinics.clinicname, districts.districtname FROM `clinics` inner join districts on clinics.districtid=districts.districtid";
$results = mysqli_query($conn, $query);
$records = mysqli_num_rows($results);
if(isset($_GET['addClinic'])){
    header("Location: admin.php?clinic=add");
}
    



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
        <?php } ?><br>

        <div class="add-btn" style="width: 210px;height:45px;">
            <a href="admin.php?clinic=add" style="text-decoration:none;"><input type="button" name="addClinic" value="Add Clinic" style="font-size: 25px; font-weight: bold;color: #1690A7;cursor:pointer;"></a>
        </div><br><br>
    
    <div class="container">


    <div class="info"></div>
        <table class="table" style="margin-top: 170px;">
            <thead>
                <tr>
                <th scope="col">Clinic ID</th>
                <th scope="col">Name</th>
                <th scope="col">District</th>
                <th scope="col" colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
if (!empty($records)) {
    while ($row = mysqli_fetch_assoc($results)) {
        ?>
                                <tr>
                                    <th scope="row"><?php echo $row['clinicid']; ?></th>
                                    <td><?php echo $row['clinicname'];?></td>
                                    <td><?php echo $row['districtname']; ?></td>
                                    <td>
                                       
                                    <a href="admin.php?clinicid=<?php echo $row['clinicid']; ?>&clinic=add" ><button>Edit</button></a>
                                    </td>
                                    <td>
                                    <a href="admin.php?clinicid=<?php echo $row['clinicid']; ?>&clinic=delete" onClick="javascript:return confirm('Do you really want to delete?');" ><button>Delete</button></a>
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