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

<div class="banners index">
	<table cellpadding="0" cellspacing="0" style="text-transform: uppercase; background-color: white;">
	<thead>
		<tr style="background-color: #35365F; color: white;">
			<th style="color: white; weight: bold; font-size: 18px;" colspan="4">
				<strong>
					Lista de Banners
				</strong>
			</th>
			<th colspan="1">
				<?php 
				echo $this->Html->link
					($this->Html->tag('strong', 'Cadastrar Banner'),
						array('action'=>'add'),
						array('class' =>'btn btn-default', 'escape' => false, 'style'=>'color: red;'
						)
					);
				?>
			</th>
		</tr>
	</thead>
	<thead>
		<tr style="background-color: #35365F; color: white;">
			<th style="color: white; weight: bold; width: 8%;"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('Banner.id', 'Código', array('style'=>'color: white')); ?></strong></th>
			<th style="width: 30%;"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('Banner.nome_banner', 'Nome do banner', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
			<th style="width: 8%;"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('Banner.data_inicio_exibicao', 'Data de início da exibição no site', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
			<th style="width: 8%;"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('Banner.data_fim_exibicao', 'Data de retirada da exibição no site', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
			<th style="width: 10%;" class="actions"><strong><?php echo __('Ações', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
		</tr>
	</thead>
	<tbody style="color: black">
	<?php foreach ($Banners as $Banner): ?>
	
	<?php
		
		$fotosNome = '';
		$fotosNome = $db->pesquisaFOTOSBanner($Banner['Banner']['id']);
		
		$arrayFotosNome = '';
		
		if(is_array($fotosNome)){
			foreach($fotosNome as $key){
				if($arrayFotosNome == ''){
					$arrayFotosNome = $key['nome_img_banner'];
				}
					else {
						$arrayFotosNome = $arrayFotosNome.','.$key['nome_img_banner'];
					}
			}
		}
	
	?>
	
	<tr>
		<td><?php echo h($Banner['Banner']['id']); ?>&nbsp;</td>
		<td><?php echo h($Banner['Banner']['nome_banner']); ?>&nbsp;</td>
		<td><?php echo h($Banner['Banner']['data_inicio_exibicao']); ?>&nbsp;</td>
		<td><?php echo h($Banner['Banner']['data_fim_exibicao']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('<i class="fa fa-edit" style="color: blue;" title="Editar"></i>'), array('action' => 'edit', $Banner['Banner']['id']), array('escape'=>false)); ?>
			<?php echo $this->Html->link(__('<i class="fa fa-camera" style="color: orange;"  title="Adicionar/Alterar Foto"></i>'), array('controller'=>'bannerphotos', 'action' => 'add', 'id'=>$Banner['Banner']['id'], 'nome_banner'=>$Banner['Banner']['nome_banner']), array('escape'=>false)); ?>
			<?php // Delete cascade das Fotos foram tratados no banco e deleção dos
				  // arquivos de imagem tratados no controller do Banners
				echo $this->Form->postLink(__('<i class="fa fa-trash-o" style="color: red;"  title="Deletar"></i>'), array('action' => 'delete', $Banner['Banner']['id'], $arrayFotosNome), array('escape'=>false, 'confirm' => __('Deseja realmente deletar %s?', $Banner['Banner']['nome_banner']))); ?>
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