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
$dbh = new PDO('mysql:host=127.0.0.1;dbname=Libreria', $user, $pass);
        foreach($dbh->query('SELECT autore.nome, autore.cognome, libro.titolo FROM libro INNER JOIN libro.id_autore = autore.id_autore ORDER BY RAND() LIMIT 4') as $row) {
        echo '<p>'.$row['libro.titolo'].'</p><br><p>'.$row['autore.nome'].' '.$row['autore.cognome'].'</p>';
        }
            ?>
    </div>
<!--Fine random-->
<!--Ultimi Libri Letti-->
    <!--Stile sidebar con copertina titolo e autore-->
<!--Fine ultimi libri letti-->
</body>
</html>