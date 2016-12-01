<!doctype html>
    <html>
<head>
<!--Mantenere style responsive-->
</head>
<body>
<!--Blocco dedicato al menù-->
    <!--menu inline-->
    
<!--Fine Blocco Menù-->
<!-- Lista dei libri random-->
    <!--quattro blocchi con tutti i dati-->
    <div>
        <!--inswerimento dei dati presi dal db e ripetuti con foreach-->
        <?php
            $dbh = new PDO('mysql:host=127.0.0.1;dbname=libreria', 'root', '');
            foreach($dbh->query('SELECT autore.nome, autore.cognome, libro.titolo FROM `libro`,`autore` INNER JOIN libro as libro2 ON autore.idautore = `id_autore` ORDER BY rand() LIMIT 4') as $row) {
                echo '<p>'.$row['titolo'].' - '.$row['nome'].' '.$row['cognome'].'</p>';
             }
        ?>
    </div>
<!--Fine random-->
<!--Ultimi Libri Letti-->
    <!--Stile sidebar con copertina titolo e autore-->
<!--Fine ultimi libri letti-->
</body>
</html>