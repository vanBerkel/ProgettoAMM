<?php
include_once ("php/model/Pianta.php");
include_once ("php/model/Specie.php");

//visualizza una pianta
function FormVisualizza($val){
    global $db; //all'esterno delle funzioni non vidibile all'esterno e ilcontrario, quindi con global � visibile anche all'interno e all'esterno delle funzioni, altrimenti non � visibile db nelle funzioni
    $q = "SELECT * FROM pianta where IdPianta = '$val'";
    $res = $db->query($q);
    $row = mysql_fetch_array($res);

    $pianta = new Pianta();
    $pianta->setDescrizione($row['Descrizione']);
    $pianta->setDisponibilita($row['Disponibilita']);
    $pianta->setId($row['IdPianta']);
    $pianta->setImmagine($row['Immagine']);
    $pianta->setNome($row['Nome']);
    $pianta->setPrezzo($row['Prezzo']);
    $pianta->setStagioneFioritura($row['StagioneFioritura']);
    include("php/view/PiantaVis.php");
    
}


//visualizza la specie selezionata
function FormSpecie($val){
    global $db; //all'esterno delle funzioni non vidibile all'esterno e ilcontrario, quindi con global � visibile anche all'interno e all'esterno delle funzioni, altrimenti non � visibile db nelle funzioni
    $q = "SELECT * FROM specie where idSpecie = '$val'";
    $res = $db->query($q);
    $row = mysql_fetch_array($res); 
    $specie = new Specie();
    $specie->setDescrizione($row['Descrizione']);
    $specie->setInfoMetodoColt($row['InfoMetodoColt']);
    $specie->setId($row['IdSpecie']);
    $specie->setImmagine($row['Immagine']);
    $specie->setNome($row['Nome']);
    $specie->setCarEsposizione($row['CarEsposizione']);
    if (mysql_num_rows($res) != 0)
        $q1 = "SELECT * FROM pianta where IdSpecieFK = '$val'";
    else
        $q1 = "SELECT * FROM pianta";
    $res1 = $db->query($q1);

    $piante[mysql_num_rows($res1)]= new Pianta();
    $i=0;
    while($row1 = mysql_fetch_array($res1)){
        $piante[$i] = new Pianta();
        $piante[$i]->setDescrizione($row1['Descrizione']);
        $piante[$i]->setDisponibilita($row1['Disponibilita']);
        $piante[$i]->setId($row1['IdPianta']);
        $piante[$i]->setImmagine($row1['Immagine']);
        $piante[$i]->setNome($row1['Nome']);
        $piante[$i]->setPrezzo($row1['Prezzo']);
        $piante[$i]->setStagioneFioritura($row1['StagioneFioritura']);
        $i++;
    }
    include("php/view/SpecieVis.php");

}

//aggiunge un cliente
function FormRegistrati(){
global $db;
//stripslashes() toglie gli slash
$name = addslashes($_POST['nome']);
$cognome = addslashes($_POST['cognome']);
$username = addslashes($_POST['username']);
$passw = addslashes($_POST['password']);
$telefono = addslashes($_POST['telefono']);
$email = addslashes($_POST['email']);
$indirizzo = addslashes($_POST['indirizzo']);
$citta = addslashes($_POST['citta']);
$cap = addslashes($_POST['cap']);

if (($username != "") && ($passw != "") && ($telefono != "")) {
//Controlla se è già esistente
        $q = "SELECT * FROM personale
        WHERE Username = '$username'";
        $res = $db->query($q);
        $row = mysql_fetch_array($res);
        if (mysql_num_rows($res) == 0) {
            $cliente="cliente";
            //inserisce il nuovo utente nell'archivio
            $q = "INSERT INTO `personale`(`Username`,`Email`,`Indirizzo`,
                `Citta`,`Cap`,`Password`,`Telefono`,`Nome`,`Cognome`,`Mansione`) 
		VALUES ('$username','$email','$indirizzo','$citta','$cap',
                    '$passw','$telefono','$name','$cognome','$cliente')";
            $res = $db->query($q);
            Login($username, $passw);
        } else {//utente già esistente
            //$_GET['job']='Registrazione';
            include ('php/view/login/RegistrazioneVis.php');
        ?>
        <script type="text/javascript">
            alert('utente già esistente!');   
	</script>
        <?php
        }    } else {
       // $_GET['job']='Registrazione';
        include ('php/view/login/RegistrazioneVis.php');
        ?>
        <script type="text/javascript">
            alert('non hai compilato alcuni campi obligatori!');   
	</script>
        <?php
}


}



/*!! se si cerca di salvare viene mostrato un messaggio di errore ma se si aggiorna
 * la pagina si torna in index.php
 * cercare di risolvere questo problema
 */
/*???
 * si ritorna sempre alla home 
 */
function Logout(){
    unset($_SESSION['logged']); // toglie il collegamento
    header('Location: index.php');//???cercare una soluzione alternativa il sito riprende dalla home
    
}
/*???
 * si ritorna sempre alla home al posto di rimanere nella stessa pagina 
 */
function Login($username,$passw){
    global $db;
    $q = "SELECT * FROM personale
    WHERE Username = '$username' AND Password ='$passw'";
    $res = $db->query($q);

    if(mysql_num_rows($res) == 1) {
        $row = mysql_fetch_array($res);
        $_SESSION['logged'] = $row['Username']; //è stata trovato username e password corrispondenti
        header('Location: index.php');//???cercare una soluzione alternativa il sito riprende dalla home
    }
    else {?>
        <script type="text/javascript">
                alert('username o password non corretti');   
        </script>
    <?php
    }
}










/*





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
global $db; //all'esterno delle funzioni non vidibile all'esterno e ilcontrario, quindi con global � visibile anche all'interno e all'esterno delle funzioni, altrimenti non � visibile db nelle funzioni
  $q = "SELECT * FROM posts"; // estrae tuttii dati dalla tabella post � la tabella
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
			//o cancella cio� l'ID dell'atricolo ?>
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



/*

function FormAttivita($val){

global $db; //all'esterno delle funzioni non vidibile all'esterno e ilcontrario, quindi con global � visibile anche all'interno e all'esterno delle funzioni, altrimenti non � visibile db nelle funzioni


$q = "SELECT * FROM attivita where Codice = '$val'";
$res = $db->query($q);
$row = mysql_fetch_array($res); 
//si dovrebbe inserire un indice per recuperare il punto di vendita
echo "<h1>" . $row['Nome'] . "</h1> <h2> �/h =  " . $row['CostoOrario'] ."</h2>";
?>

       <form method="post" action="index.php">
		
			<input type="submit" name="job" value="Richiedi" />

			<?php //considera un unico id ?>
			<input type="hidden" name="ID" value="<?php echo $row['Codice']; ?>" /> 
			<?php //mi spedisce questo quando clicco su un pulsante modifica 
			//o cancella cio� l'ID dell'atricolo ?>
		</form> 

   </li> 

  <?php


}

*/
function FormHome(){
//riportare alla prima pagina



}
/*
//aggiunge al carrello un nuovo articolo
function FormCarrello($prod){
global $db; //all'esterno delle funzioni non vidibile all'esterno e ilcontrario, quindi con global � visibile anche all'interno e all'esterno delle funzioni, altrimenti non � visibile db nelle funzioni



$q= "UPDATE pianta SET Disponibilita = Disponibilita-1 where IdPianta = $prod";
$res = $db->query($q);

	?>

<br>
	<label> hai acquistato </label>	
		
<?php		
}

//aggiorna il carrello di volta in volta
function FormAggiornamento ($ordine){
global $db; //all'esterno delle funzioni non vidibile all'esterno e ilcontrario, quindi con global � visibile anche all'interno e all'esterno delle funzioni, altrimenti non � visibile db nelle funzioni
$q = "SELECT * FROM prodotto_ordine
WHERE id_OrdineFK = '$ordine'";
$res = $db->query($q);

if(mysql_num_rows($res) == 0){ //nessun articolo nel carrello
echo "<p> il carrello � vuoto </p>";
}

else{
echo "<table rules=all><tr><th> Nome Articolo </th> <th> Prezzo</th> <th> </th></tr>";
while($row = mysql_fetch_array($res)){
//far visualizzare tutti gli articoli presenti nel carrello
//controlla il prodotto che � nel carrello
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
*/


?> 


