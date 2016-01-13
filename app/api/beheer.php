<?php
    /* DB Connection
    ================================================================================== */
    $link = mysqli_connect('localhost', 'root', '', 'zeilschooldewaai');
    if(!$link){
        echo 'could not connect to db';
    }

    /* Beheerder toevoegen
    ================================================================================== */
    if($_GET['action'] == '1') {
        echo json_encode($_POST);

        $qry = "INSERT INTO `klanten` (`klant_id`, `geslacht`, `voorletters`, `voornaam`, `tussenvoegsel`, `achternaam`, `adres`, `postcode`, `woonplaats`, `telefoonnummer`, `mobiel`, `email`, `geboortedatum`, `niveau`, `wachtwoord`, `url`, `priviledged`) VALUES (NULL, '', '".$_POST['voorletters']."', '".$_POST['voornaam']."', '".$_POST['tussenvoegsel']."', '".$_POST['achternaam']."', '', '', '', NULL, '".$_POST['mobiel']."', '".$_POST['email']."', '', '', '".sha1($_POST['wachtwoord'])."', '', '2');";
        $rslt = mysqli_query($link, $qry);
    }

    /* Klantgegevens ophalen op basis van id
    ================================================================================== */
    if($_GET['action'] == '2') {
        $qry = "SELECT voorletters, voornaam, tussenvoegsel, achternaam, mobiel, email FROM klanten WHERE klant_id = '".$_POST['user_id']."'";
        $rslt = mysqli_query($link, $qry);

        $results = array();
        while ($row = mysqli_fetch_assoc($rslt)) {
            $results[] = $row;
        }
        echo(json_encode($results));
    }

    /* Beheerder wijzigen
    ================================================================================== */
    if($_GET['action'] == '3') {
        if($_POST['wachtwoord'] != ''){
            $qry = "UPDATE `klanten` SET voorletters='".$_POST['voorletters']."', voornaam='".$_POST['voornaam']."',tussenvoegsel='".$_POST['tussenvoegsel']."',achternaam='".$_POST['achternaam']."',mobiel='".$_POST['mobiel']."',email='".$_POST['email']."',wachtwoord='".sha1($_POST['wachtwoord'])."' where klant_id = '".$_POST['klant_id']."';";
        }else{
            $qry = "UPDATE `klanten` SET voorletters='".$_POST['voorletters']."', voornaam='".$_POST['voornaam']."',tussenvoegsel='".$_POST['tussenvoegsel']."',achternaam='".$_POST['achternaam']."',mobiel='".$_POST['mobiel']."',email='".$_POST['email']."' WHERE klant_id = '".$_POST['klant_id']."';";
        }
        $rslt = mysqli_query($link, $qry);
    }

    /* Beheerder verwijderen
    ================================================================================== */
    if($_GET['action'] == '4') {

        $qry = "DELETE FROM klanten WHERE klant_id = '".$_POST['klant_id']."';";
        $rslt = mysqli_query($link, $qry);
    }