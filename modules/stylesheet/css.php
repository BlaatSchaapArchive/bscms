<?php
  $stylesheet = $request[2];
  $found = false;
  $render = false;
  foreach ($csss as $css) {
    if ($stylesheet == $css['name']) {
      header('Content-type: text/css');
      include ($css["dir"].$css["filename"]);
      $found = true;
      break;
    } 
  }

  if (!$found) {
    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
    echo "HTTP ERROR 404: FILE NOT FOUND"; 
  }
?>
