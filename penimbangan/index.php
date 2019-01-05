<!DOCTYPE html>
 <!-- <meta http-equiv="refresh" content="3;url=http://localhost/penimbangan/index.php"/> -->
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Login Form</title>
  <link rel="stylesheet" href="css-login/style.css">
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
<div class="wrapper">
  <div class="container">
    <?php 
      if(isset($_GET['message'])){
        if($_GET['message'] == "failed"){
          echo '<div class="box-info-error">';
          echo "Login gagal! username dan password salah!";
          echo '</div>';
        }else if($_GET['message'] == "logout"){
          echo '<div class="box-info">';
          echo "Anda telah berhasil logout";
          echo '</div>';
        }else if($_GET['message'] == "not_logged_in"){
          echo '<div class="box-info-error">';
          echo "Anda Belum Login!";
          echo '</div>';
        }
      }
    ?>
      <h1>Welcome</h1>
      <form class="form" name="a" method="POST" action="process.php">
        <p><input type="text" name="username" value="" placeholder="Username"></p>
        <p><input type="password" name="password" value="" placeholder="Password"></p>
        <p class="submit"><input type="submit" name="masuk" value="Login"></p>
      </form>

  <div class="login-help">
    <p>&nbsp;</p>
  </div>
  <ul class="bg-bubbles">
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
    <li></li>
  </ul>
</div>
</div>
</body>
</html>
