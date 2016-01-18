<?php
    /* DB Connection
    ================================================================================== */
    $link = mysqli_connect('localhost', 'root', '', 'zeilschooldewaai');
    if(!$link){
        echo 'could not connect to db';
    }

    /* Boot toevoegen
    ================================================================================== */
    if($_GET['action'] == '1') {

        $qry = "INSERT INTO `boten` (`boot_id`, `bootnaam`, `bouwjaar`, `type_id`) VALUES (NULL, '".$_POST['bootnaam']."', '".$_POST['bouwjaar']."', '".$_POST['type_id']."');";
        $rslt = mysqli_query($link, $qry);
    }

    /* bootgegevens ophalen op basis van id
    ================================================================================== */
    if($_GET['action'] == '2') {
        $qry = "SELECT bootnaam, bouwjaar, type_id FROM boten WHERE boot_id = '".$_POST['boot_id']."'";
        $rslt = mysqli_query($link, $qry);

        $results = array();
        while ($row = mysqli_fetch_assoc($rslt)) {
            $results[] = $row;
        }
        echo(json_encode($results));
    }

    /* boten wijzigen
    ================================================================================== */
    if($_GET['action'] == '3') {

            $qry = "UPDATE `boten` SET bootnaam='".$_POST['bootnaam']."', bouwjaar='".$_POST['bouwjaar']."', type_id='".$_POST['type_id']."'";
        
        $rslt = mysqli_query($link, $qry);

    }


    /* boten verwijderen
    ================================================================================== */
    if($_GET['action'] == '4') {

        $qry = "DELETE FROM boten WHERE boot_id = '".$_POST['boot_id']."';";
        $rslt = mysqli_query($link, $qry);
    }