<?php

  if (isset($_SESSION['userid'])) {
    $adminbar = "<div id='adminbar'>BlaatCMS " . BSCMS_VERSION. "</div>";
    $xmlroot->addChild("htmlPreContent",$adminbar);
  }
?>
