<?php
  $fontId = (int) $request[2];
  $filename = realpath(dirname(__FILE__)) . "/data/$fontId";
  $data = GetDataFromFile($filename);
  if ($data) {  
    header('Content-type: application/vnd.ms-opentype');
    die($data);
  } else {
    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
    echo "HTTP ERROR 404: FILE NOT FOUND"; 
 
  }



?>
