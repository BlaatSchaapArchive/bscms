<?php

  $pq = $pdo->prepare("select id, type,title from content where shortname = :shortname");
  $pq->execute(array(":shortname"=>$request[1]));
  $r = $pq->fetchAll();
  $type = $r[0]['type'];
  $contentId = $r[0]['id'];

  $xmlroot->addChild("title", $r[0]['title']);
  $xmlroot->addChild("contentId", $contentId);
  $xmlroot->addChild("contentType", $type);
 
  foreach ($plugins as $plugin) {
    if ($type == $plugin['content']) {
      require_once($plugin['dir'].$plugin['filename']);
      call_user_func($plugin['function'],$contentId);
      break;
    }
  }

?>
