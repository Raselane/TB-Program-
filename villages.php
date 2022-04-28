<?php
// mysql connection
require_once 'DBConnection.php';
 $query = "SELECT villageid,villagename, districts.districtname,clinics.clinicname FROM `villages` INNER JOIN clinics on villages.clinicid = clinics.clinicid inner join districts on villages.districtid=districts.districtid";
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
        <div class="add-btn" style="width: 210px;height:45px;">
            <a href="admin.php?village=add" style="text-decoration:none;"><input type="button" name="addClinic" value="Add Village" style="font-size: 25px; font-weight: bold;color: #1690A7;cursor:pointer;"></a>
        </div><br><br>
    
    <div class="container">


    <div class="info"></div>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Village ID</th>
                <th scope="col">Name</th>
                <th scope="col">District</th>
                <th scope="col">Village Clinic</th>
                <th scope="col" colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
if (!empty($records)) {
    while ($row = mysqli_fetch_assoc($results)) {
        ?>
                                <tr>
                                    <th scope="row"><?php echo $row['villageid']; ?></th>
                                    <td scope="row"><?php echo $row['villagename']; ?></td>
                                    <td><?php echo $row['districtname'];?></td>
                                    <td><?php echo $row['clinicname']; ?></td>
                                    <td>
                                       
                                    <a href="admin.php?villageid=<?php echo $row['villageid']; ?>&village=edit" ><button>Edit</button></a>
                                    </td>
                                    <td>
                                    <a href="admin.php?villageid=<?php echo $row['villageid']; ?>&village=delete" onClick="javascript:return confirm('Do you really want to delete?');" ><button>Delete</button></a>
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