<?php

  require_once '3rdparty/htmlpurifier/library/HTMLPurifier.auto.php';


function page_AdminGetAllPages(){
  global $xmlroot;
  $xmlroot->addChild("htmlAdminContent", "AllPages");
}

  function page_SavePage($contentId,$content,$raw) {
    global $pdo;
    if (!$raw) {
      $dirty_html=$content;
      $config = HTMLPurifier_Config::createDefault();
      $purifier = new HTMLPurifier($config);
      $clean_html = $purifier->purify($dirty_html);
    }
    $nextRevision = " SELECT MAX(NextRevision) AS NextRevision 
                      FROM (
                          (SELECT 1 AS NextRevision)  
                       UNION 
                          (SELECT 1+
                              (SELECT MAX(revision) 
                               FROM content_page 
                               WHERE contentid=:contentid))  
                           ) NextRevision";

    try {
      $pq = $pdo->prepare("INSERT INTO content_page (contentid, content, revision) VALUES (:contentid, :content, ($nextRevision) )");
      $pq->execute(array(":contentid" => $contentId, ":content" => $content));
    } catch (PDOException $e) {
      print $e->getMessage ();
    }
 
  }

  function page_AdminAddPage(){
    global $xmlroot;
    $xmlroot->addChild("htmlAdminContent", "AddPage");
    page_EditForm("Facny Long Title", "shorttitle", "<b>Hello</b>&nbsp;<i>World</i>","addpage");
 
    if (isset($_POST['addpage'])) {
      $contentId = content_NewContent($_POST['shortname'], $_POST['title'], $_SESSION['userid'], "page");
      if ($contentId) {
        page_SavePage($contentId, $_POST['text']);
        header("Location: /admin/content/page/edit/$contentId");
      } else {
        $xmlroot->addChild("htmlAdminContent", "ERROR!");
      } 
    }
  }


function page_AdminEditPage(){
  global $xmlroot;
  global $pdo;
  global $request;
  $contentId = $request[5];
  $pq = $pdo->prepare("select shortname, title, content from content join content_page on content.id=content_page.contentid where contentid=:contentid order by revision DESC limit 1");
  $pq->execute(array(":contentid"=>$contentId));
  $xmlroot->addChild("htmlAdminContent", "EditPage");
  $r = $pq->fetchAll();
  page_EditForm($r[0]['title'], $r[0]['shortname'], $r[0]['content'],"editpage");
  if (isset($_POST['editpage'])) {
     page_SavePage($contentId, $_POST['text']);
     header("Location: /admin/content/page/edit/$contentId");
     // TODO : update "content"
  }
}

function page_EditForm($title, $shortname, $content, $mode){
  global $xmlroot;
  $xmlroot->addChild("htmlAdminContent",
 "<script type='text/javascript' src='/3rdparty/tinymce/tinymce.min.js'></script>
      <script type='text/javascript'>
        tinymce.init({ selector: 'textarea',
         });
      </script>
      <div class='editform'>
        <form method='post'>
          <input name='title' value='$title'/>
          <input name='shortname' value='$shortname'/>
          <textarea name='text'>$content</textarea>
          <input type=submit name=$mode>
        </form>
      </div>");
}



?>
