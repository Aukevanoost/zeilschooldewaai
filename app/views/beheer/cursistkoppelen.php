<?php
/**
 * Sample layout
 */
use Core\Language;


?>
<div class="page-header">
    <h1 style="text-align: center">Beheer</h1>
</div>
<div id="ModalMessages"></div>
<table class="table table-hover">
    <thead>
    <tr>
        <th width="40px">#</th>
        <th>Naam</th>
        <th>Start datum</th>
        <th>Niveau</th>
        <th>Inschrijvingen</th>
        <th></th>

    </tr>
    </thead>
    <tbody>
    <?php
    echo $data["cursussen"];
    ?>
    </tbody>
</table>

<!-- | Bekijk koppelingen
---------------------------------------------------------------------------------------------------------------------------------- -->
<div class="modal fade" tabindex="-1" role="dialog" id="BekijkModal" style="z-index: 99999999999999999999">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="BekijkModalHeader">Bekijk Koppelingen</h4>
            </div>
            <div class="modal-body" id="BekijkModalBody">

                <table class="table table-striped" >
                    <thead>
                        <tr>
                            <th width="25px">#</th>
                            <th>Cursisten</th>
                            <th>Boot</th>
                            <th>Instructeur</th>
                            <th width="30px"></th>
                        <tr>
                    </thead>
                    <tbody id="BotenTabel">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" >Sluiten</button>
            </div>
        </div>
    </div>
</div>


<!-- | Koppel cursisten aan boten popup
---------------------------------------------------------------------------------------------------------------------------------- -->
<div class="modal fade" tabindex="-1" role="dialog" id="KoppelModal" style="z-index: 99999999999999999999">
    <form  action="" method="post" id="KoppelForm">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="KoppelModalHeader">Sample</h4>
                </div>
                <div class="modal-body" id="KoppelModalBody">
                    <div id="messages"></div>
                    <label for="table">Cursus</label>
                    <table class="table table-striped" id="CursusTabel">

                    </table>
                    <hr />
                    <label for="select">Kies gebruikers</label>
                    <select id="KiesGebruikers" multiple class="form-control" name="gebruikers[]"></select>
                    <span class="selectitems"></span>


                    <label for="select">Kies boot:</label>
                    <select id="KiesBoot" class="form-control" name="Boten"></select>

                    <label for="select">Kies Instructeur:</label>
                    <select id="KiesInstructeur" class="form-control" name="Instructeur"></select>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" >Sluiten</button>
                    <button type="submit" class="btn btn-primary" id="SaveBtn">Opslaan</button>
                </div>
            </div>
        </div>
    </form>
</div>
</div>
