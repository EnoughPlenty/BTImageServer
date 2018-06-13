<?php
//Thumbnailchangerequests.php, gets all thumbnail change requests and prints the oldest request. This is being used to get the id and the type.
//Copyright (c) willemsteller, 2018

$dbhost = "example.com";
$dbusername = "db_username";
$dbpassword = "db_password";
$dbname = "db_name";


header("Content-type: text/plain");
$connect = mysqli_connect($dbhost,$dbusername,$dbpassword) or die ("Couldn't connect to phpMyAdmin");
mysqli_select_db($connect, $dbname) or die("Couldn't find database");

$q = mysqli_query($connect, "SELECT * FROM thumbnailchangerequests ORDER BY id DESC") or die(mysqli_error($connect));
$numrows = mysqli_num_rows($q);

$clear = intval($_GET['done']);

if ($numrows != 0) {
  $r = mysqli_fetch_row($q);
  $id = $r[1];
  $type = $r[2];
  echo $id.";".$type;
  if ($clear == 1) {
    $id = intval($id);
    $del = mysqli_query($connect, "DELETE FROM thumbnailchangerequests WHERE userid=$id") or die(mysqli_error($connect));
  }
} else {
  echo "0;misc;";
}
?>
