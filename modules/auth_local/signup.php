<?php
ssl_force();
die("NOT IMPLEMENTED");

  require_once("3rdparty/pbkdf2/pbkdf2.php");
$signupform = "<form method='post'>
<table>
<tr><td>Username</td><td><input name='name'></td></tr>
<tr><td>Password</td><td><input type='password' name='password'></td></tr>
</table>
<input type='submit' name='signup'>
</form>";

echo $signupform;


  $available = true;
  if ($_POST['signup']) {


//  foreach ($plugins as $plugin) {
//    if ($_POST['name'] == $plugin['command']) $available = false;
//  }


    try {
      $prepquery = $pdo->prepare("select userid from auth_local where username = :username");
      $prepquery->execute(array(":username" => $_POST['name']));

      $result = $prepquery->fetchAll();
      if (!(empty($result))) $available = false;

    } catch (PDOException $e) {
      print $e->getMessage ();
    }

    
    if (!available) {
      //username taken
    } else {
      try { 
        $query = "INSERT INTO user (`id`) VALUES (NULL)";
  
        $pdo->query($query);
        $userid = $pdo->lastInsertId();
        //echo "User ID: $userid <br>";
      } catch (PDOException $e) {
        print $e->getMessage ();
      }  

      try {
        $hash= create_hash($_POST['password']);
        $prepquery = $pdo->prepare("insert into auth_local (userid,username,pwhash) values (:userid,:username,:pwhash)");
        $prepquery->execute(array(   ":userid"   => $userid,
                                     ":username" => $_POST['name'],
                                     ":pwhash"   => $hash));
                                     
      } catch (PDOException $e) {
        print $e->getMessage ();
      }  
    }
  }
?>
