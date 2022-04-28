 <!DOCTYPE html>
<html>
<head>
<title>Login</title>
</head>

<body>
<br />
<br />

<div class="login-card">
<div class="log_head">
<h1>TB Program Login</h1>
<img src="images/lock.png" alt="lock" class="lock" />
</div>
<?php if (isset($_GET['error'])) { ?>
     		<p class="error" style="background: #F2DEDE;color: #A94442;font-size: 18px;"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

<div class="log_body">
<form action="login.php" method="POST">
 <table width="200" border="0" align="center">
  <tr>
    <td><input value="User Name" type="text" name="username" class="log_user" ></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input value="Password" type="password" name="password" class="log_Pass"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input name="remember" type="checkbox" value="Remember Me"> Keep me logged in</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input type="submit" name="login" class="login-submit" value="SIGN IN"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Don't have an account ? <a href="registeration.php" rel="register">Sign Up</a></td>
  </tr>
</table>

</form> 
</div>

</div>
</body>
</html>

     </form>

	 <style>




.login-card {
  
  width: 400px;
  background-color: #7E7E7E;
  margin: 0px auto ;
  border-radius: 9px;
  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  min-height:440px;
 
}

.log_head{ background:#4DC889; width:400px; height:120px; border-radius:9px 9px 0 0px; }

.login-card h1 {
  text-align: center;
  font-family:open Sans;
  color:#FFFFFF;
  font-weight:700px;
  font-size:20px;
  line-height:27px;
  padding-top: 24px;
  
}

.lock{ padding-left:181px; width:30px; height:37px; padding-top:10px;}

.log_body{ padding:40px 20px 20px 20px;}

.log_user{ background:#FEFEFE; color:#999999; border-radius: 10px; width:349px; height:31px; padding:5px; font-family:open Sans; font-weight:700px; font-size:15px; border:none; }

.log_Pass{background:#FEFEFE; color:#999999; border-radius: 10px; width:349px; height:31px; padding:5px; font-family:open Sans; font-weight:700px; font-size:15px; border:none;}


.login-submit{ background:#4DC889; border:none; border-radius: 10px; width:359px; height:36px; cursor:pointer; font-family:open Sans; font-weight:700px; font-size:15px; color:#FFFFFF; }

.log_body a{ text-decoration:none; color:#78EEB2; font-family:open Sans; font-weight:900px; font-size:15px; line-height:21px;}


	 </style>

</body>
</html>
