<div id="ElencoGiardinieri">
    <fieldset>
    <h2>Elenco <?php echo $mansione; ?></h2>
    <table>
    <tr><th>Username</th><th>Nome</th><th>Cognome</th><th>Città</th>
        <th>Indirizzo</th><th>Telefono</th></tr>
    <?php for($count=0;$count<count($personale)-1;$count++){ ?>
            <tr>
                <td><?php echo $personale[$count]->getUsername();?></td>
                <td><?php echo $personale[$count]->getNome();?></td>
                <td><?php echo $personale[$count]->getCognome();?></td>
                <td><?php echo $personale[$count]->getIndirizzo();?></td>
                <td><?php echo $personale[$count]->getCitta();?></td>
                <td><?php echo $personale[$count]->getTelefono();?></td>
            </tr>
    <?php } ?>
    </table>
    </fieldset>
</div>
