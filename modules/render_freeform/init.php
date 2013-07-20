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

$module_render_freeform_directory=$current_plugin;

$css = array ( "dir" => $current_plugin , "name"=> "freeform" ,"filename" => "css.php") ;
array_push($csss,$css);

?>
