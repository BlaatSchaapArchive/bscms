<?php

//  foreach ( $xmlroot->htmlContent as $htmlContent) {
//    echo $htmlContent;
//  }

if (isset($xmlroot->redirect)) {
  header("Location: ".$xmlroot->redirect);
}


include ("default/page.php");

?>
