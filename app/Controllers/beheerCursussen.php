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
        $i = 0;

        foreach ($array as $key => $value) 
        {
            $thead .= "<th>$key</th>";
            $tableNames[$i] = $key;
            $i++;
        }
        $ret = "<table class='table table-hover'><button id='beheerCursussen' class='btn btn-primary'>Toevoegen</button>";
        $ret .= "<thead><tr>".$thead."</tr></thead>";

        foreach ($result as $key => $value) {
            $ret .= "<tr>";
            foreach ($value as $res => $val) {     
                $ret .= "<td>".$val."</td>";
            }
            $ret .= "</tr>";
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