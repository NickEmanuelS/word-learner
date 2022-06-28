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

<div class="products index">
	<table cellpadding="0" cellspacing="0" style="text-transform: uppercase; background-color: white;">
	<thead>
		<tr style="background-color: #35365F; color: white;">
			<th style="color: white; weight: bold; font-size: 18px;" colspan="5">
				<strong>
					Relatório de Produtos
				</strong>
			</th>
			<th>
				<?php 
				echo $this->Html->link
					($this->Html->tag('strong', 'Cadastrar Produto'),
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
			<!-- <th style="color: white; weight: bold; width: 8%;"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'//. $this->Paginator->sort('Product.id', 'Código', array('style'=>'color: white')); ?></strong></th> -->
			<th><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('Product.flg_tipo_produto', 'Nome', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
			<th><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('Product.valor', 'Valor Colorido', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
			<th><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('Product.valor_preto_branco', 'Valor Preto e branco', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
			<th><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('Product.prazo_entrega_dias_uteis', 'Dias entrega', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
			<th><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('Product.flg_em_falta', 'Em falta?', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
			<th class="actions"><strong><?php echo __('Ações', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
		</tr>
	</thead>
	<tbody style="color: black">
	<?php foreach ($productSends as $productSend): ?>
	<tr>
		<?php
		
			if($productSend['Product']['flg_tipo_produto'] == 'foto_impressao'){
				$nome_produto = 'FOTO '.$productSend['Product']['foto_altura'].'x'.$productSend['Product']['foto_largura'].' - '.$productSend['Product']['tipo_papel_foto'];
				$valor_preto_branco = '-';
			}
				elseif($productSend['Product']['flg_tipo_produto'] == 'banner_impressao'){
					$nome_produto = 'BANNER '.$productSend['Product']['foto_altura'].'x'.$productSend['Product']['foto_largura'];
					$valor_preto_branco = '-';
				}
					else{
						$nome_produto = 'IMPRESSÃO '.$productSend['Product']['tamanho_folha'].' - '.$productSend['Product']['tipo_papel'];
						$valor_preto_branco = number_format($productSend['Product']['valor_preto_branco'], 2, ',', '.');
					}
			
			$flg_falta = '';
			
			switch($productSend['Product']['flg_em_falta']){
				case 1:
					$flg_falta = 'Sim';
					break;
				
				default:
					$flg_falta = 'Não';
			}

			$fotosNome = '';
			$fotosNome = $db->pesquisaFOTOS($productSend['Product']['id']);
			
			$arrayFotosNome = '';
			
			if(is_array($fotosNome)){
				foreach($fotosNome as $key){
					if($arrayFotosNome == ''){
						$arrayFotosNome = $key['nome'];
					}
						else {
							$arrayFotosNome = $arrayFotosNome.','.$key['nome'];
						}
				}
			}
			
			$texto_dia_util = ' dia útil';
			if($productSend['Product']['prazo_entrega_dias_uteis'] > 1){
				$texto_dia_util = ' dias úteis';
			}
			
		?>
		<!-- <td><?php //echo h($productSend['Product']['id']); ?>&nbsp;</td> -->
		<td><?php echo h($nome_produto); ?>&nbsp;</td>
		<td><?php echo h('R$ '.number_format($productSend['Product']['valor'], 2, ',', '.')); ?>&nbsp;</td>
		<td><?php echo h('R$ '.$valor_preto_branco); ?>&nbsp;</td>
		<td><?php echo h($productSend['Product']['prazo_entrega_dias_uteis'].$texto_dia_util); ?>&nbsp;</td>
		<td><?php echo h($flg_falta); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('<i class="fa fa-edit" style="color: blue;" title="Editar"></i>'), array('action' => 'edit', $productSend['Product']['id']), array('escape'=>false)); ?>
			<?php // echo $this->Html->link(__('<i class="fa fa-camera" style="color: orange;"  title="Adicionar/Alterar Foto"></i>'), array('controller'=>'photos', 'action' => 'add', 'id'=>$productSend['Product']['id'], 'nome'=>$productSend['Product']['nome']), array('escape'=>false)); ?>
			<?php // Delete cascade das Fotos e Promoções foram tratados no banco e deleção dos
				  // arquivos de imagem tratados no controller do Products
				// echo $this->Form->postLink(__('<i class="fa fa-trash-o" style="color: red;"  title="Deletar"></i>'), array('action' => 'delete', $productSend['Product']['id'], $arrayFotosNome), array('escape'=>false, 'confirm' => __('Deseja realmente deletar %s?', $productSend['Product']['nome']))); ?>
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