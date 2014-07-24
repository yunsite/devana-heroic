<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
  <?php echo '<link rel="stylesheet" type="text/css" href="templates/'.$_SESSION[$shortTitle.'User']['template'].'/default.css">'; ?>
  <title><?php echo $title.$ui['separator'].$ui['home']; ?></title>
  <?php echo $tracker; ?>
 </head>
 <body class="body">
<?php include 'templates/'.$_SESSION[$shortTitle.'User']['template'].'/header.php'; ?>
 <div class="container">
  <div class="content" style="max-width: 500px; text-align: left;">
  欢迎来到Project Devana。<br>
  这是一个网页端的策略游戏，由Satsuki Rin汉化，目前的资源层改造度为0。<br>
  目前的版本是Alpha 0.00，欢迎大家测试。<br>
  <br>
  以下原作者版权信息。
  <br>
Welcome to Devana 2 beta 1.<br><br>
Devana 2 is an open source browser strategy game developed from the ground up (without any third party code) using OOP (Object Oriented Programming) code written in the MVC (Model View Controller) paradigm.<br><br>
Visit the <a class="link" href="http://devana.eu/blog" target="_blank">devBlog</a> for more information.<br>
Stay updated via the Facebook <a class="link" href="https://www.facebook.com/DevanaGame" target="_blank">page</a>.<br>
Enjoy. :)
  </div>
 </div>
<?php include 'templates/'.$_SESSION[$shortTitle.'User']['template'].'/footer.php'; ?>
 </body>
</html>
