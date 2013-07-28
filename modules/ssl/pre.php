<?php

function ssl_force(){
    if (!(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off')) {
      header('Strict-Transport-Security: max-age=31536000');
      header('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], true, 301);
      die("This page *must* be accessed over a secure (HTTPS) connection!");
  } 
}

?>
