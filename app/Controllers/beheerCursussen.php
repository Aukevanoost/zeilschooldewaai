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
    
    public function getData($tabel, $rechten)
    {
        $result = $this->dbCursussen->userData($tabel);
        foreach ($result as $key => $value){
            if ($value->priviledged == $rechten) {
                
            }else
            {
                unset($result[$key]);
            }
        }
        return $result;
    }
    
    public function getTable($sql, $idName)
    {
        $result = $this->dbCursussen->getAllData($sql);
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
        $ret .= "<thead><tr>".$thead."<th></th></tr></thead>";
        foreach ($result as $key => $value) 
        {  
            $ret .= "<tr>";
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
                        <a href='#' data-id='" . $id . "' class='EditRow'><i class='fa fa-pencil-square-o fa-lg'></i></a>&nbsp;
                        <a href='#' data-id='" . $id . "' class='DeleteRow'><i class='fa fa-times fa-lg'></i></a>
                    </td>";
            $ret .= "</tr>";
        }
        $ret .= "</table>";
        return $ret;
    }


    public function index()
    {
        $data['title'] = $this->language->get('beheerCursussen');

        $rechten = \Helpers\Session::get('rechten') - 1;
        //$result = $this->getData('cursussen', $rechten);
        $data["cursussen"] = $this->getTable("SELECT * FROM `cursussen`","cursus_id");

        View::renderTemplate('header', $data);
        View::render('beheer/beheercursussen', $data);
        View::renderTemplate('footer', $data);
    }
}