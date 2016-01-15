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
            <button id="KlantenToevoegen" class="btn btn-primary">Toevoegen</button>
            <thead>
                <tr>
                    <th width="40px">#</th>
                    <th width="">Voornaam</th>
                    <th width="">Tussenvoegsel</th>
                    <th>Achternaam</th>
                    <th>E-mail</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <?php
                    echo $data["users"];
                ?>
            </tbody>
        </table>


        <div class="modal fade" tabindex="-1" role="dialog" id="BeheerModal" style="z-index: 99999999999999999999">
            <form  action="" method="post" id="BeheerForm">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="BeheerModalHeader">Sample</h4>
                        </div>
                        <div class="modal-body">
                            <table id="BeheerModalBody" class="table">

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
    </div>

