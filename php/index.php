<?php
session_start();//apre la sessione
if ($_SERVER['HTTP_HOST']!="localhost"){
    include("dbclass.php");

}
else{
include("dbclass_1.php");    
}
include("controller/functions.php");
include("controller/generalControl.php");
include("view/master.php");


