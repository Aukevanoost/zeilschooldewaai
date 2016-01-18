<?php

namespace Controllers;

use Core\View;
use Core\Controller;
use Core\Config;

class Login extends Controller
{
    //De variable waar de database model in geladen zal worden.
    private $login;
    public function __construct()
    {
        parent::__construct();
        //Laad de database in en zet hem in de variable login.
        $this->login = new \Models\Db();
    }

    public function index()
    {
        //Data voor een actief menu item.
        $data['title'] = "Login";

        //Zet de email en wachtwoord in variable.
        $user = $_POST["username"];
        //Sha1 voor een hash van het wachtwoord.
        $pass = sha1($_POST["password"]);
        
        //Checkt of er een post is gegeven.
        if ($_POST) 
        {
            //Haalt informatie van de gebruiker uit de database.
            $passw = $this->login->pushUsers($user);
            //Checkt of het ingevulde gehashede wachtwoord overeen komt met het gehashede wachtwoord in de database.
            if ($pass == $passw[0]->wachtwoord) 
            {
                //Checkt of de email validatie voltooid is.
                if (!$passw[0]->priviledged == 0) 
                {
                    //Zet sessies voor de gebruikersnaam klant_id en de gegeven rechten.
                    \Helpers\Session::set('username', $user);
                    \Helpers\Session::set('id', $passw[0]->klant_id);
                    \Helpers\Session::set('rechten', $passw[0]->priviledged);
                    //Stuurt je door naar de homepagina.
                    if ($passw[0]->priviledged == 3) 
                    {
                        \Helpers\Url::redirect('beheer'); 
                    }
                    elseif ($passw[0]->priviledged == 2) 
                    {
                        \Helpers\Url::redirect('beheerklanten'); 
                    }
                    else
                    {
                        \Helpers\Url::redirect('home'); 
                    }
                    
                }
                else
                {
                    //Een error melding voor als de email niet geregistreerd is.
                    $data["error"] = '<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Activeer uw e-mail.</strong><br>Uw account is nog niet geactiveerd, check uw mail.</div>';
                }
            }
            else
            {
                //Een error melding als het wachtwoord niet overeen komt met de ingevulde gebruiker in de database.
                $data["error"] = '<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Er is een fout opgetreden.</strong><br>Dit account wordt niet herkent.</div>';
            } 
        }

        //Geeft de user door naar de view.
        $data["user"] = $user;
        //Laad de view bij de login pagina.
        View::renderTemplate('header', $data);
        View::render('user/login', $data);
        View::renderTemplate('footer', $data);
    }
    public function loguit()
    {
        //Unset de sessions.
        \Helpers\Session::destroy('username');
        \Helpers\Session::destroy('id');
        \Helpers\Session::destroy('rechten');
        //Stuurt je door naar de homepagina.
        \Helpers\Url::redirect('home');
    }
}