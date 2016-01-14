<?php
/**
 * Sample layout
 */

use Core\Language;
if (\Helpers\Session::get('id')) {
	?>
		<style>
		    .required{
		        color:red;
		        font-weight:bold;
		        font-size:20px;
		        position: relative;
		        top: -5px;
		        
		    }

		    .deleteCursus{
		    	outline: 0;
		    	background:none;
		    	border:0;
		    }
		</style>
		<!--
			$(document).on("click", ".open-AddBookDialog", function () {
			     var myBookId = $(this).data('id');
			     $(".modal-body #bookId").val( myBookId );
			     // As pointed out in comments, 
			     // it is superfluous to have to manually call the modal.
			     // $('#addBookDialog').modal('show');
			});
		-->

		<div class="page-header">
		        <h1>Profiel van <?php foreach($data['klant'] as $key => $value){ echo $value->voornaam; }?></h1>
		</div>

		<?php echo $data["melding"]; ?>

		<div class="col-md-6">
			<h2>Uw gegevens</h2>

			<form class="form-horizontal" method="post" style="margin-top:20px;">
				<?php

					$skip_data = ['klant_id', 'url', 'priviledged', 'email', 'wachtwoord'];

					foreach($data['klant'][0] as $key => $value){
						if(!in_array($key, $skip_data)){
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

		<!-- Modal -->

		<div class="modal fade" id="deleteCursus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<form method="post">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Uitschrijven</h4>
		      </div>
		      <div class="modal-body">
		        Weet u zeker dat u zich wilt uitschrijven voor deze cursus?<br><br><br>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-danger" name="deleteCursus">Uitschrijven</button>
		      </div>
		    </div>
		  </div>
		 </form>
		</div>

		<div class="col-md-6">
			<h2>Uw cursussen</h2>

		<?php
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
						<th scope="row"><?= $i; ?></th>
						<td><?= $value->cursusnaam;?></td>
						<td><?= $value->cursusprijs;?></td>
						<td><?= $value->startdatum;?></td>
						<td><?= $value->einddatum;?></td>
						<td><?= $value->niveau;?></td>
						<?php
							if(time() > strtotime($value->startdatum)){
							   echo '<td></td>';
							}else{
								echo '<td><button data-toggle="modal" data-target="#deleteCursus" type="button" class="deleteCursus" value="' . $value->cursus_id . '"><i class="fa fa-ban" style="font-size:20px;color:red;"></i></button></td>';
							}
						?>
						
					</tr>
				<?php
			}

			if(!empty($data['cursussen'])){
				echo '</tbody></table></form>';
			}

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