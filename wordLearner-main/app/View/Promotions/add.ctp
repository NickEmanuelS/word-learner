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

$listaProdutos = $db->pesquisaTodosProdutos();

if($listaProdutos){
	foreach($listaProdutos as $key){
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
		$arrayProdutos[$key['id']] = $prefixo_nome.utf8_encode($nome_produto).$textoDiasUteis;
	}
}
			
?>

<div class="Promotions form">
<?php echo $this->Form->create('Promotion'); ?>
<div class="col-sm-12 col-md-12">
	<br><strong style="font-size: 26px;">Cadastrar Promoção</strong><br><br>
<div class="block-flat" style="width: 50%">
  <form role="form">
	<div class="form-group">
		<label>Produto</label>
		<?php echo $this->Form->input('product_id', array('label'=>false, 'class'=>'form-control', 'options'=>$arrayProdutos, 'empty'=>'Selecione', 'onChange'=>'showHideInputs(this.value)', 'style'=>'text-transform: uppercase;')); ?>
	</div>
	<div class="form-group">
		<label>Quantidade mínima de unidades para entrar na promoção</label>
		<?php echo $this->Form->input('qtd_minima', array('label'=>false, 'class'=>'form-control', 'placeholder'=>'0', 'type'=>'number')); ?>
	</div>
	<div class="form-group">
		<label>Valor promocional da unidade (colorido)*</label>
		<?php echo $this->Form->input('preco_promocao_colorido', array('label'=>false, 'class'=>'form-control', 'placeholder'=>'R$ 0,00 *', 'step'=>'0.01', 'type'=>'number')); ?>
	</div>
	<div class="form-group">
		<label>Valor promocional da unidade (preto e branco)</label>
		<?php echo $this->Form->input('preco_promocao_preto_branco', array('label'=>false, 'class'=>'form-control', 'placeholder'=>'R$ 0,00 (SOMENTE PARA IMPRESSÃO DE DOCUMENTOS)', 'step'=>'0.01', 'type'=>'number')); ?>
	</div>
	<div class="input-group date datetime" data-min-view="2">
		<?php
			echo
				$this->Form->input('data_inicio_promocao', array('label'=>false,  'type'=>'text', 'required', 'onfocus'=>'loseFocus()', 'class'=>'form-control', 'placeholder'=>'Data de início da promoção'));
		?>
		<span class="input-group-addon btn btn-primary"><?php echo $this->Html->tag('span', '', array('class'=>'glyphicon glyphicon-th', 'scape'=>false)); ?></span>
	</div>
	<div class="input-group date datetime" data-min-view="2">
		<?php
			echo
				$this->Form->input('data_fim_promocao', array('label'=>false,  'type'=>'text', 'required', 'onfocus'=>'loseFocus()', 'class'=>'form-control', 'placeholder'=>'Data de fim da promoção (validade)'));
		?>
		<span class="input-group-addon btn btn-primary"><?php echo $this->Html->tag('span', '', array('class'=>'glyphicon glyphicon-th', 'scape'=>false)); ?></span>
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
	</form>
  </div>
</div>				
</div>
<script type="text/javascript">
	jQuery(document).ready(function($) {
	  $(".datetime").datetimepicker({todayHighlight: true, format: 'dd/mm/yyyy', autoclose: true, language: 'pt-BR', todayBtn: 'linked'});
	});
	
	function loseFocus(){
		alert("Selecione a data no calendário ao lado.");
		$("#PromotionDataInicioPromocao").blur();
		$("#PromotionDataFimPromocao").blur();
	}
</script>