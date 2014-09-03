<?php

//visualizza il la specie selezionato
function FormSpecie($val){

global $db; //all'esterno delle funzioni non vidibile all'esterno e ilcontrario, quindi con global è visibile anche all'interno e all'esterno delle funzioni, altrimenti non è visibile db nelle funzioni


$q = "SELECT * FROM specie where idSpecie = '$val'";
$res = $db->query($q);
$row = mysql_fetch_array($res); 
//si dovrebbe inserire un indice per recuperare il punto di vendita
echo "<div class='Specie'><h1>" . $row['Nome'] . "</h1> <p>". $row['Descrizione'] ."Di solito sono piante che vengono poste all'" . $row['InternoEsterno'] ." degli edifici</p>

<label> Elenco delle piante </label>";
echo "<fieldset>";
//fa visualizzare tutte le piante
$q1 = "SELECT * FROM pianta where IdSpecieFK = '$val'";
$res1 = $db->query($q1);
while($row1 = mysql_fetch_array($res1)){ //ciclo per estrarre i dati
  ?>
  
    <?php//apertura riga ?>
     
	   <div class=dettagli>
	   <?php echo "<h3>" . $row1['Nome'] . "</h3>"; ?><?php//campo titolo?>
	   
		Prezzo
       <?php echo $row1['Prezzo']; ?> <?php//campo dato?>
	   
	   <img src="images/<?php echo $row1['Immagine']; ?>"/><?php//campo dato?>
	   <?php if($row1['Disponibilita']=='0') {
		ECHO "<br> NON DISPONIBILE";
		}    
	   else
	   {
	   ?>
	   
	   <br> Disponibilità
	   
	   <?php echo $row1['Disponibilita']; ?> <?php//campo dato?>
	   <?php }
	   ?>
	   
       <form method="post" action="index.php">
			<input type="submit" name="job" value="Visualizza" /><br>
			
			 <?php if(! $row1['Disponibilita']==0) { ?>
			<input type="submit" name="job" value="Acquista" />
			<?php }
			
			//considera un unico id ?>
			<input type="hidden" name="IDPianta" value="<?php echo $row1['IdPianta']; ?>" /> 
			<?php //mi spedisce questo quando clicco su un pulsante modifica 
			//o cancella cioè l'ID dell'atricolo ?>
		</form> 

   

   </div>
  
  <?php
}
?>
</fieldset>
</div>
<?php

}


function FormAttivita($val){

global $db; //all'esterno delle funzioni non vidibile all'esterno e ilcontrario, quindi con global è visibile anche all'interno e all'esterno delle funzioni, altrimenti non è visibile db nelle funzioni


$q = "SELECT * FROM attivita where Codice = '$val'";
$res = $db->query($q);
$row = mysql_fetch_array($res); 
//si dovrebbe inserire un indice per recuperare il punto di vendita
echo "<h1>" . $row['Nome'] . "</h1> <h2> €/h =  " . $row['CostoOrario'] ."</h2>";
?>

       <form method="post" action="index.php">
		
			<input type="submit" name="job" value="Richiedi" />

			<?php //considera un unico id ?>
			<input type="hidden" name="ID" value="<?php echo $row['Codice']; ?>" /> 
			<?php //mi spedisce questo quando clicco su un pulsante modifica 
			//o cancella cioè l'ID dell'atricolo ?>
		</form> 

   </li> 

  <?php


}

//richiesta di un'attivita
function FormRichiedi ($cliente,$val){
global $db; //all'esterno delle funzioni non vidibile all'esterno e ilcontrario, quindi con global è visibile anche all'interno e all'esterno delle funzioni, altrimenti non è visibile db nelle funzioni

//inserimento di una nuova riga nella tabella attivita_cliente
$q="INSERT INTO attivita_cliente (IdAttivitaFK,IdClienteFK, DataPrenotazione) VALUES ($val, $cliente, 10/01/2012) ";
$res = $db->query($q);

echo "<br><label> La tua richiesta è stata presa in considerazione </label>"; 


}

















function FormHome(){
//riportare alla prima pagina



}

//aggiunge al carrello un nuovo articolo
function FormCarrello($prod){
global $db; //all'esterno delle funzioni non vidibile all'esterno e ilcontrario, quindi con global è visibile anche all'interno e all'esterno delle funzioni, altrimenti non è visibile db nelle funzioni



$q= "UPDATE pianta SET Disponibilita = Disponibilita-1 where IdPianta = $prod";
$res = $db->query($q);

	?>

<br>
	<label> hai acquistato </label>	
		
<?php		
}

//aggiorna il carrello di volta in volta
function FormAggiornamento ($ordine){
global $db; //all'esterno delle funzioni non vidibile all'esterno e ilcontrario, quindi con global è visibile anche all'interno e all'esterno delle funzioni, altrimenti non è visibile db nelle funzioni
$q = "SELECT * FROM prodotto_ordine
WHERE id_OrdineFK = '$ordine'";
$res = $db->query($q);

if(mysql_num_rows($res) == 0){ //nessun articolo nel carrello
echo "<p> il carrello è vuoto </p>";
}

else{
echo "<table rules=all><tr><th> Nome Articolo </th> <th> Prezzo</th> <th> </th></tr>";
while($row = mysql_fetch_array($res)){
//far visualizzare tutti gli articoli presenti nel carrello
//controlla il prodotto che è nel carrello
$prod1 = $row['IdProdottoFK'];
$q1 = "SELECT * FROM prodotto
WHERE id_Prodotto = '$prod1'";
$res1 = $db->query($q1);
$row1 = mysql_fetch_array($res1);

//Controlla il nome del prodotto
$prod1 = $row1 ['id_nome_prodottoFK'];
$q1 = "SELECT * FROM nome_prodotto
WHERE id_Nome_Prodotto = '$prod1'";
$res1 = $db->query($q1);
$row1 = mysql_fetch_array($res1);
//stampa il nome
echo "<tr><td>" . $row1['Titolo'] . "</td>
<td>" . $row1['Prezzo'] ."</td><td>"
?>
<form method='post' action='index.php'>
	<input type='submit' name='job' value='Rimuovi' />
	<input type="hidden" name="ID" value="<?php echo $row['id_Prod_ordine']; ?>" /> 
</form>

</td>
</tr>
<?php
}
?>
</table>
<form action=".php" method="post" align="center">


<input  type="submit" name="job" value="???VAI ALLA CASSA!!" />
	
</form>
<?php	
}
}

//rimuove l'articolo che si vuole togliere
Function FormRimuovi ($id){
global $db;
$q = "DELETE FROM prodotto_ordine
WHERE id_Prod_ordine = '$id'";
$res = $db->query($q);







}


//aggiunge un cliente
function FormRegistrati(){
global $db;
//stripslashes() toglie gli slash
$username = addslashes($_POST['username']);
$passw = addslashes($_POST['password']);
$telefono = addslashes($_POST['telefono']);


//Controlla se è già esistente



$q = "SELECT * FROM cliente
WHERE Username = '$username'";
$res = $db->query($q);
$row = mysql_fetch_array($res);

if(mysql_num_rows($res) == 1) {
 echo "nome utente già presente";
 }
else{
	//inserisce il nuovo utente nell'archivio
   $q= "INSERT INTO `cliente`(`Username`, `Password`,`telefono`) 
		VALUES ('$username','$passw','$telefono')";
	$res = $db->query($q);
	$_SESSION['logged'] = 1; //è stata trovato username e password corrispondenti

	header('Location: ../index.php');
 }

}





















//visualizza una pianta
function FormVisualizza($val){
global $db; //all'esterno delle funzioni non vidibile all'esterno e ilcontrario, quindi con global è visibile anche all'interno e all'esterno delle funzioni, altrimenti non è visibile db nelle funzioni
 
$q = "SELECT * FROM pianta where IdPianta = '$val'";
$res = $db->query($q);
$row = mysql_fetch_array($res);
  ?>
   
       <h1><?php echo $row['Nome']; ?></h1> <?php//campo dato?>
     
		<div class="dettagli">
		<p>
			<img src="images/<?php echo $row['Immagine']; ?>" style="width:200px;"/> <?php//campo dato?>
			<?php echo $row['Descrizione']; ?></p> <?php//campo dato?> </p>
			
			
				<dt> Esemplari disponibili: <?php echo $row['Disponibilita']; ?> </dt>
				
				<dt> Prezzo: <?php echo $row['Prezzo']; ?> € </dt>
			<form method="post" action="index.php">
			
			
			
			 <?php if(! $row['Disponibilita']==0) { ?>
			<input type="submit" name="job" value="Acquista" />
			<?php }
			
			//considera un unico id ?>
			<input type="hidden" name="IDPianta" value="<?php echo $row['IdPianta']; ?>" /> 
			<?php //mi spedisce questo quando clicco su un pulsante modifica 
			//o cancella cioè l'ID dell'atricolo ?>
		</form> 
			
		</div>
	
<?php
}









// visualizza il form per l'inserimento dei dati
function formInserisci(){
?>
<form action="index.php" method="post">

<label>Titolo</label>
<input type="text" name="post_title"/>
<label>Data</label>
<input type="text" name="post_date" />
<br>
<label>Contenuto</label><br>
<textarea name="post_content" rows="20" cols="80"></textarea><br>



<input type="submit" name="job" value="Inserisci in archivio" />
</form>
<?php


}

function Visualizza(){
global $db; //all'esterno delle funzioni non vidibile all'esterno e ilcontrario, quindi con global è visibile anche all'interno e all'esterno delle funzioni, altrimenti non è visibile db nelle funzioni
  $q = "SELECT * FROM posts"; // estrae tuttii dati dalla tabella post è la tabella
  $res = $db->query($q); //invochiamo  il meotdo query su db
  
echo "<table>";
 
  while($row = mysql_fetch_array($res)){ //ciclo per estrarre i dati
  
  
  ?>
  
   <tr> <?php//apertura riga ?>
       <td><?php echo $row['post_title']; ?></td> <?php//campo titolo?>
       <td><?php echo $row['post_date']; ?></td> <?php//campo dato?>
       <td> <form method="post" action="index.php">
			<input type="submit" name="job" value="Modifica" /><br>
			<input type="submit" name="job" value="Cancella" />

			<?php //considera un unico id ?>
			<input type="hidden" name="ID" value="<?php echo $row['ID']; ?>" /> 
			<?php //mi spedisce questo quando clicco su un pulsante modifica 
			//o cancella cioè l'ID dell'atricolo ?>
		</form> </td>

   </tr> 

  <?php
}
?>
</table>
<?php
}


function formModifica($ID){
global $db;

     $q = "SELECT * FROM posts WHERE ID = '$ID'"; //seleziona dalla tabella l'ID che
//	 gli sto passando
	 
	 $res = $db->query($q);
	 
	 while($row = mysql_fetch_array($res)){
	 ?>
	 <form action="index.php" method="post">

<label>Titolo</label>
<input type="text" name="post_title" value="<?php echo $row['post_title']; ?>" />
<label>Data</label>
<input type="text" name="post_date" value="<?php echo $row['post_date']; ?>" />


<br>
<label>Contenuto</label><br>
<textarea name="post_content" rows="20" cols="100"><?php echo $row['post_content']; ?> </textarea>

<input type="hidden" name="ID" value="<?php echo $row['ID']; ?>" />
<br>
<input type="submit" name="job" value="Salva" />
</form>

<?php
}
}

function salvaPost(){
global $db;
//stripslashes() toglie gli slash
$contenuto = addslashes($_POST['post_content']);
$q= " 
UPDATE posts SET
post_title = '$_POST[post_title]', 
post_content = '$contenuto',
post_date = '$_POST[post_date]'
WHERE
ID = $_POST[ID]
";
if ($db->query($q)) {
//query andata a buon fine
Visualizza();
}

else {
//query non andata a buon fine
echo "Query non eseguita";

}
}

function deletePost($ID){
global $db;
$q = "DELETE FROM posts WHERE ID = '$ID'";
$res = $db->query($q);


}








//aggiunge una riga alla tabella post
function InserisciPost() {
global $db;
//stripslashes() toglie gli slash
$contenuto = addslashes($_POST['post_content']);
$q= "INSERT INTO `posts`(`post_date`, `post_content`, 
`post_title`) 
VALUES ('$_POST[post_date]','$contenuto','$_POST[post_title]')
";

$res = $db->query($q);
Visualizza();
}
?> 