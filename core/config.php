<?php session_start();
//config
$dbHost='localhost';
$dbUser='root';
$dbPass='root';
$dbName='devana';
$dbPcon=1;
$title='Project - Devana V0.01a';
$shortTitle='devana';
$location='http://localhost/devana/';
//misc vars
$benchmark=true;
$tracker='';
$ads='<div class="ad">广告位</div>';
if (!isset($_SESSION[$shortTitle.'User']['id']))
{
 $_SESSION[$shortTitle.'User']['template']='default';
 $_SESSION[$shortTitle.'User']['locale']='zh';
}
else if ($_SESSION[$shortTitle.'User']['level']>2) $tracker=$ads='';
include 'locales/'.$_SESSION[$shortTitle.'User']['locale'].'/ui.php';
ob_start();
?>
