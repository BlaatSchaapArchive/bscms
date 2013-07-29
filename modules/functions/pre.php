<?php
function update_option($name, $value) {
  global $pdo;
  global $xmlroot;
  try {
    $pq = $pdo->prepare("Delete from options where name=:name");
    $pq->execute(array(":name"=>$name));
    $pq = $pdo->prepare("insert into options (name,value) values (:name,:value)");
    $pq->execute(array(":name"=>$name, ":value"=>$value));
  } catch (PDOException $e) {
    global $xmlroot;
    $error = $e->getMessage ();
    $xmlroot->addChild("htmlAdminContent", "<div class='error'>DB ERROR: $error</div>");
  }
}


function get_option($name) {
  global $pdo;
  global $xmlroot;
  try {

    $pq = $pdo->prepare('select value from options where name=:name');
    $pq->execute(array(":name"=>$name));
    $r = $pq->fetchAll();
    return $r[0]['value'];
  } catch (PDOException $e) {
    global $xmlroot;
    $error = $e->getMessage ();
    $xmlroot->addChild("htmlAdminContent", "<div class='error'>DB ERROR: $error</div>");
  }

}

function GetDataFromURL($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
}

function GetDataFromFile($filename){
        $fd = fopen($filename,"r");
        $data = fread($fd, filesize($filename));
        fclose($fd);
        return $data;
}


?>
