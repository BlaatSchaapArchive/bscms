<!DOCTYPE html>
<?php 
// note: should be converted to xslt or so, but for now....
// http://stackoverflow.com/questions/4531671/change-html-content-with-php-xpath-and-or-dom

$menu =  array();
$adminmenu = "";
foreach ($adminpages as $adminpage) {
  $menu[$adminpage['category']][$adminpage['name']][]= array ("item"=> $adminpage['item'],"filename"=> $adminpage['filename']);
}


function generate_menu_l2($l2,$l2name) {
  global $adminmenu;
  global $url1;
  $adminmenu .= "<div class='level2'><div class='level2title'>$l2name</div>";
  $url2 = $url1 . $l2name . "/"; 
  foreach ($l2 as $level3) {
      $item = $level3['item'];
      $url3 = $url2 . $item;
      $adminmenu .= "<div class='level3'><a href='$url3'>$item</a></div>";
    }
  $adminmenu .= "</div>";


}

function generate_menu_l1($l1,$l1name) {
  global $adminmenu;
  global $url1;
  $adminmenu .= "<div class='level1'><div class='level1title'>$l1name</div>";
  $url1 = "/admin/$l1name/"; 
  array_walk($l1, "generate_menu_l2");
  $adminmenu .= "</div>";
}

array_walk($menu, "generate_menu_l1");


?>
<html>
  <head>
    <meta charset="utf-8">
    <title>admin</title>
    <!-- <link href="admin.css" rel="stylesheet" type="text/css" /> -->
    <?php
      foreach ($csss as $css) echo "<link href='/stylesheet/".$css['name']  ."' rel='stylesheet' type='text/css' />";
    ?>
  </head>
  <body>
      <?php
      foreach ( $xmlroot->htmlPreContent as $htmlContent) {
        echo $htmlContent;
      }
      ?>

    <div id=content>
      <div id=adminmenu> 
        <?php echo $adminmenu; ?>
      </div>
      <div id=admincontent>
        <?php echo $admincontent; ?>
      </div>
    </div>
  </body>
</html>
