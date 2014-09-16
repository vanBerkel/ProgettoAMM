<?php
/* sono presenti tutti gli eventi generali */
    $job="";        
    if (isset($_GET['job'])){
        $job=$_GET['job'];
    }else{   
        if (isset($_POST['job'])){
            $job=$_POST['job'];
        }
    }
    $menu="";        
    if (isset($_GET['menu'])){
        $menu=$_GET['menu'];    
    }
    
    if ($job=="Login"){ // si sta tentando di entrare nel sito
        $username = addslashes($_POST['username']);
        $passw = addslashes($_POST['password']);
        Login($username,$passw);
    }   
    if ($menu=="logout"){//disconessione
        Logout();
    }        

?>
