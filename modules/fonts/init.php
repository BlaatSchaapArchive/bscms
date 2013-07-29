<?php

$plugin = array ( "dir" => $current_plugin , "command" => "font", "filename" => "font.php", "type" => "render" ) ;
array_push ($plugins, $plugin);


$adminpage = array ( "dir"      => $current_plugin ,
                     "category" => "render"       ,
                     "name"     => "fonts",
                     "item"     => "list" ,
                     "filename" => "admin.php"     ,
                     "function" => "fonts_AdminGetFonts",
                     "hidden"   => false);

array_push($adminpages, $adminpage);




$adminpage = array ( "dir"      => $current_plugin ,
                     "category" => "render"       ,
                     "name"     => "fonts",
                     "item"     => "google" ,
                     "filename" => "admin.php"     ,
                     "function" => "fonts_AdminGetGoogleFonts",
                     "hidden"   => false);

array_push($adminpages, $adminpage);

$module_fonts_directory=$current_plugin;

$css = array ( "dir" => $current_plugin , "name"=> "fontadmin" ,"filename" => "fontadmin.css") ;
array_push($csss,$css);

?>
