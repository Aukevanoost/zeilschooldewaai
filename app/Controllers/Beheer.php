<?php
namespace Controllers;
use Core\View;
use Core\Controller;
use Core\Config;

class Beheer extends Controller
{
    private $dbBeheer;

    public function __construct()
    {
        parent::__construct();
        $this->dbBeheer = new \Models\Db();
    }

    public function getData($tabel, $rechten)
    {
        $result = $this->dbBeheer->userData($tabel);
        foreach ($result as $key => $value){
            if ($value->priviledged == $rechten) {
                
            }else
            {
                unset($result[$key]);
            }
        }
        return $result;
    }

    public function insertData($tabel, $values)
    {
        $result = $this->dbBeheer->insertData($tabel, $values);
    }

    public function updateData($tabel, $values)
    {
        $result = $this->dbBeheer->updateData($tabel, $values);
    }

    public function deleteData($tabel, $where)
    {
        $result = $this->dbBeheer->updateData($tabel, $where);
    }

    public function beheer()
    {
        $data['title'] = $this->language->get('Beheer');

        $rechten = \Helpers\Session::get('rechten') - 1;
        $result = $this->getData('klanten', $rechten);
        $i = 1;
        foreach ($result as $key) {
            $data["users"] .= '
                <tr>
                    <td>' . $i . '</td>
                    <td>' . $key->voornaam . '</td>
                    <td>' . $key->tussenvoegsel . '</td>
                    <td>' . $key->achternaam . '</td>
                    <td>' . $key->email . '</td>
                    <td style="text-align: right">
                        <a href="#" data-id="' . $key->klant_id . '" class="EditRow"><i class="fa fa-pencil-square-o fa-lg"></i></a>&nbsp;
                        <a href="#" data-id="' . $key->klant_id . '" class="DeleteRow"><i class="fa fa-times fa-lg"></i></a>
                    </td>
                </tr>
            ';
            $i++;
        }
        
        View::renderTemplate('header', $data);
        View::render('beheer/beheer', $data);
        View::renderTemplate('footer', $data);
    }

    public function instructeur(){
        $data['title'] = $this->language->get('Instructeurbeheer');

        $result = $this->dbBeheer->userData('Instructeurs');
        $i = 1;
        foreach ($result as $key) {
            $data["instructeurs"] .= '
                <tr>
                    <td>' . $i . '</td>
                    <td>' . $key->instructeur_voornaam . '</td>
                    <td>' . $key->instructeur_voorletters . '</td>
                    <td>' . $key->instructeur_tussenvoegsels. '</td>
                    <td>' . $key->instructeur_achternaam . '</td>
                    <td>' . $key->instructeur_geslacht . '</td>
                    <td style="text-align: right">
                        <a href="#" data-id="'.$key->instructeur_id.'" class="EditInstructeur"><i class="fa fa-pencil fa-lg"></i></a>&nbsp;
                        <a href="#" data-id="'.$key->instructeur_id.'" class="DeleteInstructeur"><i class="fa fa-times fa-lg"></i></a>
                    </td>
                </tr>
            ';
            $i++;
        }

        View::renderTemplate('header', $data);
        View::render('beheer/instructeur', $data);
        View::renderTemplate('footer', $data);
    }
}