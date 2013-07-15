<?php


$plugin = array ( "dir" => $current_plugin , "content" => "",  "filename" => "content.php", "function" => "page_GetContentPage" ) ;
array_push ($plugins, $plugin);


$adminpage = array ( "dir"      => $current_plugin , 
                     "category" => "content"       ,
                     "name"     => "page"     , 
                     "item"     => "allpages" , 
                     "filename" => "admin.php"     ,
                     "function" => "page_AdminGetAllPages");

array_push($adminpages, $adminpage);

$adminpage = array ( "dir"      => $current_plugin ,
                     "category" => "content"       , 
                     "name"     => "page"     , 
                     "item"     => "addpage"  , 
                     "filename" => "admin.php"     ,
                     "function" => "page_AdminAddPage");

array_push($adminpages, $adminpage);

?>
