<?php
namespace Controllers;
use Core\View;
use Core\Controller;
use Core\Config;

class cursistKoppelen extends Controller
{
    private $dbKlanten;

    public function __construct()
    {
        parent::__construct();
        $this->Db = new \Models\Db();
    }


    public function index()
    {
        $data['title'] = $this->language->get('Koppelcursisten');

        $rechten = \Helpers\Session::get('rechten') - 1;
        $result = $this->Db->getCursusWithCustomers();
        //
        $i = 1;
        foreach ($result as $key) {
            if($key->inschrijvingen == 0){
                $key->inschrijvingen = '<b style="color: #b20000">'.$key->inschrijvingen.'</b>';
            }else{
                $key->inschrijvingen = '<b style="color: #458B00">'.$key->inschrijvingen.'</b>';
            }
            switch ($key->niveau) {
                case 1: $key->niveau = "Beginner";    break;
                case 2: $key->niveau = "Ervaren";     break;
                case 3: $key->niveau = "Wadtocht";    break;
            }

            $data["cursussen"] .= '
                <tr>
                    <td>' . $i . '</td>
                    <td>' . $key->cursusnaam . '</td>
                    <td><b>' . date("d / m / Y",strtotime($key->startdatum)) . '</b></td>
                    <td>' . $key->niveau . '</td>
                    <td>' . $key->inschrijvingen . ' Cursist(en)</td>
                    <td style="text-align: right">
                        <a href="#" data-id="' . $key->cursus_id . '" class="BekijkKoppelingen"><i class="fa fa-link fa-lg"></i></a>&nbsp;
                        <a href="#" data-id="' . $key->cursus_id . '" class="KoppelRij"><i class="fa fa-anchor fa-lg"></i></a>&nbsp;
                        <a href="#" data-id="' . $key->cursus_id . '" class="DownloadCursus"><i class="fa fa-download fa-lg"></i></a>
                    </td>
                </tr>
            ';
            $i++;
        }

        View::renderTemplate('header', $data);
        View::render('beheer/cursistkoppelen', $data);
        View::renderTemplate('footer', $data);
    }
}