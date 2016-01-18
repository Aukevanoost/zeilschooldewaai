<?php
    /* DB Connection
    ================================================================================== */
    $link = mysqli_connect('localhost', 'root', '', 'zeilschooldewaai');
    if(!$link){
        echo 'could not connect to db';
    }   
/* Cursus toevoegen
    ================================================================================== */
    if($_GET['action'] == '1') {
        echo json_encode($_POST);

        $qry = "INSERT INTO `cursussen` (`cursus_id`, `cursusnaam`, `cursusprijs`, `cursusomschrijving`, `startdatum`, `einddatum`, `niveau`, `type_id`) VALUES (NULL, '".$_POST['cursusnaam']."', '".$_POST['cursusprijs']."', '".$_POST['cursusomschrijving']."', '".$_POST['startdatum']."', '".$_POST['einddatum']."', '".$_POST['niveau']."', '".$_POST['type_id']."');";
        $rslt = mysqli_query($link, $qry);
        print_r(mysqli_error($link));
    }

    /* Cursusgegevens ophalen op basis van id
    ================================================================================== */
    if($_GET['action'] == '2') {
        $qry = "SELECT cursusnaam, cursusprijs, cursusomschrijving, startdatum, einddatum, niveau, type_id, FROM cursussen";
        $rslt = mysqli_query($link, $qry);

        $results = array();
        while ($row = mysqli_fetch_assoc($rslt)) {
            $results[] = $row;
        }
        echo(json_encode($results));
    }

    /* Cursus wijzigen
    ================================================================================== */
    if($_GET['action'] == '3') {

            $qry = "UPDATE `cursussen` SET cursusnaam='".$_POST['cursusnaam']."', cursusprijs='".$_POST['cursusprijs']."', cursusomschrijving='".$_POST['cursusomschrijving']."', startdatum='".$_POST['startdatum']."', einddatum='".$_POST['einddatum']."', niveau='".$_POST['niveau']."', type_id='".$_POST['type_id']."'";
        
        $rslt = mysqli_query($link, $qry);

    }

    /* Cursus verwijderen
    ================================================================================== */
    if($_GET['action'] == '4') {

        $qry = "DELETE FROM cursussen WHERE cursus_id = '".$_POST['cursus_id']."';";
        $rslt = mysqli_query($link, $qry);
    }