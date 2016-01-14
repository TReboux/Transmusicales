<?php echo '<h2>'.$title.'</h2>' ?>
	<table class="col-md-12 table table-hover">
		<thead>
	      		<tr>
				<th class="col-md-1"></th>
				<th class="col-md-2">Numéro tâche</th>
				<th class="col-md-8">Enoncé</th>
				<th class="col-md-1">Supprimer</th>
			</tr>
		</thead>
		<tbody>
	<?php foreach($todolist as $todo_item): ?>
	<tr>
		<td class="col-md-1"><?php echo anchor('todo/downrank/'.($todo_item["rang"]-1),'<span class="glyphicon glyphicon-chevron-up"></span>'); echo anchor('todo/downrank/'.$todo_item["rang"],'<span class="glyphicon glyphicon-chevron-down"></span>');?></td>
		<td class="col-md-2"><?php echo $todo_item["rang"] ?></td>
		<td class="col-md-8"><?php echo $todo_item['description']?></td>
		<td class="col-md-1"><?php echo anchor('todo/delete/'.$todo_item["rang"],'<span class="glyphicon glyphicon-trash"></span>'); ?></td>
	</tr>
	<?php endforeach ?>
		</tbody>
	</table>
