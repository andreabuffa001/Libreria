<!doctype html>
<htmL>
<head>

</head>
<body>
<!--menu inline-->
<!--fine menu-->
<!--Blocco inserimento nuovo libro-->
<div>
    <!--attivazione del caricamento del nuovo libro-->
    <?php
    if ((isset($_POST["submit"]))) {
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
            }
            $dbh = null;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    };
    ?>
    
</div>
<!--fine blocco di inserimento-->

</body>
</htmL>

<?php

?>