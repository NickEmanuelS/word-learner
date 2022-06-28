<?php
	//Verifica se é usuário não autorizado
	
	$perfilVisitante = $this-> Session-> read('Auth');
	if($perfilVisitante['User']['flg_tipo_usuario'] != 'Canil855358' && $perfilVisitante['User']['flg_tipo_usuario'] != '58Cliente535885'){
		echo '<span style="color: red; font-size: 26px;">Acesso negado!</span>
				<div style="position: relative; float: left;">
					'.$this->Html->image("acessdenied.jpg", array("width"=>"1300px")).'
				</div>';
		exit;
	}
	
require_once('../class/db.class.php');
$db = new DB();

$status0 = $db->getCountPedidosStatus('0', $perfilVisitante['User']['flg_unidade_usuario']);
$status1 = $db->getCountPedidosStatus('1', $perfilVisitante['User']['flg_unidade_usuario']);
$status2 = $db->getCountPedidosStatus('2', $perfilVisitante['User']['flg_unidade_usuario']);
$status3 = $db->getCountPedidosStatus('3', $perfilVisitante['User']['flg_unidade_usuario']);
$status4 = $db->getCountPedidosStatus('4', $perfilVisitante['User']['flg_unidade_usuario']);
$status5 = $db->getCountPedidosStatus('5', $perfilVisitante['User']['flg_unidade_usuario']);
$status6 = $db->getCountPedidosStatus('6', $perfilVisitante['User']['flg_unidade_usuario']);
$status7 = $db->getCountPedidosStatus('7', $perfilVisitante['User']['flg_unidade_usuario']);
	
?>	
<br><br>
<div class="tbpedidos index">
	<div class="tab-container">
		<ul class="nav nav-tabs">
			<li><a href="#naoFinalizado" data-toggle="tab"><strong>Ñ Finalizado &nbsp;<div style="font-size: 12px; background-color: #3d566d; color: white; border-radius: 1200px; width: 18px; display: inline-block;"><?php echo $status0; ?></div></strong></a></li>
			<li class="active"><a href="#aguardandoPag" data-toggle="tab"><strong>Conf. Pgto &nbsp;<div style="font-size: 12px; background-color: #3d566d; color: white; border-radius: 1200px; width: 18px; display: inline-block;"><?php echo $status1; ?></div></strong></a></li>
			<li><a href="#aguardandoProd" data-toggle="tab"><strong>Aguard. Prod. &nbsp;<div style="font-size: 12px; background-color: #3d566d; color: white; border-radius: 1200px; width: 18px; display: inline-block;"><?php echo $status2; ?></div></strong></a></li>
			<li><a href="#emProducao" data-toggle="tab"><strong>Produção &nbsp;<div style="font-size: 12px; background-color: #3d566d; color: white; border-radius: 1200px; width: 18px; display: inline-block;"><?php echo $status3; ?></div></strong></a></li>
			<li><a href="#prodConcluida" data-toggle="tab"><strong>Concluída &nbsp;<div style="font-size: 12px; background-color: #3d566d; color: white; border-radius: 1200px; width: 18px; display: inline-block;"><?php echo $status4; ?></div></strong></a></li>
			<li><a href="#disponivelRetirada" data-toggle="tab"><strong>Retirada &nbsp;<div style="font-size: 12px; background-color: #3d566d; color: white; border-radius: 1200px; width: 18px; display: inline-block;"><?= $status5; ?></div></strong></a></li>
			<li><a href="#entregue" data-toggle="tab"><strong>Entregue &nbsp;<div style="font-size: 12px; background-color: #3d566d; color: white; border-radius: 1200px; width: 18px; display: inline-block;"><?php echo $status6; ?></div></strong></a></li>
			<li><a href="#cancelado" data-toggle="tab"><strong>Cancelado &nbsp;<div style="font-size: 12px; background-color: #3d566d; color: white; border-radius: 1200px; width: 18px; display: inline-block;"><?php echo $status7; ?></strong></div></a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane cont" id="naoFinalizado">
				<table cellpadding="0" cellspacing="0" style="text-transform: uppercase; background-color: white;">
					<thead>
						<tr style="background-color: #35365F; color: white;">
							<th width="9%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.numero_pedido', 'Pedido', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="9%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.unidade_retirada', 'Retirada', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="9%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.status_pedido', 'Status', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="20%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.nome_cliente', 'Solicitante', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="10%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.telefone_cliente', 'Telefone', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="19%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.email_cliente', 'Email', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="7%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.data_atualizacao_pedido', 'Data Entrada', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="7%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.numero_pedido', 'Prazo', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="9%" class="actions"><strong><?php echo __('Ações', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
						</tr>
					</thead>
					<tbody style="color: black">
					<?php foreach ($TbPedidos0 as $tbPedido0): ?>
					<?php
						switch($tbPedido0['TbPedido']['status_pedido']){
							case '0':
							$status = 'Não Finalizado no Site';
							break;
							
							case '1':
							$status = 'Aguardando Confirmação de Pagamento';
							break;

							case '2':
							$status = 'Aguardando Produção';
							break;
							
							case '3':
							$status = 'Em Produção';
							break;
							
							case '4':
							$status = 'Produção Concluída';
							break;
							
							case '5':
							$status = 'Disponível para Retirada na Unidade';
							break;
							
							case '6':
							$status = 'Entregue';
							break;
							
							case '7':
							$status = 'Cancelado';
							break;
							
							default:
							$status = 'Não Finalizado no Site';
							break;
						}
						
						switch($tbPedido0['TbPedido']['unidade_retirada']){
							case 'alipio':
							$unidade_retirada = 'Alípio de Melo';
							break;
							
							case 'funcionarios':
							$unidade_retirada = 'Funcionários';
							break;

							case 'luxemburgo':
							$unidade_retirada = 'Luxemburgo';
							break;
							
							default:
							$unidade_retirada = 'Indefinida';
							break;
						}
						
						$prazo = $tbPedido0['TbPedido']['prazo_entrega'].' dia útil';
						if($tbPedido0['TbPedido']['prazo_entrega'] > 1){
							$prazo = $tbPedido0['TbPedido']['prazo_entrega'].' dias úteis';
						}
						
						$data = date_create($tbPedido0['TbPedido']['data_fechamento_pedido_site']);
						$data_entrada_pedido = date_format($data, "d/m/Y H:i:s");
						
						/**************** IMPORTANTE! IMPORTANTE! IMPORTANTE! ****************/
						// Na página de retorno do PagSeguro, criar função para:
						// 1 - Setar a data de entrada do pedido com a data e hora do retorno
						// 2 - Setar o prazo de entrega do pedido, com o maoir prazo de entrega
						// existente entre os itens
						
						// OBS.: O nome do cliente, telefone, email e o preço final de
						// cada item do carrinho deve ser setado na tabela "tb_pedido_itens"
						// sempre no momento em que o cliente aciona a opção "PAGAR" antes de
						// ir para o PagSeguro
						/***********************************************************************/
						
					?>
					<tr>
						<td><?php echo h('IRAI'.$tbPedido0['TbPedido']['numero_pedido']); ?>&nbsp;</td>
						<td><?php echo h($unidade_retirada); ?>&nbsp;</td>
						<td><?php echo h($status); ?>&nbsp;</td>
						<td><?php echo h($tbPedido0['TbPedido']['nome_cliente']); ?>&nbsp;</td>
						<td><?php echo h($tbPedido0['TbPedido']['telefone_cliente']); ?>&nbsp;</td>
						<td><?php echo h($tbPedido0['TbPedido']['email_cliente']); ?>&nbsp;</td>
						<td><?php echo h($data_entrada_pedido); ?>&nbsp;</td>
						<td><?php echo h($prazo); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link(__('<strong style="text-transform: none; color: #333;"><i class="fa fa-list-alt" title="Detalhes do pedido"></i></strong>'), array('action' => 'edit', $tbPedido0['TbPedido']['id']), array('escape'=>false)); ?>
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
			<div class="tab-pane active cont" id="aguardandoPag">
				<table cellpadding="0" cellspacing="0" style="text-transform: uppercase; background-color: white;">
					<thead>
						<tr style="background-color: #35365F; color: white;">
							<th width="9%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.numero_pedido', 'Pedido', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="9%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.unidade_retirada', 'Retirada', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="9%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.status_pedido', 'Status', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="20%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.nome_cliente', 'Solicitante', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="10%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.telefone_cliente', 'Telefone', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="19%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.email_cliente', 'Email', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="7%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.data_atualizacao_pedido', 'Data Entrada', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="7%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.numero_pedido', 'Prazo', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="9%" class="actions"><strong><?php echo __('Ações', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
						</tr>
					</thead>
					<tbody style="color: black">
					<?php foreach ($TbPedidos1 as $tbPedido1): ?>
					<?php
						switch($tbPedido1['TbPedido']['status_pedido']){
							case '0':
							$status = 'Não Finalizado no Site';
							break;
							
							case '1':
							$status = 'Aguardando Confirmação de Pagamento';
							break;

							case '2':
							$status = 'Aguardando Produção';
							break;
							
							case '3':
							$status = 'Em Produção';
							break;
							
							case '4':
							$status = 'Produção Concluída';
							break;
							
							case '5':
							$status = 'Disponível para Retirada na Unidade';
							break;
							
							case '6':
							$status = 'Entregue';
							break;
							
							case '7':
							$status = 'Cancelado';
							break;
							
							default:
							$status = 'Não Finalizado no Site';
							break;
						}
						
						switch($tbPedido1['TbPedido']['unidade_retirada']){
							case 'alipio':
							$unidade_retirada = 'Alípio de Melo';
							break;
							
							case 'funcionarios':
							$unidade_retirada = 'Funcionários';
							break;

							case 'luxemburgo':
							$unidade_retirada = 'Luxemburgo';
							break;
							
							default:
							$unidade_retirada = 'Indefinida';
							break;
						}
						
						$prazo = $tbPedido1['TbPedido']['prazo_entrega'].' dia útil';
						if($tbPedido1['TbPedido']['prazo_entrega'] > 1){
							$prazo = $tbPedido1['TbPedido']['prazo_entrega'].' dias úteis';
						}
						
						$data = date_create($tbPedido1['TbPedido']['data_fechamento_pedido_site']);
						$data_entrada_pedido = date_format($data, "d/m/Y H:i:s");
						
						/**************** IMPORTANTE! IMPORTANTE! IMPORTANTE! ****************/
						// Na página de retorno do PagSeguro, criar função para:
						// 1 - Setar a data de entrada do pedido com a data e hora do retorno
						// 2 - Setar o prazo de entrega do pedido, com o maoir prazo de entrega
						// existente entre os itens
						
						// OBS.: O nome do cliente, telefone, email e o preço final de
						// cada item do carrinho deve ser setado na tabela "tb_pedido_itens"
						// sempre no momento em que o cliente aciona a opção "PAGAR" antes de
						// ir para o PagSeguro
						/***********************************************************************/
						
					?>
					<tr>
						<td><?php echo h('IRAI'.$tbPedido1['TbPedido']['numero_pedido']); ?>&nbsp;</td>
						<td><?php echo h($unidade_retirada); ?>&nbsp;</td>
						<td><?php echo h($status); ?>&nbsp;</td>
						<td><?php echo h($tbPedido1['TbPedido']['nome_cliente']); ?>&nbsp;</td>
						<td><?php echo h($tbPedido1['TbPedido']['telefone_cliente']); ?>&nbsp;</td>
						<td><?php echo h($tbPedido1['TbPedido']['email_cliente']); ?>&nbsp;</td>
						<td><?php echo h($data_entrada_pedido); ?>&nbsp;</td>
						<td><?php echo h($prazo); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link(__('<strong style="text-transform: none; color: #333;"><i class="fa fa-list-alt" title="Detalhes do pedido"></i></strong>'), array('action' => 'edit', $tbPedido1['TbPedido']['id']), array('escape'=>false)); ?>
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
			<div class="tab-pane cont" id="aguardandoProd">
				<table cellpadding="0" cellspacing="0" style="text-transform: uppercase; background-color: white;">
					<thead>
						<tr style="background-color: #35365F; color: white;">
							<th width="9%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.numero_pedido', 'Pedido', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="9%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.unidade_retirada', 'Retirada', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="9%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.status_pedido', 'Status', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="20%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.nome_cliente', 'Solicitante', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="10%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.telefone_cliente', 'Telefone', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="19%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.email_cliente', 'Email', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="7%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.data_atualizacao_pedido', 'Data Entrada', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="7%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.numero_pedido', 'Prazo', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="9%" class="actions"><strong><?php echo __('Ações', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
						</tr>
					</thead>
					<tbody style="color: black">
					<?php foreach ($TbPedidos2 as $tbPedido2): ?>
					<?php
						switch($tbPedido2['TbPedido']['status_pedido']){
							case '0':
							$status = 'Não Finalizado no Site';
							break;
							
							case '1':
							$status = 'Aguardando Confirmação de Pagamento';
							break;

							case '2':
							$status = 'Aguardando Produção';
							break;
							
							case '3':
							$status = 'Em Produção';
							break;
							
							case '4':
							$status = 'Produção Concluída';
							break;
							
							case '5':
							$status = 'Disponível para Retirada na Unidade';
							break;
							
							case '6':
							$status = 'Entregue';
							break;
							
							case '7':
							$status = 'Cancelado';
							break;
							
							default:
							$status = 'Não Finalizado no Site';
							break;
						}
						
						switch($tbPedido2['TbPedido']['unidade_retirada']){
							case 'alipio':
							$unidade_retirada = 'Alípio de Melo';
							break;
							
							case 'funcionarios':
							$unidade_retirada = 'Funcionários';
							break;

							case 'luxemburgo':
							$unidade_retirada = 'Luxemburgo';
							break;
							
							default:
							$unidade_retirada = 'Indefinida';
							break;
						}
						
						$prazo = $tbPedido2['TbPedido']['prazo_entrega'].' dia útil';
						if($tbPedido2['TbPedido']['prazo_entrega'] > 1){
							$prazo = $tbPedido2['TbPedido']['prazo_entrega'].' dias úteis';
						}
						
						$data = date_create($tbPedido2['TbPedido']['data_fechamento_pedido_site']);
						$data_entrada_pedido = date_format($data, "d/m/Y H:i:s");
						
						/**************** IMPORTANTE! IMPORTANTE! IMPORTANTE! ****************/
						// Na página de retorno do PagSeguro, criar função para:
						// 1 - Setar a data de entrada do pedido com a data e hora do retorno
						// 2 - Setar o prazo de entrega do pedido, com o maoir prazo de entrega
						// existente entre os itens
						
						// OBS.: O nome do cliente, telefone, email e o preço final de
						// cada item do carrinho deve ser setado na tabela "tb_pedido_itens"
						// sempre no momento em que o cliente aciona a opção "PAGAR" antes de
						// ir para o PagSeguro
						/***********************************************************************/
						
					?>
					<tr>
						<td><?php echo h('IRAI'.$tbPedido2['TbPedido']['numero_pedido']); ?>&nbsp;</td>
						<td><?php echo h($unidade_retirada); ?>&nbsp;</td>
						<td><?php echo h($status); ?>&nbsp;</td>
						<td><?php echo h($tbPedido2['TbPedido']['nome_cliente']); ?>&nbsp;</td>
						<td><?php echo h($tbPedido2['TbPedido']['telefone_cliente']); ?>&nbsp;</td>
						<td><?php echo h($tbPedido2['TbPedido']['email_cliente']); ?>&nbsp;</td>
						<td><?php echo h($data_entrada_pedido); ?>&nbsp;</td>
						<td><?php echo h($prazo); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link(__('<strong style="text-transform: none; color: #333;"><i class="fa fa-list-alt" title="Detalhes do pedido"></i></strong>'), array('action' => 'edit', $tbPedido2['TbPedido']['id']), array('escape'=>false)); ?>
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
			<div class="tab-pane cont" id="emProducao">
				<table cellpadding="0" cellspacing="0" style="text-transform: uppercase; background-color: white;">
					<thead>
						<tr style="background-color: #35365F; color: white;">
							<th width="9%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.numero_pedido', 'Pedido', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="9%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.unidade_retirada', 'Retirada', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="9%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.status_pedido', 'Status', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="20%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.nome_cliente', 'Solicitante', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="10%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.telefone_cliente', 'Telefone', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="19%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.email_cliente', 'Email', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="7%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.data_atualizacao_pedido', 'Data Entrada', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="7%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.numero_pedido', 'Prazo', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="9%" class="actions"><strong><?php echo __('Ações', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
						</tr>
					</thead>
					<tbody style="color: black">
					<?php foreach ($TbPedidos3 as $tbPedido3): ?>
					<?php
						switch($tbPedido3['TbPedido']['status_pedido']){
							case '0':
							$status = 'Não Finalizado no Site';
							break;
							
							case '1':
							$status = 'Aguardando Confirmação de Pagamento';
							break;

							case '2':
							$status = 'Aguardando Produção';
							break;
							
							case '3':
							$status = 'Em Produção';
							break;
							
							case '4':
							$status = 'Produção Concluída';
							break;
							
							case '5':
							$status = 'Disponível para Retirada na Unidade';
							break;
							
							case '6':
							$status = 'Entregue';
							break;
							
							case '7':
							$status = 'Cancelado';
							break;
							
							default:
							$status = 'Não Finalizado no Site';
							break;
						}
						
						switch($tbPedido3['TbPedido']['unidade_retirada']){
							case 'alipio':
							$unidade_retirada = 'Alípio de Melo';
							break;
							
							case 'funcionarios':
							$unidade_retirada = 'Funcionários';
							break;

							case 'luxemburgo':
							$unidade_retirada = 'Luxemburgo';
							break;
							
							default:
							$unidade_retirada = 'Indefinida';
							break;
						}
						
						$prazo = $tbPedido3['TbPedido']['prazo_entrega'].' dia útil';
						if($tbPedido3['TbPedido']['prazo_entrega'] > 1){
							$prazo = $tbPedido3['TbPedido']['prazo_entrega'].' dias úteis';
						}
						
						$data = date_create($tbPedido3['TbPedido']['data_fechamento_pedido_site']);
						$data_entrada_pedido = date_format($data, "d/m/Y H:i:s");
						
						/**************** IMPORTANTE! IMPORTANTE! IMPORTANTE! ****************/
						// Na página de retorno do PagSeguro, criar função para:
						// 1 - Setar a data de entrada do pedido com a data e hora do retorno
						// 2 - Setar o prazo de entrega do pedido, com o maoir prazo de entrega
						// existente entre os itens
						
						// OBS.: O nome do cliente, telefone, email e o preço final de
						// cada item do carrinho deve ser setado na tabela "tb_pedido_itens"
						// sempre no momento em que o cliente aciona a opção "PAGAR" antes de
						// ir para o PagSeguro
						/***********************************************************************/
						
					?>
					<tr>
						<td><?php echo h('IRAI'.$tbPedido3['TbPedido']['numero_pedido']); ?>&nbsp;</td>
						<td><?php echo h($unidade_retirada); ?>&nbsp;</td>
						<td><?php echo h($status); ?>&nbsp;</td>
						<td><?php echo h($tbPedido3['TbPedido']['nome_cliente']); ?>&nbsp;</td>
						<td><?php echo h($tbPedido3['TbPedido']['telefone_cliente']); ?>&nbsp;</td>
						<td><?php echo h($tbPedido3['TbPedido']['email_cliente']); ?>&nbsp;</td>
						<td><?php echo h($data_entrada_pedido); ?>&nbsp;</td>
						<td><?php echo h($prazo); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link(__('<strong style="text-transform: none; color: #333;"><i class="fa fa-list-alt" title="Detalhes do pedido"></i></strong>'), array('action' => 'edit', $tbPedido3['TbPedido']['id']), array('escape'=>false)); ?>
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
			<div class="tab-pane cont" id="prodConcluida">
								<table cellpadding="0" cellspacing="0" style="text-transform: uppercase; background-color: white;">
					<thead>
						<tr style="background-color: #35365F; color: white;">
							<th width="9%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.numero_pedido', 'Pedido', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="9%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.unidade_retirada', 'Retirada', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="9%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.status_pedido', 'Status', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="20%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.nome_cliente', 'Solicitante', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="10%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.telefone_cliente', 'Telefone', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="19%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.email_cliente', 'Email', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="7%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.data_atualizacao_pedido', 'Data Entrada', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="7%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.numero_pedido', 'Prazo', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="9%" class="actions"><strong><?php echo __('Ações', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
						</tr>
					</thead>
					<tbody style="color: black">
					<?php foreach ($TbPedidos4 as $tbPedido4): ?>
					<?php
						$token_cart = $tbPedido4['TbPedido']['id'];
						switch($tbPedido4['TbPedido']['status_pedido']){
							case '0':
							$status = 'Não Finalizado no Site';
							break;
							
							case '1':
							$status = 'Aguardando Confirmação de Pagamento';
							break;

							case '2':
							$status = 'Aguardando Produção';
							break;
							
							case '3':
							$status = 'Em Produção';
							break;
							
							case '4':
							$status = 'Produção Concluída';
							break;
							
							case '5':
							$status = 'Disponível para Retirada na Unidade';
							break;
							
							case '6':
							$status = 'Entregue';
							break;
							
							case '7':
							$status = 'Cancelado';
							break;
							
							default:
							$status = 'Não Finalizado no Site';
							break;
						}
						
						switch($tbPedido4['TbPedido']['unidade_retirada']){
							case 'alipio':
							$unidade_retirada = 'Alípio de Melo';
							break;
							
							case 'funcionarios':
							$unidade_retirada = 'Funcionários';
							break;

							case 'luxemburgo':
							$unidade_retirada = 'Luxemburgo';
							break;
							
							default:
							$unidade_retirada = 'Indefinida';
							break;
						}
						
						$prazo = $tbPedido4['TbPedido']['prazo_entrega'].' dia útil';
						if($tbPedido4['TbPedido']['prazo_entrega'] > 1){
							$prazo = $tbPedido4['TbPedido']['prazo_entrega'].' dias úteis';
						}
						
						$data = date_create($tbPedido4['TbPedido']['data_fechamento_pedido_site']);
						$data_entrada_pedido = date_format($data, "d/m/Y H:i:s");
						
						/**************** IMPORTANTE! IMPORTANTE! IMPORTANTE! ****************/
						// Na página de retorno do PagSeguro, criar função para:
						// 1 - Setar a data de entrada do pedido com a data e hora do retorno
						// 2 - Setar o prazo de entrega do pedido, com o maoir prazo de entrega
						// existente entre os itens
						
						// OBS.: O nome do cliente, telefone, email e o preço final de
						// cada item do carrinho deve ser setado na tabela "tb_pedido_itens"
						// sempre no momento em que o cliente aciona a opção "PAGAR" antes de
						// ir para o PagSeguro
						/***********************************************************************/
						
					?>
					<tr>
						<td><?php echo h('IRAI'.$tbPedido4['TbPedido']['numero_pedido']); ?>&nbsp;</td>
						<td><?php echo h($unidade_retirada); ?>&nbsp;</td>
						<td><?php echo h($status); ?>&nbsp;</td>
						<td><?php echo h($tbPedido4['TbPedido']['nome_cliente']); ?>&nbsp;</td>
						<td><?php echo h($tbPedido4['TbPedido']['telefone_cliente']); ?>&nbsp;</td>
						<td><?php echo h($tbPedido4['TbPedido']['email_cliente']); ?>&nbsp;</td>
						<td><?php echo h($data_entrada_pedido); ?>&nbsp;</td>
						<td><?php echo h($prazo); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link(__('<strong style="text-transform: none; color: #333;"><i class="fa fa-list-alt" title="Detalhes do pedido"></i></strong>'), array('action' => 'edit', $tbPedido4['TbPedido']['id']), array('escape'=>false)); ?>
							<a	
								href="../ticket.php?hash=<?= $token_cart; ?>"
								target="_blank"
								onclick="window.open(this.href,'etiqueta','width=670,height=650'); return false;"
								title="Galeria de fotos"
								id="etiqueta">
								<i class="fa fa-print" title="Imprimir etiqueta"></i>
							</a>
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
			<div class="tab-pane cont" id="disponivelRetirada">
								<table cellpadding="0" cellspacing="0" style="text-transform: uppercase; background-color: white;">
					<thead>
						<tr style="background-color: #35365F; color: white;">
							<th width="9%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.numero_pedido', 'Pedido', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="9%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.unidade_retirada', 'Retirada', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="9%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.status_pedido', 'Status', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="20%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.nome_cliente', 'Solicitante', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="10%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.telefone_cliente', 'Telefone', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="19%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.email_cliente', 'Email', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="7%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.data_atualizacao_pedido', 'Data Entrada', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="7%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.numero_pedido', 'Prazo', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="9%" class="actions"><strong><?php echo __('Ações', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
						</tr>
					</thead>
					<tbody style="color: black">
					<?php foreach ($TbPedidos5 as $tbPedido5): ?>
					<?php
						$token_cart = $tbPedido5['TbPedido']['id'];
						switch($tbPedido5['TbPedido']['status_pedido']){
							case '0':
							$status = 'Não Finalizado no Site';
							break;
							
							case '1':
							$status = 'Aguardando Confirmação de Pagamento';
							break;

							case '2':
							$status = 'Aguardando Produção';
							break;
							
							case '3':
							$status = 'Em Produção';
							break;
							
							case '4':
							$status = 'Produção Concluída';
							break;
							
							case '5':
							$status = 'Disponível para Retirada na Unidade';
							break;
							
							case '6':
							$status = 'Entregue';
							break;
							
							case '7':
							$status = 'Cancelado';
							break;
							
							default:
							$status = 'Não Finalizado no Site';
							break;
						}
						
						switch($tbPedido5['TbPedido']['unidade_retirada']){
							case 'alipio':
							$unidade_retirada = 'Alípio de Melo';
							break;
							
							case 'funcionarios':
							$unidade_retirada = 'Funcionários';
							break;

							case 'luxemburgo':
							$unidade_retirada = 'Luxemburgo';
							break;
							
							default:
							$unidade_retirada = 'Indefinida';
							break;
						}
						
						$prazo = $tbPedido5['TbPedido']['prazo_entrega'].' dia útil';
						if($tbPedido5['TbPedido']['prazo_entrega'] > 1){
							$prazo = $tbPedido5['TbPedido']['prazo_entrega'].' dias úteis';
						}
						
						$data = date_create($tbPedido5['TbPedido']['data_fechamento_pedido_site']);
						$data_entrada_pedido = date_format($data, "d/m/Y H:i:s");
						
						/**************** IMPORTANTE! IMPORTANTE! IMPORTANTE! ****************/
						// Na página de retorno do PagSeguro, criar função para:
						// 1 - Setar a data de entrada do pedido com a data e hora do retorno
						// 2 - Setar o prazo de entrega do pedido, com o maoir prazo de entrega
						// existente entre os itens
						
						// OBS.: O nome do cliente, telefone, email e o preço final de
						// cada item do carrinho deve ser setado na tabela "tb_pedido_itens"
						// sempre no momento em que o cliente aciona a opção "PAGAR" antes de
						// ir para o PagSeguro
						/***********************************************************************/
						
					?>
					<tr>
						<td><?php echo h('IRAI'.$tbPedido5['TbPedido']['numero_pedido']); ?>&nbsp;</td>
						<td><?php echo h($unidade_retirada); ?>&nbsp;</td>
						<td><?php echo h($status); ?>&nbsp;</td>
						<td><?php echo h($tbPedido5['TbPedido']['nome_cliente']); ?>&nbsp;</td>
						<td><?php echo h($tbPedido5['TbPedido']['telefone_cliente']); ?>&nbsp;</td>
						<td><?php echo h($tbPedido5['TbPedido']['email_cliente']); ?>&nbsp;</td>
						<td><?php echo h($data_entrada_pedido); ?>&nbsp;</td>
						<td><?php echo h($prazo); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link(__('<strong style="text-transform: none; color: #333;"><i class="fa fa-list-alt" title="Detalhes do pedido"></i></strong>'), array('action' => 'edit', $tbPedido5['TbPedido']['id']), array('escape'=>false)); ?>
							<a	
								href="../ticket.php?hash=<?= $token_cart; ?>"
								target="_blank"
								onclick="window.open(this.href,'etiqueta','width=670,height=650'); return false;"
								title="Galeria de fotos"
								id="etiqueta">
								<i class="fa fa-print" title="Imprimir etiqueta"></i>
							</a>
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
			<div class="tab-pane cont" id="entregue">
								<table cellpadding="0" cellspacing="0" style="text-transform: uppercase; background-color: white;">
					<thead>
						<tr style="background-color: #35365F; color: white;">
							<th width="9%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.numero_pedido', 'Pedido', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="9%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.unidade_retirada', 'Retirada', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="9%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.status_pedido', 'Status', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="20%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.nome_cliente', 'Solicitante', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="10%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.telefone_cliente', 'Telefone', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="19%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.email_cliente', 'Email', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="7%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.data_atualizacao_pedido', 'Data Entrada', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="7%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.numero_pedido', 'Prazo', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="9%" class="actions"><strong><?php echo __('Ações', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
						</tr>
					</thead>
					<tbody style="color: black">
					<?php foreach ($TbPedidos6 as $tbPedido6): ?>
					<?php
						$token_cart = $tbPedido6['TbPedido']['id'];
						switch($tbPedido6['TbPedido']['status_pedido']){
							case '0':
							$status = 'Não Finalizado no Site';
							break;
							
							case '1':
							$status = 'Aguardando Confirmação de Pagamento';
							break;

							case '2':
							$status = 'Aguardando Produção';
							break;
							
							case '3':
							$status = 'Em Produção';
							break;
							
							case '4':
							$status = 'Produção Concluída';
							break;
							
							case '5':
							$status = 'Disponível para Retirada na Unidade';
							break;
							
							case '6':
							$status = 'Entregue';
							break;
							
							case '7':
							$status = 'Cancelado';
							break;
							
							default:
							$status = 'Não Finalizado no Site';
							break;
						}
						
						switch($tbPedido6['TbPedido']['unidade_retirada']){
							case 'alipio':
							$unidade_retirada = 'Alípio de Melo';
							break;
							
							case 'funcionarios':
							$unidade_retirada = 'Funcionários';
							break;

							case 'luxemburgo':
							$unidade_retirada = 'Luxemburgo';
							break;
							
							default:
							$unidade_retirada = 'Indefinida';
							break;
						}
						
						$prazo = $tbPedido6['TbPedido']['prazo_entrega'].' dia útil';
						if($tbPedido6['TbPedido']['prazo_entrega'] > 1){
							$prazo = $tbPedido6['TbPedido']['prazo_entrega'].' dias úteis';
						}
						
						$data = date_create($tbPedido6['TbPedido']['data_fechamento_pedido_site']);
						$data_entrada_pedido = date_format($data, "d/m/Y H:i:s");
						
						/**************** IMPORTANTE! IMPORTANTE! IMPORTANTE! ****************/
						// Na página de retorno do PagSeguro, criar função para:
						// 1 - Setar a data de entrada do pedido com a data e hora do retorno
						// 2 - Setar o prazo de entrega do pedido, com o maoir prazo de entrega
						// existente entre os itens
						
						// OBS.: O nome do cliente, telefone, email e o preço final de
						// cada item do carrinho deve ser setado na tabela "tb_pedido_itens"
						// sempre no momento em que o cliente aciona a opção "PAGAR" antes de
						// ir para o PagSeguro
						/***********************************************************************/
						
					?>
					<tr>
						<td><?php echo h('IRAI'.$tbPedido6['TbPedido']['numero_pedido']); ?>&nbsp;</td>
						<td><?php echo h($unidade_retirada); ?>&nbsp;</td>
						<td><?php echo h($status); ?>&nbsp;</td>
						<td><?php echo h($tbPedido6['TbPedido']['nome_cliente']); ?>&nbsp;</td>
						<td><?php echo h($tbPedido6['TbPedido']['telefone_cliente']); ?>&nbsp;</td>
						<td><?php echo h($tbPedido6['TbPedido']['email_cliente']); ?>&nbsp;</td>
						<td><?php echo h($data_entrada_pedido); ?>&nbsp;</td>
						<td><?php echo h($prazo); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link(__('<strong style="text-transform: none; color: #333;"><i class="fa fa-list-alt" title="Detalhes do pedido"></i></strong>'), array('action' => 'edit', $tbPedido6['TbPedido']['id']), array('escape'=>false)); ?>
							<a	
								href="../ticket.php?hash=<?= $token_cart; ?>"
								target="_blank"
								onclick="window.open(this.href,'etiqueta','width=670,height=650'); return false;"
								title="Galeria de fotos"
								id="etiqueta">
								<i class="fa fa-print" title="Imprimir etiqueta"></i>
							</a>
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
			<div class="tab-pane cont" id="cancelado">
								<table cellpadding="0" cellspacing="0" style="text-transform: uppercase; background-color: white;">
					<thead>
						<tr style="background-color: #35365F; color: white;">
							<th width="9%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.numero_pedido', 'Pedido', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="9%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.unidade_retirada', 'Retirada', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="9%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.status_pedido', 'Status', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="20%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.nome_cliente', 'Solicitante', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="10%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.telefone_cliente', 'Telefone', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="19%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.email_cliente', 'Email', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="7%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.data_atualizacao_pedido', 'Data Entrada', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="7%"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('TbPedido.numero_pedido', 'Prazo', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
							<th width="9%" class="actions"><strong><?php echo __('Ações', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
						</tr>
					</thead>
					<tbody style="color: black">
					<?php foreach ($TbPedidos7 as $tbPedido7): ?>
					<?php
						switch($tbPedido7['TbPedido']['status_pedido']){
							case '0':
							$status = 'Não Finalizado no Site';
							break;
							
							case '1':
							$status = 'Aguardando Confirmação de Pagamento';
							break;

							case '2':
							$status = 'Aguardando Produção';
							break;
							
							case '3':
							$status = 'Em Produção';
							break;
							
							case '4':
							$status = 'Produção Concluída';
							break;
							
							case '5':
							$status = 'Disponível para Retirada na Unidade';
							break;
							
							case '6':
							$status = 'Entregue';
							break;
							
							case '7':
							$status = 'Cancelado';
							break;
							
							default:
							$status = 'Não Finalizado no Site';
							break;
						}
						
						switch($tbPedido7['TbPedido']['unidade_retirada']){
							case 'alipio':
							$unidade_retirada = 'Alípio de Melo';
							break;
							
							case 'funcionarios':
							$unidade_retirada = 'Funcionários';
							break;

							case 'luxemburgo':
							$unidade_retirada = 'Luxemburgo';
							break;
							
							default:
							$unidade_retirada = 'Indefinida';
							break;
						}
						
						$prazo = $tbPedido7['TbPedido']['prazo_entrega'].' dia útil';
						if($tbPedido7['TbPedido']['prazo_entrega'] > 1){
							$prazo = $tbPedido7['TbPedido']['prazo_entrega'].' dias úteis';
						}
						
						$data = date_create($tbPedido7['TbPedido']['data_fechamento_pedido_site']);
						$data_entrada_pedido = date_format($data, "d/m/Y H:i:s");
						
						/**************** IMPORTANTE! IMPORTANTE! IMPORTANTE! ****************/
						// Na página de retorno do PagSeguro, criar função para:
						// 1 - Setar a data de entrada do pedido com a data e hora do retorno
						// 2 - Setar o prazo de entrega do pedido, com o maoir prazo de entrega
						// existente entre os itens
						
						// OBS.: O nome do cliente, telefone, email e o preço final de
						// cada item do carrinho deve ser setado na tabela "tb_pedido_itens"
						// sempre no momento em que o cliente aciona a opção "PAGAR" antes de
						// ir para o PagSeguro
						/***********************************************************************/
						
					?>
					<tr>
						<td><?php echo h('IRAI'.$tbPedido7['TbPedido']['numero_pedido']); ?>&nbsp;</td>
						<td><?php echo h($unidade_retirada); ?>&nbsp;</td>
						<td><?php echo h($status); ?>&nbsp;</td>
						<td><?php echo h($tbPedido7['TbPedido']['nome_cliente']); ?>&nbsp;</td>
						<td><?php echo h($tbPedido7['TbPedido']['telefone_cliente']); ?>&nbsp;</td>
						<td><?php echo h($tbPedido7['TbPedido']['email_cliente']); ?>&nbsp;</td>
						<td><?php echo h($data_entrada_pedido); ?>&nbsp;</td>
						<td><?php echo h($prazo); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link(__('<strong style="text-transform: none; color: #333;"><i class="fa fa-list-alt" title="Detalhes do pedido"></i></strong>'), array('action' => 'edit', $tbPedido7['TbPedido']['id']), array('escape'=>false)); ?>
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
	</div>
</div>