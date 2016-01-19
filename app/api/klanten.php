<?php
    /* DB Connection
    ================================================================================== */
    $link = mysqli_connect('localhost', 'root', '', 'zeilschooldewaai');
    if(!$link){
        echo 'could not connect to db';
    }

    /* Klant toevoegen
    ================================================================================== */
    if($_GET['action'] == '1') {
        echo json_encode($_POST);

        $qry = "INSERT INTO `klanten` (`klant_id`, `geslacht`, `voorletters`, `voornaam`, `tussenvoegsel`, `achternaam`, `adres`, `postcode`, `woonplaats`, `telefoonnummer`, `mobiel`, `email`, `geboortedatum`, `niveau`, `wachtwoord`, `url`, `priviledged`) VALUES (NULL, '".$_POST['geslacht']."', '".$_POST['voorletters']."', '".$_POST['voornaam']."', '".$_POST['tussenvoegsel']."', '".$_POST['achternaam']."', '".$_POST['adres']."', '".$_POST['postcode']."', '".$_POST['woonplaats']."', '', '".$_POST['mobiel']."', '".$_POST['email']."', '".$_POST['geboortedatum']."', '".$_POST['niveau']."', '".sha1($_POST['wachtwoord'])."', '', '1');";
        $rslt = mysqli_query($link, $qry);
        print_r(mysqli_error($link));
    }

    /* Klantgegevens ophalen op basis van id
    ================================================================================== */
    if($_GET['action'] == '2') {
        $qry = "SELECT geslacht, voorletters, voornaam, tussenvoegsel, achternaam, adres, postcode, woonplaats, telefoonnummer, mobiel, email, geboortedatum, niveau FROM klanten WHERE klant_id = '".$_POST['user_id']."'";
        $rslt = mysqli_query($link, $qry);

        $results = array();
        while ($row = mysqli_fetch_assoc($rslt)) {
            $results[] = $row;
        }
        echo(json_encode($results));
    }

    /* Klant wijzigen
    ================================================================================== */
    if($_GET['action'] == '3') {
        if($_POST['wachtwoord'] != ''){
            $qry = "UPDATE `klanten` SET geslacht='".$_POST['geslacht']."', voorletters='".$_POST['voorletters']."', voornaam='".$_POST['voornaam']."',tussenvoegsel='".$_POST['tussenvoegsel']."',achternaam='".$_POST['achternaam']."', adres='".$_POST['adres']."',postcode='".$_POST['postcode']."',woonplaats='".$_POST['woonplaats']."',telefoonnummer='".$_POST['telefoonnummer']."',mobiel='".$_POST['mobiel']."',email='".$_POST['email']."',geboortedatum='".$_POST['geboortedatum']."',niveau='".$_POST['niveau']."',wachtwoord='".sha1($_POST['wachtwoord'])."' where klant_id = '".$_POST['klant_id']."';";
        }else{
            $qry = "UPDATE `klanten`SET geslacht='".$_POST['geslacht']."', voorletters='".$_POST['voorletters']."', voornaam='".$_POST['voornaam']."',tussenvoegsel='".$_POST['tussenvoegsel']."',achternaam='".$_POST['achternaam']."', adres='".$_POST['adres']."',postcode='".$_POST['postcode']."',woonplaats='".$_POST['woonplaats']."',telefoonnummer='".$_POST['telefoonnummer']."',mobiel='".$_POST['mobiel']."',email='".$_POST['email']."',geboortedatum='".$_POST['geboortedatum']."',niveau='".$_POST['niveau']."' WHERE klant_id = '".$_POST['klant_id']."';";
        }
        $rslt = mysqli_query($link, $qry);

    }

    /* Klant verwijderen
    ================================================================================== */
    if($_GET['action'] == '4') {

        $qry = "DELETE FROM klanten WHERE klant_id = '".$_POST['klant_id']."';";
        $rslt = mysqli_query($link, $qry);
    }