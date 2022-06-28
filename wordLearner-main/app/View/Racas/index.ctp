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

require_once('../class/db.class.php');

$db = new DB();
	
?>
<br>
<div class="col-sm-12 col-md-12" align="right">
<?php 
	echo $this->Html->link
		($this->Html->tag('strong', 'Cadastrar raça'),
			array('action'=>'add'),
			array('class' =>'btn btn-default btn-sm', 'escape' => false, 'style'=>'color: red;'
			)
		);
?>
</div>
<div class="col-sm-12 col-md-12">
	<div class="racas index">
		<table cellpadding="0" cellspacing="0" style="text-transform: none; background-color: white;">
		<thead>
			<tr style="background-color: #35365F; color: white;">
				<th style="color: white; weight: bold; font-size: 18px;" colspan="3">
					<strong>
						Lista de Raças
					</strong>
				</th>
			</tr>
		</thead>
		<thead>
			<tr style="background-color: #35365F; color: white;">
				<th><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('Raca.nome_raca', 'Nome da Raça', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
				<th class="actions"><strong><?php echo __('Ações', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
			</tr>
		</thead>
		<tbody style="color: black">
		<?php foreach ($Racas as $Raca): ?>
		<tr>
			<td><?php echo h($Raca['Raca']['nome_raca']); ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('<i class="fa fa-edit" style="color: blue;" title="Editar"></i>'), array('action' => 'edit', $Raca['Raca']['id']), array('escape'=>false)); ?>
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
</div>