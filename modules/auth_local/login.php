<?php
  ssl_force();
  require_once("3rdparty/pbkdf2/pbkdf2.php");

  $loginform = "
  <div id='loginform'>
    <form method='post'>
      <table>
        <tr><td>Username</td><td><input name=name></td></tr>
        <tr><td>Password</td><td><input type=password name=password></td></tr>
        <tr><td></td><td><input type='submit' name='login'></td></tr>
      </table>
    </form>
  </div>";

  if (!(isset($_SESSION['userid']))) {
    $xmlroot->addChild("htmlContent",$loginform);

    if (isset($_POST['login'])) {
      try {  
        $prepquery = $pdo->prepare("select userid, pwhash from auth_local where username = :username");
        $prepquery->execute(array( ":username" => $_POST['name']));
        $result = $prepquery->fetchAll();
        $valid = validate_password($_POST['password'], $result[0]['pwhash']);
        if($valid) {
           $_SESSION['userid']=$result[0]['userid'];
          //echo "good<br>";
          $xmlroot->addChild("redirect","/admin");
          $xmlroot->addChild("htmlContent","<div class='notice'>Logged in successfully!</div>");
        } else {
          //echo "bad<br>";
          $xmlroot->addChild("htmlContent","<div class='error'>Username and/or password incorrect!</div>");
        }
      } catch (PDOException $e) {
        //print $e->getMessage ();
      }  
    }
  } else {
    $xmlroot->addChild("htmlContent","<div class='error'>Already logged in!</div>");
    $xmlroot->addChild("redirect","/admin");
  }
?>
