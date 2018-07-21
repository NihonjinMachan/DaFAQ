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
  $title = $db->prepare("SELECT title, qst FROM questions WHERE qstID='$_GET[qstID]'");
  $title->execute();
  $titleresult = $title->fetch(PDO::FETCH_ASSOC);

  $view = $db->prepare("UPDATE questions SET views=views+1 WHERE qstID='$_GET[qstID]'");
  $view->execute();

  $asker = $db->prepare("SELECT userName FROM user u, questions q WHERE u.userID=q.userID AND qstID='$_GET[qstID]'");
  $asker->execute();
  $askerresult = $asker->fetch(PDO::FETCH_ASSOC);

  $answer = $db->prepare("SELECT * FROM answers WHERE qstID='$_GET[qstID]'");
  $answer->execute();
  $rows = $answer->rowCount();
  ?>

  <div class="questions">
    <h1> <?php echo "$titleresult[title]" ?> </h1>
    <p style='color:black'> Asked by <?php echo "$askerresult[userName]" ?> </p>
    <p style='color:black'>
    <?php if($titleresult['qst'] == Null){
      echo "No Description Provided";
    }
    else{
      echo $titleresult['qst'];
    }
    ?>
    </p>
    <h2 style='margin-top:80px; text-decoration:underline'> Answers </h2>
    <?php
    if($rows == 0){
      echo ("<p id='noAns' style='color:black'> No Answers Available </p>
            <ul id='answerList'></ul>
            ");
    }
    else{
    foreach ($answer as $ans) {
      $replyer = $db->prepare("SELECT userName FROM user u, answers a WHERE u.userID=a.userID AND ansID=$ans[ansID]");
      $replyer->execute();
      $result = $replyer->fetch(PDO::FETCH_ASSOC);
      echo("  <ul id='answerList'>
                <li style='list-style:none; margin-top:20px; margin-right:25px; margin-bottom:40px'> <p style='color: #D64541'> " . $ans['ans'] . "</p>
                     <p style='color:black'> Answered by: " . $result['userName'] . "</p>
                     <form>
                     <button type='submit' class='vote' style='padding: 5px 5px; font-size: 1em;' value=1 id='".$ans['ansID']."''> Upvote </button>
                     <button type='submit' class='vote' style='padding: 5px 5px; font-size: 1em;' value=-1 id='".$ans['ansID']."''> Downvote </button>
                     </form>
                     <p style='color:black'> Votes: <span id='votes' value='".$ans['ansID']."'>" . $ans['votes'] . "</span></p>
                </li>
              </ul>

            <script>
            $('li').css('font-family','Raleway');
            </script>
            ");
      }
    }
    ?>
    <p id='userans'> Submit Your Answer </p>
    <form>
        <textarea id='info' rows="7" cols="50" name="question" placeholder="Your Answer Goes Here" required></textarea><br>
        <button type='submit' id='answer'> Submit </button>
    <form>
  </div>

  <script>
    $('#userans').addClass('userans');
    $('#answer').addClass('answer');
  </script>

  <style>
    .answer{
      vertical-align:middle;
      padding: 5px 10px;
      font-size: 1em;
      font-weight: bold;
      margin-top: 5px;
    }

    .userans{
      margin-top: 80px;
      font-size: 1.3em;
    }

  </style>

  <script>
  //method to that returns the GET value
  var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

        for (i = 0; i < sURLVariables.length; i++) {
          sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
          return sParameterName[1] === undefined ? true : sParameterName[1];
          }
        }
      };

    //method that disables submit button if there is no output
    $('#answer').attr('disabled',true);
    $('#info').keyup(function(){
        if($(this).val().length !=0){
              $('#answer').attr('disabled', false);
        }
        else{
              $('#answer').attr('disabled', true);
          }
        });

    //method to post an answer without page refresh
    $(document).ready(function(){
      $('#answer').click(function(e){
        e.preventDefault();
        var info = $('#info').val();
        var qstID = getUrlParameter('qstID');

        $.ajax({
            type: "POST",
            url: 'addanswer.php',
            data: 'info='+info+'&qstID='+qstID,
            success:function(data){
              $('#noAns').hide();
              $('#answerList').append(data);
              $('#info').val('');
              alert('Answer Posted!');
            }
          });
      });
  });

  //method to update votes without page refresh
    $(document).ready(function(){
      $('.vote').click(function(e){
        e.preventDefault();
        var ansID = $(this).attr('id');
        var factor = $(this).attr('value');
        $.ajax({
        type:'POST',
        url:'updateVote.php',
        data:'ansID='+ansID+'&factor='+factor,
        success:function(data) {
            $('span[value="'+ ansID +'"]').text(data);
        }
        });
      });
    });

  </script>

  <div class="footer">
      <ul>
          <li><a href="">Legal</a></li>
          <li><a href="">Site Map</a></li>
          <li><a href="">Careers</a></li>
          <li><a href="">Social Media</a></li>
      </ul>
  </div>

</body>
</html>
