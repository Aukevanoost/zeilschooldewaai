<?php

namespace Controllers;

use Core\View;
use Core\Controller;
use Core\Config;

class Profiel extends Controller
{


    private $profiel;

    // Constructor
    public function __construct()
    {
        parent::__construct();
        $this->profiel = new \Models\Db();
    }

    // Een functie om alle verkeerde karakters te verwijderen voordat het naar de DB gestuurd wordt.
    public function removeBadCharacters($s)
    {
       return str_replace(array('&','<','>','/','\\','"',"'",'?'), '', $s);
    }

    // De zichtbare pagina voor Profiel
    public function index()
    {
        $data['title'] = "Profiel";
        $id = \Helpers\Session::get('id');

        // De post voor het uitschrijven van een cursus van een klant.
        if($_POST['submit-uitschrijven']){
            $cursus_id = $_POST['cursus_id'];
            $query = array('klant_id' => $id, 'cursus_id' => $cursus_id);
            $this->profiel->deleteData("inschrijvingen", $query);
            
            // Melding dat hij is uitgeschreven.
            $data["melding"] = '<div class="alert alert-success alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Gelukt!</strong><br>U bent uitgeschreven op de cursus.</div>';
        }
        
        // De post voor het verwerken en aanpassen van de gegevens.
        if ($_POST['submit-gegevens'])
        {   
            // Kijken of er geen velden leeg zijn
            if(!empty($_POST['geslacht']) && !empty($_POST['voorletters']) && !empty($_POST['voornaam']) && !empty($_POST['achternaam']) && !empty($_POST['adres']) && !empty($_POST['postcode']) && !empty($_POST['woonplaats']) && !empty($_POST['geboortedatum']) && !empty($_POST['niveau']))
            { 

                $geslacht = $_POST['geslacht'];
                $voorletters = $this->removeBadCharacters($_POST['voorletters']);
                $voornaam = $this->removeBadCharacters($_POST['voornaam']);
                $tussenvoegsel = $this->removeBadCharacters($_POST['tussenvoegsel']);
                $achternaam = $this->removeBadCharacters($_POST['achternaam']);
                $adres = $this->removeBadCharacters($_POST['adres']);
                $postcode = $this->removeBadCharacters($_POST['postcode']);
                $woonplaats = $this->removeBadCharacters($_POST['woonplaats']);
                $telefoonnummer = $this->removeBadCharacters($_POST['telefoonnummer']);
                $mobiel = $this->removeBadCharacters($_POST['mobiel']);    
                $geboortedatum = $_POST['geboortedatum'];
                $niveau = $_POST['niveau'];

                // Regex van de postcode.
                $regex = '~\A[1-9]\d{3} ?[a-zA-Z]{2}\z~';
                if (preg_match($regex, $postcode)) {
                    // Hier binnen is het gelukt en gaat hij de aanpassingen doorsturen naar de database.
                    $this->profiel->updateUser($id, $geslacht,$voorletters, $voornaam, $tussenvoegsel, $achternaam, $adres, $postcode, $woonplaats, $telefoonnummer, $mobiel, $geboortedatum, $niveau);
                    
                    // Melding dat het gelukt is.
                    $data["melding"] = '<div class="alert alert-success alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Gelukt!</strong><br>Uw gegevens zijn succesvol aangepast.</div>';
                }
                else
                {
                    // De postcode is onjuist.
                    $data["melding"] = '<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Er is een fout opgetreden.</strong><br>De postcode is onjuist</div>';
                }
            }else{
                // Niet alle velden zijn ingevuld.
                $data["melding"] = '<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Er is een fout opgetreden.</strong><br>Alle velden moeten ingevuld blijven en er mag geen veld leeg blijven.</div>';
            }
        }

        // De post voor het verwerken en aanpassen van het nieuwe wachtwoord.
        if ($_POST['submit-wachtwoord'])
        {   
            // Kijk of beide wachtwoorden ingevuld zijn
            if(!empty($_POST['wachtwoord']) && !empty($_POST['wachtwoord1']))
            { 

                $wachtwoord = sha1($_POST['wachtwoord']);
                $wachtwoord1 = sha1($_POST['wachtwoord1']);

                // Bekijken of de twee wachtwoorden hetzelfde zijn.
                if($wachtwoord == $wachtwoord1){

                    // Is het wachtwoord 8 karakters lang?
                    if(strlen($wachtwoord >= 8)){

                        //Hash het wachtwoord.
                        $wachtwoord = sha1($wachtwoord);
                        $this->profiel->updateUserPassword($id, $wachtwoord);

                        // Melding dat het gelukt is.
                        $data["melding"] = '<div class="alert alert-success alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Gelukt!</strong><br>Uw wachtwoord is succesvol aangepast.</div>';
                    }else{
                        //Een error melding dat het wachtwoord niet lang genoeg is.
                        $data["melding"] = '<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Er is een fout opgetreden.</strong><br>Uw wachtwoord moet minimaal 8 karakters hebben.</div>';                            
                    }

                }else{
                    // De twee wachtwoorden zijn niet hetzelfde.
                    $data["melding"] = '<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Er is een fout opgetreden.</strong><br>De twee wachtwoorden moeten hetzelfde zijn.</div>';
                }
            }else{
                // De beide wachtwoorden zijn niet ingevuld.
                $data["melding"] = '<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Er is een fout opgetreden.</strong><br>Vul beide wachtwoord velden in.</div>';
            }
        }       

        // De data die van de database file komen opslaan in de data variabel zodat hij in de view file gebruikt kan worden.
        $data['klant'] = $this->profiel->getUser($id);
        $data['cursussen'] = $this->profiel->getInschrijvingen($id);
          
        View::renderTemplate('header', $data);
        View::render('user/profiel', $data);
        View::renderTemplate('footer', $data);
    }


}
