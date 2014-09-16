<h2>Agenda settimanale personale</h2>
<table>
    <tr><th>Giorno</th><th>Nome</th><th>Cognome</th><th>Indirizzo</th><th>Telefono</th></tr>
    <?php for($count=0;$count<(7);$count++){ ?>
            <tr><?php if ($personale[$count]->getNome()==""){ ?>
                <td><?php echo $personale[$count]->getData();?></td>
                <td><?php echo $personale[$count]->getNome();?></td>
                <td><?php echo $personale[$count]->getCognome();?></td>
                <td><?php echo $personale[$count]->getIndirizzo();?></td>
                <td><?php echo $personale[$count]->getTelefono();?></td>
            <?php } else { ?>
                <th><?php echo $personale[$count]->getData();?></th>
                <th><?php echo $personale[$count]->getNome();?></th>
                <th><?php echo $personale[$count]->getCognome();?></th>
                <th><?php echo $personale[$count]->getIndirizzo();?></th>
                <th><?php echo $personale[$count]->getTelefono();?></th>
            <?php } ?>
            </tr>
    <?php } ?>
</table>