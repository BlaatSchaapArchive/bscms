<?php

  function freeform_GenerateCssBlock_Old($id,$left,$top,$width,$height){

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

$_SESSION['freeform_themeid']=1; //temporary

$pq = $pdo->prepare("Select * from render_freeform_blocks where themeid=:themeid");  
$pq->execute(array(":themeid"=>$_SESSION['freeform_themeid']));
$r = $pq->fetchAll();

$css = "";

foreach ($r as $cssrule) {

  $css .= "#" . $cssrule['name'] . " { position : relative; /* absolute; */ display  : block; ";
  switch ($cssrule['origin']) {
    case "topleft":
      $css .= "left     : ".$cssrule['x']."px; ";
      $css .= "top      : ".$cssrule['y']."px; ";
      $css .= "width    : ".$cssrule['width']."px; ";
      $css .= "height   : ".$cssrule['height']."px; ";
      break;
    case "topright":
      $css .= "right    : ".$cssrule['x']."px; ";
      $css .= "top      : ".$cssrule['y']."px; ";
      $css .= "width    : ".$cssrule['width']."px; ";
      $css .= "height   : ".$cssrule['height']."px; ";
      break;
    case "bottomleft":
      $css .= "left     : ".$cssrule['x']."px; ";
      $css .= "bottom   : ".$cssrule['y']."px; ";
      $css .= "width    : ".$cssrule['width']."px; ";
      $css .= "height   : ".$cssrule['height']."px; ";
      break;
    case "bottomright":
      $css .= "right    : ".$cssrule['x']."px; ";
      $css .= "bottom   : ".$cssrule['y']."px; ";
      $css .= "width    : ".$cssrule['width']."px; ";
      $css .= "height   : ".$cssrule['height']."px; ";
      break;
   
  }
  $css .= "}  ";
}

//echo freeform_GenerateCssBlock("title",25,25,250,25);
//echo freeform_GenerateCssBlock("content",75,75,500,500);

echo $css;
?>

.freeformeditform * input {
 width : 90%;
}
