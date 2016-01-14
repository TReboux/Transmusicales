<?php echo '<h2>'.$title.'</h2>' ?>

	<?php if (!empty($salles)): ?>
	<table class="col-md-12 table table-hover">
		<thead>
	      		<tr>
				<th class="col-md-2"><?php echo anchor('/todo/trier_salles/nom','Nom <span class="glyphicon glyphicon-chevron-down"></span>'); ?></th>
				<th class="col-md-5"><a><?php echo anchor('/todo/trier_salles/adresse','Adresse <span class="glyphicon glyphicon-chevron-down"></span>'); ?></a></th>
				<th class="col-md-2"><a><?php echo anchor('/todo/trier_salles/capacite','Capacité <span class="glyphicon glyphicon-chevron-down"></span>'); ?></a></th>
				<th class="col-md-3"><a><?php echo anchor('/todo/trier_salles/acceshandicap','Accès handicapé <span class="glyphicon glyphicon-chevron-down"></span>'); ?></a></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
	<?php foreach($salles as $salle_item): ?>
	<tr>
		<td class="ligne-salle"><?php echo $salle_item["nom"] ?></td>
		<td class="ligne-salle"><?php echo $salle_item['adresse']?></td>
		<td class="ligne-salle"><?php echo $salle_item['capacite']?></td>
		<td class="ligne-salle">
			<?php 
				if ($salle_item['acceshandicap']=='t'){
					echo '<span class="glyphicon glyphicon-ok" style="color:green"></span>';
				}else{
					echo '<span class="glyphicon glyphicon-remove"></span>';
				}

			?>
		</td>
		<td class="ligne-salle"><?php echo anchor('','<span class="glyphicon glyphicon-calendar"></span>'); ?></td>
	</tr>
	<?php 
		endforeach; 
		else:
			echo '<p>Aucun résultat</p>';
		endif;
	?>
		</tbody>
	</table>
