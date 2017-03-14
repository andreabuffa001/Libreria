<!doctype html>
<html>
<head>
    <!--Mantenere style responsive-->
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        tr: { width: 33% ;}
    </style>
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
    <H2>Ricerca</H2>
    <!--Blocco mostra libro dopo ricerca-->
<?php
if (isset($_GET['ricerca'])) {
    //variabili in post dal form
    $query= $_GET['query_string'];
    $dbh = new PDO('mysql:host=127.0.0.1;dbname=libreria', 'root', '');
    echo '<br><br><br><br><br><table><tr><td>Risultati della ricerca:</td></tr><tr>';
    foreach($dbh->query('SELECT DISTINCT autore.nome, autore.cognome, libro.titolo, libro.copertina FROM `libro`,`autore` INNER JOIN libro as libro2 ON autore.idautore = `id_autore` WHERE libro.titolo LIKE \'%'.$query.'%\' ORDER BY libro.id_libro DESC') as $row) {
        echo '<td><div class="book-sidebar"><p id="p-libro">'.$row['titolo'].' - '.$row['nome'].' '.$row['cognome'].'</p><br><img id="img-sidebar" src="http://localhost/libreria/uploads/'.($row['copertina']).'" width="100" height="150"></div></td></tr>';
    }
    echo '</table><p><a href="search.php">Nuova ricerca</a></p>';
}
Else
{
    ?>
    <br><br><br><br><br><form method="get" action="search.php" name="form" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Ricerca libro</td>
                <td><input type="text" name="query_string"></td>
                <td><input type="submit" value="ricerca" name="ricerca" id="ricerca"></td>
            </tr>
        </table>
    </form>
    <?php
}
?>

