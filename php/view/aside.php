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
	<?php
        /*
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
	*/?>
</div>
