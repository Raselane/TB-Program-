

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



    if(isset($_GET['comment_mess'])){
        $id = $_GET['id'];
        $response = $_GET['comment_mess'];
    
        $sql = "UPDATE `comments` SET reply='".$response."' WHERE commentid='".$id."'";
        $result = mysqli_query($conn, $sql);
        if($result){
            header("Location: vhw.php?success=Reply sent&comment=reply");
        }
    }
    
    else if(isset($_GET['request_mess'])){
        $id = $_GET['id'];
        $response = $_GET['request_mess'];
    
        $sql = "UPDATE `requests` SET reply='".$response."' WHERE requestid='".$id."'";
        $result = mysqli_query($conn, $sql);
        if($result){
            header("Location: vhw.php?success=Reply sent&request=reply");
        }
    }




else if(isset($_GET['comment'])){

    $id = $_GET['commentid'];
    $sql = "SELECT * FROM `comments` WHERE commentid='".$id."'";
    $result_comment = mysqli_query($conn, $sql);
    $info_comment = mysqli_fetch_array($result_comment);
}

else if(isset($_GET['request'])){

    $id = $_GET['requestid'];
    $sql = "SELECT * FROM `requests` WHERE requestid='".$id."'";
    $result_request = mysqli_query($conn, $sql);
    $info_request= mysqli_fetch_array($result_request);
}
 
    

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

   
       <div class="elements" >
       <form method="GET" id="commentForm" action="" style="height: 400px;">

                   <h2 style="color: #1690A7;"><?php if(isset($_GET['comment'])){echo 'Reply a Comment';}else{echo 'Reply a Request';}?></h2>
                   <div class="form-group">
                       <input type="text" name="id" id="submit" value="<?php if(isset($_GET['comment'])){echo $info_comment['commentid'];}else{echo $info_request['requestid'];}?>" disabled/>
                   </div>

                   <div class="form-group">
                   <textarea name="message" id="submit" placeholder="<?php if(isset($_GET['comment'])){echo $info_comment['comment'];}else if(isset($_GET['request'])){echo $info_request['request'];}else{echo '';}?>" id="request" class="form-control" rows="5" disabled></textarea>
                   </div>
                   <div class="form-group">
                       <textarea name="<?php if(isset($_GET['comment'])){echo 'comment_mess';}else{echo 'request_mess';}?>" id="request" class="form-control" placeholder="Enter Response" rows="5" required></textarea>
                   </div><br><br>
                   <span id="message"></span>
                   <div class="form-group">
                   <button type="submit" name="respond" style="width: 300px; height: 35px; font-size: 20px; cursor: pointer;background: #760ca0; color: #fff; float: right;">Send response</button>

                   </div>
               </form>	
           </div>	
   </div>
   </body>
   </html>
   
   