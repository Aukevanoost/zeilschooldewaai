<?php
/**
 * Sample layout
 */

use Core\Language;

?>


<br />
<!-- Nav tabs -->
<ul class="nav nav-tabs TabNavigation" role="tablist">
    <li role="presentation" class="active"><a href="#OnzeVloot" class="ContentBtn" data-content="zeilschool" role="tab" data-toggle="tab">De zeilschool</a></li>
    <li role="presentation"><a href="#Soorten" role="tab"  class="ContentBtn" data-content="hostel" data-toggle="tab">Het hostel</a></li>
    <li role="presentation"><a href="#Soorten" role="tab"  class="ContentBtn" data-content="Route" data-toggle="tab">Route</a></li>
    <li role="presentation"><a href="#Soorten" role="tab"  class="ContentBtn" data-content="Kleding" data-toggle="tab">Kleding</a></li>
</ul>
<select class="form-control RespTabNav">
    <option value="zeilschool">De zeilschool</option>
    <option value="hostel">Het hostel</option>
    <option value="Route">Route</option>
    <option value="Kleding">Kleding</option>
</select>

<div id="zeilschool" class="Subject">

    <br />
    <div class="row">
        <div class="col-md-7">
            <div class="page-header">
                <h2>De zeilschool</h2>
            </div>
            Wij zijn de specialist in het verzorgen van complete zeilcursussen in het mooie Friese Gaasterland in het plaatsje Warns. Onze cursussen worden verzorgd door een team ervaren zeilinstructeurs en activiteitenbegeleiders. Tijdens uw verblijf op onze zeilschool komt u niets tekort. Zo hebben wij een gezellig restaurant, een bar en verzorgen wij ook avondprogramma's, zoals spelprogramma's voor kinderen, droppings voor de wat oudere deelnemer, en karaokeavonden.
            <br><br>
            Uniek in bij onze zeilschool zijn, naast beginnerscursussen en gevorderdencursussen, de wadtochten. Dit zijn tochten over de Waddenzee onder begeleiding van een instructeur. Hier leert u hoe je moet zeilen op zee en zeilen in stromend water. De overnachtingen in deze cursus vinden op de Waddenzee zelf plaats! Dit kan doordat hier gebruik gemaakt wordt van Schouwen. Dit zijn boten met platte bodems, zodat de boten bij laag tij op de zeebodem kunnen blijven liggen, zonder dat het schip kantelt. Een unieke ervaring voor de gevorderde zeiler!
        </div>
        <div class="col-md-5">
            <br />
            <div id="carousel-zeilschool" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-zeilschool" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-zeilschool" data-slide-to="1"></li>
                    <li data-target="#carousel-zeilschool" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="/zeilschooldewaai/app/templates/default/img/overons/zeilschool1.jpg" alt="Terrein" style="width: 100%">
                        <div class="carousel-caption"></div>
                    </div>
                    <div class="item">
                        <img src="/zeilschooldewaai/app/templates/default/img/overons/zeilschool2.jpg" alt="Instructeur" style="width: 100%">
                        <div class="carousel-caption"></div>
                    </div>
                    <div class="item">
                        <img src="/zeilschooldewaai/app/templates/default/img/overons/zeilschool3.jpg" alt="terrein vanuit de lucht" style="width: 100%">
                        <div class="carousel-caption"></div>
                    </div>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-zeilschool" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-zeilschool" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>
<div id="hostel" class="Subject">
    <br />
    <div class="row">
        <div class="col-md-7">
            <div class="page-header">
                <h2>Het hostel (Bed and Breakfast)</h2>
            </div>
            Het hostel ligt op loopafstand van het plaatsje Warns aan de Westelijke zijde. Hier zal tijdens de zeilcursussen
            een verblijfplaats zijn voor de gasten. in het dorpje warns zijn een supermarkt, een slager, een groenteboer en een aantal cafe's te vinden.

            <Br /><BR />
            Het hostel is van alle gemakken voorzien: Er is een bar, een gezamelijke ruimte voor de gasten en een terras. dit om ervoor te zorgen dat de gasten zich niet hoeven te vervelen buiten de cursustijden.
            <br /><br/>
        </div>
        <div class="col-md-5">
            <br />
            <div id="carousel-hostel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-hostel" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-hostel" data-slide-to="1"></li>
                    <li data-target="#carousel-hostel" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="/zeilschooldewaai/app/templates/default/img/overons/hostel1.jpg" alt="Gezamelijke ruimte hostel" style="width: 100%">
                        <div class="carousel-caption"></div>
                    </div>
                    <div class="item">
                        <img src="/zeilschooldewaai/app/templates/default/img/overons/hostel2.jpg" alt="Slaapkamers hostel" style="width: 100%">
                        <div class="carousel-caption"></div>
                    </div>
                    <div class="item">
                        <img src="/zeilschooldewaai/app/templates/default/img/overons/hostel3.jpg" alt="Voorkant hostel" style="width: 100%">
                        <div class="carousel-caption"></div>
                    </div>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-hostel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-hostel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>
<div id="Route" class="Subject" style="display: none">
    <div class="row">
        <br />

        <div class="col-md-7">
            <div class="page-header">
                <h2>Route</h2>
            </div>
            <b>Vanaf Lemmer (A6)</b><br />
            <ul>
                <li>Neem afslag 17-Lemmer naar N359 richting Lemmer/Balk</li>
                <li>Sla linksaf naar 22/Pasveer/N359</li>
                <li>Neem op de rotonde de 2e afslag nar Sudersewei/N359</li>
                <li>Neem op de rotonde de 3e afslag naar Gaaikemastraat/N359</li>
                <li>Sla Linksaf naar Flinkeboskje</li>
                <li>Vervolg de weg naar De Soal</li>
                <li>Sla rechtsaf de Buoren straat in richting Molkwerum</li>
                <li>Sla linksaf de Middelweg in richting Stavoren</li>
            </ul>


        </div>
        <div class="col-md-5">
            <br /><br /><br /><br /><br />
            <iframe class="home_map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d77090.91150382684!2d5.372949701799224!3d52.856762982829274!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c895a2b353cd9b%3A0x29a949f02a712d45!2s8721+Warns!5e0!3m2!1snl!2snl!4v1452083014828" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

        </div>
    </div>
</div>

<div id="Kleding" class="Subject" style="display: none">
    <div class="row">
        <br />

        <div class="col-md-12">
            <div class="page-header">
                <h2>Kleding</h2>
            </div>
            Het is verstandig goede zeilkleding mee te nemen. Omdat dit nogal duur kan zijn adviseren wij voor de beginners een goed regenpak. Voor de gevorderde zeiler is echte zeilkleding aan te raden. In (en ook  buiten) de provincie Friesland zijn talloze winkels waar men u kunt adviseren. Google even op "zeilkleding" gevolgd door uw woonplaats.
            <br>

        </div>
    </div>
</div>