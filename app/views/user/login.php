<?php
/**
 * Sample layout
 */

use Core\Language;
if (\Helpers\Session::get('id')) {
	\Helpers\Url::redirect('home');
}
else{
?>
	<center>
	    <div class="page-header">
	            <h1>Login</h1>
	    </div>
        <?php
           // if (\Helpers\Session::get('checkmail')) {
            //$test = \Helpers\Session::get('checkmail');

            //}

        ?>
        <form action="" method="post" class="login_form">
        <?php echo $data["error"]; 
         if (\Helpers\Session::get('checkmail')) {
        echo "<div class='alert alert-warning'>".\Helpers\Session::get('checkmail')."</div>";

            }

        ?>
            <p><b>E-mail:</b><br /><input class="form-control" type='text' value='<?php echo $data["user"]; ?>' name='username'></p>
            <p><b>Wachtwoord:</b><br /><input class="form-control" type='password' name='password'></p>
            <br>
            <input class="btn btn-primary" type='submit' name='submit' value='Inloggen'>
            <br><br>Nog geen account? <a href="registreren">Registreer</a> een account.
        </form>
    </center>

	<?php }