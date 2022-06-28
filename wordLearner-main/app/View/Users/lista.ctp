<?php

	$perfilVisitante = $this-> Session-> read('Auth');
	if($perfilVisitante['User']['flg_tipo_usuario'] != 'adm'){
		echo '<span style="color: red; font-size: 26px;">Acesso negado!</span>
				<div style="position: relative; float: left;">
					'.$this->Html->image("acessdenied.jpg", array("width"=>"1300px")).'
				</div>';
		exit;
	}
	
?>	

<div class="col-sm-12 col-md-12"><br>
	<div class="products index">
		<table cellpadding="0" cellspacing="0" style="text-transform: uppercase; background-color: white;">
		<thead>
			<tr style="background-color: #35365F; color: white; text-transform: none;">
			<th style="color: white; weight: bold; font-size: 18px;" colspan="4">
				<strong>Users report</strong>
			</th>
			<th colspan="1">
				<?php 
				echo $this->Html->link
					($this->Html->tag('strong', 'Add users'),
						array('action'=>'add'),
						array('class' =>'btn btn-default btn-xs', 'escape' => false, 'style'=>'color: red;'
						)
					);
				?>
			</th>
			</tr>
		</thead>
		<thead>
			<tr style="background-color: #35365F; color: white; text-transform: none;">
				<th style="width: 15%;"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('User.name', 'Name', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
				<th style="width: 10%;"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('User.username', 'User', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
				<th style="width: 15%;"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('User.email', 'Email', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
				<th style="width: 10%;"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('User.telefone', 'Phone', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
				<th style="width: 10%;" class="actions"><strong><?php echo __('Action', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
			</tr>
		</thead>
		<tbody style="color: black">
		<?php foreach ($users as $user): ?>
		<tr style="text-transform: none;">
			<td><?php echo h($user['User']['name']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['telefone']); ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('<i class="fa fa-edit" style="color: blue;" title="Edit"></i>'), array('action' => 'edit', $user['User']['id']), array('escape'=>false)); ?>
				<?php // echo $this->Form->postLink(__('<i class="fa fa-trash-o" style="color: red;"  title="Deletar"></i>'), array('action' => 'delete', $user['User']['id']), array('escape'=>false, 'confirm' => __('Deseja realmente deletar %s?', $user['User']['name']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
		</tbody>
		</table>
		<div style="color: black; padding: 10px; background-color: white; font-size: 13px;">
		<?php
		echo $this->Paginator->counter(array(
			'format' => __('Page <strong>{:page}</strong> of {:pages} | Total records {:count} | Showing from <strong>{:start} to {:end}</strong>')
		));
		?>
		<span style="position: relative; left: 55%;">
		<?php
			echo $this->Paginator->prev(__('<button class="btn btn-primary"><<</button> &nbsp;&nbsp;'), array('escape'=>false), null, array('class' => 'prev disabled'));
			echo $this->Paginator->numbers(array('separator' => '<span style="color: black;"> | </span>'), array('escape'=>false), array('class'=>'btn btn-danger'));
			echo $this->Paginator->next(__('&nbsp;&nbsp;<button class="btn btn-primary">>></button>'), array('escape'=>false), null, array('class' => 'next disabled'));
		?>
		</span>
		</div>
	</div>
</div>