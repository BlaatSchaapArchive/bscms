<?php

$plugin = array ( "dir" => $current_plugin , "command" => "login",  "filename" => "login.php",  "type" => "auth") ;
array_push ($plugins, $plugin);
$plugin = array ( "dir" => $current_plugin , "command" => "logout", "filename" => "logout.php", "type" => "auth" ) ;
array_push ($plugins, $plugin);
$plugin = array ( "dir" => $current_plugin , "command" => "status", "filename" => "status.php", "type" => "auth" ) ;
array_push ($plugins, $plugin);
$plugin = array ( "dir" => $current_plugin , "command" => "signup", "filename" => "signup.php", "type" => "auth" ) ;
array_push ($plugins, $plugin);


$plugin = array ( "dir" => $current_plugin , "pre" => "", "filename" => "pre.php", "type" => "auth" ) ;
array_push ($plugins, $plugin);


?>
