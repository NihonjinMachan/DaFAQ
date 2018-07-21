<?php

session_start();
if(session_destroy()){
  echo("<script type='text/javascript'>
  alert('You are logging out! Redirecting to Home Page');
  window.location.href = 'index.php';
  </script>");
}

?>
