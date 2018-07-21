<?php
  include('dbConnect.php');
  session_start();
  $title = $db->quote($_POST['title']);
  $qst = $db->quote($_POST['question']);

  $add = $db->prepare("INSERT INTO questions (userID, title, qst,views) VALUES ('$_SESSION[login_id]', $title , $qst, 0);");
  $add->execute();


  if($add){
    echo("<script type='text/javascript'>
    alert('Question Asked! Redirecting to Home Page');
    window.location.href = 'index.php';
    </script>");
  }

  else{
    echo("<script type='text/javascript'>
    alert('Question was not Asked! Try again');
    window.location.href = 'ask.php';
    </script>");
  }

?>
