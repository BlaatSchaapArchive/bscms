<?php
  require_once '3rdparty/htmlpurifier/library/HTMLPurifier.auto.php';

  if ($_POST['text']) {
    $dirty_html=$_POST['text'];
    $config = HTMLPurifier_Config::createDefault();
    $purifier = new HTMLPurifier($config);
    $clean_html = $purifier->purify($dirty_html);";
  }

// TODO: mode to variable!!!
  $xmlroot->addChild("htmlContent",
     "<script type='text/javascript' src='/3rdparty/tinymce/tinymce.min.js'></script>
      <script type='text/javascript'>
        tinymce.init({ selector: 'textarea'  });
      </script>
      <form method='post'>
        <textarea name=text>$CurrentContent</textarea>
        <input type=submit>
      </form>");



  
}
?>
