<?php

namespace Controllers;

use Core\View;
use Core\Controller;

/**
 * Sample controller showing a construct and 2 methods and their typical usage.
 */
class Voorwaarden extends Controller
{

    /**
     * Call the parent construct
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = $this->language->get('Voorwaarden');

        View::renderTemplate('header', $data);
        View::render('home/voorwaarden', $data);
        View::renderTemplate('footer', $data);
    }
}
