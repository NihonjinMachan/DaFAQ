<?php
  include('dbConnect.php');
  session_start();
  $ans = $db->quote($_POST['info']);

  $addanswer = $db->prepare("INSERT INTO answers (userID, qstID, ans,votes) VALUES ('$_SESSION[login_id]','$_POST[qstID]', $ans , 0)");
  $addanswer->execute();

  $answer = $db->prepare("SELECT * FROM answers ORDER BY ansID DESC LIMIT 1");
  $answer->execute();
  $rows = $answer->rowCount();

  if($rows != 0){
    foreach ($answer as $ans) {
      $replyer = $db->prepare("SELECT userName FROM user u, answers a WHERE u.userID=a.userID AND ansID=$ans[ansID]");
      $replyer->execute();
      $result = $replyer->fetch(PDO::FETCH_ASSOC);
      echo ("
      <li style='list-style:none; margin-top:20px; margin-right:25px; margin-bottom:40px'> <p style='color: #D64541'> " . $ans['ans'] . "</p>
           <p style='color:black'> Answered by: " . $result['userName'] . "</p>
           <button class='vote' style='padding: 5px 5px; font-size: 1em;' value=1 id='".$ans['ansID']."''> Upvote </button>
           <button class='vote' style='padding: 5px 5px; font-size: 1em;' value=-1 id='".$ans['ansID']."''> Downvote </button>
           <p style='color:black'> Votes: <span id='votes' value='".$ans['ansID']."'>" . $ans['votes'] . "</span></p>
      </li>
      ");
    }
  }

  else{
    echo("<script type='text/javascript'>
    alert('Answer Not Posted! Try again');
    </script>");
  }

?>
