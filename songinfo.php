<?php

include 'getfileinfo.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $search = validate($_POST["song"]);
}

function validate($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


//get file info

$a=getfileinfo($search);

$album = $a['tags']['id3v2']['album'][0];
$genre = $a['tags']['id3v2']['genre'][0];
$artist = $a['tags']['id3v2']['artist'][0];
$title = $a['tags']['id3v2']['title'][0];
$size = floatval($a['filesize']);

echo "URL:".$search."</br>";
echo "TITLE:".$title."</br>";
echo "ARTIST:".$artist."</br>";
echo "ALBUM:".$album."</br>";
echo "GENRE:".$genre."</br>";
echo "SIZE:".$size."</br>";

?>


