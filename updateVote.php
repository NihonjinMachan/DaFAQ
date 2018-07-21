<?php
include('dbConnect.php');

$update= $db->prepare("UPDATE answers SET votes=votes+'$_POST[factor]' WHERE ansID='$_POST[ansID]'");
$update->execute();

$newVote = $db->prepare("SELECT votes FROM answers WHERE ansID='$_POST[ansID]'");
$newVote->execute();
$result = $newVote->fetch(PDO::FETCH_ASSOC);

if($update){
  echo $result['votes'];
}

else{
  echo "error";
}

?>
