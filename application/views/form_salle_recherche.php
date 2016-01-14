	<div class="col-md-12 search-form">
		<div class="errors">
				<?php echo validation_errors(); ?>
				<?php echo form_open('todo'); ?>
			</div>
			<div class="col-md-12">
				<div class="col-md-3">
					<label>Nom :</label>
					<?php
					echo '<input class="inp-s5 form-control form-input" type="text" id="name" name="name" placeholder="Nom de la salle"';
					if($this->session->has_userdata('recherche_salle')['nom'] == ''){
						echo ' value="'.$this->session->userdata('recherche_salle')['nom'].'"';
					}
					echo '/>';
					?>
				</div>
				<div class="col-md-2">
					<label>Capacité :</label>
					<select required name="capacite" class="inp-s5 form-control form-input"/>
						<option value ="-1">(vide)</option>
						<?php 
						foreach ($capacites as $cap){
							echo '<option value="'.$cap.'"';
							if ($cap == $this->session->userdata('recherche_salle')['capacite']){
								echo ' selected';
							}
							echo '>> '.$cap.'</option>';						

						}						
						?>
					</select>
				
				</div>
				<div class="col-md-2">
					<label>De :</label>
					<select required name="heure_debut" class="inp-s5 form-control form-input"/>
						<option value ="-1">(vide)</option>
						<?php foreach ($horaires as $heure): ?>
						<option value ="<?php echo $heure ?>"><?php echo $heure."h"?></option>
						<?php endforeach?>
					</select>
				</div>
				<div class="col-md-2">
					<label>A :</label>
					<select required name="heure_fin" class="inp-s5 form-control form-input"/>
						<option value ="-1">(vide)</option>
						<?php foreach ($horaires as $heure): ?>
						<option value ="<?php echo $heure ?>"><?php echo $heure."h"?></option>
						<?php endforeach?>
					</select>
				</div>
				<div class="col-md-3">
					<label>Le :</label>
					<input class="inp-s5 form-control form-input" type="date" id="debut" name="debut" placeholder="Date (JJ/MM/AAAA)"/>
				</div>
				<div class="col-md-3">
					<label>Accès handicapé :</label>
					<?php
					echo '<input type="checkbox" class="form-input" id="handicap" name="handicap"';
					if($this->session->userdata('recherche_salle')['handicap'] == 'on'){
						echo ' checked';
					}
					echo '/>';
					?>
				</div>
			</div>
			<div class="col-md-4 col-md-offset-4">
				<input class="btn col-md-12 inp-s5 inp-sub" type="submit" value="Rechercher"/>
			</div>
		</form>
	</div>
   
