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
        $result = $this->dbCursussen->getAllCourses();
        $ret = "<table class='table table-hover'><thead><tr><th>cursusnaam</th></th><th>cursusprijs</th><th>cursusomschrijving</th><th>startdatum</th><th>einddatum</th><th></th><th></th></tr></thead>";
        foreach ($result as $key) {
            $ret .= "<tr><td>".$key->cursusnaam."</td><td>".$key->cursusprijs."</td><td>".$key->cursusomschrijving."</td><td>".$key->startdatum."</td><td>".$key->einddatum."</td><td>A</td><td>R</td></tr>";
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