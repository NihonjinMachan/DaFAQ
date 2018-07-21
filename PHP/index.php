<?php
	session_start();
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
<body>
<div class="navbar">
			<ul class ="list1">
				<li><a href="index.php"><img width="65" height="65" alt="dafaq logo" src="images/logo.png"></img></a></li>
        <?php if (isset($_SESSION[login_user])){
          echo"<li class='listtext'>Hello $_SESSION[login_user] ( <a href='logout.php'> LogOut </a>) </li>";
        }
        else{
          echo "<li class='listtext'> Hello Guest</li>";
        } ?>
			</ul>
</div>

<div class="maintext">
    <p>DaFAQ</p>
    <p id="subtext"><strong>Where Questions Are Asked or Answered</strong></p>

    <div class="buttons">
		<?php if (isset($_SESSION[login_user])){
    echo("<ul>
				<form>
        <li><button type='submit' formaction='ask.php'>Ask a question</button></li>
        <li><button type='submit' formaction='questions.php'>Answer a question</button></li>
				</form>
    		</ul>");
		}
		else {
			echo("<ul>
					<form>
					<li><button type='submit' formaction='login.php'>Log In</button></li>
					<li><button type='submit' formaction='signup.php'>Sign Up</button></li>
					</form>
					</ul>");
		} ?>
    </div>

</div>


<footer>
		<ul>
		<li><a href="legal.html">Legal</a></li>
		<li><a href="">Site Map</a></li>
        <li><a href="">Careers</a></li>
        <li><a href="">Social Media</a></li>
		</ul>
</footer>
</body>
</html>
