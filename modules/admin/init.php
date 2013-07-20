<?php

$plugin = array ( "dir" => $current_plugin , "pre" => "", "filename" => "pre.php", "type" => "admin" ) ;
array_push ($plugins, $plugin);

$plugin = array ( "dir" => $current_plugin , "command" => "admin", "filename" => "admin.php", "type" => "admin" ) ;
array_push ($plugins, $plugin);

$renderer = array ( "dir" => $current_plugin , "filename" => "render.php",  "name" => "admin") ;
array_push ($renderers, $renderer);

$module_admin_dir = $current_plugin;


$css = array ( "dir" => $current_plugin , "name"=> "admin" ,"filename" => "admin.css") ;
array_push($csss,$css);

$css = array ( "dir" => $current_plugin , "name"=> "adminbar" ,"filename" => "adminbar.css") ;
array_push($csss,$css);


?>
