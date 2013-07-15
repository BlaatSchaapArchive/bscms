<?php


function page_AdminGetAllPages(){

}

function page_AdminAddPage(){

}

function page_AdminEditPage(){

}

function page_EditForm($CurrentContent){
  return "<script type='text/javascript' src='/3rdparty/tinymce/tinymce.min.js'></script>
      <script type='text/javascript'>
        tinymce.init({ selector: 'textarea'  });
      </script>
      <form method='post'>
        <textarea name=text>$CurrentContent</textarea>
        <input type=submit>
      </form>";
}

?>
