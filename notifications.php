

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
   .success .chat{
       float: left;
       display: inline;
       padding: 20px;
   }
   .success a img{
       float: right;
   }
   
</style>

<?php
    require_once 'DBConnection.php';

    $id = $_SESSION['id'];
    $sql = "SELECT * FROM `notifications` WHERE userid='".$id."'";
    $result = mysqli_query($conn, $sql);

    $sql2 = "SELECT * FROM `comments`";
    $result2 = mysqli_query($conn, $sql2);

    $sql3 = "SELECT * FROM `requests`";
    $result3 = mysqli_query($conn, $sql3);

?>

   <!DOCTYPE html>
   <html>
       <body>

       <?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

     	<?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
        <?php } ?><br>

       <?php while($row1 = mysqli_fetch_array($result)):;?>
   <div class="success">
   <p><?php echo $row1['description']; ?></p>
   <p><?php echo $row1['datemade']; ?></p>
   <p><?php echo $row1['message'];?></p>
   <a href="patient.php?notid=<?php echo $row1['notificationid'];?>&notifications=delete"><img src="images/delete.png" alt=""></a>
   </div>

   

        <?php endwhile;?>
<?php if($_SESSION['usertype'] === 'vhw'){?>
    <p class="error">Users Comments</p>
        <?php while($row2 = mysqli_fetch_array($result2)):;?>
   <div class="success">
       <div class="chat"><p><?php echo $row2['userid']; ?></p></div>
    <div class="chat"> <p><?php echo $row2['comment']; ?></p></div>
  <div class="chat">   <p><?php echo $row2['date'];?></p></div>
<div class="chat" style="float: right;">   <a href="vhw.php?commentid=<?php echo $row2['commentid'];?>&comment=delete"><img src="images/delete.png" alt=""></a></div>
  <div class="chat" style="float: right;"><a href="vhw.php?commentid=<?php echo $row2['commentid'];?>&comment=reply"><img src="images/reply.png" alt=""></a>
</div>
</div>
<?php endwhile;}?>

<?php if($_SESSION['usertype'] === 'vhw'){?>
    <p class="error">Users Requests</p>
        <?php while($row3 = mysqli_fetch_array($result3)):;?>
   <div class="success">
       <div class="chat"><p><?php echo $row3['userid']; ?></p></div>
    <div class="chat"> <p><?php echo $row3['request']; ?></p></div>
  <div class="chat">   <p><?php echo $row3['datemade'];?></p></div>
<div class="chat" style="float: right;">   <a href="vhw.php?requestid=<?php echo $row3['requestid'];?>&request=delete"><img src="images/delete.png" alt=""></a></div>
  <div class="chat" style="float: right;"><a href="vhw.php?requestid=<?php echo $row3['requestid'];?>&request=reply"><img src="images/reply.png" alt=""></a>
</div>
</div>
<?php endwhile;}?>
            
      

   </body>
   </html>
   
   