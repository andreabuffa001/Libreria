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
            <li>Libreria Completa</li>
            <li>Ricerca</li>
            <li><a href="new_book.php">Nuovo</a></li>
        </ul>
    </div>
    <!--Fine Blocco Menù-->
    <!--Ultimi Libri inseriti-->
    <!--Stile sidebar con copertina titolo e autore-->
    <div id="sidebar">
        <p>Ultimi libri inseriti</p>
        <!--query select  per ultimi libri inseriti-->
        <?php
        $dbh = new PDO('mysql:host=127.0.0.1;dbname=Libreria', 'root', '');
        foreach($dbh->query('SELECT autore.nome, autore.cognome, libro.titolo FROM `libro`,`autore` INNER JOIN libro as libro2 ON autore.idautore = `id_autore` ORDER BY libro.id_libro DESC LIMIT 4') as $row) {
            echo '<p>'.$row['titolo'].' - '.$row['nome'].' '.$row['cognome'].'</p>';
        }
        ?>
    </div>
    <!--Fine ultimi libri inseriti-->
    <!-- Lista dei libri random-->
    <!--quattro blocchi con tutti i dati-->
    <div id="elenco">
        <!--stampa dei dati presi dal db e ripetuti con foreach-->
        <?php
        $dbh = new PDO('mysql:host=127.0.0.1;dbname=Libreria', 'root', '');
        foreach($dbh->query('SELECT autore.nome, autore.cognome, libro.titolo FROM `libro`,`autore` INNER JOIN libro as libro2 ON autore.idautore = `id_autore` ORDER BY rand() LIMIT 2') as $row) {
            echo '<div class="show-book">'.$row['titolo'].'<br>'.$row['nome'].' '.$row['cognome'].'</div>';
        }?>
        <br>
        <?php
        foreach($dbh->query('SELECT autore.nome, autore.cognome, libro.titolo FROM `libro`,`autore` INNER JOIN libro as libro2 ON autore.idautore = `id_autore` ORDER BY rand() LIMIT 2') as $row) {
            echo '<div class="show-book">'.$row['titolo'].'<br>'.$row['nome'].' '.$row['cognome'].'</div>';
        }
        ?>
    </div>
    <!--Fine random-->
</div>
</body>
</html>