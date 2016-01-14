<?php
/**
 * Cursussen Sectie controller
 */

namespace Controllers;

use Core\View;
use Core\Controller;

/**
 * Sample controller showing a construct and 2 methods and their typical usage.
 */
class Cursussen extends Controller
{

    /**
     * Call the parent construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->language->load('Home');
        $this->Database = new \Models\Db();
    }

    public function index()
    {
        $data['title'] = $this->language->get('Cursussen');
        $data['home_message'] = $this->language->get('no message');

        $data['Courses'] = $this->Database->getAllCourses();
        $data['CoursesOverzicht'] = $this->Database->getAllCoursesOverzicht();
        View::renderTemplate('header', $data);
        View::render('cursussen/overzicht', $data);
        View::renderTemplate('footer', $data);
    }

    public function validatie(){
        /* Pagina */
        $data['title'] = $this->language->get('No permission');
        $data['home_message'] = $this->language->get('no message');
        View::renderTemplate('header', $data);

        /* Klant gegevens */
        $klant = $this->Database->getUser($_POST['user_id']);

        if($klant[0]->geslacht == 'man'){
            $aanhef = 'Dhr.';
        } else {
            $aanhef = 'Mevr.';
        }

        if($klant[0]->tussenvoegsel != ''){
            $aanhef = $aanhef.' ' . $klant[0]->voorletters .' '.$klant[0]->tussenvoegsel . ' ' .$klant[0]->achternaam;
        }else {
            $aanhef = $aanhef.' ' . $klant[0]->voorletters . ' ' . $klant[0]->achternaam;
        }
        $email = $klant[0]->email;

        /* Cursus gegevens */
        $cursus = $this->Database->getCursus($_POST['cursus_id']);

        $body = '
'.$aanhef.'
<br /><br />
We hebben uw inschrijving met succes ontvangen, <br />
hieronder ziet u nog even alle gegevens op een rijtje.
<br /><br />
<table>
    <tr>
        <td width="200px"><b>Cursus: </b></td>
        <td>'.$cursus[0]->cursusnaam.'</td>
    </tr>
    <tr>
        <td><b>Prijs: </b></td>
        <td>&euro; '.$cursus[0]->cursusprijs.'</td>
    </tr>
    <tr>
        <td><b>startdatum: </b></td>
        <td>'.date("j M Y",strtotime($cursus[0]->startdatum)).'</td>
    </tr>
    <tr>
        <td><b>einddatum: </b></td>
        <td>'.date("j M Y",strtotime($cursus[0]->einddatum)).'</td>
    </tr>
    <tr>
        <td><b>Opmerking: </b></td>
        <td>'.$_POST['comment'].'</td>
    </tr>
</table>
<br />
U krijgt nog een herinnering 14 dagen voor de cursus, wij wensen u veel zeilplezier en tot ziens.
<br /><br />
Zeilteam de Waai.
        ';

        $mail = new \Helpers\PhpMailer\Mail();
        $mail->addAddress($email);
        $mail->subject('Inschrijving cursus: ' . $cursus[0]->cursusnaam);
        $mail->body($body);
        $mail->Send();

        View::render('cursussen/validatie', $data);
        View::renderTemplate('footer', $data);

    }
}
