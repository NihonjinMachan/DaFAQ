<?php
  error_reporting(0);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ask or Answer</title>
	<link rel="stylesheet" type="text/css" href="dq1styles.css"/>
	<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'/>
  <link href="https://fonts.googleapis.com/css?family=Work+Sans:200" rel="stylesheet"/>
</head>

<body class="page2">
  <div class="logo">
  <a href="index.php"><img width="65" height="65" alt="dafaq logo" src="images/logo.png"></img></a>
  </div>

  <div class="login">
    <h1> Login </h1>
    <form method="post" action="loginprocessor.php">
      <p><input type="text" name="login" value="" placeholder="Username" required></p>
      <p><input type="password" name="password" value="" placeholder="Password" required></p>
      <p><input class="submit" type="submit" name="commit" value="Submit"></p>
      <p>Not a member? Register <a href="signup.php">here</a></p>
    </form>
  </div>

  <div class="footer">
  		<ul>
  		    <li><a href="legal.html">Legal</a></li>
  		    <li><a href="">Site Map</a></li>
          <li><a href="">Careers</a></li>
          <li><a href="">Social Media</a></li>
  		</ul>
  </div>

</body>
</html>
