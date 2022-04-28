

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

   <div class="medicine"> 
       <div class="elements">
       <h2><center>There are no active reports!!!</center></h2>
       </div>
           <br><br>
    
   </body>
   </html>
   
   