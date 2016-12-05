<!doctype html>
<html>
<head>
    <!--Mantenere style responsive-->
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="conteiner">
    <!--Blocco dedicato al menù-->
    <!--menu inline-->
    <div id="menu">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="all_book.php">Libreria Completa</a></li>
            <li>Ricerca</li>
            <li><a href="new_book.php">Nuovo</a></li>
        </ul>
    </div>
    <!--Stile sidebar con copertina titolo e autore-->
    <div id="sidebar">
        <p>Ultimi libri inseriti</p>
        <!--query select  per ultimi libri inseriti-->
        <?php
        $dbh = new PDO('mysql:host=127.0.0.1;dbname=libreria', 'root', '');
        foreach($dbh->query('SELECT autore.nome, autore.cognome, libro.titolo FROM `libro`,`autore` INNER JOIN libro as libro2 ON autore.idautore = `id_autore` ORDER BY libro.id_libro DESC LIMIT 4') as $row) {
            echo '<p>'.$row['titolo'].' - '.$row['nome'].' '.$row['cognome'].'</p>';
        }
        ?>
    </div>
    <!--Fine ultimi libri inseriti-->
    <div id="elenco">
        <!--Fine Blocco Menù-->
        <!--stampa a video di tutti i librbi inseriti-->
     <?php
        $dbh = new PDO('mysql:host=127.0.0.1;dbname=libreria', 'root', '');
        foreach($dbh->query('SELECT autore.nome, autore.cognome, libro.titolo FROM `libro`,`autore` INNER JOIN libro as libro2 ON autore.idautore = `id_autore` ORDER BY libro.id_libro DESC ') as $row) {
            echo '<div class="show-book">'.$row['titolo'].'<br>'.$row['nome'].' '.$row['cognome'].'</div>';
        }
        ?>
    </div>

