<?php
session_start(); 
include("dbclass.php");
include("functions.php");
?>

<html>
<head>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<title>Registrazione</title>
<body>
<div id="container">


<form action="registr.php" method="post">

<fieldset>

	<select name="PrivatoPublico">
	<option value="Privato">Privato</option>
	<option value="Publico">Publico</option>
	
	</select>
  
  
  <label>*Nome</label>
  <input type="text" name="Nome">

 <label>Cognome</label>
  <input type="text" name="Cognome">
  
 
  
  

  
  <label>Nome utente*</label>
  <input type="text" name="username">

  <label>Password*</label>
  <input type="password" name="password">

   <label>Telefono*</label>
   <input type="text" name="telefono"><br>
   
   
   <input type="submit" name="job" value="Salva"/>
   <label> * campi obbligatori </label>
</fieldset>
</form>
<?php
if (isset($_POST['job']) and $_POST['job'] == 'Salva'){
  FormRegistrati();
}  

?>
</div>
</body>
</html>