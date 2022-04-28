
<style>
   
.medicine{
    width: 500px;
    height: 100px;
    margin-top: 80px;
    margin-left: 60px;
    margin-bottom: 400px;
}
.medicine img{
    width:350px;
    margin-top: 40px;
}

form .form-group input[type="text"]{
    width: 180px;
    height: 35px;
    border: 2px green solid;
    border-radius:3px;
    font-size: 20px;
    outline: none;
}
form .form-group textarea{
    width: 190px;
    height: 75px;
    border: 2px green solid;
    border-radius:3px;
    font-size: 20px;
    outline: none;
    margin-left: 120px;
}
form input[type="submit"]{
    width:150px;
    height: 35px;
    background: #fff;
    border: 1px green solid;
    color: #1690A7;
    font-size:16px;
    font-weight:bold;
    border-radius:3px;

}
form input[type="submit"]:hover{
    background: #1690A7;
    color:#fff;
    cursor: pointer;
   
}

.medicine .elements h2{
    color: red;
}


</style>
<?php
    require_once 'DBConnection.php';

    $id = $_SESSION['id'];
   $sql = "SELECT * FROM `users` WHERE id='".$id."'";
   

    $result = mysqli_query($conn, $sql);
    $info = mysqli_fetch_array($result);
    $id = $info['medication'];
    $sql2 = "SELECT * FROM `medicine` WHERE medicineid='".$id."'";
    $result2 = mysqli_query($conn, $sql2);
    $info2 = mysqli_fetch_array($result2);

?>
<!DOCTYPE html>
<html>
    <body>

      
<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

     	<?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
        <?php } ?>

<div class="medicine"> 
    <div class="elements">
    <img src="images/tb.jpg" alt="">
    <h2><center><?php if(!empty($info['medication'])){echo 'Medicine : '.$info2['name'];}else{echo 'No Medication Assigned, Request for medicine!!!';}?></center></h2>
    </div>
        <br><br>
    <div class="elements">
    <form method="GET" id="commentForm" action="">
    <h2 style="color: #1690A7;">Comment Section</h2>
               
                <div class="form-group">
                    <textarea name="comment" id="comment" class="form-control" placeholder="Enter Comment" rows="5" required></textarea>
                </div><br><br>
                <span id="message"></span>
                <div class="form-group">
                    <input type="submit" name="submit" id="submit" value="comment"/>
                </div>
            </form>	
        </div>	
</div>
</body>
</html>

