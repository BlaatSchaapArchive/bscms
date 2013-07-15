<?php


$plugin = array ( "dir" => $current_plugin , "content" => "",  "filename" => "content.php", "function" => "page_GetContentPage" ) ;
array_push ($plugins, $plugin);


$adminpage = array ( "dir"      => $current_plugin , 
                     "category" => "content"       ,
                     "name"     => "page"     , 
                     "item"     => "list" , 
                     "filename" => "admin.php"     ,
                     "function" => "page_AdminGetAllPages");

array_push($adminpages, $adminpage);

$adminpage = array ( "dir"      => $current_plugin ,
                     "category" => "content"       , 
                     "name"     => "page"     , 
                     "item"     => "add"  , 
                     "filename" => "admin.php"     ,
                     "function" => "page_AdminAddPage");

array_push($adminpages, $adminpage);


$adminpage = array ( "dir"      => $current_plugin ,
                     "category" => "content"       ,
                     "name"     => "page"     ,
                     "item"     => "edit"  ,
                     "filename" => "admin.php"     ,
                     "function" => "page_AdminEditPage",
                     "hidden"   => true              );

array_push($adminpages, $adminpage);

?>
