<?php
require 'class/db_mysqli.class.php';
require 'class/misc.class.php';
require 'class/blacklist.class.php';
require 'class/activation.class.php';
require 'class/user.class.php';
require 'class/message.class.php';
require 'class/node.class.php';
require 'class/grid.class.php';
require 'class/alliance.class.php';

if ($benchmark) $startTime=misc::microTime();
$db=new db();
$db->create($dbHost, $dbUser, $dbPass, $dbName, $dbPcon);
?>