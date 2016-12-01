<!doctype html>
<htmL>
<head>
<style>
    #note{
        height: 100px;
    }
</style>
</head>
<body>
<!--menu inline-->
<!--fine menu-->
<!--Blocco inserimento nuovo libro-->
<div>
    <!--attivazione del caricamento del nuovo libro-->
    <!--Blocco caricamento libro sul db-->
    <?php
    if ((isset($_POST["carica"]))) {
        $autore_libro= $_POST['autore'];
        $titolo_libro=$_POST['titolo'];
        $genere_libro= $_POST['genere'];
        $negozio= $_POST['negozio'];
        $prezzo_libro= $_POST['prezzo'];
        $anno_libro= $_POST['anno'];
        $note= $_POST['note'];
        $copertina_libro= $_POST['copertina'];
        $dbh = new PDO('mysql:host=127.0.0.1;dbname=libreria', 'root', '');
        try {
            foreach($dbh->query('INSERT INTO `libro`( `id_autore`, `titolo`, `prezzo`, `id_genere`, `anno`, `note`, `id_negozio`, `copertina`) VALUES ("'.$autore_libro.'","'.$titolo_libro.'",'.$prezzo_libro.',"'.$genere_libro.'","'.$anno_libro.'", "'.$note.'","'.$negozio.'","'.$copertina_libro.'")') as $row) {
                print_r($row);
                echo "Abbiamo inserito: ".$row['titolo']." di ".$row['nome'].' '.$row['cognome'];
            }
            $dbh = null;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    Else{
    ?>
        <!--Form Inserimento nuovo libro-->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="form">
            <table>
                <tr>
                    <td>Autore:</td>
                    <td><input type="text" name="autore"></td>
                </tr>
                <tr>
                    <td>Titolo:</td>
                    <td><input type="text" name="titolo"></td>
                </tr>
                <tr>
                    <td>Genere</td>
                    <td><select name="genere">
                            <optgroup label="Forma 1">
                                <option value="1">Romanzo</option>
                                <option value="2">Giallo</option>
                                <option value="3">Poesia</option>
                            </optgroup>
                            <optgroup label="Forma 2">
                                <option value="4">Poesia</option>
                                <option value="5">Epico</option>
                                <option value="6">Dramma</option>
                            </optgroup>
                        </select></td>
                </tr>
                <tr>
                    <td>Negozio</td>
                    <td><select name="negozio">
                            <option value="1">Feltrinelli (Via Roma)</option>
                            <option value="2">Mondadori</option>
                        </select></td>
                </tr>
                <tr>
                    <td>Prezzo:</td>
                    <td><input type="text" name="prezzo"></td>
                </tr>
                <tr>
                    <td>Anno:</td>
                    <td><input type="text" name="anno"></td>
                </tr>
                <tr>
                    <td>Note:</td>
                    <td><input type="text" name="note" id="note"></td>
                </tr>
                <tr>
                    <td><input type="submit" value="carica" name="carica"></td>
                </tr>
            </table>
        </form>
        <!--Fine Form INserimento nuovo libro-->

        <?php
}
?>

    <!--fine blocco caricamento-->

</div>
<!--fine blocco di inserimento-->

</body>
</htmL>

<?php

?>