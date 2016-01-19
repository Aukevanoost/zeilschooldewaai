<?php
    /* DB Connection
     ================================================================================== */
    $link = mysqli_connect('localhost', 'root', '', 'zeilschooldewaai');
    if(!$link){
        echo 'could not connect to db';
    }


    /* Cursusgegevens
    ================================================================================== */
    if($_GET['action'] == '1') {
        $qry = "SELECT cursus_id, cursusnaam, startdatum, niveau FROM cursussen WHERE cursus_id = '".$_POST['cursus_id']."'";
        $rslt = mysqli_query($link, $qry);

        while ($row = mysqli_fetch_assoc($rslt)) {
          $results[1] = $row;
        }
        $niveau = $results[1]["niveau"];
        $results[1]["startdatum"] = date("d / m / Y",strtotime($results[1]["startdatum"]));


        $qry = "SELECT * FROM klanten AS c JOIN inschrijvingen AS i ON c.klant_id = i.klant_id WHERE i.cursus_id = ".$_POST['cursus_id']." AND c.klant_id NOT IN (SELECT klant_id FROM koppelinggen WHERE cursus_id = ".$_POST['cursus_id'].")";
        $rslt = mysqli_query($link, $qry);

        $results[2] = array();
        while ($row = mysqli_fetch_array($rslt)) {
            array_push($results[2], $row);
        }

        $qry = "SELECT *, (SELECT Count(*) FROM koppelinggen AS k WHERE k.boot_id = boten.boot_id AND k.cursus_id = ".$_POST['cursus_id'].") as BezettePlekken FROM boten LEFT JOIN typen ON boten.type_id=typen.type_id  WHERE niveau = ".$niveau;
        $rslt = mysqli_query($link, $qry);

        $results[3] = array();
        while ($row = mysqli_fetch_array($rslt)) {
            array_push($results[3], $row);
        }

        $qry = "SELECT i.instructeur_id, i.instructeur_voornaam, i.instructeur_voorletters, i.instructeur_tussenvoegsels, i.instructeur_achternaam, b.bootnaam, k.cursus_id FROM instructeurs i LEFT JOIN koppelinggen k ON i.instructeur_id = k.instructeur_id LEFT JOIN boten b ON k.boot_id = b.boot_id";
        //$qry = "SELECT * FROM instructeurs";
        $rslt = mysqli_query($link, $qry);

        $results[4] = array();

        while ($row = mysqli_fetch_array($rslt)) {
            if($row['cursus_id'] == '' || $row['cursus_id'] == $_POST['cursus_id']){
                $key = $row["instructeur_id"];
                $array = end($results[4]);
                if(!empty($results[4])){
                    if (!in_array($key, $array)) {
                        array_push($results[4], $row);
                    }
                }else{
                    array_push($results[4], $row);
                }
            }

        }

        echo(json_encode($results));
    }

    /* Boot koppelen
    ================================================================================== */
    if($_GET['action'] == '2') {
        //echo(json_encode($_POST));
        $cursus = $_POST['cursus'];
        $gebruikers = $_POST['gebruikers'];
        $boot = $_POST['Boten'];
        $instructeur = $_POST['Instructeur'];
        $insert = array();

        foreach ($gebruikers as $gebruiker) {
            array_push($insert, "(".$boot.",".$cursus.",".$gebruiker.",".$instructeur.")");
        }
        $insert = implode(',' , $insert);

        $qry = "INSERT INTO koppelinggen VALUES ".$insert.";";
        $rslt = mysqli_query($link, $qry);
        if($rslt){
            echo 'query succeed';
        }else{
            echo 'query failed, ' . $qry;
        }
    }

    /* Koppelingen bekijken
    ================================================================================== */
    if($_GET['action'] == '3') {
        //var_dump($_POST);
        $qry = "SELECT c.klant_id, k.cursus_id, b.boot_id, c.voorletters, c.tussenvoegsel, c.achternaam, b.bootnaam, i.instructeur_voorletters, i.instructeur_tussenvoegsels, i.instructeur_achternaam FROM koppelinggen k JOIN klanten c ON k.klant_id = c.klant_id JOIN boten b ON k.boot_id = b.boot_id JOIN instructeurs i ON i.instructeur_id = k.instructeur_id WHERE k.cursus_id = ".$_POST['cursus_id'];
        $rslt = mysqli_query($link, $qry);
        $results = array();
        while ($row = mysqli_fetch_assoc($rslt)) {
            array_push($results, $row);
        }
        echo(json_encode($results));
    }

    /* Koppelingen verwijderen
    ================================================================================== */
    if($_GET['action'] == '4') {

        $qry = "DELETE FROM koppelinggen WHERE boot_id = ".$_POST['boot_id']." AND klant_id = ".$_POST['klant_id']." AND cursus_id = ".$_POST['cursus_id'];
        $rslt = mysqli_query($link, $qry);

        if($rslt){
            echo 'Koppeling verwijderd';
        }else{
            echo 'aanvraag geweigerd';
        }
    }

    /* Generate pdf
    ================================================================================== */
    if($_GET['action'] == '5'){
        $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
        $txt = "John Doe\n";
        fwrite($myfile, $txt);
        $txt = "Jane Doe\n";
        fwrite($myfile, $txt);
        fclose($myfile);
    }
