<?php
// mysql connection
require_once 'DBConnection.php';


 $query = "SELECT * FROM `districts`";
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
        <?php } ?><br>

        <div class="add-btn" style="width: 230px;height:45px;">
            <a href="admin.php?district=add" style="text-decoration:none;"><input type="button" name="addDistrict" value="Add District" style="width: 230px;font-size: 25px; font-weight: bold;color: #1690A7;cursor:pointer;"></a>
        </div><br><br>
     
    
    <div class="container">


    <div class="info"></div>
        <table class="table" style="margin-top: 170px;">
            <thead>
                <tr>
                <th scope="col">District ID</th>
                <th scope="col">District Name</th>
                <th scope="col">Description</th>
                <th scope="col">Address</th>
                <th scope="col" colspan="3">Action</th>

                </tr>
            </thead>
            <tbody>
                <?php
if (!empty($records)) {
    while ($row = mysqli_fetch_assoc($results)) {
        ?>
                                <tr>
                                    <th scope="row"><?php echo $row['districtid']; ?></th>
                                    <td><?php echo $row['districtname'];?></td>
                                    <td><?php echo $row['description']; ?></td>
                                    <td><?php echo $row['address']; ?></td>
                                    <td>
                                       
                                    <a href="admin.php?districtid=<?php echo $row['districtid']; ?>&district=add" ><button>Edit</button></a>
                                    </td>
                                    <td>
                                    <a href="admin.php?districtid=<?php echo $row['districtid']; ?>&district=delete" onClick="javascript:return confirm('Do you really want to delete?');" ><button>Delete</button></a>
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