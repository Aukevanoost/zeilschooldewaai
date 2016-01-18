<?php
namespace Controllers;
use Core\View;
use Core\Controller;
use Core\Config;

class beheerKlanten extends Controller
{
    private $dbKlanten;

    public function __construct()
    {
        parent::__construct();
        $this->dbKlanten = new \Models\Db();
    }

    public function getData($tabel, $rechten)
    {
        $result = $this->dbKlanten->userData($tabel);
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
        $result = $this->dbKlanten->insertData($tabel, $values);
    }

    public function updateData($tabel, $values)
    {
        $result = $this->dbKlanten->updateData($tabel, $values);
    }

    public function deleteData($tabel, $where)
    {
        $result = $this->dbKlanten->updateData($tabel, $where);
    }

    public function index()
    {
        $data['title'] = $this->language->get('beheer klanten');

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
        View::render('beheer/beheerklanten', $data);
        View::renderTemplate('footer', $data);
    }
}