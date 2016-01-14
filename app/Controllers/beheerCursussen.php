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
        $result = $this->dbBeheer->getAllCourses();

        return $result;
    }

    public function index()
    {
        $data['title'] = $this->language->get('beheerCursussen');

        $data['cursussen'] = $this->dbCursussen->getCursussen();

        View::renderTemplate('header', $data);
        View::render('boten/overzicht', $data);
        View::renderTemplate('footer', $data);
    }
}