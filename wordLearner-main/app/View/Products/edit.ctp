<script>
function showHideInputs(){
	var tipoProduto = $('input[name="data[Product][flg_tipo_produto]"]:checked').val();
	if(tipoProduto == 'arquivo_impressao'){
		// Exibe e habilita campos específicos do produto do tipo Impressão de Fotografia
		$("#dadosImpressaoArquivo").fadeIn();
		document.getElementById('ProductTamanhoFolha').disabled = false; //Habilitando
		document.getElementById('ProductTipoPapel').disabled = false; //Habilitando
		document.getElementById('ProductValorPretoBranco').disabled = false; //Habilitando
		
		// Oculta, limpa e desabilita campos específicos do produto do tipo Impressão de Fotografia
		$("#dadosImpressaoFoto").fadeOut();
		document.getElementById('ProductFotoAltura').value = ''; //Desmarcando
		document.getElementById('ProductFotoLargura').value = ''; //Desmarcando
		document.getElementById('ProductTipoPapelFoto').value = ''; //Desmarcando
		document.getElementById('ProductFotoAltura').disabled = true; //Desabilitando
		document.getElementById('ProductFotoLargura').disabled = true; //Desabilitando
		document.getElementById('ProductTipoPapelFoto').disabled = true; //Desabilitando
	}
		else{
			// Oculta, limpa e desabilita campos específicos do produto do tipo Impressão de Arquivos
			$("#dadosImpressaoArquivo").fadeOut();
			$("#formGroupProductTipoPapelFoto").fadeIn();
			document.getElementById('ProductTamanhoFolha').value = ''; //Desmarcando
			document.getElementById('ProductTipoPapel').value = ''; //Desmarcando
			document.getElementById('ProductValorPretoBranco').value = ''; //Desmarcando
			document.getElementById('ProductTamanhoFolha').disabled = true; //Desabilitando
			document.getElementById('ProductTipoPapel').disabled = true; //Desabilitando
			document.getElementById('ProductValorPretoBranco').disabled = true; //Desabilitando
			
			// Exibe e habilita campos específicos do produto do tipo Impressão de Fotografia
			$("#dadosImpressaoFoto").fadeIn();
			document.getElementById('ProductFotoAltura').disabled = false; //Habilitando
			document.getElementById('ProductFotoLargura').disabled = false; //Habilitando
			document.getElementById('ProductTipoPapelFoto').disabled = false; //Habilitando
		}
		
		if(tipoProduto == 'banner_impressao'){
			$("#formGroupProductTipoPapelFoto").fadeOut();
			document.getElementById('ProductTipoPapelFoto').disabled = true; //Habilitando
			document.getElementById('ProductTipoPapelFoto').value = ''; //Desmarcando
		}
		
}
</script>

<div class="products form">

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

$aba = 0;
if(isset($this->request->params['named']['aba'])){
	$aba = ($this->request->params['named']['aba']);
}

if($aba == 0){
	$activeAba_0 = 'class="active"';
	$activeConteudo_0 = 'class="tab-pane active cont"';
	$activeAba_1 = '';
	$activeConteudo_1 = 'class="tab-pane active cont"';
}
	else{
		$activeAba_0 = '';
		$activeConteudo_0 = 'class="tab-pane cont"';
		$activeAba_1 = 'class="active"';
		$activeConteudo_1 = 'class="tab-pane active cont"'; 
	}

require_once('../class/db.class.php');

$db = new DB();

$optionsTamanhoFolha =  array(
					'A4'=>'A4',
					'A3'=>'A3',
					'A2'=>'A2',
					);
					
$optionsTipoPapel =  array(
					'Comum 75gr'=>'Comum 75gr',
					'Couchê 180gr'=>'Couchê 180gr'
					);
					
$optionsTipoPapelFoto =  array(
						'Tradicional' =>'Tradicional',
						'Brilhante Instantâneo'=>'Brilhante Instantâneo'
						);

// Verifica se é impressão de foto ou
// de arquivo para exibir ou ocultar os campos
$tipoProduto = $this->request->data['Product']['flg_tipo_produto'];

if($tipoProduto == 'arquivo_impressao'){
	$hiddenShow_inputs_impressao_arquivo = ''; //Exibe campos específicos produto impressão arquivo
	$hiddenShow_inputs_impressao_fotos = 'hidden'; //Oculta campos específicos produto impressão fotos
	
	// Se o produto for do tipo impressão
	// de arquivos desabilita os campos específicos
	// de impressão de fotos, retirando assim
	// o problema com sua obrigatoriedade oculta
	$statusInputsFoto = true; // Desabilitado
	$statusInputPapelFoto = true; // Desabilitado
	$statusInputsArquivo = false; // Não desabilitado
}
	else {
		$hiddenShow_inputs_impressao_arquivo = 'hidden'; //Oculta campos específicos produto impressão arquivo
		$hiddenShow_inputs_impressao_fotos = ''; //Exibe campos específicos produto impressão fotos
		
		// Se o produto for do tipo impressão
		// de fotos desabilita os campos específicos
		// de impressão de arquivos, retirando assim
		// o problema com sua obrigatoriedade oculta
		$statusInputsFoto = false; // Não desabilitado
		$statusInputPapelFoto = false; // Não desabilitado
		$statusInputsArquivo = true; // Desabilitado
	}

$hiddenShow_inputs_impressao_banner = '';
if($tipoProduto == 'banner_impressao'){
	$hiddenShow_inputs_impressao_banner = 'hidden'; //Oculta campos específicos produto impressão fotos
	$statusInputPapelFoto = true; // Desabilitado
}

echo $this->Form->create('Product');

//Setando ID do registro editado
echo $this->Form->input('id', array('hidden'));
					
?>

<div class="col-sm-8 col-md-8">
	<div class="tab-container">
		<ul class="nav nav-tabs">
		  <li <?php echo $activeAba_0; ?>><a href="#produto" data-toggle="tab"><strong>Produto</strong></a></li>
		  <li <?php echo $activeAba_1; ?>><a href="#fotos" data-toggle="tab"><strong>Foto</strong></a></li>
		</ul>
		<div class="tab-content">
		  <div <?php echo $activeConteudo_0; ?> id="produto">
			<div class="block-flat">
			<strong style="font-size: 26px;">Atualizar Produto</strong><br><br>
			  <form role="form">
				<div class="form-group">
					<label>Tipo do produto *</label><br>
					<?php
						echo
							$this->Form->radio('flg_tipo_produto', array('foto_impressao'=>'&nbsp;&nbsp;Impressão de fotos',
																		 'arquivo_impressao'=>'&nbsp;&nbsp;Impressão de arquivos',
																		 'banner_impressao'=>'&nbsp;&nbsp;Impressão de banners'),
																	array('legend'=>false,
																		  'type'=>'radio',
																		  'value'=>$this->request->data['Product']['flg_tipo_produto'],
																		  'separator'=>'&nbsp;&nbsp;&nbsp;',
																		  'onchange' => "showHideInputs()")
												); ?>
				</div>
				<div id="dadosImpressaoFoto" <?= $hiddenShow_inputs_impressao_fotos; ?> >
					<div class="form-group">
					  <label>Altura da foto (em centímetros) *</label>
					  <?php echo $this->Form->input('foto_altura', array('label'=>false, 'disabled'=>$statusInputsFoto, 'value'=>$this->request->data['Product']['foto_altura'], 'placeholder'=>'ALTURA DA FOTO EM CENTÍMETROS (10.0 cm)', 'type'=>'number', 'step'=>'0.01', 'class'=>'form-control', 'maxlength'=>'15')); ?>
					</div>
					<div class="form-group">
					  <label>Largura da foto (em centímetros) *</label>
					  <?php echo $this->Form->input('foto_largura', array('label'=>false, 'disabled'=>$statusInputsFoto, 'value'=>$this->request->data['Product']['foto_largura'], 'placeholder'=>'LARGURA DA FOTO EM CENTÍMETROS (15.5)', 'type'=>'number', 'step'=>'0.01', 'class'=>'form-control', 'maxlength'=>'15')); ?>
					</div>
					<div class="form-group" id="formGroupProductTipoPapelFoto" <?= $hiddenShow_inputs_impressao_banner; ?>>
						<label>Tipo do papel *</label>
						<?php echo $this->Form->input('tipo_papel_foto', array('label'=>false, 'disabled'=>$statusInputPapelFoto, 'value'=>$this->request->data['Product']['tipo_papel_foto'], 'options'=>$optionsTipoPapelFoto, 'empty'=>'Selecione', 'class'=>'form-control',)); ?>
					</div>
				</div>
				<div id="dadosImpressaoArquivo" <?= $hiddenShow_inputs_impressao_arquivo; ?> >
					<div class="form-group">
						<label>Tamanho da folha *</label>
						<?php echo $this->Form->input('tamanho_folha', array('label'=>false, 'disabled'=>$statusInputsArquivo, 'value'=>$this->request->data['Product']['tamanho_folha'], 'options'=>$optionsTamanhoFolha, 'empty'=>'Selecione', 'class'=>'form-control')); ?>
					</div>
					<div class="form-group">
						<label>Tipo do papel *</label>
						<?php echo $this->Form->input('tipo_papel', array('label'=>false, 'disabled'=>$statusInputsArquivo, 'value'=>$this->request->data['Product']['tipo_papel'], 'options'=>$optionsTipoPapel, 'empty'=>'Selecione', 'class'=>'form-control')); ?>
					</div>
					<div class="form-group">
						<label>Valor da unidade (preto e branco) *</label>
						<?php echo $this->Form->input('valor_preto_branco', array('label'=>false, 'disabled'=>$statusInputsArquivo, 'value'=>$this->request->data['Product']['valor_preto_branco'], 'placeholder'=>'VALOR DA UNIDADE (PRETO E BRANCO) - (R$ 0,00) *', 'type'=>'number', 'step'=>'0.01', 'class'=>'form-control')); ?>
					</div>
				</div>
				<div class="form-group">
				  <label>Valor da unidade (colorido) *</label>
				  <?php echo $this->Form->input('valor', array('label'=>false, 'value'=>$this->request->data['Product']['valor'], 'placeholder'=>'VALOR DA UNIDADE (R$ 0000,00) *', 'placeholder'=>'VALOR DA UNIDADE (COLORIDO) - (R$ 0,00) *', 'type'=>'number', 'step'=>'0.01', 'class'=>'form-control', 'maxlength'=>'15')); ?>
				</div>
				<div class="form-group">
				  <label>Quantidade de dias úteis para a entrega *</label>
				  <?php echo $this->Form->input('prazo_entrega_dias_uteis', array('label'=>false, 'value'=>$this->request->data['Product']['prazo_entrega_dias_uteis'], 'placeholder'=>'DIAS ÚTEIS PARA A ENTREGA *', 'type'=>'number', 'step'=>'1', 'class'=>'form-control', 'maxlength'=>'15')); ?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('flg_em_falta', array('selected'=>$this->request->data['Product']['flg_em_falta'], 'label'=>'PRODUTO EM FALTA? *', 'type'=>'checkbox', 'class'=>'switch', 'data-on-color'=>'danger')); ?>
				</div>
				<div class="form-group">
					<?php
						echo $this->Form->button('Salvar', array('class'=>'btn btn-success', 'type'=>'submit'));
						echo $this->Html->link
									($this->Html->tag('', 'Cancelar'),
										array('action'=>'index'),
										array('class' =>'btn btn-warning', 'escape' => false,
											'confirm'=>'Deseja realmente cancelar a operação?'
										)
									);
						echo $this->Html->link
									($this->Html->tag('strong', 'Novo produto'),
										array('controller'=>'products', 'action'=>'add'),
										array('class' =>'btn btn-default', 'escape' => false, 'style'=>'color: red;')
									);
					?>
				</div>
				<span style="color: red;">(*) Campos obrigatórios</span>
			</div>
		  </div>
		  <div <?php echo $activeConteudo_1; ?> id="fotos">
			<div class="checkbox">
				<?php 
						if($this->request->data['Product']['flg_tipo_produto'] == 'foto_impressao'){
							$nome_produto = 'FOTO '.$this->request->data['Product']['foto_altura'].'x'.$this->request->data['Product']['foto_largura'].' - '.$this->request->data['Product']['tipo_papel_foto'];
						}
							elseif($this->request->data['Product']['flg_tipo_produto'] == 'arquivo_impressao'){
								$nome_produto = 'IMPRESSÃO '.$this->request->data['Product']['tamanho_folha'].' - '.$this->request->data['Product']['tipo_papel'];
							}
								elseif($this->request->data['Product']['flg_tipo_produto'] == 'banner_impressao'){
									$nome_produto = 'BANNER '.$this->request->data['Product']['foto_altura'].'x'.$this->request->data['Product']['foto_largura'];
								}
									else{
										$nome_produto = 'FOTO '.$this->request->data['Product']['foto_altura'].'x'.$this->request->data['Product']['foto_largura'].' - '.$this->request->data['Product']['tipo_papel_foto'];
									}
				
						//PESQUISANDO FOTO DO PRODUTO
						$db = new DB();
						$photos = $db->pesquisaFOTOS($this->request->data['Product']['id']);
				
						if(empty($photos)){
							echo $this->Html->link
								($this->Html->tag('strong', 'Cadastrar Foto'),
									array('controller'=>'photos', 'action'=>'add', 'id'=>$this->request->data['Product']['id'], 'nome'=>$nome_produto), 
									array('class' =>'btn btn-default', 'escape' => false, 'style'=>'color: red; weight: bold;')
								);
						}
				?>
			</div>
			
			<?php	//Por um motivo misterioso o cakephp
					//não está gerando o form para o primeiro
					//postLink do foreach, o que ocasiona a
					//falha na deleção da primeirta imagem.
					//Para dar uma solução paleativa, o
					//primeiro postLink abaixo foi criado
					echo $this->Form->postLink((''));
			?>
			
			<?php
				if(empty($photos)){
					echo 'Nenhuma foto cadastrada';
				}
					else{
						echo '<div class="gallery-cont">';
						
						foreach($photos as $photo){
							$excluir = '<i class="fa fa-trash-o" style="cursor: pointer; font-size: 16px; color: red;" title="Remover foto"> <strong style="font-family: verdana; font-size: 10px;">Remover foto</strong></i>';
							
							echo '
									<div class="item">
									  <div class="photo">
										<div class="head">';
							
							echo $this->Form->postLink(($excluir), array('controller'=>'Photos', 'action' => 'delete', $photo['id'], $photo['product_id']), array('confirm' => 'Deseja realmente remover esta foto?', 'escape'=>false, 'title'=>'Remover foto'));
								
							echo '
									</div>
									<div class="img">';
							
							$foto = $photo['nome'];
							$foto = $this->Html->image("produtos/$foto");
							
							echo
									$foto;
								
							echo '
								    </div>
								   </div>
								  </div>';
						}
						
						echo '</div>';
					}
			?>
 
		  </div>
		</div>
	</div>			
</div>
</form>
</div>