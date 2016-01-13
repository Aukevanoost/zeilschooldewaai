<?php
/**
 * Sample layout
 */
use Core\Language;
if (\Helpers\Session::get('rechten')==3) 
{
	?>
    <div class="page-header">
        <h1 style="text-align: center">Beheer</h1>
    </div>
        <table class="table table-hover">
            <button id="BeheerderToevoegen" class="btn btn-primary">Toevoegen</button>
            <thead>
                <tr>
                    <th width="40px">#</th>
                    <th width="100px">Voornaam</th>
                    <th width="70px"></th>
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


        <div class="modal fade" tabindex="-1" role="dialog" id="AdminModal" style="z-index: 99999999999999999999">
            <form  action="" method="post" id="AdminForm">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="AdminModalHeader">Sample</h4>
                        </div>
                        <div class="modal-body">
                            <table id="AdminModalBody" class="table">

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
<?php
}
elseif(\Helpers\Session::get('rechten')==2)
{
?>
	
<div class="page-header">
        <h1 style="text-align: center">Beheer</h1>
    </div> 
<!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#BeheerProfiel" onclick="ChangeContent('BeheerProfiel')" role="tab" data-toggle="tab">Beheer Profiel</a></li>
        <li role="presentation"><a href="#BeheerKlanten" role="tab"  onclick="ChangeContent('BeheerKlanten')" data-toggle="tab">Beheer Klanten</a></li>
        <li role="presentation"><a href="#BeheerBoten" role="tab"  onclick="ChangeContent('BeheerBoten')" data-toggle="tab">Beheer Boten</a></li>
        <li role="presentation"><a href="#BeheerCursussen" role="tab"  onclick="ChangeContent('BeheerCursussen')" data-toggle="tab">Beheer Cursussen</a></li>
        <li role="presentation"><a href="#BeheerInstructeurs" role="tab"  onclick="ChangeContent('BeheerInstructeurs')" data-toggle="tab">Beheer Instructeurs</a></li>
        <li role="presentation"><a href="#CursistKoppelen" role="tab"  onclick="ChangeContent('CursistKoppelen')" data-toggle="tab">Cursist Koppelen</a></li>
    </ul>
<br />
<?php echo $data["users"];
 }
else
{
	echo "geen rechten";
}