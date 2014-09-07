<div class='Specie'>
    <h1><?php echo $specie->getNome();?></h1> 
    <p><?php echo $specie->getDescrizione(); ?></p>
    <label> Elenco delle piante </label>
    <fieldset>
        <?php
            for($count=0;$count<count($piante)-1;$count++){
                 //ciclo per estrarre i dati
        ?>
                <div class=dettagli>
                <h3><?php echo $piante[$count]->getNome();?> </h3>
	   	<p>Prezzo <?php echo $piante[$count]->getPrezzo(); ?> € 
                <img src="images/<?php echo $piante[$count]->getImmagine(); ?>"/>
                <?php
                    if($piante[$count]->getDisponibilita()==0) {
                        ?><br>NON DISPONIBILE </p><?php
                    }    
                    else
                    {
                    ?>
                    <br>Disponibilità
                        <?php echo $piante[$count]->getDisponibilita();                    
                    }
                    ?></p>
	   
                <form method="get" action="index.php">
			<input type="submit" name="job" value="Visualizza" /><br>
                        <?php
                        if(! $piante[$count]->getDisponibilita()==0) { ?>
                                <input type="submit" name="job" value="Acquista" />
                        <?php
                        }
			?>
			<input type="hidden" name="IDPianta" value="<?php echo $piante[$count]->getId(); ?>" /> 
                        <input type="hidden" name="specie" value="<?php echo $specie->getId(); ?>" />
                </form> 
            </div>
        <?php
        }
        ?>
    </fieldset>
</div>