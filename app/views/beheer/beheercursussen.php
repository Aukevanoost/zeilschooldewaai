<?php

use Core\Language;

?> 
<div class="page-header">
        <h1 style="text-align: center">Beheer</h1>
    </div>
        
                <?php
                    echo $data["cursussen"];
                ?>


        <div class="modal fade" tabindex="-1" role="dialog" id="CursusModal" style="z-index: 99999999999999999999">
            <form  action="" method="post" id="CursusForm">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="CursusModalHeader">Sample</h4>
                        </div>
                        <div class="modal-body">
                            <table id="CursusModalBody" class="table">

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