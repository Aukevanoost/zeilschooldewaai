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

    public function getTable($sql, $idName)
    {
        $result = $this->dbBeheer->getAllData($sql);
        $array = get_object_vars($result[0]);
        $thead = "";
        $i = 0;

        foreach ($array as $key => $value) 
        {
            if ($key == $idName) {
                $tableNames[$i] = $key;
            }
            else
            {
                $thead .= "<th>$key</th>";
                $tableNames[$i] = $key;  
            }
            $i++;
        }
        $ret = "<table class='table table-hover'><button id='".$idName."' class='btn btn-primary'>Toevoegen</button>";
        $ret .= "<thead><tr><th>#</th>".$thead."<th></th></tr></thead>";
        $number=1;
        foreach ($result as $key => $value) 
        {  
            $ret .= "<tr><td>".$number."</td>";
            $number++;
            $i = 0;
            foreach ($value as $res => $val) 
            {   
                if ( $tableNames[$i] == $idName) 
                {
                      $id = $val;
                }  
                else
                {
                    $ret .= "<td>".$val."</td>";
                }
                $i++;
            }
            $ret .= "<td style='text-align: right'>
                        <a href='#' data-id='" . $id . "' class='".$idName."EditRow'><i class='fa fa-pencil-square-o fa-lg'></i></a>&nbsp;
                        <a href='#' data-id='" . $id . "' class='DeleteRow'><i class='fa fa-times fa-lg'></i></a>
                    </td>";
            $ret .= "</tr>";
        }
        $ret .= "</table>";

        return $ret;
    }

    public function beheer()
    {
        $data['title'] = $this->language->get('Beheer');

        $rechten = \Helpers\Session::get('rechten') - 1;

        $data["users"] .= $this->getTable("SELECT voornaam, tussenvoegsel, achternaam, email FROM `klanten` WHERE priviledged =".$rechten, "klant_id");
        
        View::renderTemplate('header', $data);
        View::render('beheer/beheer', $data);
        View::renderTemplate('footer', $data);
    }

    public function instructeur(){
        $data['title'] = $this->language->get('Instructeurbeheer');

        $data["instructeurs"] .= $this->getTable("SELECT * FROM `instructeurs`", "instructeur_id");
        
        View::renderTemplate('header', $data);
        View::render('beheer/instructeur', $data);
        View::renderTemplate('footer', $data);
    }

    public function beheerBoten()
    {
        $data["boten"] = $this->getTable("SELECT bootnaam, bouwjaar, `typen`.boottype FROM `boten` JOIN `typen` ON `boten`.`type_id`=`typen`.`type_id`", "boot_id");

        View::renderTemplate('header', $data);
        View::render('beheer/beheerboten', $data);
        View::renderTemplate('footer', $data);
    }

    public function beheerCursussen()
    {
        $data['title'] = $this->language->get('beheerCursussen');

        $data['cursussen'] = $this->getTable("SELECT cursus_id, cursusnaam, cursusprijs, cursusomschrijving, startdatum, einddatum FROM `cursussen`", "cursus_id");

        View::renderTemplate('header', $data);
        View::render('beheer/beheercursussen', $data);
        View::renderTemplate('footer', $data);
    }

    public function cursistKoppelen()
    {
        View::renderTemplate('header', $data);
        View::render('beheer/cursistKoppelen', $data);
        View::renderTemplate('footer', $data);
    } 
}