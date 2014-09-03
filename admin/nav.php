<ul>
<li> <a href="index.php" class="menu">Home </a></li><?php // una vriabilenell'arreay associativo post si chima job con valore "inserisci"?>

<li><a class="menu"> Profilo </A> 
<ul> <li> 

<?php

//le sessioni altrimenti non si può fare il controllo su log
if (isset($_SESSION['logged']) AND $_SESSION['logged']==1) { //è meglio fare 
//un if che ogni volta una query in ogni  pagina
//variabile settata correttamente


?>
<form action="admin/logout.php" method="post" align="right">
<input  type="submit" name="job" value="Logout" />
	
</form>	

<?php if(isset($_POST['job']) and $_POST['job'] == 'Acquista'){ 
	
	formCarrello ($_POST['IDPianta']);

}

//controlla se si è rimosso qualche articolo
if(isset($_POST['job']) and $_POST['job'] == 'Rimuovi'){ 
	
	formRimuovi ($_POST['ID']);

}
//aggiorna il carrello

if(isset($_POST['job']) and $_POST['job'] == 'Richiedi'){ 
	
	formRichiedi ($_SESSION['cod'], $_POST['ID']);

}



}
else {
?>




<fieldset text="Collegati" >
<p> Collegati per accedere al servizio </p>
<form action="admin/reg.php" method="post">


     <label>Username</label>
	 <input type="text" name="username" />
	 <br>
	 <label>Password</label>
	 <input type="password" name="password"/>
	 <br>
	 <input type="submit" style="float:center" value="LOG IN" />

</form>
<form action="admin/registr.php">
<label>Sei un nuovo cliente? </label><input type="submit"  value="Registrati"/>
</form>
</fieldset>

	

	 
<?php

}





?>
</li>
</ul>
</ul>




