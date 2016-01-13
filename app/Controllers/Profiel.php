<?php

namespace Controllers;

use Core\View;
use Core\Controller;
use Core\Config;
/**
 * Sample controller showing a construct and 2 methods and their typical usage.
 */
class Profiel extends Controller
{
    /**
     * Call the parent construct
     */
    private $profiel;
    public function __construct()
    {
        parent::__construct();
        $this->profiel = new \Models\Db();
    }

    public function removeBadCharacters($s)
    {
       return str_replace(array('&','<','>','/','\\','"',"'",'?'," "), '', $s);
    }

    public function index()
    {

        $data['title'] = "Profiel";
        $id = \Helpers\Session::get('id');
        

        if ($_POST['submit-gegevens'])
        {   
            if(!empty($_POST['geslacht']) && !empty($_POST['voorletters']) && !empty($_POST['voornaam']) && !empty($_POST['achternaam']) && !empty($_POST['adres']) && !empty($_POST['postcode']) && !empty($_POST['woonplaats']) && !empty($_POST['email']) && !empty($_POST['geboortedatum']) && !empty($_POST['niveau']))
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
                $email = $this->removeBadCharacters($_POST['email']);       
                $geboortedatum = $_POST['geboortedatum'];
                $niveau = $_POST['niveau'];
                
                $this->profiel->updateUser($id, $geslacht,$voorletters, $voornaam, $tussenvoegsel, $achternaam, $adres, $postcode, $woonplaats, $telefoonnummer, $mobiel, $email, $geboortedatum, $niveau);
                //\Helpers\Url::redirect('profiel');
                $data["melding"] = '<div class="alert alert-success alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Gelukt!</strong><br>Uw gegevens zijn succesvol aangepast.</div>';
            }else{
                $data["melding"] = '<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Er is een fout opgetreden.</strong><br>Alle velden moeten ingevuld blijven en er mag geen veld leeg blijven.</div>';
            }
        }

        if ($_POST['submit-wachtwoord'])
        {   
            if(!empty($_POST['wachtwoord']) && !empty($_POST['wachtwoord1']))
            { 

                $wachtwoord = $_POST['wachtwoord'];
                $wachtwoord1 = $_POST['wachtwoord1'];

                if($wachtwoord == $wachtwoord1){
                    $wachtwoord = sha1($wachtwoord);
                    $this->profiel->updateUserPassword($id, $wachtwoord);
                    $data["melding"] = '<div class="alert alert-success alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Gelukt!</strong><br>Uw wachtwoord is succesvol aangepast.</div>';
                }else{
                    $data["melding"] = '<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Er is een fout opgetreden.</strong><br>De twee wachtwoorden moeten hetzelfde zijn.</div>';
                }
            }else{
                $data["melding"] = '<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Er is een fout opgetreden.</strong><br>Vul beide wachtwoord velden in.</div>';
            }
        }       

        $data['klant'] = $this->profiel->getUser($id); 
          
        View::renderTemplate('header', $data);
        View::render('user/profiel', $data);
        View::renderTemplate('footer', $data);
    }


}