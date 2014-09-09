

<?php
//formSpecie ($val);

//data attuale$b = date('d M y - H:i');



//richiedi giardiniere il giorno
?>

<?php



if(isset($_POST['prenota'])&&($_POST['prenota']=='Prenota')){ //controlla i lavoratori disponibili per tale giorno
    GestionePrenotazione($_POST['attivita'],$_POST['giorno']);
}


if(isset($_POST['day'])&&($_POST['day']=='Conferma')){ //controlla i lavoratori disponibili per tale giorno
   FormLavoro($_POST['giorno']);
}

if(isset($_GET['job']) and $_GET['job'] == 'Conferma'){ 
    $val = $_GET['specie'];
    formSpecie ($val);
}

if(isset($_GET['job']) and $_GET['job'] == 'Visualizza'){ 
	$val = $_GET['IDPianta'];
        FormVisualizza ($val);
}

     
/*Solo se l'utente non è loggato questi eventi possono accadere */
if (isset($_SESSION['logged'])) {  
}else{
    if(isset($_GET['job']) and $_GET['job'] == 'Registrati'){
        include 'php/view/login/RegistrazioneVis.php';;
    }
}
if (isset($_POST['job']) and $_POST['job'] == 'Salva'){
            FormRegistrati();
    }


if (isset($_SESSION['logged'])){ 
    if(isset($_POST['logout']) and $_POST['logout'] == 'Logout'){ 
	Logout();
    }
    if(isset($_GET['job']) and $_GET['job'] == 'Acquista'){ 
	formCarrello ($_GET['IDPianta']);

    }
}else{
      if(isset($_GET['job']) and $_GET['job'] == 'Acquista'){ 
	?>
        <script type="text/javascript">
            alert('devi prima effettuare il login!');   
	</script>
	<?php
        if (isset($_GET['specie'])){
            $val = $_GET['specie'];
            formSpecie ($val);
        }
            else{
                $val = $_GET['IDPianta'];
                FormVisualizza ($val);
            }
    }
    if(isset($_POST['login']) and $_POST['login'] == 'LOGIN'){
            $username = addslashes($_POST['username']);
            $passw = addslashes($_POST['password']);
            Login($username,$passw);
    }
}


/* if(isset($_GET['job']) and $_GET['job'] == 'ConfermaAttivita'){ 
//se � settata la variabile $_POST (se ho cliccato su uno dei due pulsanti), 
//se ha valoree Inserisci e hoo cliccato sul tasto inserisci invoca la funzione inserisci
	$val = $_GET['attivita'];
	
	formAttivita ($val);

}
 * 
 */
?>