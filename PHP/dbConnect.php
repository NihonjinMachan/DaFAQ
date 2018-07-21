<?php
$db = new PDO('mysql:host=localhost;dbname=coursework','root','');
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
?>
