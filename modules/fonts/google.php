<?php

function fonts_GetGoogleFonts() {
  global $pdo;
  global $xmlroot;
  global $request;
  try {
    /*
    $pq = $pdo->prepare('select value from options where name="google_api_key"');
    $pq->execute();
    $r = $pq->fetchAll();
    $key = $r[0]['value'];
    */
    $key = get_option("googleapikey");
    if (strlen($key)) {
      $url = "https://www.googleapis.com/webfonts/v1/webfonts?key=$key";
      $data = GetDataFromURL($url);
      $data = str_replace("http://","https://",$data); //enforce https
      return json_decode($data,true);
    } else {
      $xmlroot->addChild("htmlAdminContent","<p>The Google API key is not set. Please visit <a href='https://code.google.com/apis/console/' target='_blank'>https://code.google.com/apis/console/</a> to obtain an API key.</p>");
    }
  } catch (PDOException $e) {
    $error = $e->getMessage ();
    $xmlroot->addChild("htmlAdminContent", "<div class='error'>DB ERROR: $error</div>");
  }
}
?>
