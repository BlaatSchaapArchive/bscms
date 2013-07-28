<?php


  function content_RegisterContent($content) {
    global $plugins;
    global $module_content_directory;
    $addContent = array ( "dir" => $module_content_directory , "command" => "$content", "filename" => "content.php", "type" => "content" ) ;
    array_push ($plugins, $addContent);
  }

  function content_NewContent($shortname, $title, $authorid, $type){
    try{
      global $pdo;
      $prepquery = $pdo->prepare("insert into content (shortname,title,authorid,type) values (:shortname,:title,:authorid,:type)");
      $prepquery->execute(array( ":shortname"=> $shortname,
                               ":title"    => $title,        
                               ":authorid" => $authorid,
                               ":type"     => $type));
      return $pdo->lastInsertId();
      
    } catch (PDOException $e) {
      global $xmlroot;
      $error = $e->getMessage ();
      $xmlroot->addChild("htmlAdminContent", "<div class='error'>DB ERROR: $error</div>");

      //print $e->getMessage ();
      return 0;
    }
  }

  $pq = $pdo->prepare("select shortname from content");
  $pq->execute();
  $r = $pq->fetchAll();
  
  foreach ($r as $content) {

    content_RegisterContent($content['shortname']);
  }


?>
