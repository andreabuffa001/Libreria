<!doctype html>
    <html>
<head>

</head>
<body>
<!--barra di ricerca-->
<!--prova inserimento primo libro-->
<?php
//crdenziali solo per il proprietario da prendere in post-->
$user="root";
$pass="";
$autore_libro= 2;
$titolo_libro= "Libro test 3";
try {
    $dbh = new PDO('mysql:host=127.0.0.1;dbname=Libreria', $user, $pass);
    foreach($dbh->query('SELECT autore.nome, autore.cognome, libro.titolo FROM libro, autore WHERE libro.titolo LIKE "%2"') as $row) {
        print_r($row);
    }
    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>

</body>
</html>