<?php
	//Verifica se é usuário não autorizado
	
	$perfilVisitante = $this-> Session-> read('Auth');
	if($perfilVisitante['User']['flg_tipo_usuario'] != 'Canil855358'){
		echo '<span style="color: red; font-size: 26px;">Acesso negado!</span>
				<div style="position: relative; float: left;">
					'.$this->Html->image("acessdenied.jpg", array("width"=>"1300px")).'
				</div>';
		exit;
	}
?>	

<div class="products index">
	<table cellpadding="0" cellspacing="0" style="text-transform: uppercase; background-color: white;">
	<thead>
		<tr style="background-color: #35365F; color: white;">
		<th style="color: white; weight: bold; font-size: 18px;" colspan="6">
			<strong>Relatório de Usuários Internos</strong>
		</th>
		<th colspan="1">
			<?php 
			echo $this->Html->link
				($this->Html->tag('strong', 'Cadastrar Usuário'),
					array('action'=>'addInternos'),
					array('class' =>'btn btn-default', 'escape' => false, 'style'=>'color: red;'
					)
				);
			?>
		</th>
		</tr>
	</thead>
	<thead>
		<tr style="background-color: #35365F; color: white;">
			<th style="width: 15%;"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('User.name', 'Nome', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
			<th style="width: 10%;"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('User.username', 'Usuário', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
			<th style="width: 15%;"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('User.email', 'Email', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
			<th style="width: 15%;"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('User.flg_unidade_usuario', 'Unidade do Usuário Interno', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
			<th style="width: 15%;"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('User.flg_unidade_usuario', 'Perfil', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
			<th style="width: 10%;"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('User.telefone', 'Telefone?', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
			<th style="width: 10%;" class="actions"><strong><?php echo __('Ações', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
		</tr>
	</thead>
	<tbody style="color: black">
	<?php foreach ($users as $user): ?>
	<?php
		switch ($user['User']['flg_unidade_usuario']){
			case 'alipio':
			$unidade = 'Alípio de Melo';
			break;
			
			case 'funcionarios':
			$unidade = 'Funcionarios';
			break;
			
			case 'luxemburgo':
			$unidade = 'Luxemburgo';
			break;
			
			case 'todas':
			$unidade = 'Todas';
			break;
			
			default:
			$unidade = 'Não informado';
			break;
		}
		
		switch ($user['User']['flg_tipo_usuario']){
			case 'Canil855358':
			$perfil = 'Gerente';
			break;
			
			case '58Cliente535885':
			$perfil = 'Produção';
			break;
			
			default:
			$perfil = 'Não informado';
			break;
		}
	?>
	<tr>
		<td><?php echo h($user['User']['name']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
		<td><?php echo h($unidade); ?>&nbsp;</td>
		<td><?php echo h($perfil); ?>&nbsp;</td>
		<td><?php echo h($user['User']['telefone']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('<i class="fa fa-edit" style="color: blue;" title="Editar"></i>'), array('action' => 'editInternos', $user['User']['id']), array('escape'=>false)); ?>
			<?php // echo $this->Form->postLink(__('<i class="fa fa-trash-o" style="color: red;"  title="Deletar"></i>'), array('action' => 'delete', $user['User']['id']), array('escape'=>false, 'confirm' => __('Deseja realmente deletar %s?', $user['User']['name']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<div style="color: black; padding: 10px; background-color: white; font-size: 13px;">
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Página <strong>{:page}</strong> de {:pages} | Total de registros {:count} | Exibindo de <strong>{:start} à {:end}</strong>')
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