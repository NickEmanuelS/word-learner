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

<div class="promotions index">
	<table cellpadding="0" cellspacing="0" style="text-transform: uppercase; background-color: white;">
	<thead>
		<tr style="background-color: #35365F; color: white;">
			<th style="color: white; weight: bold; font-size: 18px;" colspan="7">
				<strong>
					Lista de Promoções
				</strong>
			</th>
			<th colspan="1">
				<?php 
				echo $this->Html->link
					($this->Html->tag('strong', 'Cadastrar Promoção'),
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
			<th style="color: white; weight: bold; width: 8%;"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('Promotion.id', 'Código', array('style'=>'color: white')); ?></strong></th>
			<th style="width: 30%;"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('Promotion.product_id', 'Produto / Promoção', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
			<th style="width: 17%;"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('Promotion.qtd_minima', 'Quantidade mínima', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
			<th style="width: 10%;"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('Promotion.preco_promocao_colorido', 'Preço promoção (colorido)', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
			<th style="width: 10%;"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('Promotion.preco_promocao_preto_branco', 'Preço promoção (preto e branco)', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
			<th style="width: 10%;"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('Promotion.data_inicio_promocao', 'Data de início da promoção', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
			<th style="width: 10%;"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('Promotion.data_fim_promocao', 'Data de fim da promoção (validade)', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
			<th style="width: 10%;" class="actions"><strong><?php echo __('Ações', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
		</tr>
	</thead>
	<tbody style="color: black">
	<?php foreach ($Promotions as $Promotion): ?>
	<?php
		$detalhesProduto = $db->pesquisaProdutoId($Promotion['Promotion']['product_id']);
		if($detalhesProduto){
			foreach($detalhesProduto as $key){
				switch($key['prazo_entrega_dias_uteis']){
					case 1:
					$textoDiasUteis = ' dia útil';
					break;
					
					default:
					$textoDiasUteis = ' dias úteis';
					break;
				}
				if($key['flg_tipo_produto'] == 'foto_impressao'){
					$prefixo_nome = 'Foto ';
					$nome_produto = $key['foto_altura'].'x'.$key['foto_largura'].' - '.$key['tipo_papel_foto'].' - '.$key['prazo_entrega_dias_uteis'];
				}
					elseif($key['flg_tipo_produto'] == 'banner_impressao'){
						$prefixo_nome = 'Banner ';
						$nome_produto = $key['foto_altura'].'x'.$key['foto_largura'].' - '.$key['prazo_entrega_dias_uteis'];
					}
						elseif($key['flg_tipo_produto'] == 'arquivo_impressao'){
							$prefixo_nome = 'Impressão ';
							$nome_produto = $key['tamanho_folha'].' - '.$key['tipo_papel'].' - '.$key['prazo_entrega_dias_uteis'];
						}
							else{
								$prefixo_nome = 'Foto ';
								$nome_produto = $key['foto_altura'].'x'.$key['foto_largura'].' - '.$key['tipo_papel_foto'].' - '.$key['prazo_entrega_dias_uteis'];
							}
				$detalhesProduto = $prefixo_nome.utf8_encode($nome_produto).$textoDiasUteis;
			}
		}
		
		$preco_promocao_pb = 'R$ '.number_format($Promotion['Promotion']['preco_promocao_preto_branco'], 2, ',', '.');
		if(empty($Promotion['Promotion']['preco_promocao_preto_branco']) || $Promotion['Promotion']['preco_promocao_preto_branco'] == 0){
			$preco_promocao_pb = '-';
		}
		
	?>
	<tr>
		<td><?php echo h($Promotion['Promotion']['id']); ?>&nbsp;</td>
		<td><?php echo h($detalhesProduto); ?>&nbsp;</td>
		<td><?php echo h($Promotion['Promotion']['qtd_minima']); ?> unidades&nbsp;</td>
		<td><?php echo h('R$ '.number_format($Promotion['Promotion']['preco_promocao_colorido'], 2, ',', '.')); ?>&nbsp;</td>
		<td><?php echo h($preco_promocao_pb); ?>&nbsp;</td>
		<td><?php echo h($Promotion['Promotion']['data_inicio_promocao']); ?>&nbsp;</td>
		<td><?php echo h($Promotion['Promotion']['data_fim_promocao']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('<i class="fa fa-edit" style="color: blue;" title="Editar"></i>'), array('action' => 'edit', $Promotion['Promotion']['id']), array('escape'=>false)); ?>
			<?php echo $this->Form->postLink(__('<i class="fa fa-trash-o" style="color: red;"  title="Deletar"></i>'), array('action' => 'delete', $Promotion['Promotion']['id']), array('escape'=>false, 'confirm' => __('Deseja realmente deletar a promoção código %s, %s?', $Promotion['Promotion']['id'], $detalhesProduto))); ?>
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