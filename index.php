<?php
session_start();// ci asssicura che il server usa 

?>
<html>
<head>
    <link rel="stylesheet" href="css/style.css"  type="text/css" media="all" />
    <title>Vivaio</title> 
</head>

<body>
<div id="container">


<div id="header">

<h1>Vivaio </h1>
<?php

//le sessioni altrimenti non si pu� fare il controllo su log
if (isset($_SESSION['logged']) AND $_SESSION['logged']==1) { //� meglio fare 
//un if che ogni volta una query in ogni  pagina
//variabile settata correttamente
echo "<label> Ciao, " . $_SESSION['cliente'] . "</label>";



?>


<?php
}
?>

<h2>di Annis van Berkel </h2>
</div>


<?php

include("admin/dbclass.php");
include("admin/functions.php");
?>




<div id="nav">

<?php include("admin/nav.php"); //abbiamo incluso il file nav.php 

//pulsante per disconnetersi 
if (isset($_SESSION['logged']) AND $_SESSION['logged']==1) {
?>

<?php
} //chiusura if di Collegamento

if(isset($_POST['job']) and $_POST['job'] == 'Home'){ //se � settata la variabile $_POST (se ho cliccato su uno dei due pulsanti), se ha valoree Inserisci e hoo cliccato sul tasto inserisci invoca la funzione inserisci
  FormHome();
}



if(isset($_POST['job']) and $_POST['job'] == 'Visualizza Catalogo'){

  
  FormVisualizza($val);
}




if(isset($_POST['job']) and $_POST['job'] == 'Modifica'){
  formModifica($_POST['ID']);
}

if(isset($_POST['job']) and $_POST['job'] == 'Salva'){
  salvaPost();
}
if (isset($_POST['job']) and $_POST['job'] == 'Cancella'){
  deletePost($_POST['ID']);
}  

if (isset($_POST['job']) and $_POST['job'] == 'Inserisci in archivio'){
  InserisciPost();
}  


?>

</div>


<div id="main">




<?php if(isset($_GET['job']) and $_GET['job'] == 'Conferma'){ 
//se � settata la variabile $_POST (se ho cliccato su uno dei due pulsanti), 
//se ha valoree Inserisci e hoo cliccato sul tasto inserisci invoca la funzione inserisci
	$val = $_GET['specie'];
	
	formSpecie ($val);

}
?>


<?php if(isset($_GET['job']) and $_GET['job'] == 'ConfermaAttivita'){ 
//se � settata la variabile $_POST (se ho cliccato su uno dei due pulsanti), 
//se ha valoree Inserisci e hoo cliccato sul tasto inserisci invoca la funzione inserisci
	$val = $_GET['attivita'];
	
	formAttivita ($val);

}
?>

<?php if(isset($_POST['job']) and $_POST['job'] == 'Visualizza'){ 
//se � settata la variabile $_POST (se ho cliccato su uno dei due pulsanti), 
//se ha valoree Inserisci e hoo cliccato sul tasto inserisci invoca la funzione inserisci
	$val = $_POST['IDPianta'];
	
	FormVisualizza ($val);

}
?>


</div>






<div id="aside">	
<form method="get" action="index.php">
<fieldset>
	<label> Cerca Pianta per Specie</label><br>
	<select name="specie">
	<option value="null"> -- Scegli La Specie -- </option>
	<?php 
	global $db;
	$q = "SELECT * FROM specie"; // estrae tuttii dati dalla tabella post � la tabella
  $res = $db->query($q); //invochiamo  il meotdo query su db
    while($row = mysql_fetch_array($res)){ //ciclo per estrarre i dati
    ?>
      <option value="<?php echo $row['IdSpecie']; ?>"><?php echo $row['Nome'];?></option>
	  <?php
  }

?>

</select>
	<input type="submit" name="job" value="Conferma"/>
</fieldset>
	</form>
	
<form method="get" action="index.php">
<fieldset>
	<label> Cerca Attivita</label><br>
	<select name="attivita">
	<option value="null"> -- Scegli Attivita -- </option>
	<?php 
	global $db;
	$q = "SELECT * FROM Attivita "; // estrae tuttii dati dalla tabella post � la tabella
  $res = $db->query($q); //invochiamo  il meotdo query su db
    while($row = mysql_fetch_array($res)){ //ciclo per estrarre i dati
    ?>
      <option value="<?php echo $row['Codice']; ?>"><?php echo $row['Nome'];?></option>
	  <?php
  }

?>

</select>
	<input type="submit" name="job" value="ConfermaAttivita"/>
</fieldset>
	</form>
	






	
</div>



<div id="sub">
</div>
</div>


</body>
</html>