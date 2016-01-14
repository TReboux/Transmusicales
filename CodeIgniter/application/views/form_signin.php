	<div class="col-md-6 col-md-offset-3">
		<h2>Inscription</h2>
		<div class="error">
				<?php echo validation_errors(); ?>
				<?php echo form_open('createlogin'); ?>
			</div>
			<input class="inp-s5 form-control" type="text" id="name" name="name" placeholder="Nom de l'artiste"/>
			<br>
			<input class="inp-s5 form-control" type="email" id="mail" name="mail" placeholder="Mail"/>
			<br/>
			<input class="inp-s5 form-control" type="password" id="password" name="password" placeholder="Mot de passe"/>
			<br/>
			<select required name="country" class="inp-s5 form-control"/>
				<?php foreach ($countries as $country): ?>
				<option value ="<?php echo $country['id'] ?>"><?php echo $country['nom']?></option>
				<?php endforeach?>
			</select>
			<br/>
			<input class="inp-s5 form-control" type="date" id="debut" name="debut" placeholder="Date de début (JJ/MM/AAAA)"/>
			<br/>
			<input class="btn col-md-12 inp-s5 inp-sub" type="submit" value="S'inscrire"/>
		</form>
		<a class="btn col-md-12" href="login">Déjà inscrit ? Se connecter</a>
	</div>
   
