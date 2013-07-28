<?php


function freeform_AdminGetAllThemes() {
  global $xmlroot;
  global $pdo;

  if (isset($_POST['addtheme'])) {
    $themeId = freeform_AdminAddTheme($_POST['name']);
    if ($themeId) {
       header("Location: /admin/render/freeform/edit/$themeId");
    } else {

      $xmlroot->addChild("htmlAdminContent","ERRORRRRRRRRR");

    }
  } else {
    $pq = $pdo->prepare("select * from render_freeform_themes");
    $pq->execute();
    $r = $pq->fetchAll();
    $xmlroot->addChild("htmlAdminContent","<table><tr><td>ID</td><td>Theme</td><td>Enabled</td><td></td></tr>");
    foreach ($r as $theme) {
      $enabled = $theme['enabled'] ? "yes" : "no";
      $xmlroot->addChild("htmlAdminContent","<tr><td>".$theme['id']."</td>".
                                          "<td>".$theme['name']."</td>".
                                          "<td>$enabled</td>".
                                          "<td><a href='/admin/render/freeform/edit/".$theme['id']."'>Edit</a></td></tr>");
    }
    $xmlroot->addChild("htmlAdminContent","</table>");
    $xmlroot->addChild("htmlAdminContent","<hr><form method='post'><table>".
      "<tr><td>Title</td><td><input name='name'></td><td><input type=submit name='addtheme' value='add theme'></td></td></table></form>");

    $xmlroot->addChild("htmlAdminContent","Freeform"); 
  }
}


function freeform_AdminEditTheme() {
  global $xmlroot;
  global $pdo;
  global $request;
  try {
    $themeId = $request[5];

    if (isset($_POST['addblock'])) {
      $pq = $pdo->prepare("insert into render_freeform_blocks (name,x,y,width,height,origin,type,class,themeid) values
                               (:name,:x,:y,:width,:height,:origin,:type,:class,:themeid)");
      $pq->execute(array(":name"=> $_POST['name'],
                         ":x"=> $_POST['x'],
                         ":y"=> $_POST['y'],
                         ":width"=> $_POST['width'],
                         ":height"=> $_POST['height'],
                         ":origin"=> $_POST['origin'],
                         ":type"=> $_POST['type'],
                         ":class"=> $_POST['class'],
                         ":themeid"=>$themeId ));
    }



    $pq = $pdo->prepare("select * from render_freeform_blocks where themeid = :themeid");
    $pq->execute(array(":themeid" => $themeId));
    $r = $pq->fetchAll();
    $xmlroot->addChild("htmlAdminContent","<table class='freeformeditform'><tr><td>name</td><td>x</td><td>y</td><td>width</td><td>height</td><td>origin</td><td>type</td><td>class</td><td></td></tr>");
    foreach ($r as $block) {
      $delete = ($block['type'] != "main") ? "<input type='submit' value='Delete' name='deleteblock'>" : "" ;
      $xmlroot->addChild("htmlAdminContent",
        "<form method='post'><tr><td><input  name=blockid type=hidden value='" . $block['id'] . "'>".
        "<input name='name' value='"  . $block['name'] ."'>" . 
        "</td><td><input name='x' value='" . $block['x']    . "'>" .
        "</td><td><input name='y' value='" . $block['y']    ."'>" .
        "</td><td><input name='width' value='" . $block['width']    ."'>" .
        "</td><td><input name='height' value='" . $block['height']    ."'>" .
        "</td><td><input name='origin' value='" . $block['origin']    ."'>" .
        "</td><td><input name='type' value='" . $block['type']    ."'>" .
        "</td><td><input name='class' value='" . $block['class']    ."'>" .
        "</td><td><input type='submit' name='editblock' value='Edit' /></td><td>$delete</td></tr>" );
    }


      $xmlroot->addChild("htmlAdminContent",
        "<tr><td colspan=10>Add new</td></tr>" . 
        "<Tr><td><form method='post'>".
        "<input name='name'>" .
        "</td><td><input name='x'>" .
        "</td><td><input name='y'>" .
        "</td><td><input name='width'>" .
        "</td><td><input name='height'>" .
        "</td><td><input name='origin'>" .
        "</td><td><input name='type'>" .
        "</td><td><input name='class'>" .
        "</td><td><input type='submit' name='addblock' value='Add' /></td></tr>" );


    $xmlroot->addChild("htmlAdminContent","</table>");

  } catch (PDOException $e) {
    global $xmlroot;
    $error = $e->getMessage ();
    $xmlroot->addChild("htmlAdminContent", "<div class='error'>DB ERROR: $error</div>");
  }


 $xmlroot->addChild("htmlAdminContent","freeform_AdminEditTheme() ");
 $xmlroot->addChild("htmlAdminContent","Freeform");

}



function freeform_AdminAddTheme($name){
  try{
    global $pdo;
    global $xmlroot;
    $pq = $pdo->prepare("insert into render_freeform_themes (name) values (:name)");
    $pq->execute(array( ":name"=> $name));
    $themeId =  $pdo->lastInsertId();
    $pq = $pdo->prepare('insert into render_freeform_blocks (type, name, themeid) values ("main", "main" , :themeid)');
    $pq->execute(array( ":themeid"=> $themeId));
    return $themeId;
  } catch (PDOException $e) {
    global $xmlroot;
    $error = $e->getMessage ();
    $xmlroot->addChild("htmlAdminContent", "<div class='error'>DB ERROR: $error</div>");
    return 0;
  }
}




?>
