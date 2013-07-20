<?php

//$css = array ( "dir" => $module_render_freeform_directory , "name"=> "freeform" ,"filename" => "css.php") ;
//array_push($csss,$css);

//  foreach ( $xmlroot->htmlContent as $htmlContent) {
//    echo $htmlContent;
//  }

if (isset($xmlroot->redirect)) {
  header("Location: ".$xmlroot->redirect);
}


include ("default/page.php");

?>
