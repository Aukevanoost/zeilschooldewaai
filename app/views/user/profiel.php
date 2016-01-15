<?php

use Core\Language;

// Bekijk of de user is ingelogd.
if (\Helpers\Session::get('id')) {
	?>

		<div class="page-header">
		    <h1>Profiel van <?php foreach($data['klant'] as $key => $value){ echo $value->voornaam; }?></h1>
		</div>

		<!-- Laat de melding zien van de acties. -->
		<?php echo $data["melding"]; ?>

		<!-- De linkerkant van de pagina met gegevens veranderen. -->
		<div class="col-md-6">
			<h2>Uw gegevens</h2>

			<form class="form-horizontal" method="post" style="margin-top:20px;">
				<?php
					// Array met waardes die hij niet moet laten zien.
					$skip_data = ['klant_id', 'url', 'priviledged', 'email', 'wachtwoord'];

					foreach($data['klant'][0] as $key => $value){

						if(!in_array($key, $skip_data)){

							// Als de waarde geslacht is.
							if($key == "geslacht"){
								?>
									<div class="form-group">
									  <label for="<?php echo $key; ?>" class="col-sm-3 control-label" style="text-align: left;"><?php echo ucfirst($key); ?> <span class="required">*</span></label>
									  <div class="col-sm-9">
									    <select class="form-control" id="<?php echo $key; ?>" name="<?php echo $key; ?>">
									      <option value="man" <?php if($value == "man"){ echo "selected"; } ?> >Man</option>
									      <option value="vrouw" <?php if($value == "vrouw"){ echo "selected"; } ?>>Vrouw</option>
									    </select>
									  </div>
									</div>							
								<?php

							// Als de waarde niveau is.
							}else if($key == "niveau"){
								?>
									<div class="form-group">
									  <label for="<?php echo $key; ?>" class="col-sm-3 control-label" style="text-align: left;"><?php echo ucfirst($key); ?> <span class="required">*</span></label>
									  <div class="col-sm-9">
									    <select class="form-control" id="<?php echo $key; ?>" name="<?php echo $key; ?>">
									        <option <?php if($value == "1"){ echo 'selected'; } ?> value="1">Beginner</option>
									        <option <?php if($value == "2"){ echo 'selected'; } ?>  value="2">Gevorderd</option>
									    </select>
									  </div>
									</div>							
								<?php

							// Als de waarde tussenvoegsel, telefoonnummer of mobiel is.
							}else if($key == "tussenvoegsel" || $key == "telefoonnummer" || $key == "mobiel"){
								?>
									<div class="form-group">
									  <label for="<?php echo $key; ?>" class="col-sm-3 control-label" style="text-align: left;"><?php echo ucfirst($key); ?></label>
									  <div class="col-sm-9">
									    <input type="text" class="form-control" id="<?php echo $key; ?>" name="<?php echo $key; ?>" value="<?php echo $value; ?>">
									  </div>
									</div>
								<?php
							}else{
								?>
									<div class="form-group">
									  <label for="<?php echo $key; ?>" class="col-sm-3 control-label" style="text-align: left;"><?php echo ucfirst($key); ?> <span class="required">*</span></label>
									  <div class="col-sm-9">
									    <input type="<?php if($key == "geboortedatum"){ echo 'date'; }else{ echo 'text'; } ?>" class="form-control" id="<?php echo $key; ?>" name="<?php echo $key; ?>" value="<?php echo $value; ?>" required>
									  </div>
									</div>
						<?php
							}
						}
					}
				?>
			  <div class="form-group">
			    <div class="col-sm-offset-3 col-sm-9">
			      <input class="btn btn-primary" type='submit' name='submit-gegevens' value='Verander gegevens'>
			    </div>
			  </div>

			</form>
		</div>


		<!-- Modal om uit te schrijven van een cursus -->
		<div class="modal fade" id="deleteCursus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<form method="post">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Uitschrijven</h4>
		      </div>
		      <div class="modal-body">
		      	U kunt zich <b>3</b> weken voor de cursus kosteloos afmelden.
		        Weet u zeker dat u zich wilt uitschrijven voor deze cursus?<br>
		        <input type="hidden" name="cursus_id" id="cursus_id"/>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Sluiten</button>
		        <input class="btn btn-danger" type='submit' name='submit-uitschrijven' value='Uitschrijven'>
		      </div>
		    </div>
		  </div>
		 </form>
		</div>

		<!-- Modal om uit te schrijven van een cursus -->
		<div class="modal fade" id="between3Weeks" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<form method="post">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Uitschrijven niet mogelijk</h4>
		      </div>
		      <div class="modal-body">
		      	U kan zich helaas niet meer uitschrijven omdat het binnen <b>3</b> weken is. Graag via het contactformulier contact opnemen.
		        <input type="hidden" name="cursus_id" id="cursus_id"/>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Sluiten</button>
		      </div>
		    </div>
		  </div>
		 </form>
		</div>


		<!-- De rechterkant van de pagina met cursussen en wachtwoord veranderen. -->
		<div class="col-md-6">
			<h2>Uw cursussen</h2>

		<?php

			// Als er wel curcussen bestaan.
			if(!empty($data['cursussen'])){
				echo '<form method="post"><table class="table"><thead><tr><th>#</th><th>Naam</th><th>Prijs</th><th>Startdatum</th><th>Einddatum</th><th>Niveau</th><th></th></tr></thead><tbody>';
			}

			$i = 0;

			foreach($data['cursussen'] as $key => $value){
				$i++;

				if(time() > strtotime($value->startdatum)){
				   echo '<tr style="color:#BBB;">';
				}else{
					echo '<tr>';
				}
			?>
				<!-- Vul de velden -->
				<th scope="row"><?= $i; ?></th>
				<td><?= $value->cursusnaam;?></td>
				<td><?= $value->cursusprijs;?></td>
				<td><?= $value->startdatum;?></td>
				<td><?= $value->einddatum;?></td>
				<td>
				<?php
					if($value->niveau == 0){
						echo 'Beginner';
					}elseif($value->niveau == 1){
						echo 'Gevorderd';
					}else{
						echo 'Waddentocht';
					}
				?>
				</td>

				<?php
					if(time() > strtotime($value->startdatum)){
					   echo '<td></td>';
					}else{

						if (strtotime('-3 week') < strtotime($value->startdatum) && strtotime($value->startdatum) < strtotime('+3 week')) {
							// Binnen de 3 weken
							echo '<td><button data-toggle="modal" data-target="#between3Weeks" type="button" class="deleteCursus"><i class="fa fa-question" style="font-size:20px;"></i></button></td>';
						}else{
							// Dit is buiten de 3 weken
							echo '<td><button data-toggle="modal" data-startdatum="' . $value->startdatum . '" data-id="' . $value->cursus_id . '" data-target="#deleteCursus" type="button" class="deleteCursus"><i class="fa fa-ban" style="font-size:20px;color:red;"></i></button></td>';
						}						
					}
				?>
						
					</tr>
				<?php
			}
				// Als er wel curcussen zijn, sluit de tabel en form.
				if(!empty($data['cursussen'])){
					echo '</tbody></table></form>';
				}

			// Er zijn geen curcussen
			if($i == 0){
				echo 'U heeft zich nog niet ingeschreven voor een cursus.<br><br>';
			}
		?>


			<br><hr><br>
			<h2>Verander uw wachtwoord</h2>

			<form class="form-horizontal" method="post">
				
				<div class="form-group">
			    	<label for="wachtwoord" class="col-sm-3 control-label">Wachtwoord <span class="required">*</span></label>
			    	<div class="col-sm-9">
			      		<input type="password" class="form-control" id="wachtwoord" name="wachtwoord" placeholder="Wachtwoord..">
			    	</div>
			  	</div>

			  	<div class="form-group">
			      	<label for="wachtwoord1" class="col-sm-3 control-label">Wachtwoord herhalen <span class="required">*</span></label>
			      	<div class="col-sm-9">
			        	<input type="password" class="form-control" id="wachtwoord1" name="wachtwoord1" placeholder="Herhaal wachtwoord..">
			      	</div>
			    </div>

				  <div class="form-group">
				    <div class="col-sm-offset-3 col-sm-9">
				      <input class="btn btn-primary" type='submit' name='submit-wachtwoord' value='Verander wachtwoord'>
				    </div>
				  </div>
			</form>

		</div>
	<?php
}
else{
	\Helpers\Url::redirect('home');
}