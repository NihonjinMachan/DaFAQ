<?php
  include('dbConnect.php');

  $username = $_POST['username'];
  $password = md5($_POST['password']);

  $usercheck = $db->prepare('SELECT * FROM user WHERE userName=:theName');
  $usercheck->execute(array(':theName' =>$username));
  $rowcount = $usercheck->rowCount();
  if($rowcount>0){
    echo("<script type='text/javascript'>
    alert('Username already taken! Try again');
    window.location.href = 'signup.php';
    </script>");
  }
  else{
  $signup = $db->prepare('insert into user (userName,password) values (:username, :password)');
  $signup->bindParam(':username', $username);
  $signup->bindParam(':password', $password);
  $signup->execute();

  if($signup){
    echo("<script type='text/javascript'>
    alert('Sign Up complete! Redirecting to Home Page');
    window.location.href = 'index.php';
    </script>");
  }

  else{
    echo("<script type='text/javascript'>
    alert('Sign Up Failed! Try again');
    window.location.href = 'signup.php';
    </script>");
  }
}
?>
