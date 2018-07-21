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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>

<body class="page2">
  <div class="navbar">
  			<ul class ="list1">
  				<li><a href="index.php"><img width="65" height="65" alt="dafaq logo" src="images/logo.png"></img></a></li>
          <li class='listtext'>Hello <?php echo $_SESSION['login_user'] ?> ( <a href='logout.php'> LogOut </a>) </li>
  			</ul>
  </div>

  <?php
  include('dbConnect.php');
  $questions = $db->prepare('SELECT * FROM questions ORDER BY views DESC');
  $questions->execute();
  $rows = $questions->rowCount();
  ?>

  <div class="questions">
    <h1> Answer a Question </h1>
    <?php
    if($rows == 0){
      echo "<p> No Questions Available </p> \n";
    }
    else{
    foreach ($questions as $qst) {
      $asker = $db->prepare("SELECT userName FROM user u, questions q WHERE u.userID=q.userID AND qstID=$qst[qstID]");
      $asker->execute();
      $result = $asker->fetch(PDO::FETCH_ASSOC);
      echo("<ul>
                <li style='list-style:none; margin-top:50px; margin-right:25px'> <a href='answer.php?qstID=$qst[qstID]' style='text-decoration:none; color: #D64541'> " . $qst['title'] . "</a>
                     <p style='color:black'> Asked by: " . $result['userName'] . "</p>
                     <p style='color:black'> Views: " . $qst['views'] . "</p>
                </li>
            </ul>

            <script>
            $('a').mouseover(function() {
                  $(this).css('color','#E08283');
            }).mouseout(function() {
                  $(this).css('color','#D64541');
            });
            $('li').css('font-family','Raleway');
            </script>
            ");
      }
    }
    ?>
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
