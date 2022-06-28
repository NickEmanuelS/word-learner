<script>
function showHideInput(){
	var statusPedido = $('select[name="data[TbPedido][status_pedido]"]').val();
	if(statusPedido == '5' || statusPedido == '6'){
		// Exibe e habilita o campo de observação de retirada
		$("#div_ObsRetiradaPedido").fadeIn();
		document.getElementById('TbPedidoObsRetiradaPedido').disabled = false; //Habilitando
		document.getElementById('TbPedidoObsRetiradaPedido').focus();
	}
		else {
			// Exibe e habilita o campo de observação de retirada
			$("#div_ObsRetiradaPedido").fadeOut();
			document.getElementById('TbPedidoObsRetiradaPedido').disabled = true; //Desabilitando
		}
		
	if(statusPedido == '7'){
		// Exibe e habilita o campo de motivo do cancelamento
		$("#div_DscMotivoCancelamento").fadeIn();
		document.getElementById('TbPedidoDscMotivoCancelamento').disabled = false; //Habilitando
		document.getElementById('TbPedidoDscMotivoCancelamento').focus();
	}
		else {
			// Exibe e habilita o campo de observação de retirada
			$("#div_DscMotivoCancelamento").fadeOut();
			document.getElementById('TbPedidoDscMotivoCancelamento').disabled = true; //Desabilitando
		}
}
</script>

<div class="tb_pedidos form">

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

$data_aprovacao_pagamento = 'Pendente';
$aprovacaoPagamento = $db->getDataAprovacao($this->request->data['TbPedido']['id']);
if(is_array($aprovacaoPagamento)){
	$dateAprovacao = date_create($aprovacaoPagamento[0]['data_atualizacao']);
	$data_aprovacao_pagamento = date_format($dateAprovacao, "d/m/Y H:i:s");
}

$ultimaAlteracaoStatus = $db->getUltimaAlteracaoStatus($this->request->data['TbPedido']['id']);
if(is_array($ultimaAlteracaoStatus)){
	
	$dateUltimaAlteracao = date_create($ultimaAlteracaoStatus[0]['data_atualizacao']);
	$data_ultima_alteracao = date_format($dateUltimaAlteracao, "d/m/Y H:i:s");
	
	$status_antigo = $ultimaAlteracaoStatus[0]['status_antigo'];
	switch($status_antigo){
		case '0':
		$status_antigo = 'Não Finalizado no Site';
		break;
		
		case '1':
		$status_antigo = 'Aguardando Conf. de Pgto';
		break;

		case '2':
		$status_antigo = 'Aguardando Produção';
		break;
		
		case '3':
		$status_antigo = 'Em Produção';
		break;
		
		case '4':
		$status_antigo = 'Produção Concluída';
		break;
		
		case '5':
		$status_antigo = 'Disp. p/ Retirada na Unid.';
		break;
		
		case '6':
		$status_antigo = 'Entregue';
		break;
		
		case '7':
		$status_antigo = 'Cancelado';
		break;
		
		case '8':
		$status_antigo = 'Obsoleto';
		break;
		
		default:
		$status_antigo = 'Não Finalizado no Site';
		break;
	}
	
	$status_novo = $ultimaAlteracaoStatus[0]['status_novo'];
	switch($status_novo){
		case '0':
		$status_novo = 'Não Finalizado no Site';
		break;
		
		case '1':
		$status_novo = 'Aguardando Conf. de Pgto';
		break;

		case '2':
		$status_novo = 'Aguardando Produção';
		break;
		
		case '3':
		$status_novo = 'Em Produção';
		break;
		
		case '4':
		$status_novo = 'Produção Concluída';
		break;
		
		case '5':
		$status_novo = 'Disp. p/ Retirada na Unid.';
		break;
		
		case '6':
		$status_novo = 'Entregue';
		break;
		
		case '7':
		$status_novo = 'Cancelado';
		break;
		
		case '8':
		$status_novo = 'Obsoleto';
		break;
		
		default:
		$status_novo = 'Não Finalizado no Site';
		break;
	}
	
	if($ultimaAlteracaoStatus[0]['id_usuario_logado'] != '0'){
		$usuario_alteracao = $db->getUsuario($ultimaAlteracaoStatus[0]['id_usuario_logado']);
	}
		else{
			$usuario_alteracao = array(array('username'=>'KWebSystems'));
		}
		
	$data_ultima_alteracao = 'Data: '.$data_ultima_alteracao.'<br>'.
	'Status anterior: '.$status_antigo.'<br>'.
	'Status atual: '.$status_novo.'<br>'.
	'Usuário: '.$usuario_alteracao[0]['username'].'&nbsp;&nbsp;<a	
																href="../../../historicoStatus.php?hash='.$this->request->data['TbPedido']['id'].'"
																target="_blank"
																onclick="window.open(this.href,'."'".'historico'."'".','."'".'width=670,height=480'."'".'); return false;"
																id="historicoStatus">
																<i style="color: green; font-size: 20px; cursor: pointer;" title="Visualizar histórico de alteração de status" class="fa fa-search"></i>
															</a>';
}
	else{
		$data_ultima_alteracao = 'Nenhuma alteração de status.';
	}
	
echo $this->Form->create('TbPedido');

//Setando ID do registro editado
echo $this->Form->input('id', array('hidden'));

switch($this->request->data['TbPedido']['unidade_retirada']){
	case 'alipio':
	$unidadeRetirada = 'Alípio de Melo';
	break;
	
	case 'funcionarios':
	$unidadeRetirada = 'Funcionários';
	break;
	
	case 'luxemburgo':
	$unidadeRetirada = 'Luxemburgo';
	break;
	
	default:
	$unidadeRetirada = 'Indefinida';
	break;
}

if($this->request->data['TbPedido']['status_pedido'] == '0'){
	$arrayStatus = array(
							'0' => 'Não Finalizado no Site',
							'1' => 'Aguardando Confirmação de Pagamento',
							'2' => 'Aguardando Produção',
							'3' => 'Em Produção',
							'4' => 'Produção Concluída',
							'5' => 'Disponível para Retirada na Unidade',
							'6' => 'Entregue',
							'7' => 'Cancelado'
						);
	$dataPedidoSite = 'Aguardando finalização no site';
	$prazoEntrega = 'Aguardando finalização no site';
}
	else{
		$arrayStatus = array(
						'1' => 'Aguardando Confirmação de Pagamento',
						'2' => 'Aguardando Produção',
						'3' => 'Em Produção',
						'4' => 'Produção Concluída',
						'5' => 'Disponível para Retirada na Unidade',
						'6' => 'Entregue',
						'7' => 'Cancelado'
					);

		$date = date_create($this->request->data['TbPedido']['data_fechamento_pedido_site']);
		$dataPedidoSite = date_format($date, "d/m/Y H:i:s");			

		$diaUtil = ' dia útil';
		if($this->request->data['TbPedido']['prazo_entrega'] > 1){
			$diaUtil = ' dias úteis';
		}
		$prazoEntrega = $this->request->data['TbPedido']['prazo_entrega'].$diaUtil;
	}
				
?>

<div class="col-sm-12 col-md-12">
	<form role="form">
		<div class="tab-container">
			<ul class="nav nav-tabs">
				<li class="tab-pane active cont"><a href="#Pedido" data-toggle="tab"><strong>Pedido</strong></a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active cont" id="Pedido">
					<strong style="font-size: 26px;">Atualizar Pedido</strong><br><br>
					<div class="block-flat">
						<strong style="font-size: 19px;">
							<?php
								echo 'STATUS PEDIDO IRAI'.$this->request->data['TbPedido']['numero_pedido'];
								echo '&nbsp;&nbsp;&nbsp;'.$this->Form->button('Atualizar', array('class'=>'btn btn-success btn-sm', 'type'=>'submit'));
								echo '&nbsp;'.$this->Html->link
											($this->Html->tag('', 'Voltar'),
												array('action'=>'index'),
												array('class' =>'btn btn-warning btn-sm', 'escape' => false)
											);
								
								if($this->request->data['TbPedido']['status_pedido'] == '4' || $this->request->data['TbPedido']['status_pedido'] == '5' || $this->request->data['TbPedido']['status_pedido'] == '6'){
									echo '	<a	
												href="../../../ticket.php?hash='.$this->request->data['TbPedido']['id'].'"
												target="_blank"
												onclick="window.open(this.href,'."'".'etiqueta'."'".','."'".'width=670,height=650'."'".'); return false;"
												id="etiqueta">
												<button class="btn btn-primary btn-sm">Gerar etiqueta</button>
											</a>';
								}
							?>
						</strong>
						<?php echo $this->Form->input('status_pedido', array('label'=>false, 'class'=>'form-control', 'value'=>$this->request->data['TbPedido']['status_pedido'], 'options'=>$arrayStatus, 'style'=>'text-transform: uppercase;', 'onchange'=>"showHideInput()")); ?>
						<?php
							if($this->request->data['TbPedido']['status_pedido'] == '0'){
								echo '<i style="color: red;">O pedido ainda não foi finalizado pelo cliente no site. Alterar o status somente em situações excepcionais.</i>';
							}
						?>
						<?php
							$displayRetirada = 'none';
							if($this->request->data['TbPedido']['status_pedido'] == '5' || $this->request->data['TbPedido']['status_pedido'] == '6'){
								$displayRetirada = 'block';
							}
							
							$displayCancelamento = 'none';
							$disabledCancelamento = 'disabled';
							if($this->request->data['TbPedido']['status_pedido'] == '7'){
								$displayCancelamento = 'block';
								$disabledCancelamento = '';
							}
						?>
						<div id="div_ObsRetiradaPedido" style="display: <?= $displayRetirada; ?>" class='form-group'>
							<?php echo $this->Form->input('obs_retirada_pedido', array('label'=>'Observação na retirada do pedido', 'placeholder'=>'Exemplo: nome da pessoa que fez a retirada', 'value'=>$this->request->data['TbPedido']['obs_retirada_pedido'], 'type'=>'text', 'class'=>'form-control', 'maxlength'=>'128')); ?>
						</div>
						<div id="div_DscMotivoCancelamento" style="display: <?= $displayCancelamento; ?>" class='form-group'>
							<?php echo $this->Form->input('dsc_motivo_cancelamento', array('label'=>'Motivo do cancelamento', 'placeholder'=>'Descreva o motivo do cancelamento', 'value'=>$this->request->data['TbPedido']['dsc_motivo_cancelamento'], 'type'=>'text', 'required', $disabledCancelamento, 'class'=>'form-control', 'maxlength'=>'128')); ?>
						</div>
							<div class="form-group">
								<table>
									<tbody>
										<tr>
											<td style="border: none; background-color: white; font-size: 15px;">
												<strong>Cliente</strong><br>
												<?php
													echo $this->request->data['TbPedido']['nome_cliente'];
												?>
											</td>
											<td style="border: none; background-color: white; font-size: 15px;">
												<strong>CPF</strong><br>
												<?php
													echo $this->request->data['TbPedido']['cpf_cliente'];
												?>
											</td>
											<td style="border: none; background-color: white; font-size: 15px;">
												<strong>Telefone</strong><br>
												<?php
													echo $this->request->data['TbPedido']['telefone_cliente'];
												?>
											</td>
										</tr>
											<?php
													echo '	<tr>
																<td style="border: none; background-color: white; font-size: 15px;">
																	<strong>Email</strong><br>';
																	echo $this->request->data['TbPedido']['email_cliente'];
													echo '		</td>
																<td style="border: none; background-color: white; font-size: 15px;">
																	<strong>Unidade de Retirada</strong><br>
																		'.$unidadeRetirada.'
																</td>
																<td style="border: none; background-color: white; font-size: 15px;">
																	<strong>Prazo de Entrega</strong><br>
																		'.$prazoEntrega.'
																</td>
															</tr>';
											?>
										<tr>
											<td style="border: none; background-color: white; font-size: 15px;">
												<strong>Data Recebimento (Site)</strong><br>
												<?php echo $dataPedidoSite; ?>
											</td>
											<td style="border: none; background-color: white; font-size: 15px;">
												<strong>Aprovação Pagamento</strong><br>
												<?php echo $data_aprovacao_pagamento; ?>
											</td>
											<td style="border: none; background-color: white; font-size: 15px;">
												<strong>Última atualização de status</strong><br>
												<?php
													echo $data_ultima_alteracao;
												?>
											</td>
										</tr>
									</tbody>
								</table>
								<br>
								<table>
									<tbody>
										<tr>
											<td style="border: none; background-color: white; font-size: 15px;">
												<strong>Observação <span style="color: #d42a32;">interna</span></strong>
												<div class="form-group">
													<?php echo $this->Form->input('obs_interna_pedido', array('label'=>false, 'placeholder'=>'Descreva alguma observação importante para a EQUIPE', 'value'=>$this->request->data['TbPedido']['obs_interna_pedido'], 'type'=>'text', 'class'=>'form-control', 'maxlength'=>'128')); ?>
												</div>
											</td>
										</tr>
										<tr>
											<td style="border: none; background-color: white; font-size: 15px;">
												<strong>Observação externa (para o cliente)</strong>
												<div class="form-group">
													<?php echo $this->Form->input('obs_externa_pedido', array('label'=>false, 'placeholder'=>'Descreva alguma observação importante para o CLIENTE', 'value'=>$this->request->data['TbPedido']['obs_externa_pedido'], 'type'=>'text', 'class'=>'form-control', 'maxlength'=>'128')); ?>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
								<br>
								<?php
									if($this->request->data['TbPedido']['status_pedido'] >= '2' && $this->request->data['TbPedido']['status_pedido'] <= '5'){
										echo '<a href="../../../download.php?ticket='.$this->request->data['TbPedido']['id'].'&pedido='.$this->request->data['TbPedido']['numero_pedido'].'&itemDB=0&itemList=0" style="color: white;"><strong><button class="btn btn-success"><i class="fa fa-download"></i>&nbsp; Baixar arquivo(s)</a></strong></button>';
									}
								?>
								<table>
									<thead>
										<tr style="background-color: #555; color: white;">
											<th colspan="7"><strong style="font-size: 15px;">Detalhamento - Pedido </th>
										</tr>
										<tr style="background-color: #555; color: white;">
											<th>Item</th>
											<th>Descrição</th>
											<th>Quantidade</th>
											<th>Valor</th>
											<th>Subtotal</th>
											<th>Nome do arquivo</th>
											<th>Observação</th>
										</tr>
									</thead>
									<tbody>
										<?php
											
											$produtosCarrinho = $db->getItensCarrinho($this->request->data['TbPedido']['id']);
											$total = 0;
											$conteudoListaPedido = '';
											$codItem = 0;
											if($produtosCarrinho){
												foreach($produtosCarrinho as $key){
													
													$codItem++;
													$downloadIcon = '';
													
													/*
													if($this->request->data['TbPedido']['status_pedido'] != '6' && $this->request->data['TbPedido']['status_pedido'] != '7' && $this->request->data['TbPedido']['status_pedido'] != '8'){
														$downloadIcon = '<a href="../../../download.php?ticket='.$this->request->data['TbPedido']['id'].'&pedido='.$this->request->data['TbPedido']['numero_pedido'].'&itemDB='.$key['id_item'].'&itemList='.$codItem.'"><i class="fa fa-download" title="Baixar arquivo" style="cursor: pointer; color: #2d97ba;"></i></a>';
													}
													*/
											
													$detalhesProduto = $db->getProdutoDetalhes($key['cod_produto']);
													
													$tipo_produto = $detalhesProduto[0]['flg_tipo_produto'];
													$altura_produto = $detalhesProduto[0]['foto_altura'];
													$largura_produto = $detalhesProduto[0]['foto_largura'];
													$tamanho_folha_produto = $detalhesProduto[0]['tamanho_folha'];
													$tipo_papel_produto = $detalhesProduto[0]['tipo_papel'];
													$tipo_papel_foto = $detalhesProduto[0]['tipo_papel_foto'];
													$nome_original_arquivo_doc = $key['nome_original_arquivo_doc'];
													
													$obs_cliente_item = '-';
													if(!empty($key['obs_cliente_item'])){
														$obs_cliente_item = $key['obs_cliente_item'];
													}
													
													$nome_original_arquivo_doc = '-';
													if(!empty($key['nome_original_arquivo_doc'])){
														$nome_original_arquivo_doc = $key['nome_original_arquivo_doc'];
													}
													
													if($tipo_produto == 'arquivo_impressao'){
														$nome_produto = utf8_decode('Impressão ').$tamanho_folha_produto.' - '.$tipo_papel_produto;
														$valorProduto = ($key['qtd_folha_colorida'] * $key['valor_und_fechamento_pedido']) + ($key['qtd_folha_preto_branco'] * $key['valor_preto_branco_und_fechamento_pedido']);
														if($valorProduto == 0){
															$valorProduto = $key['valor_preto_branco_und_fechamento_pedido'];
														}
													}
														elseif($tipo_produto == 'foto_impressao'){
															$nome_produto = 'Foto '.$altura_produto.'x'.$largura_produto.' - '.$tipo_papel_foto;
															if($tipo_papel_foto == 'Tradicional'){
																$nome_produto = 'Foto '.$altura_produto.'x'.$largura_produto.' - '.$tipo_papel_foto.' ('.$key['tipo_papel_tradicional'].')';
															}
															
															$valorProduto = $key['valor_und_fechamento_pedido'];
														}
															elseif($tipo_produto == 'banner_impressao'){
																$nome_produto = 'Banner '.$altura_produto.'x'.$largura_produto;
																$valorProduto = $key['valor_und_fechamento_pedido'];
															}
													
													$subtotal = $key['qtd_copias'] * $valorProduto;
													$total = $total + $subtotal;
													
													$conteudoListaPedido =
													$conteudoListaPedido .'<tr>
																				<td style="text-align: left;">
																					'.$codItem.'&nbsp;&nbsp;&nbsp;'.$downloadIcon.'
																				</td>
																				<td style="text-align: left;">
																					'.utf8_encode($nome_produto).'
																				</td>
																				<td style="text-align: left;">
																					'.$key['qtd_copias'].'
																				</td>
																				<td style="text-align: left;">
																					R$ '.number_format($valorProduto, 2, ',', '.').'
																				</td>
																				<td style="text-align: left;">
																					R$ '.number_format($subtotal, 2, ',', '.').'
																				</td>
																				<td style="text-align: left;">
																					'.$nome_original_arquivo_doc.'
																				</td>
																				<td style="text-align: left;">
																					'.$obs_cliente_item.'
																				</td>
																			</tr>';
												}
											}
											
											echo $conteudoListaPedido.'	<tr style="text-align: left;">
																			<td colspan="4">Total</td>
																			<td colspan="3">R$ '.number_format($total, 2, ',', '.').'</td>
																		</tr>';
																			
									?>
									</tbody>
								</table>
							</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>