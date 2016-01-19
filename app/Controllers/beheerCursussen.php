<?php
namespace Controllers;

use Core\View;
use Core\Controller;
use Core\Config;

class beheerCursussen extends Controller
{
    private $dbCursussen;

    public function __construct()
    {
        parent::__construct();
        $this->dbCursussen = new \Models\Db();
    }

    public function getCursussen()
    {
        $sql = "SELECT cursusnaam, cursusprijs, cursusomschrijving, startdatum, einddatum FROM `cursussen`";
        $result = $this->dbCursussen->getAllData($sql);
        $array = get_object_vars($result[0]);
        $thead = "";
        foreach ($array as $key => $value) {
            $thead .= "<th>$key</th>";
        }
        $ret = "<table class='table table-hover'><button id='beheerCursussen' class='btn btn-primary'>Toevoegen</button>";
        $ret .= "<thead><tr>".$thead."</tr></thead>";
        foreach ($result as $key) {
            $ret .= "<tr><td>".$key->cursusnaam."</td><td>".$key->cursusprijs."</td><td>".$key->cursusomschrijving."</td><td>".$key->startdatum."</td><td>".$key->einddatum."</td><td><i class='fa fa-pencil'></i></td><td><i class='fa fa-times'></i></td></tr>";
        }
        $ret .= "</table>";

        return $ret;
    }

    public function index()
    {
        $data['title'] = $this->language->get('beheerCursussen');

        $data['cursussen'] = $this->getCursussen();

        View::renderTemplate('header', $data);
        View::render('beheer/beheercursussen', $data);
        View::renderTemplate('footer', $data);
    }
}