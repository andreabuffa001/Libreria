<!doctype html>
<htmL>
<head>
    <!--Mantenere style responsive-->
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://use.fontawesome.com/fb7210964a.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script type="text/javascript">
       $(document).getElementById("autore")(function(){
           $("#autore").hide();
       });
        function mostra () {
          $("#autore").show();
        }
    </script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( function() {
            $.widget( "custom.combobox", {
                _create: function() {
                    this.wrapper = $( "<span>" )
                        .addClass( "custom-combobox" )
                        .insertAfter( this.element );

                    this.element.hide();
                    this._createAutocomplete();
                    this._createShowAllButton();
                },

                _createAutocomplete: function() {
                    var selected = this.element.children( ":selected" ),
                        value = selected.val() ? selected.text() : "";

                    this.input = $( "<input>" )
                        .appendTo( this.wrapper )
                        .val( value )
                        .attr( "title", "" )
                        .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
                        .autocomplete({
                            delay: 0,
                            minLength: 0,
                            source: $.proxy( this, "_source" )
                        })
                        .tooltip({
                            classes: {
                                "ui-tooltip": "ui-state-highlight"
                            }
                        });

                    this._on( this.input, {
                        autocompleteselect: function( event, ui ) {
                            ui.item.option.selected = true;
                            this._trigger( "select", event, {
                                item: ui.item.option
                            });
                        },

                        autocompletechange: "_removeIfInvalid"
                    });
                },

                _createShowAllButton: function() {
                    var input = this.input,
                        wasOpen = false;

                    $( "<a>" )
                        .attr( "tabIndex", -1 )
                        .attr( "title", "Show All Items" )
                        .tooltip()
                        .appendTo( this.wrapper )
                        .button({
                            icons: {
                                primary: "ui-icon-triangle-1-s"
                            },
                            text: false
                        })
                        .removeClass( "ui-corner-all" )
                        .addClass( "custom-combobox-toggle ui-corner-right" )
                        .on( "mousedown", function() {
                            wasOpen = input.autocomplete( "widget" ).is( ":visible" );
                        })
                        .on( "click", function() {
                            input.trigger( "focus" );

                            // Close if already visible
                            if ( wasOpen ) {
                                return;
                            }

                            // Pass empty string as value to search for, displaying all results
                            input.autocomplete( "search", "" );
                        });
                },

                _source: function( request, response ) {
                    var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
                    response( this.element.children( "option" ).map(function() {
                        var text = $( this ).text();
                        if ( this.value && ( !request.term || matcher.test(text) ) )
                            return {
                                label: text,
                                value: text,
                                option: this
                            };
                    }) );
                },

                _removeIfInvalid: function( event, ui ) {

                    // Selected an item, nothing to do
                    if ( ui.item ) {
                        return;
                    }

                    // Search for a match (case-insensitive)
                    var value = this.input.val(),
                        valueLowerCase = value.toLowerCase(),
                        valid = false;
                    this.element.children( "option" ).each(function() {
                        if ( $( this ).text().toLowerCase() === valueLowerCase ) {
                            this.selected = valid = true;
                            return false;
                        }
                    });

                    // Found a match, nothing to do
                    if ( valid ) {
                        return;
                    }

                    // Remove invalid value
                    this.input
                        .val( "" )
                        .attr( "title", value + " didn't match any item" )
                        .tooltip( "open" );
                    this.element.val( "" );
                    this._delay(function() {
                        this.input.tooltip( "close" ).attr( "title", "" );
                    }, 2500 );
                    this.input.autocomplete( "instance" ).term = "";
                },

                _destroy: function() {
                    this.wrapper.remove();
                    this.element.show();
                }
            });

            $( "#combobox" ).combobox();
            $( "#toggle" ).on( "click", function() {
                $( "#combobox" ).toggle();
            });
        } );
    </script>
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
    <div id="titoli"><H2>Inserisci nuovo libro</H2></div>
    <!--Stile sidebar con copertina titolo e autore-->
    <div id="sidebar">
        <!--query select  per ultimi libri inseriti-->
        <?php
        $dbh = new PDO('mysql:host=127.0.0.1;dbname=libreria', 'root', '');
        foreach($dbh->query('SELECT DISTINCT autore.nome, autore.cognome, libro.titolo, libro.copertina FROM `libro`,`autore` INNER JOIN libro as libro2 ON autore.idautore = `id_autore` ORDER BY libro.id_libro DESC LIMIT 4') as $row) {
            echo '<div class="book-sidebar"><p id="p-libro">'.$row['titolo'].' - '.$row['nome'].' '.$row['cognome'].'</p><br><img id="img-sidebar" src="http://localhost/libreria/uploads/'.($row['copertina']).'" width="100" height="150"> </div>';
        }
        ?>
    </div>
    <!--Fine ultimi libri inseriti-->
    <!--Blocco inserimento nuovo libro-->
    <div>
        <!--attivazione del caricamento del nuovo libro-->
        <!--Blocco caricamento libro sul db-->
        <?php
        if (isset($_POST['carica'])) {
            //variabili in post dal form
            $autore_libro= $_POST['autore'];
            $titolo_libro=$_POST['titolo'];
            $genere_libro= $_POST['genere'];
            $negozio= $_POST['negozio'];
            $prezzo_libro= $_POST['prezzo'];
            $anno_libro= $_POST['anno'];
            $note= $_POST['note'];
            //prova ftp
            //nome temponareo
            $userfile_tmp = $_FILES['copertina']['tmp_name'];
            //nome originale
            $userfile_name = $_FILES['copertina']['name'];
            $uploaddir = 'C:/xampp/htdocs/Libreria/uploads/';
            // $copertina_libro= $_POST['copertina'];//file name
            //fine varibili
            if (move_uploaded_file($userfile_tmp, $uploaddir . $userfile_name)) {
                //Se l'operazione è andata a buon fine...
                echo "Abbiamo inserito: ".$titolo_libro." di ".$autore_libro;
            }else{
                //Se l'operazione è fallta...
                echo 'Upload NON valido!';
            }
            try {
                foreach($dbh->query('INSERT INTO `libro`( `id_autore`, `titolo`, `prezzo`, `id_genere`, `anno`, `note`, `id_negozio`, `copertina`) VALUES ('.$autore_libro.',"'.$titolo_libro.'","'.$prezzo_libro.'",'.$genere_libro.','.$anno_libro.',"'.$note.'",'.$negozio.',"'.$userfile_name.'")') as $row) {
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

            <form method="post" action="new_book.php" name="form" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td>Autore:</td>
                        <td><select name="autore" id="combobox">
                                <option value="0">Scrivi l'autore</option>
                                <option value="1">Alessandro Baricco</option>
                                <option value="2">Francesco Carofiglio</option>
                                <option value="3">Arthur Conan Doyle</option>
                                <option value="4">Alessandro Manzoni</option>
                                <option value="5">Carlo Collodi</option>
                                <option value="6">Emily Bronte</option>
                                <option value="7">Herman Hesse</option>
                            </select></td>
                    </tr>
                    <tr>
                        <td>Titolo:</td>
                        <td><input type="text" name="titolo"></td>
                    </tr>
                    <tr>
                        <td>Genere</td>
                        <td><select name="genere" id="combobox">
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
                        <td><input type="file" name="copertina" /> </td>
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

</div>
</body>
</htmL>

<?php

?>