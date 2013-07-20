<?php

  require_once '3rdparty/htmlpurifier/library/HTMLPurifier.auto.php';


function page_AdminGetAllPages(){
  global $xmlroot;
  global $pdo;
  $pq = $pdo->prepare('select contentid,shortname,title, authorid, status,timestamp, max(revision) as revision, displayname
                       from content join content_page on content.id=content_page.contentid
                                    join user on user.id=content.authorid
                       where type="page"
                       group by contentid
');
  $pq->execute();
  $r = $pq->fetchAll();

  $xmlroot->addChild("htmlAdminContent", "<table>
<tr>
  <td>ID</td>
  <td>Shortname</rd>
  <td>Title</td>
  <td>Author</td>
  <td>Time</td>
  <td>Revision</td><td></td></tr>");

  foreach ($r as $page) {
    $xmlroot->addChild("htmlAdminContent",
"<tr>
   <td>".$page['contentid']."</td>
   <td>".$page['shortname']."</td>
   <td>".$page['title']."</td>
   <td>".$page['displayname']."</td>
   <td>".$page['timestamp']."</td>
   <td>".$page['revision']."</td>
   <td><a href='/admin/content/page/edit/".$page['contentid']."'>Edit</a></tr>");
  }
  $xmlroot->addChild("htmlAdminContent","</table>");
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
    page_EditForm("", "", "");
 
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
          <table><tr>
            <td>Title</td><td><input name='title' value='$title'/></td></tr>
            <td>Shortname</td><td><input name='shortname' value='$shortname'/></td></tr>
            <tr><td colspan=2><textarea name='text'>$content</textarea></td></tr>
            <tr><td></td><td><input type=submit value='Save' name=$mode></td></tr>
          </table>
        </form>
      </div>");
}



?>
