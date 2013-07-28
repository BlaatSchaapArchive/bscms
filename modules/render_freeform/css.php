<?php

  function freeform_GenerateCssBlock($id,$left,$top,$width,$height){

    return "#$id {
  position : absolute;
  display  : block;
  left     : ".$left."px;
  top      : ".$top."px;
  width    : ".$width."px;
  height   : ".$height."px;
}
";

  }



echo freeform_GenerateCssBlock("title",25,25,250,25);
echo freeform_GenerateCssBlock("content",75,75,500,500);

?>

.freeformeditform * input {
 width : 90%;
}
