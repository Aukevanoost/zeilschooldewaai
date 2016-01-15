<?php
    /* DB Connection
     ================================================================================== */
    $link = mysqli_connect('localhost', 'root', '', 'zeilschooldewaai');
    if(!$link){
        echo 'could not connect to db';
    }

    /* Instructeur toevoegen
    ================================================================================== */
    if($_GET['action'] == '1') {
        $qry = "INSERT INTO `instructeurs` (`instructeur_id`, `instructeur_geslacht`, `instructeur_voorletters`, `instructeur_voornaam`, `instructeur_tussenvoegsels`, `instructeur_achternaam`) VALUES (NULL, '".$_POST['geslacht']."', '".$_POST['voorletters']."', '".$_POST['voornaam']."', '".$_POST['tussenvoegsel']."', '".$_POST['achternaam']."');";
        echo $qry;
        $rslt = mysqli_query($link, $qry);
    }

    /* Instructeur ophalen op basis van id
    ================================================================================== */
    if($_GET['action'] == '2') {
        $qry = "SELECT `instructeur_geslacht`, `instructeur_voorletters`, `instructeur_voornaam`, `instructeur_tussenvoegsels`, `instructeur_achternaam` FROM instructeurs WHERE instructeur_id = '".$_POST['instructeur_id']."'";
        $rslt = mysqli_query($link, $qry);

        $results = array();
        while ($row = mysqli_fetch_assoc($rslt)) {
            $results[] = $row;
        }
        echo(json_encode($results));
    }

    /* Instructeur wijzigen
    ================================================================================== */
    if($_GET['action'] == '3') {
        $qry = "UPDATE `instructeurs` SET instructeur_voorletters='".$_POST['voorletters']."', instructeur_voornaam='".$_POST['voornaam']."',instructeur_tussenvoegsels='".$_POST['tussenvoegsels']."',instructeur_achternaam='".$_POST['achternaam']."',instructeur_geslacht='".$_POST['geslacht']."' WHERE instructeur_id = '".$_POST['id']."';";
        $rslt = mysqli_query($link, $qry);
    }


    /* Instructeur verwijderen
    ================================================================================== */
    if($_GET['action'] == '4') {

        $qry = "DELETE FROM instructeurs WHERE instructeur_id = '".$_POST['instructeur_id']."';";
        $rslt = mysqli_query($link, $qry);
    }