<?php
  error_reporting(0);
  session_start();
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
  <div class="navbar">
  			<ul class ="list1">
  				<li><a href="index.php"><img width="65" height="65" alt="dafaq logo" src="images/logo.png"></img></a></li>
          <li class='listtext'>Hello <?php echo $_SESSION[login_user] ?> ( <a href='logout.php'> LogOut </a>) </li>
  			</ul>
  </div>

  <div class="login">
    <h1> Ask A Question </h1>
    <form method="post" action="addquestion.php">
      <p><input type="text" name="title" placeholder="Enter Question Here" style="width: 370px;" required></p>
      <textarea rows="5" cols="50" name="question" placeholder="Enter Question Details Here (Optional)"></textarea>
      <p><input class="submit" type="submit" name="commit" value="Submit"></p>
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
