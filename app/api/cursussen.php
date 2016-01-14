<?php
    /* DB Connection
    ================================================================================== */
    $link = mysqli_connect('localhost', 'root', '', 'zeilschooldewaai');
    if(!$link){
        echo 'could not connect to db';
    }


    /* Read
    ================================================================================== */

    if($_GET['action'] == '1'){
        if(isset($_POST['voorwaarden'])){
            $password = sha1($_POST['password']);
            $klant = $_POST['user_id'];

            $qry = "SELECT * FROM klanten WHERE wachtwoord = '$password' AND klant_id = '$klant'";
            $rslt = mysqli_query($link, $qry);
            $SearchUser = mysqli_num_rows($rslt);

            if($SearchUser >= 1){
                $cursus = $_POST['cursus'];
                $comments = addslashes($_POST['comments']);

                $qry = "SELECT * FROM inschrijvingen WHERE cursus_id = '$cursus' AND klant_id = '$klant'";
                $rslt = mysqli_query($link, $qry);
                $countRows = mysqli_num_rows($rslt);

                if($countRows == 0){
                    $qry = "INSERT INTO inschrijvingen (cursus_id,klant_id,Opmerkingen) VALUES ($cursus, $klant,'$comments');";
                    $rslt = mysqli_query($link, $qry);

                    if($rslt){
                        $qry = "SELECT * FROM cursussen WHERE cursus_id = '$cursus'";
                        $rslt = mysqli_query($link, $qry);

                        $results = array();
                        while ($row = mysqli_fetch_assoc($rslt)) {
                            $results[] = $row;
                        }
                        $results[0]["startdatum"] = date("j M Y",strtotime($results[0]["startdatum"]));
                        $results[0]["einddatum"] = date("j M Y",strtotime($results[0]["einddatum"]));

                        echo(json_encode($results));
                    }else{
                        echo 'Query Failed: '.$qry;
                    }
                }else{
                    echo 'Inschrijving bestaat al';
                }
            }else{
                echo 'Wachtwoord verkeerd';
            }
        }else{
            echo 'voorwaarden niet geaccepteerd';
        }
    }