<?php
	
require_once("getid3/getid3/getid3.php");

function getfileinfo($remoteFile)
 
{
 
$url=$remoteFile;
$uuid=uniqid("designaeon_", true);
 $file="temp/".$uuid.".mp3";
 $size=0;
 $ch = curl_init($remoteFile);
 //==============================Get Size==========================//
 $contentLength = 'unknown';
 $ch1 = curl_init($remoteFile);
 curl_setopt($ch1, CURLOPT_NOBODY, true);
 curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch1, CURLOPT_HEADER, true);
 curl_setopt($ch1, CURLOPT_FOLLOWLOCATION, true); //not necessary unless the file redirects (like the PHP example we're using here)
 $data = curl_exec($ch1);
 curl_close($ch1);
 if (preg_match('/Content-Length: (\d+)/', $data, $matches)) {
 $contentLength = (int)$matches[1];
 $size=$contentLength;
 }
 //==============================Get Size==========================//
 
 if (!$fp = fopen($file, "wb")) {
 echo 'Error opening temp file for binary writing';
 return false;
 } else if (!$urlp = fopen($url, "r")) {
 echo 'Error opening URL for reading';
 return false;
 }
 try {
 $to_get = 65536; // 64 KB
 $chunk_size = 4096; // Haven't bothered to tune this, maybe other values would work better??
 $got = 0; $data = null;
 
 // Grab the first 64 KB of the file
 while(!feof($urlp) && $got < $to_get) {  $data = $data . fgets($urlp, $chunk_size);  $got += $chunk_size;  }  fwrite($fp, $data);  // Grab the last 64 KB of the file, if we know how big it is.  if ($size > 0) {
 curl_setopt($ch, CURLOPT_FILE, $fp);
 curl_setopt($ch, CURLOPT_HEADER, 0);
 curl_setopt($ch, CURLOPT_RESUME_FROM, $size - $to_get);
 curl_exec($ch);
 
 
 // Now $fp should be the first and last 64KB of the file!!
 
 @fclose($fp);
 @fclose($urlp);
 }
 
 catch (Exception $e)
 {
 @fclose($fp);
 @fclose($urlp);
 echo 'Error transfering file using fopen and cURL !!';
 return false;
 }
 $getID3 = new getID3;
 $filename=$file;
 $ThisFileInfo = $getID3->analyze($filename);
 getid3_lib::CopyTagsToComments($ThisFileInfo);
 unlink($file);
 return $ThisFileInfo;
}

?>