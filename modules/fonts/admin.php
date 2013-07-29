<?php
function fonts_AdminGetFonts(){
  global $pdo;
  global $request;
  global $xmlroot;

  $pq= $pdo->prepare("select * from fonts");
  $pq->execute();
  $r = $pq->fetchAll();
  foreach ($r as $font) {
    $fontId = $font['id'];
    $type   = $font['type'];
    $family = $font['family'];
    $url = "/modules/fonts/data/$fontId.$type";
    $style = "@font-face { font-family : '$family'; src: url($url); }";
    $quote = "The quick brown fox jumps over the lazy dog.";
    $xmlroot->addChild("htmlAdminContent","<style>$style</style><div class='fontname'> $family </div>");
    $xmlroot->addChild("htmlAdminContent","<div style='font-size:24px; font-family: \"$family\"'>$quote</div>"); 
  }

}

function fonts_AdminGetGoogleFonts(){
  global $pdo;
  global $request;
  global $xmlroot;
  if (isset($_POST['googleapikey'])){
    update_option("googleapikey",$_POST['googleapikey']);
  }

  if (isset($request[5]) && $request[5]=="install") {
     $gfid = $request[6];
     $font = $_SESSION['googlefonts']['items'][$gfid];
     if (isset($font['files']['regular'])) {
       $url = $font['files']['regular'];
     } else if (isset($font['files']['400'])) { 
       $url = $font['files']['400'];
     } else {
        $url = $font['files'][0];
     }
   
     $pq = $pdo->prepare("select family from fonts");
     $pq->execute();
     $r = $pq->fetchAll();
     foreach ($r as $installedfont) {
       if ($font['family'] == $installedfont['family'] ) {
         $xmlroot->addChild("htmlAdminContent", "Error: a font named " . $font['family'] . " is already installed");
         return;
       }
     }
     if (isset($url)) {
       $type = explode(".",$url);

       $type = $type[count($type) -1 ]; 
       $pq = $pdo->prepare("insert into fonts (family, type) values (:family,:type)");
       $pq->execute(array(":family"=>$font['family'], ":type"=>$type));
       $fontId = $pdo->lastInsertId();
       $data = GetDataFromURL($url);
       $filename = realpath(dirname(__FILE__)) . "/data/$fontId.$type";
       $fd = fopen($filename,"w");
       if ($fd) {
         fwrite($fd, $data);
         fclose($fd); 
         $xmlroot->addChild("htmlAdminContent",$font['family'] . " installed.");
       } else {
         $xmlroot->addChild("htmlAdminContent", "Error saving $filename. Please check file permissions");
       }
     } else {
       $xmlroot->addChild("htmlAdminContent","url missing");
     }

    
  } else {
    require_once("google.php");
    if (!(isset($_SESSION['googlefonts']))) $_SESSION['googlefonts'] = fonts_GetGoogleFonts();

    $googlefonts = $_SESSION['googlefonts'];
    $googleapikey = get_option("googleapikey");
    $googleapikeyform = "<form method='post'><table><tr><td>Google API key</td>".
                  "<td><input name='googleapikey' value='$googleapikey'> </td>".
                  "<td><input type='submit' value='Save'></td>".
                  "</tr></table>";
    $xmlroot->addChild("htmlAdminContent",$googleapikeyform);

    if (isset($request[5]) && $request[5]=="page") {
      if (isset($request[6])) {
        $offset = ($request[6] -1 ) * 10;
      } else $offset = 0;
    } else $offset = 0;

    for ($i = 1 ; $i-1  < ceil (count($googlefonts['items'])/10) ; $i++) {
      $navigator .= "  <a href='/admin/render/fonts/google/page/$i'>$i</a>";
    }
    

    $xmlroot->addChild("htmlAdminContent",$navigator);
    for ($i = $offset; ( $i < ($offset + 10) ) && ($i < count($googlefonts['items'])) ; $i++) {
      $googlefont = $googlefonts['items'][$i];
      $family = $googlefont['family'];


       if (isset($googlefont['files']['regular'])) {
         $url = $googlefont['files']['regular'];
       } else if (isset($font['files']['400'])) {
         $url = $googlefont['files']['400'];
       } else {
          $url = $googlefont['files'][0];
       }

        $style = "@font-face { font-family : '$family'; src: url($url); }";
        $quote = "The quick brown fox jumps over the lazy dog.";
        $xmlroot->addChild("htmlAdminContent","<div class='fontpreview'>");
        $xmlroot->addChild("htmlAdminContent","<style>$style</style><div class='fontname'>$family</div>");
        $xmlroot->addChild("htmlAdminContent", " <a class='fontinstall' href='/admin/render/fonts/google/install/$i' class='font'>Install</a>");
        $xmlroot->addChild("htmlAdminContent","<div style='font-size:24px; font-family: \"$family\"'>$quote</div>");
        $xmlroot->addChild("htmlAdminContent","</div>");
    }
    $xmlroot->addChild("htmlAdminContent",$navigator);

  } 
}

?>
