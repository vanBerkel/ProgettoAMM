<?php
session_start();//apre la sessione
date_default_timezone_set("Europe/Rome");
if ($_SERVER['HTTP_HOST']!="localhost"){
    include("dbclass.php");
}
else{
    include("dbclass_1.php");    
}
include("controller/functions.php");
include("controller/generalControl.php");
include("view/master.php");



