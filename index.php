<?php
  session_start();  //start session
//  ob_start();       //start output buffering

  require_once("config/db.php");
  require_once("3rdparty/mobile_detection/detect.php");

  define ("BSCMS_VERSION", "0.0.1");
  //if (isset($_GET['command'])) $command = $_GET['command']; else $command = false;

  $request = explode ('/',$_SERVER['REQUEST_URI']);
  //echo "<pre>"; print_r($request); echo "</pre>"; 

  $command = $request[1];

  //------------------------------------------------------------------
  // Setting up XML Document
  //------------------------------------------------------------------

  $xmlroot = new SimpleXMLElement("<BlaatCMS></BlaatCMS>");
  $xmlroot->addChild("version","0.1");
  
 
  //------------------------------------------------------------------
  // Load Modules
  //------------------------------------------------------------------

  $plugins     = Array();
  $adminpages  = Array();
  $renderers   = Array();
  $csss        = Array();
  $htmlheaders = Array();

  array_push($htmlheaders, "<meta name='generator' content='BlaatCMS ".BSCMS_VERSION."' />");

  $dir = "./modules/";

  if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
      while (($file = readdir($dh)) !== false) {
           if (($file != "." or $file != "..") and is_dir($dir.$file)) {
             $current_plugin = $dir . $file . "/";
             if (file_exists($current_plugin. "init.php")) {
               include $current_plugin ."init.php";
             }
           }
         }
       closedir($dh);
       }
     }

  //------------------------------------------------------------------
  // Pre-Process
  //------------------------------------------------------------------

  foreach ($plugins as $plugin) {
    if (isset($plugin["pre"]))      {
      include $plugin['dir'].$plugin['filename'];
    }
  }

  //------------------------------------------------------------------
  // Process commands by plugins 
  //------------------------------------------------------------------
  $processed = false;
  foreach ($plugins as $plugin) {
    if (isset($plugin["command"]))      {
      if ($command == $plugin["command"])    {
        include $plugin['dir'].$plugin['filename'];
        if (isset($plugin["function"])) call_user_func($plugin["function"]);
        $processed = true;
        break;
      }
    }
  }


  if (!$processed) {
    $xmlroot->addChild("htmlContent","404 NOT FOUND");
    header("404 NOT FOUND");
  }
  
  //------------------------------------------------------------------
  // Render                     
  //------------------------------------------------------------------

  if (!(isset($render))) {
    //$render="freeform";
    $pq = $pdo->prepare("select value from options where name=:name");
    $pq->execute(array(":name" => "render_default"));
    $r = $pq->fetchAll();
    $render= $r[0]['value'];
  }
  
  if (!(isset($render))) {
    die ("Configuration Error: Renderer is not set!");
  }

  foreach ($renderers as $renderer) {
    if ($render == $renderer['name']) {
      include $renderer['dir'].$renderer['filename'];
      break;
    }
  }

?>

