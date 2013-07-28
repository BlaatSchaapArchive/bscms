<?php
  function page_GetContentPage($contentId){
    global $pdo;
    global $xmlroot;
    

    $pq = $pdo->prepare("select shortname, title, content from content join content_page on content.id=content_page.contentid where contentid=:contentid order by revision DESC limit 1");

    $pq->execute(array(":contentid"=>$contentId));
    $r = $pq->fetchAll();

    $xmlroot->addChild("htmlContent", $r[0]['content']);
  }

?>
