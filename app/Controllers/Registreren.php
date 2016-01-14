<?php
/**
 * Welcome controller
 *
 * @author David Carr - dave@daveismyname.com
 * @version 2.2
 * @date June 27, 2014
 * @date updated Sept 19, 2015
 */

namespace Controllers;

use Core\View;
use Core\Controller;
use Core\Config;

class Registreren extends Controller
{
    //De variable waar de database model in geladen zal worden.
    private $registreren;
    public function __construct()
    {
        parent::__construct();
        //Laad de database in en zet hem in de variable registreren.
        $this->registreren = new \Models\Db();
    }

    public function sendValidateMail($email)
    {
        //Maakt een unieke url aan die de klant als email zal ontvangen.
        $url = md5($email."halloditisvoordezewebsitezeilschooldewaai@@@#!");

        //Roept de mail class aan, en zet de benodigde parameters.
        $mail = new \Helpers\PhpMailer\Mail();
        $mail->addAddress($email);
        $mail->subject('Zeilschool de waai validatie');
        $mail->body("Hallo, door op deze <a href='http://ruudlouwerse.nl/zeilschooldewaai/registreren/".$url."'>Link</a> te klikken activeert u uw account ");
        //Stuurt de email naar de nieuwe klant (Weggeslashed doordat dit op localhost niet werkt).
        //$mail->Send();
        //Stuurt de url terug om in de database gezet te worden.
        return $url;
    }

    public function post($slug)
    {
        //Checkt of de aangemaakt url matched aan één van de url's in de database.
        $check = $this->registreren->validateUser($slug);
        if(count($check) == 1){
            //Als er een gebruiker gelinkt is word het account geactiveerd.
            $this->registreren->givePrivilage($check[0]->klant_id);
        }
        //Linkt je naar de succes pagina.
        \Helpers\Url::redirect('activatie');
    }

    public function activatie()
    {
        //Laad de view voor de activatie pagina.
        View::renderTemplate('header', $data);
        View::render('user/activatie', $data);
        View::renderTemplate('footer', $data);
    }

    public function index()
    {
        //Data voor een actief menu item.
        $data['title'] = $this->language->get('Registreren');

        //Checkt of er gepost is.
        if ($_POST)
        {   
            $form_captcha = $_POST['g-recaptcha-response'];
            //Checkt of de captcha correct in ingevult.
            if($form_captcha == 0)
            {
                //Error als de captcha incorrect is.
                $data["melding"] = '<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Er is een fout opgetreden.</strong><br>De captcha is niet ingevuld.</div>';
            }
            //Checkt of de form data gevult is.
            else if(!empty($_POST['geslacht']) && !empty($_POST['voorletters']) && !empty($_POST['voornaam']) && !empty($_POST['achternaam']) && !empty($_POST['adres']) && !empty($_POST['postcode']) && !empty($_POST['woonplaats']) && !empty($_POST['email']) && !empty($_POST['niveau']) && !empty($_POST['date']) && !empty($_POST['password']))
            {
                //Zet alle post data in een variable.
                $geslacht = $_POST['geslacht'];
                $voorletters = $_POST['voorletters'];
                $voornaam = $_POST['voornaam'];
                $tussenvoegsel = $_POST['tussenvoegsel'];
                $achternaam = $_POST['achternaam'];
                $adres = $_POST['adres'];
                $postcode = $_POST['postcode'];
                $woonplaats = $_POST['woonplaats'];
                $telefoonnummer = $_POST['tel'];
                $mobiel = $_POST['mobiel'];
                $email = $_POST['email'];       
                $niveau = $_POST['niveau'];
                $geboortedatum = $_POST['date'];
                //hashed het wachtwoord.
                $wachtwoord = sha1($_POST["password"]);
                $wachtwoord1 = sha1($_POST["password1"]);
                

                //regex van de postcode.
                $regex = '~\A[1-9]\d{3} ?[a-zA-Z]{2}\z~';
                if (preg_match($regex, $postcode)) {
                    //Kijkt of de wachtwoorden overeen komen.
                    if($wachtwoord == $wachtwoord1)
                    {
                        if(strlen($wachtwoord >= 8)){
                            //Er word gekeken of de email al bestaad in de database.
                            $check = $this->registreren->checkEmail($email);
                            if (count($check) == 0) 
                            {
                                //Stuurt een email met een unieke url naar de gebruiker.
                                $url = $this->sendValidateMail($email);
                                //Ze de gegevens van de klant in de database.
                                $this->registreren->insertUsers($geslacht,$voorletters, $voornaam, $tussenvoegsel, $achternaam, $adres, $postcode, $woonplaats, $telefoonnummer, $mobiel, $email, $niveau, $geboortedatum, $wachtwoord, $url);
                                //Je word doorgestuurd naar de login pagina.
                                \Helpers\Url::redirect('login');
                            }
                            else
                            {
                                //Een error melding als de email al bestaad in de database.
                                $data["melding"] = '<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Er is een fout opgetreden.</strong><br>Uw email is al geregeristreerd.</div>';
                            }
                        }else{
                            //Een error melding dat het wachtwoord niet lang genoeg is.
                            $data["melding"] = '<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Er is een fout opgetreden.</strong><br>Uw wachtwoord moet minimaal 8 karakters hebben.</div>';                            
                        }

                    }
                    else
                    {
                        //Een error melding als de ingevulde wachtwoorden niet overeen komen.
                        $data["melding"] = '<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Er is een fout opgetreden.</strong><br>De wachtwoorden zijn niet hetzelfde.</div>';
                    }
                }
                else
                {
                    // Een error melding dat de postcode onjuist is.
                    $data["melding"] = '<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Er is een fout opgetreden.</strong><br>De postcode is onjuist</div>';
                }

            }
            else
            {
                //Een error melding als de captcha niet juist ingevult is.
                $data["melding"] = '<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Er is een fout opgetreden.</strong><br>De captcha of alle velden zijn niet allemaal ingevuld.</div>';
            }
        }
        
        //Laad de view bij de registratie pagina.
        View::renderTemplate('header', $data);
        View::render('user/registreren', $data);
        View::renderTemplate('footer', $data);
        
    }
    
}
