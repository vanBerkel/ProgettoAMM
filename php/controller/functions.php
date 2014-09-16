<?php
/* sono presenti tutte le funzioni principali */

include_once ("php/model/Pianta.php"); //classe pianta
include_once ("php/model/Specie.php"); //classe specie
include_once ("php/model/Personale.php"); //classe personale

/*
 * Aggiorna la lista del menu di navigazione per un utente non logato
 */
function AggiornaListaNav(){
        include 'php/view/login/Accedi.php';
}

/*
 * Modifica i Dati personali di un cliente o giardiniere 
 */
function Modifica_Profilo(){
    global $db;
    $user = $_SESSION['logged'];
    $q="SELECT * FROM personale WHERE Username='$user'";
    $res = $db->query($q);
    $row = mysql_fetch_array($res);
    
    $personale = new Personale();
    $personale->setUsername($row['Username']);
    $personale->setPassword($row['Password']);
    $personale->setEmail($row['Email']);
    $personale->setIndirizzo($row['Indirizzo']);
    $personale->setCap($row['Cap']);
    $personale->setNome($row['Nome']);
    $personale->setCognome($row['Cognome']);
    $personale->setCitta($row['Citta']);
    $personale->setTelefono($row['Telefono']);
    
    echo "<h2>Modifica i miei dati personali </h2>";
    PagePersonale($personale,1);
    
}

/*
 * PagePersonale apre la pagina dei dati personali del personale
 * $personale perchè deve inserire i dati del personale nel form html
 * $tipo determina che tipo di PAgePersonale sarà
 * $tipo = 0 non modificabile
 * >0 modificabile
 * =2 aggiunta 
 * =3 registrazione
 */
function PagePersonale($personale,$tipo){
    if ($tipo>0){
        $dis="";
        $type="password";
        $psw="<label>ripeti password*</label><input type=password name=password2>";
        $uso="name=personale value=Salva";
    }
    if($tipo==0){
        $type="text";
        $dis="disabled";
        $psw="";
        $uso="name=personale value=Modifica";
    }
    if ($tipo==2){  $uso="name=admin value=Inserisci";
    }if ($tipo==3){
        $uso="name=job value=Salva";
    }
        include 'php/view/other/PagePersonale.php';
    
}

/*
 * Apre il div "miei dati personali" 
 * Effettua una ricerca dell'utente che ha effettuato l'accesso
 */
function InfoPersonali(){
    global $db;
    $user = $_SESSION['logged'];
    $q="SELECT * FROM personale WHERE Username='$user'";
    $res = $db->query($q);
    $row = mysql_fetch_array($res);
    
    $personale = new Personale();
    $personale->setUsername($row['Username']);
    $personale->setPassword($row['Password']);
    $personale->setEmail($row['Email']);
    $personale->setIndirizzo($row['Indirizzo']);
    $personale->setCap($row['Cap']);
    $personale->setNome($row['Nome']);
    $personale->setCognome($row['Cognome']);
    $personale->setCitta($row['Citta']);
    $personale->setTelefono($row['Telefono']);
  
    echo "<h2>I miei dati personali </h2>";
    PagePersonale($personale,0);
    
}


/*
 * Crea o Modifica un nuovo cliente o giardiniere
 */
function Aggiorna_Profilo(){
    global $db;
    if (isset ($_SESSION['logged'])){
        $logged= $_SESSION['logged'];
    }
    else {
        $logged="";
    }
$username = addslashes($_POST['username']);
$passw = addslashes($_POST['password']);
$passw2 = addslashes($_POST['password2']);
if ($passw==$passw2){
    $name = addslashes($_POST['nome']);
    $cognome = addslashes($_POST['cognome']);
    $telefono = addslashes($_POST['telefono']);
    $email = addslashes($_POST['email']);
    $indirizzo = addslashes($_POST['indirizzo']);
    $citta = addslashes($_POST['citta']);
    $cap = addslashes($_POST['cap']);

    if (($username != "") && ($passw != "") && ($telefono != "")) {
    //Controlla se è già esistente
            $unico=0;
            if ($logged!=$username){
                $q = "SELECT * FROM personale
                WHERE Username = '$username'";
                $res = $db->query($q);
                $row = mysql_fetch_array($res);
                $unico = mysql_num_rows($res);
                  
            }
            if ( $unico == 0) {
                $cliente="cliente";
                //inserisce il nuovo utente nell'archivio
                if ($logged!=""){  
                    $qq="SELECT Id FROM personale WHERE Username='$logged'";
                    $resout = $db->query($qq);
                    $resout = mysql_fetch_array($resout);
                    $resout = $resout['Id'];
                    $q = "UPDATE personale SET `Username`='$username',
                            `Password`='$passw', `Citta`='$citta',
                            `Indirizzo`='$indirizzo',`Cap`='$cap',
                            `Telefono`='$telefono',`Email`='$email',
                            `Nome`='$name',`Cognome`='$cognome'
                          WHERE `Id`='$resout'";
                                  
                }else{
                    $q = "INSERT INTO `personale`(`Username`,`Email`,`Indirizzo`,
                        `Citta`,`Cap`,`Password`,`Telefono`,`Nome`,`Cognome`,`Mansione`) 
                        VALUES ('$username','$email','$indirizzo','$citta','$cap',
                        '$passw','$telefono','$name','$cognome','$cliente')";
                }
            
                $res = $db->query($q);
                if ($logged!=""){
                    $_SESSION['logged']=$username;
                    InfoPersonali();
                    ?>
                      <script type="text/javascript">
                          alert('modifiche effettuate!');   
                      </script>
                    <?php
                }else {
                    Login($username, $passw);
                }                   
                   
            } else {
                if ($logged!="")
                    Modifica_Profilo();
                else include ('php/view/login/RegistrazioneVis.php');
            ?>
            <script type="text/javascript">
                alert('nome utente non valido!');   
            </script>
            <?php
            }    
            
            } else 
                {
                    if ($logged!="") Modifica_Profilo();
                    else include ('php/view/login/RegistrazioneVis.php');
                     ?>
                     <script type="text/javascript">
                         alert('nome utente, password, telefono sono campi da compilare obligatoriamente');   
                     </script>
                     <?php
    }

}
else{
    if ($logged!="") Modifica_Profilo();
    else include ('php/view/login/RegistrazioneVis.php');
        ?>
        <script type="text/javascript">
            alert('password non corrispondenti!');   
	</script>
        <?php
}
    
    
}

/*visualizza una pianta
 * $val indice della pianta
 * ritorna un oggetto di tipo pianta
 */
//visualizza una pianta
function Pianta($val){
    global $db; 
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
    
    return $pianta;
}

/*
 * visualizza una pianta nella pagina
 * in base al valore di $val=indice della pianta da visualizzare
 */
function FormVisualizza($val){
    $pianta = new Pianta();
    $pianta=Pianta($val);
    $mansione="";
    if(isset($_SESSION['logged'])){
        $mansione=  ReturnMansione($_SESSION['logged']);
    }
    include("php/view/other/PiantaVis.php");
    
}

/*
 * visualizza una lista di piante appartenenti a una specie
 * in base al valore di $val=indice della specie
 */
function FormSpecie($val){
    global $db; 
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

    include("php/view/other/SpecieVis.php");
    ElencoPianteTipo(mysql_num_rows($res),$val);
    
}

/*
 * Visualizza un elenco di giardinieri o clienti 
 * in base al valore $mansione
 */
function ElencoPersonale($mansione){
    global $db; 
    $q = "SELECT * FROM personale WHERE Mansione='$mansione'";
    $res = $db->query($q);
    $i=0;
    $personale[mysql_num_rows($res)]=new Personale();
    while($row = mysql_fetch_array($res)){
        $personale[$i] = new Personale();
        $personale[$i]->setUsername($row['Username']);
        $personale[$i]->setEmail($row['Email']);
        $personale[$i]->setIndirizzo($row['Indirizzo']);
        $personale[$i]->setCap($row['Cap']);
        $personale[$i]->setNome($row['Nome']);
        $personale[$i]->setCognome($row['Cognome']);
        $personale[$i]->setCitta($row['Citta']);
        $personale[$i]->setTelefono($row['Telefono']);
        $i++;
    }
    if ($mansione=="giardiniere"){
        $mansione="giardinieri";
    }else{
        $mansione="clienti";
    }
    include("php/view/other/ElencoPersonale.php");
 }



/* 
 * Visualizza un elenco di piante
 * in base al valore di tipo e val
 * tipo =0 Seleziona tutte le piante
 * tipo>0 selezione solo le piante di una specie 
 * tipo <0 cerca per lettera
 * val = idSPecie oppure 
 *      = lettera da cercare 
 *      = 0 identifica che siamo in elenco di lettere
 */
function ElencoPianteTipo($tipo,$val){
    global $db;
    $esiste=0; 
    switch ($tipo){
        case 0 :
            $q = "SELECT * FROM pianta";
            if ($val=='0'){
                include ("php/view/other/ElencoPianteLettera.php");
            }else
            {
                include ("php/view/other/Piante.php");
 
            }
           break;
        case 1:
            $q = "SELECT * FROM pianta where IdSpecieFK = '$val'";
            $esiste=$val;
            break;
        default:
            $q="SELECT * FROM pianta WHERE nome regexp'^[$val]'";
            include ("php/view/other/ElencoPianteLettera.php");
            break;
    }
    $res = $db->query($q);
    $piante[mysql_num_rows($res)]= new Pianta();
    $i=0;
    while($row = mysql_fetch_array($res)){
        $piante[$i] = new Pianta();
        $piante[$i]->setDescrizione($row['Descrizione']);
        $piante[$i]->setDisponibilita($row['Disponibilita']);
        $piante[$i]->setId($row['IdPianta']);
        $piante[$i]->setImmagine($row['Immagine']);
        $piante[$i]->setNome($row['Nome']);
        $piante[$i]->setPrezzo($row['Prezzo']);
        
        $i++;
    }
    $mansione="";
    if (isset($_SESSION['logged'])){
         $mansione=ReturnMansione($_SESSION['logged']);
    }
    include ("php/view/other/ElencoPiante.php");
}

/* Tenta di aggiungere uno nuovo personale
 * in base al valore di $mansione aggiunge un giardiniere o cliente
 * return 0 personale aggiunto
 * 1    nome utente gia esistente
 * 2    password non combaccia
 * 3    non compilati tutti i campi obligatori
 */
function AggiungiPersonale($mansione){
    global $db;
    $ritorno =0;

    $username = addslashes($_POST['username']);
    $passw = addslashes($_POST['password']);
    $passw2 = addslashes($_POST['password2']);
    if ($passw==$passw2){
        $name = addslashes($_POST['nome']);
        $cognome = addslashes($_POST['cognome']);
        $telefono = addslashes($_POST['telefono']);
        $email = addslashes($_POST['email']);
        $indirizzo = addslashes($_POST['indirizzo']);
        $citta = addslashes($_POST['citta']);
        $cap = addslashes($_POST['cap']);

            if (($username != "") && ($passw != "") && ($telefono != "")) {
        //Controlla se è già esistente
                if (ReturnId($username)==NULL) {
                    //inserisce il nuovo utente nell'archivio
                    $q = "INSERT INTO `personale`(`Username`,`Email`,`Indirizzo`,
                        `Citta`,`Cap`,`Password`,`Telefono`,`Nome`,`Cognome`,`Mansione`) 
                        VALUES ('$username','$email','$indirizzo','$citta','$cap',
                            '$passw','$telefono','$name','$cognome','$mansione')";
                    $res = $db->query($q);
                } else{//utente già esistente
                    $ritorno=1;
                }    

            } else {
                 $ritorno=3;
        }
    }
    else{
        $ritorno=2;
    }
    return $ritorno;
}


/*
 * L'utente si disconnette 
 */
function Logout(){
    unset($_SESSION['logged']); // toglie il collegamento
    header('Location: index.php');
    
}


/*
 * Effettua il login
 * in base al valore di $username e passw 
 * se i valori di username e passw sono corretti 
 */
function Login($username,$passw){
    global $db;
    $q = "SELECT * FROM personale
    WHERE Username = '$username' AND Password ='$passw'";
    $res = $db->query($q);

    if(mysql_num_rows($res) == 1) {
        $row = mysql_fetch_array($res);
        $_SESSION['logged'] = $row['Username']; //è stata trovato username e password corrispondenti
        header('Location: index.php');
    }
    else {?>
        <script type="text/javascript">
                alert('username o password non corretti');   
        </script>
    <?php
    }
}


/* 
 * Aggiorna il giorno e visualizza il div "RicercaGiorno"
 */
function AggiornaGiorno(){
    $t = time();
    $b = date('Y-m-d',$t);
    $g=86400;
    $w=86400*7;
    $b = date('Y-m-d',$t+$g);
    $max= date('Y-m-d',$t+$w);
    $pos = date('Y-m-d; G i s',$t);
    include 'php/view/other/RicercaGiornoForm.php';
}




/*
 * Effettua un controllo sui giardinieri 
 * che sono liberi in un determinato giorno
 * e li visualizza sullo schermo
 * $giorno = contiene il giorno su cui si deve basare la ricerca
 */
function FormLavoro($giorno){
    global $db; 
    $mansione = "giardiniere";
    $q = "SELECT * FROM personale WHERE Mansione='$mansione' AND 
            Id NOT IN (SELECT giardiniere_fk FROM giorno WHERE DAY =  '$giorno')";
    $res = $db->query($q);
    if (mysql_num_rows($res) !=0){
        $giardiniere[mysql_num_rows($res)]= new Personale();
        $i=0;
        while($row = mysql_fetch_array($res)){
             $giardiniere[$i] = new Personale();
             $giardiniere[$i]->setUsername($row['Username']);
             $giardiniere[$i]->setNome($row['Nome']);
             $giardiniere[$i]->setCognome($row['Cognome']);
             $i++;
        }
        include 'php/view/other/ListaGiardinieri.php';
    }
    else 
        echo "<p>non ci sono giardinieri disponibili per il " . $giorno . "</p>";
 }
 
/*
 * Gestisce la prenotazione di un giardiniere ($giardiniere)
 * in un determinato giorno ($giorno) da parte di un cliente
 */
function GestionePrenotazione($giardiniere, $giorno){
    global $db;
    if ($giardiniere=="null"){
        ?>
        <script type="text/javascript">
            alert('non hai selezionato nessun giardiniere!');   
	</script>
        <?php
        include 'php/view/ListaGiardinieri.php';
    }else{
    if (isset($_SESSION['logged'])){
        $mansione = "giardiniere";
        $g = "SELECT * FROM personale WHERE Username='$giardiniere'";
        $resg=$db->query($g);
        $giar = mysql_fetch_array($resg);
        $giardini = $giar['Id'];
        $clienti = $_SESSION['logged'];
        $c = "SELECT * FROM personale WHERE Username='$clienti'";
        $resc=$db->query($c);
          
        $cl = mysql_fetch_array($resc);
        $cliente=$cl['Id'];
      
        $t= time($giorno);
        $q = "INSERT INTO giorno (`day`,`giardiniere_fk`, `cliente_fk`) 
                VALUES ('$giorno','$giardini', '$cliente')";
                $db->query($q);
        echo "prenotazione effettuata per il giorno ".$giorno;
    }
    else {
        ?>
        <script type="text/javascript">
            alert('devi prima autenticarti!');   
	</script>
        <?php
    }
}
    
}

/*
 * visualizza la select di selezione di una specie
 * cerca tutte le specie presenti nel database
 */
Function SceltaSpecie(){       
    global $db;
    $q = "SELECT * FROM specie"; // estrae tuttii dati dalla tabella post è la tabella
    $res = $db->query($q); //invochiamo  il metodo query su db
    $specie[mysql_num_rows($res)] = new Specie();
    $i=0;
    while($row = mysql_fetch_array($res)){ //ciclo per estrarre i dati
        $specie[$i] = new Specie();
        $specie[$i]->setId($row['IdSpecie']);
        $specie[$i]->setNome($row['Nome']);
        $i++;
    }
    include 'php/view/other/ListaSpecie.php';
 }        

 /*
  * Acquista una nuova pianta
  * $prod = contiene l'id della pianta da acquistare
  */
function FormCarrello($prod){
    global $db;
    $cliente = $_SESSION['logged'];
    $q= "UPDATE pianta SET Disponibilita = Disponibilita-1 WHERE IdPianta = '$prod'";
    $res = $db->query($q);
    //ricerca dell'acquirente
    $IdCliente = ReturnId($cliente);
        //ricerca se la pianta è stata già acquistata
    $q = "SELECT * FROM acquisto WHERE cliente_fk='$IdCliente' AND pianta_fk = $prod ";
    $res = $db->query($q);
    if (mysql_num_rows($res)==0){
        $q = "INSERT INTO `acquisto`(`quantita`, `cliente_fk`, `pianta_fk`) 
                VALUES ('1','$IdCliente','$prod')";
    }else{
        $q="UPDATE acquisto SET quantita = quantita+1 where pianta_fk = $prod and cliente_fk=$IdCliente";
       }
    $res = $db->query($q);
    if (isset($_GET['IDSpecie'])){
            FormSpecie($_GET['IDSpecie']);
            
    }else{
        FormVisualizza($prod);
    }
    ?>
        
        <script type="text/javascript">
            alert('pianta acquistata!!');   
	</script>
		
    <?php		
}
 
/* restituisce la mansione di un determinato personale
 * $personale = contiene l'username su cui si basa la ricerca
 */
function ReturnMansione($personale){
    global $db;
    $q ="SELECT * FROM personale WHERE Username='$personale'";
    $res = $db->query($q);
    $row = mysql_fetch_array($res);
    $mansione = $row['Mansione'];
    return $mansione;
}

/*
 * restituisce l'id di un determinato personale
 *  $personale = contiene l'username su cui si basa la ricerca
 */
function ReturnId($personale){
    global $db;
    $q ="SELECT * FROM personale WHERE Username='$personale'";
    $res = $db->query($q);
    $row = mysql_fetch_array($res);
    $Idpersonale = $row['Id'];
    return $Idpersonale;
}


/*
 * Aggiunge una pianta nel database
 */
function AggiungiPianta($nome,$descrizione,$disponibilita,$specie, $immagine,$prezzo){
    global $db;
    $q = "INSERT INTO pianta (`Nome`,`Descrizione`, `Disponibilita`,`IdSpecieFK`,
        `Immagine`,`Prezzo`) 
                VALUES ('$nome','$descrizione', '$disponibilita', '$specie','$immagine'
            , '$prezzo')";
    $db->query($q);
}


/*
 * Ricerca una pianta in base al $nome
 * restituisce idPianta se viene trovato altrimenti NULL
 */
function CercaPianta($nome){
    global $db;
    $q ="SELECT * FROM pianta WHERE Nome='$nome'";
    $res = $db->query($q);
    $row = mysql_fetch_array($res);
    $Idpianta = $row['IdPianta'];
    return $Idpianta;   
}

/*
 * Aggiunge una pianta nel database
 */
function AggiungiSpecie($nome,$descrizione){
    global $db;
    $q = "INSERT INTO specie(`Nome`,`Descrizione`) 
                VALUES ('$nome','$descrizione')";
    $db->query($q);
}

/*
 * Ricerca una specie in base al $nome
 * restituisce idSpecie se viene trovato altrimenti NULL
 */
function CercaSpecie($nome){
    global $db;
    $q ="SELECT * FROM specie WHERE Nome='$nome'";
    $res = $db->query($q);
    $row = mysql_fetch_array($res);
    $Idspecie = $row['IdSpecie'];
    return $Idspecie;   
}

/*
 * visualizza la form di aggiunta di una specie
 */
function FormAggiungiSpecie(){
    $specie = new Specie();
    $specie->setDescrizione("");
    $specie->setNome("");
    include 'php/view/admin/PageSpecie.php';
}

/*
 * visualizza la form di aggiunta di un personale
 * $mansione specifica che tipo di utente dovrà essere aggiunto
 */
function FormAggiungiPersonale($mansione){
    $i=1;
    $personale = new Personale();
    $personale->setUsername("");
    $personale->setPassword("");
    $personale->setEmail("");
    $personale->setIndirizzo("");
    $personale->setCap(0);
    $personale->setNome("");
    $personale->setCognome("");
    $personale->setCitta("");
    $personale->setTelefono(0);
    if ($mansione=="giardiniere"){
        include 'php/view/admin/PageGiardiniere.php';
        $i=2;
    }
    if ($mansione=="cliente"){
        echo "<h1>Registrazione nuovo cliente</h1>";
        $i=3;
    }
    PagePersonale($personale,$i);
}

/*
 *visualizza form di modifica di una pianta
 * idPianta = identifica ID della pianta da modificare
 */
function FormModificaPianta($idPianta){
    global $db;
    $pianta = new Pianta;
    $pianta = Pianta($idPianta);
    $q ="SELECT * FROM pianta WHERE IdPianta=$idPianta";
    $res = $db->query($q);
    $row = mysql_fetch_array($res);
    $idSpecie = $row['IdSpecieFK'];
    $q ="SELECT * FROM specie WHERE IdSpecie NOT IN ($idSpecie)";
    $res = $db->query($q);
    $specie[mysql_num_rows($res)+1] = new Specie();
    $i =1;
    while ($row = mysql_fetch_array($res)){
        $specie[$i] = new Specie();
        $specie[$i]->setId($row['IdSpecie']);
        $specie[$i]->setNome($row['Nome']);
        $i++;
    }
    $q ="SELECT * FROM specie WHERE IdSpecie=$idSpecie";
    $res = $db->query($q); 
    $row = mysql_fetch_array($res);
    $specie[0] = new Specie();
    $specie[0]->setId($row['IdSpecie']);
    $specie[0]->setNome($row['Nome']);
    $id=$idPianta;
    echo "<h1>Modifica di una pianta</h1>";
    include 'php/view/admin/PagePianta.php';
}

/*
 * visualizza la form di aggiunta di una pianta
 */
function FormAggiungiPianta(){
    global $db;
    $pianta = new Pianta();
    $pianta->setDescrizione("");
    $pianta->setDisponibilita(0);
    $pianta->setImmagine("");
    $pianta->setNome("");
    $pianta->setPrezzo("");
   
    $q ="SELECT * FROM specie";
    $res = $db->query($q);

    $specie[mysql_num_rows($res)] = new Specie();
    $i =0;
    while ($row = mysql_fetch_array($res)){
        $specie[$i] = new Specie();
        $specie[$i]->setId($row['IdSpecie']);
        $specie[$i]->setNome($row['Nome']);
        $i++;
    }
    $id=-1;
    echo "<h1>Inserimento di una nuova pianta</h1>";
    include 'php/view/admin/PagePianta.php';
}

/*
 * Modifica i dati di una pianta nel database
 * IDpianta = specifica Id della pianta da modificare 
 */
function ModificaPianta($idPianta){
   global $db;
   $nome = $_POST['nome'];
   $descrizione = $_POST['descrizione'];
   $disponibilita = $_POST['disponibilita'];
   $idspecie = $_POST['specie'];
   $img = $_POST['immagine'];
   $prezzo = $_POST['prezzo'];
   $q = "UPDATE pianta SET `Nome`='$nome',`Descrizione`='$descrizione', 
           `Disponibilita`='$disponibilita', `IdSpecieFK`='$idspecie',
          `Immagine`='$img', `Prezzo`='$prezzo' WHERE IdPianta='$idPianta'";
 
    $db->query($q);

}


/*
 * visualizza il profilo dell'amministratore
 */
function AdminProfilo(){
    PianteFinite();
    include 'php/view/admin/Profilo.php';
}

/*
 * visualizza le piante la cui disponibilita sta per terminare 
 */
function PianteFinite(){
    global $db;
    $q ="SELECT * FROM pianta WHERE Disponibilita<5";
    $res = $db->query($q);
    
        $piante[mysql_num_rows($res)]= new Pianta();
        $i=0;
        while($row1 = mysql_fetch_array($res)){
            $piante[$i] = new Pianta();
            $piante[$i]->setDescrizione($row1['Descrizione']);
            $piante[$i]->setDisponibilita($row1['Disponibilita']);
            $piante[$i]->setId($row1['IdPianta']);
            $piante[$i]->setImmagine($row1['Immagine']);
            $piante[$i]->setNome($row1['Nome']);
            $piante[$i]->setPrezzo($row1['Prezzo']);
            $i++;
        }
    include 'php/view/admin/PianteEsaurite.php'; 
}
   

/*
 * Aggiunge una certa quantita di esemplari di una pianta
 * $IdPianta = specifica l'id della pianta 
 * $quant= specifica la quantità da aggiungere
 */
function AdminAggiungiPiante($idPianta,$quant){
    global $db;
    $q ="UPDATE pianta SET `Disponibilita`=Disponibilita+'$quant'
                            WHERE IdPianta='$idPianta'";
    $res = $db->query($q);
}


/*
 * visualizza l'elenco delle piante acquistate da un cliente
 * $idPersonale = determina Id del cliente
 */
function ClienteAcquisti($idPersonale){
    global $db;
    $q ="SELECT DISTINCT * FROM acquisto, pianta WHERE cliente_fk=$idPersonale AND pianta_fk=IdPianta";
    $res = $db->query($q);
 
        $piante[mysql_num_rows($res)]= new Pianta();
        $i=0;
        while($row1 = mysql_fetch_array($res)){
            $piante[$i] = new Pianta();
            $piante[$i]->setDescrizione($row1['Descrizione']);
            $piante[$i]->setDisponibilita($row1['quantita']);
            $piante[$i]->setId($row1['IdPianta']);
            $piante[$i]->setImmagine($row1['Immagine']);
            $piante[$i]->setNome($row1['Nome']);
            $piante[$i]->setPrezzo($row1['Prezzo']);
            
            $i++;
        }
    include 'php/view/cliente/Acquisti.php';
}

/*
 * visualizza le informazioni generali di un personale (nome , cognome ,username)
 */
function ClienteInfoPersonali($idPersonale){
    global $db;
   
    $q="SELECT * FROM personale WHERE Id='$idPersonale'";
    $res = $db->query($q);
    $row = mysql_fetch_array($res);
    
    $personale = new Personale();
    $personale->setUsername($row['Username']);
    $personale->setNome($row['Nome']);
    $personale->setCognome($row['Cognome']);
    include 'php/view/cliente/InfoPersonali.php';
}
/* 
 * visualizza le prenotazioni dei giardinieri effettuate dai clienti
 * idPersonale= Id del cliente
 */
function ClienteGiardiniere($idPersonale){
    global $db;
    $mansione="giardiniere";
    $b = date('Y-m-d');
    $q ="SELECT DISTINCT * 
    FROM giorno, personale
    WHERE cliente_fk='$idPersonale'
    AND DAY >  '$b'
    AND giardiniere_fk = Id";
    $res = $db->query($q);
    $personale[mysql_num_rows($res)]= new Personale();
    $i=0;
    while($row = mysql_fetch_array($res)){
        $personale[$i] = new Personale();
        $personale[$i]->setUsername($row['Username']);
        $personale[$i]->setNome($row['Nome']);
        $personale[$i]->setCognome($row['Cognome']);
        $personale[$i]->setData($row['day']);
        $i++;
    }
    include 'php/view/cliente/ClienteGiardiniere.php';
}

/*
 * visualizza l'agenda settimanale del giardiniere
 * idPersonale = identifica Id del giardiniere
 */
function GiardiniereAgenda($idPersonale){
    global $db;
    $personale[7] = new Personale();
    $data=  date('d-m-Y');
    $g=86400;
    $t = time();
    for ($i=0;$i<7;$i++){
        $data = date('d-m-Y',$t+=$g);
        $dg = date('Y-m-d',$t);
        $personale[$i]= new Personale();
        $personale[$i]->setData($data);
        $q="SELECT * 
        FROM giorno, personale
        WHERE giardiniere_fk='$idPersonale'
        AND DAY =  '$dg'
        AND cliente_fk = Id ";
        $res = $db->query($q);
        $row = mysql_fetch_array($res);
        $personale[$i]->setUsername($row['Username']);
        $personale[$i]->setNome($row['Nome']);
        $personale[$i]->setIndirizzo($row['Indirizzo']);
        $personale[$i]->setTelefono($row['Telefono']);
        $personale[$i]->setCognome($row['Cognome']);
    }
    include 'php/view/giardiniere/Agenda.php';
}

/*
 * visualizza il profilo del giardiniere
 */
function GiardiniereProfilo(){
    $personale=$_SESSION['logged'];
    ClienteInfoPersonali(ReturnId($personale));
    GiardiniereAgenda(ReturnId($personale));
}

/*
 * visualizza il profilo del cliente
 */
function ClienteProfilo(){
    $personale=$_SESSION['logged'];
    ClienteInfoPersonali(ReturnId($personale));
    ClienteAcquisti(ReturnId($personale));
    ClienteGiardiniere(ReturnId($personale));
}
 
/*
 * visualizza header in base all'utente che accede al sito
 */  
function VerificaHeaderPersonale(){
    if (isset($_SESSION['logged'])){
        $username=$_SESSION['logged'];
        include 'php/view/personale/header.php';
    }else
    {
        include 'php/view/login/header.php';
    }
    
}

/*
 * visualizza nav in base all'utente che accede al sito
 */  
function VerificaNavPersonale(){
    if(isset($_SESSION['logged'])){
        $personale=$_SESSION['logged'];
        $mansione=ReturnMansione($personale);
        if($mansione=="amministratore"){
            include 'php/view/admin/nav.php';
        }
            include 'php/view/other/nav.php';
        
    }else{
            include 'php/view/login/nav.php';
    }
    
 

}
    

/*
 * visualizza aside in base all'utente che accede al sito
 */  
function VerificaAsidePersonale(){
    SceltaSpecie();
    if(isset($_SESSION['logged'])){
        $personale=$_SESSION['logged'];
        $mansione=ReturnMansione($personale);
        if($mansione=="cliente"){
            AggiornaGiorno();
        }
    }else{
        AggiornaGiorno();
    }
 }
 
 /*
  * visualizza PageGiardiniere cioè i giardinieri disponibili 
  * in un determinato giorno
  * $giorno = -1 semplice PageGiardinieri
  * altrimenti in piu la scelta del giardiniere
  */
 function PageGiardiniere($giorno){
    include 'php/view/other/PageGiardinieri.php';
    if($giorno!="-1"){
            FormLavoro($giorno);
    }
 }
/*
 * visualizza Homepage
 */
 function Homepage(){
    include 'php/view/other/Homepage.php';
 }



?> 


