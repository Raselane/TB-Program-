<?php
require_once 'DBConnection.php';
 $query = "SELECT * FROM `medicine`";
$results = mysqli_query($conn, $query);
$records = mysqli_num_rows($results);
 

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Dispensary Panel</title>
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
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Category</th>
               <th scope="col" colspan="2">Action</th>

                </tr>
            </thead>
            <tbody>
                <?php
if (!empty($records)) {
    while ($row = mysqli_fetch_assoc($results)) {
        ?>
                                <tr>
                                    <td scope="row"><?php echo $row['medicineid']; ?></td>
                                    <td><?php echo $row['name'];?></td>
                                    <td><?php echo $row['category']; ?></td>
                                    <td>
                                         <a href="dispensary.php?medicine=edit&medicineid=<?php echo $row['medicineid']; ?>&medicine=edit" ><button>Edit Medicine</button></a>
                                    </td>
                                    <td>
                                    <a href="dispensary.php?medicineid=<?php echo $row['medicineid']; ?>&medicine=delete" onClick="javascript:return confirm('Do you really want to delete?');" ><button>Delete</button></a>
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