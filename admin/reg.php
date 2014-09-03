<?php
session_start(); 
include("dbclass.php");
include("functions.php");
?>
<html>
<head>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<title>pannello di controllo</title>
<body>
<div id="container">
<?php
$q = "SELECT * FROM cliente
WHERE Username = '$_POST[username]' AND Password ='$_POST[password]'";
$res = $db->query($q);



if(mysql_num_rows($res) == 1) {
$row = mysql_fetch_array($res);
$c = $row['IdCliente'];
$_SESSION['logged'] = 1; //è stata trovato username e password corrispondenti
$_SESSION['cliente'] = $_POST['username'];
$_SESSION['cod'] = $c;

header('Location: ../index.php');

}
else {
header('Location: ../index.php');
}


?>
</div>
</body>
</html>