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
			document.getElementById('ProductTamanhoFolha').value = ''; //Desmarcando
			document.getElementById('ProductTipoPapel').value = ''; //Desmarcando
			document.getElementById('ProductValorPretoBranco').value = ''; //Desmarcando
			document.getElementById('ProductTamanhoFolha').disabled = true; //Desabilitando
			document.getElementById('ProductTipoPapel').disabled = true; //Desabilitando
			document.getElementById('ProductValorPretoBranco').disabled = true; //Desabilitando
			
			// Exibe e habilita campos específicos do produto do tipo Impressão de Fotografia
			$("#dadosImpressaoFoto").fadeIn();
			$("#formGroupProductTipoPapelFoto").fadeIn();
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

$optionsTamanhoFolha =  array(
					'A4'=>'A4',
					'A3'=>'A3',
					'A2'=>'A2'
					);
					
$optionsTipoPapel =  array(
					'Comum 75gr'=>'Comum 75gr',
					'Couchê 180gr'=>'Couchê 180gr'
					);
					
$optionsTipoPapelFoto =  array(
						'Brilhante Instantâneo'=>'Brilhante Instantâneo',
						'Tradicional' =>'Tradicional'
						);
				
?>

<div class="products form">
<?php echo $this->Form->create('Product'); ?>
<div class="col-sm-12 col-md-12">
<div class="block-flat">
<strong style="font-size: 26px;">Cadastrar Produto</strong><br><br>
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
															  'value'=>'foto_impressao',
															  'separator'=>'&nbsp;&nbsp;&nbsp;',
															  'onchange' => "showHideInputs()")
									); ?>
	</div>
	<div id="dadosImpressaoFoto">
		<div class="form-group">
		  <?php echo $this->Form->input('foto_altura', array('label'=>false, 'placeholder'=>'ALTURA DA FOTO EM CENTÍMETROS (10.0 cm) *', 'type'=>'number', 'step'=>'0.01', 'class'=>'form-control', 'maxlength'=>'15')); ?>
		</div>
		<div class="form-group">
		  <?php echo $this->Form->input('foto_largura', array('label'=>false, 'placeholder'=>'LARGURA DA FOTO EM CENTÍMETROS (15.5) *', 'type'=>'number', 'step'=>'0.01', 'class'=>'form-control', 'maxlength'=>'15')); ?>
		</div>
		<div class="form-group" id="formGroupProductTipoPapelFoto">
			<label>Tipo do papel *</label>
			<?php echo $this->Form->input('tipo_papel_foto', array('label'=>false, 'class'=>'form-control', 'options'=>$optionsTipoPapelFoto, 'empty'=>'Selecione')); ?>
		</div>
	</div>
	<div id="dadosImpressaoArquivo" hidden >
		<div class="form-group">
			<label>Tamanho da folha *</label>
			<?php echo $this->Form->input('tamanho_folha', array('label'=>false, 'disabled'=>'true', 'class'=>'form-control', 'options'=>$optionsTamanhoFolha, 'empty'=>'Selecione')); ?>
		</div>
		<div class="form-group">
			<label>Tipo do papel *</label>
			<?php echo $this->Form->input('tipo_papel', array('label'=>false, 'disabled'=>'true', 'class'=>'form-control', 'options'=>$optionsTipoPapel, 'empty'=>'Selecione')); ?>
		</div>
		<div class="form-group">
			<label>Valor da unidade (preto e branco) *</label>
			<?php echo $this->Form->input('valor_preto_branco', array('label'=>false, 'disabled'=>'true', 'placeholder'=>'VALOR DA UNIDADE (PRETO E BRANCO) - (R$ 0,00) *', 'type'=>'number', 'step'=>'0.01', 'class'=>'form-control', 'maxlength'=>'15')); ?>
		</div>
	</div>
	<div class="form-group">
	  <label>Valor da unidade (colorido) *</label>
	  <?php echo $this->Form->input('valor', array('label'=>false, 'placeholder'=>'VALOR DA UNIDADE (COLORIDO) - (R$ 0,00) *', 'type'=>'number', 'step'=>'0.01', 'class'=>'form-control', 'maxlength'=>'15')); ?>
	</div>
	<div class="form-group">
	  <?php echo $this->Form->input('prazo_entrega_dias_uteis', array('label'=>false, 'placeholder'=>'DIAS ÚTEIS PARA A ENTREGA *', 'type'=>'number', 'step'=>'1', 'class'=>'form-control', 'maxlength'=>'15')); ?>
	</div>
	<div class="form-group">
		<?php echo $this->Form->input('flg_em_falta', array('label'=>'PRODUTO EM FALTA? *', 'type'=>'checkbox', 'class'=>'switch', 'data-on-color'=>'danger', 'checked'=>true)); ?>
	</div>
	<div class="checkbox">
		<?php echo $this->Form->button('Continuar >>', array('class'=>'btn btn-success', 'type'=>'submit')); ?>
		<?php 
				echo $this->Html->link
					($this->Html->tag('', 'Cancelar'),
						array('action'=>'index'),
						array('class' =>'btn btn-warning', 'escape' => false,
							'confirm'=>'Deseja realmente cancelar a operação?'
						)
					);
		?>
	</div>
	<span style="color: red;">(*) Campos obrigatórios</span>
</form>
</div>				
</div>
