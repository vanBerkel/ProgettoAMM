<?php
/*
 * sono presenti tutti gli eventi che modificano il main
 */
$mansione="";
if (isset($_SESSION['logged'])){
    $mansione = ReturnMansione($_SESSION['logged']);
}

$menu=""; //definisce quale pulsante del menu di navigazione si è digitato       
if (isset($_GET['menu'])){
    $menu=$_GET['menu'];
}

$job="";// definisce un evento generale che può sempre accaddere anche se non si è connessi al sito        
if (isset($_GET['job'])){
    $job=$_GET['job'];
}else{
    if (isset($_POST['job'])){
        $job=$_POST['job'];
    }
}

$elenco="";      //definisce la lettera che si è digitata per elenco piante  
if (isset($_GET['elenco'])){
    $elenco=$_GET['elenco'];
} 

switch ($menu){ //pulsante menu di navigazione eventi che possono accadere sempre
    case "piante":
            ElencoPianteTipo(0,0);
        break;
    case "giard":
            PageGiardiniere("-1");
            if (($mansione!="giardiniere") &&($mansione!="amministratore")){
                echo "<p>prenota un appuntamento qui affianco -> </p>";
            }
        break;
    case "home":
            Homepage();
        break;
}


switch ($mansione){//in base alla mansione certi eventi possono accadere
    case "amministratore":
        $inputAdmin="";
        if (isset($_POST['admin'])){
            $inputAdmin =($_POST['admin']);
        }
        switch ($inputAdmin) {
                    case "Aggiungi":
                        if (isset($_POST['IDPianta'])&&(isset($_POST['quant']))){
                            //aggiunge una quantita stabilita di esemplari di una pianta
                            AdminAggiungiPiante($_POST['IDPianta'],$_POST['quant']);
                        }
                        if (isset($_POST['giard'])){
                            //aggiunge un nuovo giardiniere
                            $mansione="giardiniere";
                            FormAggiungiPersonale($mansione);
                        }
                    case "Nuova":
                        if (isset($_POST['pianta'])){
                            //aggiunge un nuovo pianta
                            FormAggiungiPianta();
                        }
                        if (isset($_POST['specie'])){
                            //aggiunge una nuova specie
                            FormAggiungiSpecie();
                        }
                        break;
                    case "Modifica":
                        switch ($_POST['modifica']){
                            case "pianta":
                                //modifica una pianta
                                FormModificaPianta($_POST['IDPianta']);
                            break;
                        }
                    case "Inserisci":
                        if (isset($_POST['inserisci'])){
                            switch ($_POST['inserisci']){
                                case "pianta":                       
                                    $id=CercaPianta($_POST['nome']);
                                    if (($_POST['id']=='-1')&&($id==NULL)){
                                          //inserisce una nuova pianta nel database
                                          AggiungiPianta($_POST['nome'],$_POST['descrizione'],
                                                    $_POST['disponibilita'],$_POST['specie'],$_POST['immagine'],$_POST['prezzo']);
                                          echo "<h2> la pianta è stata aggiunta </h2>";
                                          AdminProfilo();//aggiorna profilo amministratore
                                    }else{ if ($id==($_POST['id'])||(($id)==NULL)){
                                                //modifica pianta
                                                ModificaPianta($_POST['id']);
                                                echo "<h2> la pianta è stata modificata </h2>";
                                                    AdminProfilo();//aggiorna profilo amministratore
                                            }else{
                                                echo "<p> !!!la pianta non è stata aggiunta!!! nome pianta già esistente </p>";
                                                FormAggiungiPianta();//aggiorna profilo amministratore
                                            }
                                    }
                                break;
                                case "specie":
                                    //tenta di aggiungere una nuova specie
                                    $id=CercaSpecie($_POST['nome']);
                                    if ($id==NULL){
                                        //aggiungi specie
                                          AggiungiSpecie($_POST['nome'],$_POST['descrizione']);
                                          echo "<h2> la specie è stata aggiunta </h2>";
                                          AdminProfilo();//aggiorna profilo amministratore
                                      }else{
                                        echo "<p> !!!la specie non è stata aggiunta!!! nome specie già esistente </p>";
                                        FormAggiungiSpecie();//aggiorna profilo amministratore
                                       }

                                break;
                                case "personale": //tenta di aggiungere un giardiniere nel database
                                    $mansione="giardiniere";
                                    $i=AggiungiPersonale($mansione);
                                    switch ($i){
                                        case 0://giardiniere aggiunto correttamente
                                            echo "<h2> il giardiniere è stato aggiunto </h2>";
                                            AdminProfilo();
                                            break;
                                        case 1: //nome utente già utilizzato
                                                echo "<p> !!!il giardiniere non è stata aggiunto!!! nome utente già esistente </p>";
                                                FormAggiungiPersonale($mansione);
                                                break;
                                        case 2: //la password non combaccia
                                            echo "<p> !!!il giardiniere non è stata aggiunto!!! password non corretta </p>";
                                            FormAggiungiPersonale($mansione);
                                            break;
                                        case 3: // non sono stati inseriti i campi obligatori
                                            echo "<p> !!!il giardiniere non è stata aggiunto!!! non sono stati compilati tutti i campi </p>";
                                            FormAggiungiPersonale($mansione);
                                            break;
                                    }

                                break;    
                            }
                        }
                        
                        break;
                    default:
                        if ((($menu=="")&&($elenco=="")
                                &&($job==""))||($menu=="profilo")){
                            AdminProfilo();//aggiorna profilo amministratore
                        }
                        if ((($menu=="clienti")&&($elenco=="")
                                &&($job==""))){
                            $mansione="cliente";
                            ElencoPersonale($mansione); //elenco dei clienti
                        }
                        if ((($menu=="giard")&&($elenco=="")
                                &&($job==""))){
                            $mansione="giardiniere";
                            ElencoPersonale($mansione);//elenco dei giardinieri
                        }
                    break;
                }
        break;
    case "cliente" : //gestione sessione del cliente
            $cliente="";        
            if (isset($_GET['personale'])){
                $cliente=$_GET['personale'];
            }else {
                 if (isset($_POST['personale'])){
                    $cliente=$_POST['personale'];
                }
            }
            switch ($cliente){
                case "info":
                    InfoPersonali();
                    break;
                case "Modifica":
                    Modifica_Profilo();
                    break;
                case "Salva":
                    Aggiorna_Profilo();
                    break;
                default:
                   if (($menu=="profilo")||(($menu=="")&&($elenco=="")&&($job==""))){
                         ClienteProfilo(); 
                     }
                    break;
      
            }
            break;
    case "giardiniere" :
        if (($menu=="profilo")||(($menu=="")&&($elenco=="")&&($job==""))){
                         GiardiniereProfilo(); 
        }
        break;
    default ://nessun account
        $mansione="cliente"; 
        if ($job=="Registrati"){
            FormAggiungiPersonale($mansione);
         }
        if ($job=="Salva"){
            $i=AggiungiPersonale($mansione);
            switch ($i){
                case 0://cliente aggiunto correttamente
                    echo "<h2> Registrazione effettuata </h2>";
                    Login(($_POST['username']), ($_POST['password']));
                    
                    break;
                case 1: //nome utente già utilizzato
                        echo "<p> !!! nome utente già esistente </p>";
                        FormAggiungiPersonale($mansione);
                        break;
                case 2: //la password non combaccia
                    echo "<p> !!! password non corretta </p>";
                    FormAggiungiPersonale($mansione);
                    break;
                case 3: // non sono stati inseriti i campi obligatori
                    echo "<p> !!! non sono stati compilati tutti i campi </p>";
                    FormAggiungiPersonale($mansione);
                    break;
            }
        }
        if(($job=="")&&($elenco=="")&&(($menu==""))){
            Homepage();
        }
        break;

}
    
switch ($job){
    case "Conferma":
        if (isset($_POST['giorno'])){
            PageGiardiniere($_POST['giorno']);
            
        }else{
            if (isset($_GET['specie'])){
                formSpecie ($_GET['specie']); 
            }
       }
        break;
    case "Prenota":
        if (isset($_POST['giorno'])){
            GestionePrenotazione($_POST['attivita'],$_POST['giorno']);
        }
        break;
    case "Visualizza":
            FormVisualizza ($_GET['IDPianta']);
        break;
    case "Acquista":
            formCarrello ($_GET['IDPianta']);
        break;
}
   


if ($elenco!=""){    
    if ($elenco=='0'){
        ElencoPianteTipo(0,$elenco);
    }else{
        ElencoPianteTipo(-1,$elenco);
    }
}




?>