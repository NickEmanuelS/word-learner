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
	($this->Html->tag('strong', 'Cadastrar genitor'),
		array('action'=>'add'),
		array('class' =>'btn btn-default btn-sm', 'escape' => false, 'style'=>'color: red;'
		)
	);
?>
</div>
<div class="col-sm-12 col-md-12">
	<div class="genitors index">
		<table cellpadding="0" cellspacing="0" style="background-color: white;">
		<thead>
			<tr style="background-color: #35365F; color: white;">
				<th style="color: white; weight: bold; font-size: 18px;" colspan="5">
					<strong>
						Relatório de Genitores
					</strong>
				</th>
			</tr>
		</thead>
		<thead>
			<tr style="background-color: #35365F; color: white;">
				<!-- <th style="color: white; weight: bold; width: 8%;"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'//. $this->Paginator->sort('Genitor.id', 'Código', array('style'=>'color: white')); ?></strong></th> -->
				<th><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('Genitor.nome_genitor', 'Nome do Genitor', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
				<th><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('Genitor.raca_id', 'Raça', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
				<th><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('Genitor.flg_tipo_genitor', 'Tipo Genitor', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
				<th><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('Genitor.flg_status', 'Status', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
				<th class="actions"><strong><?php echo __('Ações', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
			</tr>
		</thead>
		<tbody style="color: black">
		<?php foreach ($Genitors as $Genitor): ?>
		<tr>
			<?php
				$tipoGenitor = '';
				switch($Genitor['Genitor']['flg_tipo_genitor']){
					case 1:
					$tipoGenitor = 'Padreador';
					break;
					
					default:
					$tipoGenitor = 'Matriz';
				}
				
				$status = '';
				switch($Genitor['Genitor']['flg_status']){
					case 1:
					$status = 'Ativo';
					break;
					
					default:
					$status = 'Inativo';
				}

				$raca = '';
				$raca = $db->getRaca($Genitor['Genitor']['raca_id']);

			?>
			<!-- <td><?php //echo h($Genitor['Genitor']['id']); ?>&nbsp;</td> -->
			<td><?php echo h($Genitor['Genitor']['nome_genitor']); ?>&nbsp;</td>
			<td><?php echo h($raca[0]['nome_raca']); ?>&nbsp;</td>
			<td><?php echo h($tipoGenitor); ?>&nbsp;</td>
			<td><?php echo h($status); ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('<i class="fa fa-edit" style="color: blue;" title="Editar"></i>'), array('action' => 'edit', $Genitor['Genitor']['id']), array('escape'=>false)); ?>
				<?php // echo $this->Html->link(__('<i class="fa fa-camera" style="color: orange;"  title="Adicionar/Alterar Foto"></i>'), array('controller'=>'photos', 'action' => 'add', 'id'=>$Genitor['Genitor']['id'], 'nome'=>$Genitor['Genitor']['nome']), array('escape'=>false)); ?>
				<?php // Delete cascade das Fotos e Promoções foram tratados no banco e deleção dos
					  // arquivos de imagem tratados no controller do Genitors
					// echo $this->Form->postLink(__('<i class="fa fa-trash-o" style="color: red;"  title="Deletar"></i>'), array('action' => 'delete', $Genitor['Genitor']['id'], $arrayFotosNome), array('escape'=>false, 'confirm' => __('Deseja realmente deletar %s?', $Genitor['Genitor']['nome']))); ?>
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