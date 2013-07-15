<?php
if (isset($_SESSION['userid'])) {
  $render="admin";

} else {
  $xmlroot->addChild("redirect","/login");
}
?>
