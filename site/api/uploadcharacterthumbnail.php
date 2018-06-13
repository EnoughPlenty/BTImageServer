<?php
//Uploadcharacterthumbnail.php, used for uploading and cropping the screenshots sent by the thumbnail system.
$name = $_GET['filename'];
$type = $_GET['type'];


$secret = "my_secret_key"; //Important: set this to a hard to guess string, so other people cannot upload images! Also make sure to set the secret in the thumbnail server to this string.

$id = $_GET['uid'];

if ($_GET['secret'] != $secret) {
  die("403: Access denied");
}

/*print("tmpName: " . $_FILES['theFile']['tmp_name'] . " ");
print("size: " . $_FILES['theFile']['size'] . " ");
print("mime: " . $_FILES['theFile']['type'] . " ");
print("name: " . $_FILES['theFile']['name'] . " ");*/

echo "Uploading image.<br>";
echo "Type: $type<br>";
echo "Filename: $name<br>";


//move_uploaded_file($_FILES['theFile']['tmp_name'], "../images/userthumbnails/" . $id . ".png");

if ($type == 'avatar') {
  move_uploaded_file($_FILES['theFile']['tmp_name'], "../assets/thumbnails/avatars/" . $id . ".png");
} else if ($type == 'hat') {
  move_uploaded_file($_FILES['theFile']['tmp_name'], "../assets/thumbnails/hats/" . $id . ".png");
} else if ($type == 'shirt') {
  move_uploaded_file($_FILES['theFile']['tmp_name'], "../assets/thumbnails/shirts/" . $id . ".png");
} else if ($type == 'pants') {
  move_uploaded_file($_FILES['theFile']['tmp_name'], "../assets/thumbnails/pants/" . $id . ".png");
} else if ($type == 'tshirt') {
  move_uploaded_file($_FILES['theFile']['tmp_name'], "../assets/thumbnails/tshirts/" . $id . ".png");
} else if ($type == 'model') {
  move_uploaded_file($_FILES['theFile']['tmp_name'], "../assets/thumbnails/models/" . $id . ".png");
} else {
  move_uploaded_file($_FILES['theFile']['tmp_name'], "../assets/thumbnails/misc/" . $id . ".png");
}

if ($type == 'avatar') {
  $img = imagecreatefrompng("../assets/thumbnails/avatars/" . $_FILES['theFile']['name']);
} else if ($type == 'hat') {
  $img = imagecreatefrompng("../assets/thumbnails/hats/" . $_FILES['theFile']['name']);
} else if ($type == 'shirt') {
  $img = imagecreatefrompng("../assets/thumbnails/shirts/" . $_FILES['theFile']['name']);
} else if ($type == 'pants') {
  $img = imagecreatefrompng("../assets/thumbnails/pants/" . $_FILES['theFile']['name']);
} else if ($type == 'tshirt') {
  $img = imagecreatefrompng("../assets/thumbnails/tshirts/" . $_FILES['theFile']['name']);
} else if ($type == 'model') {
  $img = imagecreatefrompng("../assets/thumbnails/models/" . $_FILES['theFile']['name']);
} else {
  $img = imagecreatefrompng("../assets/thumbnails/misc/" . $_FILES['theFile']['name']);
}

$result = imagecrop($img, ['x' => 239, 'y' => 124, 'width' => 555, 'height' => 555]); //Put the coordinates of the image here, x is offset (x), y is offset (y), width is the image width and height is the image height.

if ($type == 'avatar') {
  imagepng($result, "../assets/thumbnails/avatars/" . $id . ".png", 0);
} else if ($type == 'hat') {
  imagepng($result, "../assets/thumbnails/hats/" . $id . ".png", 0);
} else if ($type == 'shirt') {
  imagepng($result, "../assets/thumbnails/shirts/" . $id . ".png", 0);
} else if ($type == 'pants') {
  imagepng($result, "../assets/thumbnails/pants/" . $id . ".png", 0);
} else if ($type == 'tshirt') {
  imagepng($result, "../assets/thumbnails/tshirts/" . $id . ".png", 0);
} else if ($type == 'model') {
  imagepng($result, "../assets/thumbnails/models/" . $id . ".png", 0);
} else {
  imagepng($result, "../assets/thumbnails/misc/" . $id . ".png", 0);
}
?>
