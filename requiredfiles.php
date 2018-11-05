<?php
session_start();
require_once("DataBase.php");
$db = DataBase::getDB("localhost", "root", "", "my_db");
?>