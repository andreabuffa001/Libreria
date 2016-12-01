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
    if (isset($_GET['carica'])) {
        $autore_libro= $_GET['autore'];
        $titolo_libro=$_GET['titolo'];
        $genere_libro= $_GET['genere'];
        $negozio= $_GET['negozio'];
        $prezzo_libro= $_GET['prezzo'];
        $anno_libro= $_GET['anno'];
        $note= $_GET['note'];
        $copertina_libro= $_GET['copertina'];
        $dbh = new PDO('mysql:host=127.0.0.1;dbname=libreria', 'root', '');
        echo $autore_libro;
        try {
            foreach($dbh->query('INSERT INTO `libro`( `id_autore`, `titolo`, `prezzo`, `id_genere`, `anno`, `note`, `id_negozio`, `copertina`) VALUES ('.$autore_libro.',"'.$titolo_libro.'",'.$prezzo_libro.','.$genere_libro.','.$anno_libro.',"'.$note.'",'.$negozio.','.$copertina_libro.')') as $row) {
                echo "Abbiamo inserito: ".$titolo_libro." di ".$autore_libro;
            }
            $dbh = null;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    Else
    {
    ?>
        <!--Form Inserimento nuovo libro-->
        <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="form">
            <table>
                <tr>
                    <td>Autore:</td>
                    <td><select name="autore">
                            <option value="1">Alessandro Baricco</option>
                        </select></td>
                </tr>
                <tr>
                    <td>Titolo:</td>
                    <td><input type="text" name="titolo"></td>
                </tr>
                <tr>
                    <td>Genere</td>
                    <td><select name="genere">
                            <option value="0">Scegli Genere</option>
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
                            <option value="0">Scegli Negozio</option>
                            <option value="1">Feltrinelli (Via Roma)</option>
                            <option value="2">Mondadori</option>
                        </select></td>
                </tr>
                <tr>
                    <td>Prezzo: </td>
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
                    <td><input type="file" name="copertina"> </td>
                    <td><input type="submit" value="carica" name="carica" id="carica"></td>
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