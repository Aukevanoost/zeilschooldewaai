<?php
/**
 * Sample layout
 */
use Core\Language;


?>
<div class="page-header">
    <h1 style="text-align: center">Beheer</h1>
</div>
<table class="table table-hover">
    <button id="InstructeurToevoegen" class="btn btn-primary">Toevoegen</button>
    <thead>
    <tr>
        <th width="40px">#</th>
        <th width="100px">voornaam</th>
        <th width="100px">Voorletters</th>
        <th width="70px"></th>
        <th>Achternaam</th>
        <th>Geslacht</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    echo $data["instructeurs"];
    ?>
    </tbody>
</table>

<div class="modal fade" tabindex="-1" role="dialog" id="InstructeurModal" style="z-index: 99999999">
    <form  action="" method="post" id="InstructeurForm">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="InstructeurModalHeader">Sample</h4>
                </div>
                <div class="modal-body">
                    <table id="InstructeurModalBody" class="table">

                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Sluiten</button>
                    <button type="submit" class="btn btn-primary" id="SaveBtn">Opslaan</button>
                </div>
            </div>
        </div>
    </form>
</div>

