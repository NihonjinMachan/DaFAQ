<?php
  include('dbConnect.php');

  $username = $_POST['login'];
  $password = md5($_POST['password']);


  $login = $db->prepare("SELECT * FROM user WHERE userName=:username AND password=:password");
  $login->bindParam(':username', $username);
  $login->bindParam(':password', $password);
  $login->execute();
  $rows = $login->rowCount();

  if($rows != 0){
    session_start();
    $result = $login->fetch(PDO::FETCH_ASSOC);
    $_SESSION['login_user']=$result['userName'];
    $_SESSION['login_id']=$result['userID'];
    echo("<script type='text/javascript'>
    alert('Log in successful! Redirecting to Home Page');
    window.location.href = 'index.php';
    </script>");
  }

  else{
    echo("<script type='text/javascript'>
    alert('Log in Failed! Try again');
    window.location.href = 'login.php';
    </script>");
  }

?>
