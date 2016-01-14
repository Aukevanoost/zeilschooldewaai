
<?php
/**
 * Sample layout
 */
 
use Helpers\Assets;
use Helpers\Url;
use Helpers\Hooks;
 
//initialise hooks
$hooks = Hooks::get();
?>
    <style>
        .required{
            color:red;
            font-weight:bold;
            font-size:20px;
            position: relative;
            top: -5px;
            
        }
    </style>
 
    <div class="page-header">
        <h1>Registreren</h1>
    </div>
 
    <?php echo $data["melding"]; ?>
 
    <form action="" method="post">
        <div class="row">
            <div class="col-md-7" style="padding-left:0px;">
                <div class="col-md-12">
                    <p>Voornaam <span class="required">*</span><br /><input class="form-control" type='text' name='voornaam' value="<?php echo $_POST['voornaam']; ?>" required></p>
                </div>
                <div class="col-md-3">
                    Voorletters <span class="required">*</span><br /><input class="form-control" type='text' name='voorletters' value="<?php echo $_POST['voorletters']; ?>" required>
                </div>
 
                <div class="col-md-3">
                    <p>Tussenvoegsel<br /><input class="form-control" type='text' name='tussenvoegsel' value="<?php echo $_POST['tussenvoegsel']; ?>"></p>
                </div>
 
                <div class="col-md-6">
                    <p>Achternaam <span class="required">*</span><br /><input class="form-control" type='text' name='achternaam' value="<?php echo $_POST['achternaam']; ?>" required></p>
                </div>
                <div class="col-md-5">
                    <p>Adres <span class="required">*</span><br /><input class="form-control" type='text' name='adres' value="<?php echo $_POST['adres']; ?>" required></p>
                </div>
                <div class="col-md-2">
                    <p>Postcode <span class="required">*</span><br /><input class="form-control" type='text' name='postcode' value="<?php echo $_POST['postcode']; ?>" required></p>
                </div>
                <div class="col-md-5">
                    <p>Woonplaats <span class="required">*</span><br /><input class="form-control" type='text' name='woonplaats' value="<?php echo $_POST['woonplaats']; ?>" required></p>
                </div>
                <div class="col-md-6">
                    <p>Telefoonnummer <br /><input class="form-control" type='tel' name='tel' value="<?php echo $_POST['tel']; ?>"></p>
                </div>
                <div class="col-md-6">
                    <p>Mobiel<br /><input class="form-control" type='text' name='mobiel' value="<?php echo $_POST['mobiel']; ?>"></p>
                </div>
                <div class="col-md-12">
                    <p>E-mail <span class="required">*</span><br /><input class="form-control" type='email' name='email' value="<?php echo $_POST['email']; ?>" required></p>
                </div>
                <div class="col-md-4">
                    <p>Geboorte datum <span class="required">*</span><br /><input class="form-control" type='date' name='date' value="<?php echo $_POST['date']; ?>" required></p>
                </div>
                <div class="col-md-8">
                    <p>Geslacht <span class="required">*</span>
                        <br />
                        <select id="geslacht" name="geslacht" class="form-control">
                            <option <?php if($_POST['geslacht'] == "Man"){ echo 'selected'; } ?> value="Man">Man</option>
                            <option <?php if($_POST['geslacht'] == "Vrouw"){ echo 'selected'; } ?> value="Vrouw">Vrouw</option>
                        </select>
                    </p>
                </div>
                <div class="col-md-12">
                    <p>Niveau <span class="required">*</span>
                        <br />
                        <select id="niveau" name="niveau"  class="form-control">
                            <option <?php if($_POST['niveau'] == "1"){ echo 'selected'; } ?> value="1">Beginner</option>
                            <option <?php if($_POST['niveau'] == "2"){ echo 'selected'; } ?>  value="2">Gevorderd</option>
                        </select>
                    </p>
                </div>
                <div class="col-md-6">
                    <p>Password <span class="required">*</span><br /><input class="form-control" type='password' name='password' required></p>
                </div>
                <div class="col-md-6">
                    <p>Re-Password <span class="required">*</span><br /><input class="form-control" type='password' name='password1' required></p>
                </div>
                <div class="col-md-12">
                    <label for="message">Captcha <small>(Tegen bots)</small>:</label>
                    <div class="g-recaptcha" id="captcha" name="form_captcha" data-sitekey="6LdEohQTAAAAAJTVjYk_L35j7aQ_ctXuv0qCPEzj"></div>
                </div>
                <div class="col-md-12">
                    <br />
                    <button class="btn btn-primary" type="submit">Registreren</button>
                </div>
            </div>
            <div class="col-md-5">
                <img src="/zeilschooldewaai/app/templates/default/img/register.jpg" width="100%" style="border-radius: 4px;" id="registerimg"/>
            </div>
        </div>
    </form>