<!DOCTYPE html>
<html>
  <head>
    <?php
      foreach ($csss as $css) echo "<link href='/stylesheet/".$css['name']  ."' rel='stylesheet' type='text/css' />";
    ?>
    <meta charset="utf-8">
    <?php 
      echo "<title>$title</title>";
      foreach ($htmlheaders as $htmlheader) echo $htmlheader;
    ?>
  </head>
  <body>
      <?php
      foreach ( $xmlroot->htmlPreContent as $htmlContent) {
        echo $htmlContent;
      }
      ?>

    <div id="content">
      <?php
      foreach ( $xmlroot->htmlContent as $htmlContent) {
        echo $htmlContent;
      }
      ?>
    </div>
  </body>
</html>
