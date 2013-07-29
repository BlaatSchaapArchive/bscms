<?php

$renderer = array ( "dir" => $current_plugin , "filename" => "render.php",  "name" => "freeform") ;
array_push ($renderers, $renderer);


$adminpage = array ( "dir"      => $current_plugin , 
                     "category" => "render"       ,
                     "name"     => "freeform",
                     "item"     => "themes" , 
                     "filename" => "admin.php"     ,
                     "function" => "freeform_AdminGetAllThemes");

array_push($adminpages, $adminpage);

$adminpage = array ( "dir"      => $current_plugin ,
                     "category" => "render"       ,
                     "name"     => "freeform",
                     "item"     => "edit" ,
                     "filename" => "admin.php"     ,
                     "function" => "freeform_AdminEditTheme",
                     "hidden"   => true);

array_push($adminpages, $adminpage);

$adminpage = array ( "dir"      => $current_plugin ,
                     "category" => "render"       ,
                     "name"     => "freeform",
                     "item"     => "classes" ,
                     "filename" => "admin.php"     ,
                     "function" => "freeform_AdminGetClasses",
                     "hidden"   => true);

array_push($adminpages, $adminpage);
/*
$adminpage = array ( "dir"      => $current_plugin ,
                     "category" => "render"       ,
                     "name"     => "freeform",
                     "item"     => "fonts" ,
                     "filename" => "admin.php"     ,
                     "function" => "freeform_AdminGetFonts",
                     "hidden"   => false);

array_push($adminpages, $adminpage);
*/




$module_render_freeform_directory=$current_plugin;

$css = array ( "dir" => $current_plugin , "name"=> "freeform" ,"filename" => "css.php") ;
array_push($csss,$css);

?>
