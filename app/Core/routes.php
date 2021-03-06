<?php
/**
 * Routes - all standard routes are defined here.
 *
 * @author David Carr - dave@daveismyname.com
 * @version 2.2
 * @date updated Sept 19, 2015
 */

/** Create alias for Router. */
use Core\Router;
use Helpers\Hooks;

/* Landing sectie */
Router::any('', 'Controllers\Home@index');
Router::any('home', 'Controllers\Home@index');
Router::any('overons', 'Controllers\Home@overons');
Router::any('contact', 'Controllers\Contact@index');
Router::any('developers', 'Controllers\Home@developers');

/* Boten sectie */
Router::any('boten', 'Controllers\Boten@index');

/* Cursussen sectie */
Router::any('cursussen', 'Controllers\Cursussen@index');
Router::any('cursussen/validatie', 'Controllers\Cursussen@validatie');

/* User sectie */
Router::any('login', 'Controllers\Login@index');
Router::any('registreren', 'Controllers\Registreren@index');
Router::get('registreren/(:all)', 'Controllers\Registreren@post');
Router::any('activatie', 'Controllers\Registreren@activatie');
Router::any('profiel', 'Controllers\Profiel@index');
Router::any('loguit', 'Controllers\Login@loguit');

/* beheer sectie */
Router::any('beheer', 'Controllers\Beheer@beheer');
Router::any('beheercursussen', 'Controllers\beheer@beheerCursussen');
Router::any('beheerklanten', 'Controllers\beheer@beheerKlanten');
Router::any('beheerboten', 'Controllers\beheer@beheerBoten');
Router::any('beheerinstructeurs', 'Controllers\Beheer@instructeur');
Router::any('cursistkoppelen', 'Controllers\beheer@cursistKoppelen');
Router::any('createpdf/(:num)', 'Controllers\beheer@createPdf');


/** Module routes. */
$hooks = Hooks::get();
$hooks->run('routes');

/** If no route found. */
Router::error('Core\Error@index');

/** Turn on old style routing. */
Router::$fallback = false;

/** Execute matched routes. */
Router::dispatch();
