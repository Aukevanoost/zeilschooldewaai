<?php
/**
 * Welcome controller
 *
 * @author David Carr - dave@daveismyname.com
 * @version 2.2
 * @date June 27, 2014
 * @date updated Sept 19, 2015
 */

namespace Controllers;

use Core\View;
use Core\Controller;

/**
 * Sample controller showing a construct and 2 methods and their typical usage.
 */
class Home extends Controller
{

    /**
     * Call the parent construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->language->load('Home');
    }

    public function index()
    {
        $data['title'] = $this->language->get('Home');
        $data['home_message'] = $this->language->get('home_message');

        View::renderTemplate('header', $data);
        View::render('home/home', $data);
        View::renderTemplate('footer', $data);
    }
    public function overons()
    {
        $data['title'] = $this->language->get('Over ons');
        $data['home_message'] = $this->language->get('no message');

        View::renderTemplate('header', $data);
        View::render('home/overons', $data);
        View::renderTemplate('footer', $data);
    }

    public function developers(){
        $data['title'] = $this->language->get('Developerteam');

        View::renderTemplate('header', $data);
        View::render('home/developers', $data);
        View::renderTemplate('footer', $data);
    }
}
