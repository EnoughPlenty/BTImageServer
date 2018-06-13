<?php
//Thumb.php, generates a script which generates the character in the client to make a screenshot of.
// Copyright (c) willemsteller, 2018

header("Content-Type: text/plain");

$dbhost = "example.com";
$dbusername = "example_username";
$dbpassword = "example_password";
$dbname = "database_name";

$connect = mysqli_connect($dbhost, $dbusername, $dbpassword) or die ("Couldn't connect to phpMyAdmin");
mysqli_select_db($connect, $dbname) or die("Couldn't find database");

$id = intval($_GET['uid']);
$type = $_GET['type'];

//With T-shirt:
//echo "game.GuiRoot:remove()\nlocal g = Instance.new(\"Player\", game.Players)\ng.CharacterAppearance = \"http://bloxtopia.xyz/users/". $_GET['uid'] ."/characterappearance.xml;http://bloxtopia.xyz/assets/xml/hats". $_USER['hatid'] .".xml;http://bloxtopia.xyz/assets/xml/tshirts/". $_USER['tshirtid'] .".xml\"\ng.Name = \"\"\ng:LoadCharacter()\ng.Character.Humanoid.MaxHealth = 0"
//Without T-shirt:
//echo "game.GuiRoot:remove()\nlocal g = Instance.new(\"Player\", game.Players)\ng.CharacterAppearance = \"http://bloxtopia.xyz/users/". $_GET['uid'] ."/characterappearance.xml;http://bloxtopia.xyz/assets/xml/hats". $_USER['hatid'] .".xml\"\ng.Name = \"\"\ng:LoadCharacter()\ng.Character.Humanoid.MaxHealth = 0";

//For 2008
//echo "game.GuiRoot:remove()\ngame.Players:CreateLocalPlayer(0):LoadCharacter(true)\ngame.Players.LocalPlayer.CharacterAppearance = \"http://bloxtopia.xyz/users/". $_GET['uid'] ."/characterappearance.xml;http://bloxtopia.xyz/assets/xml/hats". $_USER['hatid'] .".xml;http://bloxtopia.xyz/assets/xml/tshirts/". $_USER['tshirtid'] .".xml;http://bloxtopia.xyz/assets/xml/shirts/9.xml;http://bloxtopia.xyz/assets/xml/pants/9.xml\"";
//For 2009
//echo "game.GuiRoot:remove()\ngame.Players:CreateLocalPlayer(0):LoadCharacter(true)\ngame.Players.LocalPlayer.CharacterAppearance = \"http://bloxtopia.xyz/users/". $_GET['uid'] ."/characterappearance.xml;http://bloxtopia.xyz/assets/xml/hats". $_USER['hatid'] .".xml;http://bloxtopia.xyz/assets/xml/tshirts/". $_USER['tshirtid'] .".xml\"";
$uq = mysqli_query($connect, "SELECT * FROM users WHERE id='$id'") or die("Couldn't select user data: ". mysqli_error($connect));
$_USER = mysqli_fetch_assoc($uq);
if ($type == "avatar") {
  echo "game.GuiRoot:remove()\ngame.Players:CreateLocalPlayer(0):LoadCharacter(true)\ngame.Players.LocalPlayer.CharacterAppearance = \"http://bloxtopia.xyz/users/". $_GET['uid'] ."/characterappearance.xml;http://bloxtopia.xyz/assets/xml/hats". $_USER['hatid'] .".xml;http://bloxtopia.xyz/assets/xml/tshirts/". $_USER['tshirtid'] .".xml;http://bloxtopia.xyz/assets/xml/shirts/". $_USER['shirtid'] .".xml;http://bloxtopia.xyz/assets/xml/pants/". $_USER['pantsid'] .".xml\"";
} else if ($type == "hat") {
  echo "game.GuiRoot:remove()\ngame.Players:CreateLocalPlayer(0):LoadCharacter(true)\ngame.Players.LocalPlayer.CharacterAppearance = \"http://bloxtopia.xyz/users/7/characterappearance.xml;http://bloxtopia.xyz/assets/xml/hats". $id .".xml;http://bloxtopia.xyz/assets/xml/tshirts/0.xml;http://bloxtopia.xyz/assets/xml/shirts/0.xml\"\ngame.Players.LocalPlayer.Character[\"Head\"]:remove()\ngame.Players.LocalPlayer.Character[\"Torso\"]:remove()\ngame.Players.LocalPlayer.Character[\"Right Arm\"]:remove()\ngame.Players.LocalPlayer.Character[\"Left Arm\"]:remove()\ngame.Players.LocalPlayer.Character[\"Left Leg\"]:remove()\ngame.Players.LocalPlayer.Character[\"Right Leg\"]:remove()\n";
} else if ($type == "shirt") {
  echo "game.GuiRoot:remove()\ngame.Players:CreateLocalPlayer(0):LoadCharacter(true)\ngame.Players.LocalPlayer.CharacterAppearance = \"http://bloxtopia.xyz/users/7/characterappearance.xml;http://bloxtopia.xyz/assets/xml/hats0.xml;http://bloxtopia.xyz/assets/xml/tshirts/0.xml;http://bloxtopia.xyz/assets/xml/shirts/". $id .".xml;http://bloxtopia.xyz/assets/xml/pants/0.xml\"";
} else if ($type == 'pants') {
  echo "game.GuiRoot:remove()\ngame.Players:CreateLocalPlayer(0):LoadCharacter(true)\ngame.Players.LocalPlayer.CharacterAppearance = \"http://bloxtopia.xyz/users/7/characterappearance.xml;http://bloxtopia.xyz/assets/xml/hats0.xml;http://bloxtopia.xyz/assets/xml/tshirts/0.xml;http://bloxtopia.xyz/assets/xml/shirts/0.xml;http://bloxtopia.xyz/assets/xml/pants/". $id .".xml\"";
} else if ($type == 'tshirt') {
  echo "game.GuiRoot:remove()\ngame.Players:CreateLocalPlayer(0):LoadCharacter(true)\ngame.Players.LocalPlayer.CharacterAppearance = \"http://bloxtopia.xyz/users/7/characterappearance.xml;http://bloxtopia.xyz/assets/xml/hats0.xml;http://bloxtopia.xyz/assets/xml/tshirts/". $id .".xml;http://bloxtopia.xyz/assets/xml/shirts/0.xml;http://bloxtopia.xyz/assets/xml/pants/0.xml\"";
} else {
  echo "game.GuiRoot:remove()\ngame.Players:CreateLocalPlayer(0):LoadCharacter(true)\ngame.Players.LocalPlayer.CharacterAppearance = \"http://bloxtopia.xyz/users/". $_GET['uid'] ."/characterappearance.xml;http://bloxtopia.xyz/assets/xml/hats". $_USER['hatid'] .".xml;http://bloxtopia.xyz/assets/xml/tshirts/". $_USER['tshirtid'] .".xml;http://bloxtopia.xyz/assets/xml/shirts/". $_USER['shirtid'] .".xml;http://bloxtopia.xyz/assets/xml/pants/". $_USER['pantsid'] .".xml\"";
}

?>
