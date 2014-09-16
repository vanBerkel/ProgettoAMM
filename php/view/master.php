   <!DOCTYPE html>
    <!-- 
pagina master, contiene tutto il layout della applicazione 
         le varie pagine vengono caricate a "pezzi" a seconda della zona
         del layout:
         - header (header)
         - nav (menu)
         - main (la parte centrale con il contenuto)
         - aside (sidebar destra)
         - footer (footer)
    -->
<html>
<head>
    
    <link rel="stylesheet" href="css/style.css"  type="text/css" media="all" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />           
    <meta name="keywords" content="Annis Pier Paolo" />
    <meta name="description" content="Una pagina per gestire le funzioni di un vivaio" />

    <title>il viale verde</title> 
</head>
<body>
<div id="container">
    <a href="html/html.html">help</a>
<?php 
    include("header.php");
    include("nav.php");
    include("main.php");
    include("aside.php");
?>
    <div id="foot"></div>
<div id="sub">
    
   
    Copyright © 2014 - Viale Verde. Tutti i diritti riservati. Webdesign Pier Paolo Annis  
    
    
    
</div>
 
</div>
   <div id="angolo">
        <img src="images/ricciolo_basso_SX.png">
    </div>

</body>
</html>