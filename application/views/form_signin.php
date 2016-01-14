	<div class="col-md-6 col-md-offset-3 login-form">
		<h1 class="form-title">Inscription</h1>
		<div class="error">
				<?php echo validation_errors(); ?>
				<?php echo form_open('createlogin'); ?>
			</div>
			<input class="inp-s5 form-control form-input" type="text" id="name" name="name" placeholder="Nom de l'artiste"/>
			<input class="inp-s5 form-control form-input" type="email" id="mail" name="mail" placeholder="Mail"/>
			<input class="inp-s5 form-control form-input" type="password" id="password" name="password" placeholder="Mot de passe"/>
			<select required name="country" class="inp-s5 form-control form-input"/>
				<?php 
                foreach ($countries as $country){
				    echo '<option value ="'.$country['id'].'"';
                    if ($country['nom']=='France') echo ' selected';
                    echo '>'.$country['nom'].'</option>';
				}
                ?>
			</select>
            <select required name="debut" class="inp-s5 form-control form-input"/>
				<?php foreach ($years as $year): ?>
				<option value ="<?php echo $year?>"><?php echo $year ?></option>
				<?php endforeach?>
			</select>
			<input class="inp-s5 form-control form-input" type="number" id="nbformation" name="nbformation" min="1" placeholder="Nombre de membres"  step="1"/>
			<input class="inp-s5 form-control form-input" type="text" id="genre" name="genre" placeholder="Genre musical"/>
			<input class="inp-s5 form-control form-input" type="text" id="parente" name="parente" placeholder="Parenté"/>
			<input class="inp-s5 form-control form-input" type="url" id="website" name="website" placeholder="Site Web"/>
			<input class="btn col-md-12 inp-s5 inp-sub" type="submit" value="S'inscrire"/>
		</form>
		<a class="btn col-md-12" href="login">Déjà inscrit ? Se connecter</a>
	</div>
   
