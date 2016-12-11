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
            <li><a href="search.php">Ricerca</a></li>
            <li><a href="new_book.php">Nuovo</a></li>
        </ul>
    </div>
    <!--Fine Blocco Menù-->
    <div id="titoli"><h2>Home</h2><h3>Ultimi libri inseriti</h3></div>
    <!--Ultimi Libri inseriti-->
    <!--Stile sidebar con copertina titolo e autore-->
    <div id="sidebar">
        <!--query select  per ultimi libri inseriti-->
        <?php
        $dbh = new PDO('mysql:host=127.0.0.1;dbname=libreria', 'root', '');
        foreach($dbh->query('SELECT DISTINCT autore.nome, autore.cognome, libro.titolo, libro.copertina FROM `libro`,`autore` INNER JOIN libro as libro2 ON autore.idautore = `id_autore` ORDER BY libro.id_libro DESC LIMIT 4') as $row) {
            echo '<div class="book-sidebar"><p id="p-libro">'.$row['titolo'].' - '.$row['nome'].' '.$row['cognome'].'</p><br><img id="img-sidebar" src="http://127.0.0.1/Libreria/uploads/'.($row['copertina']).'" width="100" height="150"> </div>';
        }
        ?>
    </div>
    <!--Fine ultimi libri inseriti-->
    <!-- Lista dei libri random-->
    <!--quattro blocchi con tutti i dati-->
    <div id="elenco">
        <!--stampa dei dati presi dal db e ripetuti con foreach-->
        <?php
        $dbh = new PDO('mysql:host=127.0.0.1;dbname=libreria', 'root', '');
        foreach($dbh->query('SELECT DISTINCT autore.nome, autore.cognome, libro.titolo, libro.copertina FROM `libro`,`autore` INNER JOIN libro as libro2 ON autore.idautore = `id_autore` ORDER BY rand() LIMIT 4') as $row) {
            echo '<div class="show-book"><p id="p-libro">'.$row['titolo'].' - '.$row['nome'].' '.$row['cognome'].'</p><img id="img-elenco" src="http://127.0.0.1/Libreria/uploads/'.($row['copertina']).'" width="200" height="250"></div>';
        }?>
    </div>
    <!--Fine random-->
</div>
</body>
</html>