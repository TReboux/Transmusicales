	<div class="col-md-6 col-md-offset-3 login-form">
			<h1 class="form-title">Se connecter</h1>			
			<div class="error">
				<?php echo validation_errors(); ?>
				<?php echo form_open('verifylogin'); ?>
			</div>
			<input class="inp-s5 form-control form-input" type="text" id="login" name="login" placeholder="Identifiant"/>
			<input class="inp-s5 form-control form-input" type="password" id="password" name="password" placeholder="Mot de passe"/>
			<input class="btn col-md-12 inp-s5 inp-sub"type="submit" value="Se connecter"/>
			</form>
			<a class="btn col-md-12 inp-det" href="signin">Pas inscrit ? Cliquez ici !</a>
		</div>
	</div>
   
