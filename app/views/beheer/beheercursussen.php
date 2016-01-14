<?php

use Core\Language;

?> <div class="page-header">
        <h1 style="text-align: center">Beheer</h1>
    </div>
<?php
if(\Helpers\Session::get('rechten')==2)
{
	echo $data["cursussen"];
}
else
{
	echo "geen rechten";
}
?>
