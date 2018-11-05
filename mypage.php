<?php
/**
 * Created by PhpStorm.
 * User: Sovochka
 * Date: 02.11.2018
 * Time: 12:57
 */
require_once("requiredfiles.php");
if (isset($_GET['exit']))
{
    session_destroy();
    header("Location:index.php");

}
if(!isset($_SESSION["USER_ID"])){
    header("Location:index.php");
}
require_once("mypageview.php");
?>