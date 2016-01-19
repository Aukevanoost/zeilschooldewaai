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
                $thead .= str_replace("instructeur_","","<th>$key</th>");
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
                        <a href='#' data-id='" . $id . "' class='".$idName."DeleteRow'><i class='fa fa-times fa-lg'></i></a>
                    </td>";
            $ret .= "</tr>";
        }
        $ret .= "</table>";

        return $ret;
    }

    public function checkValidation($needed)
    {
        if (\Helpers\Session::get('rechten')==$needed) 
        {
            return true;
        }
        else
        {
            View::renderTemplate('header', $data);
            View::render('error/403', $data);
            View::renderTemplate('footer', $data);
        }
    }

    public function beheer()
    {
        $this->checkValidation(3);

        $rechten = \Helpers\Session::get('rechten') - 1;

        $data["users"] .= $this->getTable("SELECT klant_id, voornaam, tussenvoegsel, achternaam, email FROM `klanten` WHERE priviledged =".$rechten, "klant_id");
        
    
        View::renderTemplate('header', $data);
        View::render('beheer/beheer', $data);
        View::renderTemplate('footer', $data);
    }

    public function instructeur()
    {
        $this->checkValidation(2);

        $data['title'] = $this->language->get('beheer instructeurs');

        $data["instructeurs"] .= $this->getTable("SELECT * FROM `instructeurs`", "instructeur_id");

        View::renderTemplate('header', $data);
        View::render('beheer/instructeur', $data);
        View::renderTemplate('footer', $data);
    }

    public function beheerBoten()
    {

        $data["boten"] = $this->getTable("SELECT boot_id, bootnaam, bouwjaar, `typen`.boottype FROM `boten` JOIN `typen` ON `boten`.`type_id`=`typen`.`type_id`", "boot_id");


        $this->checkValidation(2);

        $data['title'] = $this->language->get('beheer boten');

        View::renderTemplate('header', $data);
        View::render('beheer/beheerboten', $data);
        View::renderTemplate('footer', $data);
    }
    
    public function beheerCursussen()
    {
        $this->checkValidation(2);


        $data['title'] = $this->language->get('beheer cursussen');

        $data['cursussen'] = $this->getTable("SELECT cursus_id, cursusnaam, cursusprijs, cursusomschrijving, startdatum, einddatum FROM `cursussen`", "cursus_id");

        View::renderTemplate('header', $data);
        View::render('beheer/beheercursussen', $data);
        View::renderTemplate('footer', $data);
    }

    public function beheerKlanten()
    {
        $this->checkValidation(2);

        $data['title'] = $this->language->get('beheer klanten');

        $rechten = \Helpers\Session::get('rechten') - 1;
        $data["users"] = $this->getTable("SELECT klant_id, voornaam, tussenvoegsel, achternaam, email FROM `klanten` WHERE priviledged=".$rechten, "klant_id");
        
        View::renderTemplate('header', $data);
        View::render('beheer/beheerklanten', $data);
        View::renderTemplate('footer', $data);
    }

    public function createPdf($query)
    {
        $this->checkValidation(2);

        //http://www.fpdf.org/

        $qry = "SELECT c.klant_id, cu.cursusnaam, k.cursus_id, b.boot_id, c.voorletters, c.tussenvoegsel, c.achternaam, b.bootnaam, i.instructeur_voorletters, i.instructeur_tussenvoegsels, i.instructeur_achternaam FROM koppelinggen k JOIN klanten c ON k.klant_id = c.klant_id JOIN boten b ON k.boot_id = b.boot_id JOIN instructeurs i ON i.instructeur_id = k.instructeur_id JOIN cursussen cu ON cu.cursus_id = k.cursus_id WHERE k.cursus_id =".$query;
        $result = $this->dbBeheer->getAllData($qry);
        $pdf = new \Models\FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','',12);
        $pdf->Image('http://localhost/zeilschooldewaai/app/templates/default/img/logo.png',125,10,-100);

        $i=0;
        $pdf->Ln(30);
        $pdf->SetFont('Arial','B',15);
        $pdf->Cell(40,5, 'Schema cursus ');
        $pdf->Ln(10);

        foreach ($result as $key) {
            $string = $key->voorletters." ".$key->tussenvoegsel." ".$key->achternaam."";
            $bootnaam = $key->bootnaam;
            $instructeur = $key->instructeur_voorletters.' '.$key->instructeur_tussenvoegsels .' '. $key->instructeur_achternaam;
            if ($i==0) {
                $pdf->SetFont('Arial','',12);
                $pdf->Cell(40,5, 'Cursus: '.$key->cursusnaam);
                $pdf->Ln(10);
                $pdf->SetFont('Arial','b',12);
                $pdf->Cell(40,5, "Dit zijn de aangemelde cursisten");
                $pdf->Ln(10);
                $pdf->Cell(60,5, 'Gebruiker');
                $pdf->Cell(40,5, 'Boot');
                $pdf->Cell(50,5, 'Instructeur');
                $pdf->Ln(1);
                $pdf->cell(151,5, '_______________________________________________________________');
            }
            $pdf->Ln(6);
            $pdf->SetFont('Arial','',12);
            $pdf->Cell(60,5, $string);
            $pdf->Cell(40,5, $bootnaam);
            $pdf->Cell(50,5, $instructeur);
            $pdf->Ln(1);
            $pdf->cell(151,5, '_______________________________________________________________');
            $i++;
        }

        $pdf->Ln(10);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(100,5, 'Voor meer informatie, kunt u mailen naar info@zeilschooldewaai.nl of');
        $pdf->Ln(4);
        $pdf->Cell(100,5, 'bezoek de website: dewaai.aukevanoost.com');

        $pdf->Output();
        
        View::renderTemplate('header', $data);
        View::render('beheer/createpdf', $data);
        View::renderTemplate('footer', $data);
    }

    public function cursistKoppelen()
    {
        $this->checkValidation(2);
        
        $data['title'] = $this->language->get('cursisten koppelen');

        $rechten = \Helpers\Session::get('rechten') - 1;
        $result = $this->dbBeheer->getCursusWithCustomers();
        //
        $i = 1;
        foreach ($result as $key) {
            if($key->inschrijvingen == 0){
                $key->inschrijvingen = '<b style="color: #b20000">'.$key->inschrijvingen.'</b>';
            }else{
                $key->inschrijvingen = '<b style="color: #458B00">'.$key->inschrijvingen.'</b>';
            }
            switch ($key->niveau) {
                case 1: $key->niveau = "Beginner";    break;
                case 2: $key->niveau = "Ervaren";     break;
                case 3: $key->niveau = "Wadtocht";    break;
            }

            $data["cursussen"] .= '
                <tr>
                    <td>' . $i . '</td>
                    <td>' . $key->cursusnaam . '</td>
                    <td><b>' . date("d / m / Y",strtotime($key->startdatum)) . '</b></td>
                    <td>' . $key->niveau . '</td>
                    <td>' . $key->inschrijvingen . ' Cursist(en)</td>
                    <td style="text-align: right">
                        <a href="#" data-id="' . $key->cursus_id . '" class="BekijkKoppelingen"><i class="fa fa-link fa-lg"></i></a>&nbsp;
                        <a href="#" data-id="' . $key->cursus_id . '" class="KoppelRij"><i class="fa fa-anchor fa-lg"></i></a>&nbsp;
                        <a href="createpdf/' . $key->cursus_id . '" target="_blank" data-id="' . $key->cursus_id . '" class="DownloadCursus"><i class="fa fa-download fa-lg"></i></a>
                    </td>
                </tr>
            ';
            $i++;
        }

        View::renderTemplate('header', $data);
        View::render('beheer/cursistkoppelen', $data);
        View::renderTemplate('footer', $data);
    } 
}