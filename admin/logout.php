<?php
session_start(); // ci asssicura che il server usa 
//le sessioni altrimenti non si può fare il controllo su log
include("dbclass.php"); //connette il database

unset($_SESSION['logged']); // toglie il collegamento
header('Location: ../index.php');
?>