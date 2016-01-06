<?php
/**
 * Sample layout
 */

use Core\Language;

?>



	<div class="page-header">
		<h1>Contact</h1>
	</div>
	<p>Neem contact met ons op wanneer nu nog vragen of opmerkingen heeft.</p>
	<?php
		if($_POST){
			$name = $_POST['name'];
			$email = $_POST['email'];
			$message = $_POST['message'];
			$form_captcha = $_POST['g-recaptcha-response'];

			if($name == "" || $email == "" || $message == "" || $form_captcha == 0){
				echo '<br><div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Er is een fout opgetreden.</strong><br>Niet alle velden zijn ingevuld of de captcha is niet ingevuld.</div>';
				?>
					<form id="contact_form" method="post">
						<div class="form-group">
						  <label for="name">Naam:</label>
						  <input type="text" class="form-control" id="name" placeholder="Naam.." name="name" value="<?php echo $name; ?>" required>
						</div>

						<div class="form-group">
						  <label for="email">Email address</label>
						  <input type="email" class="form-control" id="email" placeholder="Email.." name="email" value="<?php echo $email; ?>" required>
						</div>

						<div class="form-group">
						  <label for="message">Uw bericht:</label>
						  <textarea id="message" class="form-control" placeholder="Bericht.." name="message" required><?php echo $message; ?></textarea>
						</div>

						<div class="form-group">
						  <label for="message">Captcha <small>(Tegen bots)</small>:</label>
						  <div class="g-recaptcha" id="captcha" name="form_captcha" data-sitekey="6LdEohQTAAAAAJTVjYk_L35j7aQ_ctXuv0qCPEzj"></div>
						</div>
					  <button type="submit" class="button">Verzenden</button>
					</form>
				<?php 
			}else{
				echo '<br><div class="alert alert-success alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Succesvol.</strong><br>Het contactformulier is succesvol verzonden, we nemen binnen 24 uur contact met u op.</div>';
				// Hier kan mail ingesteld worden.
			}
		}else{
			?>
				<form id="contact_form" method="post">
					<div class="form-group">
					  <label for="name">Naam:</label>
					  <input type="text" class="form-control" id="name" placeholder="Naam.." name="name" value="<?php echo $name; ?>" required>
					</div>

					<div class="form-group">
					  <label for="email">Email address</label>
					  <input type="email" class="form-control" id="email" placeholder="Email.." name="email" value="<?php echo $email; ?>" required>
					</div>

					<div class="form-group">
					  <label for="message">Uw bericht:</label>
					  <textarea id="message" class="form-control" placeholder="Bericht.." name="message" required><?php echo $message; ?></textarea>
					</div>

					<div class="form-group">
					  <label for="message">Captcha <small>(Tegen bots)</small>:</label>
					  <div class="g-recaptcha" id="captcha" name="form_captcha" data-sitekey="6LdEohQTAAAAAJTVjYk_L35j7aQ_ctXuv0qCPEzj"></div>
					</div>
				  <button type="submit" class="button">Verzenden</button>
				</form>
			<?php
		}
	?>
