   <!DOCTYPE html>
    <!-- 

    -->
<html>
<head>
    
    <link rel="stylesheet" href="css/style.css"  type="text/css" media="all" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />           
    <meta name="keywords" content="Annis Pier Paolo" />
    <meta name="description" content="Una pagina per gestire le funzioni di un vivaio" />

  <!-- far in modo tale da cambiare il titolodella pagina<title><?= $vd->getTitolo() ?></title>  -->
    <title>Vivaio</title> 
</head>
<body>
<div id="container">
<?php 

//require '$nav';
if (isset($_SESSION['logged'])){
    include("cliente/header.php");
    include("cliente/nav.php"); //abbiamo incluso il file nav.php 
}
else {
    include("header.php");
    include("login/nav.php");
}

include("main.php");
include("aside.php");

?>
<div id="sub">
</div>
</div>


</body>
</html>