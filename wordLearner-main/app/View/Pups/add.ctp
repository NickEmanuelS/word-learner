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

$listaRacas = $db->getTodasRacas();
$arrayRaca = '';
if(is_array($listaRacas)){
	foreach($listaRacas as $key){
		$arrayRaca[$key['id']] = utf8_encode($key['nome_raca']);
	}
}

?>

<div class="Pups form">
<?php echo $this->Form->create('Pup'); ?>
<br>
<div class="col-sm-12 col-md-12">
<div class="block-flat" style="width: 50%">
<strong style="font-size: 26px;">Cadastro >> Filhote</strong><br>
  <form role="form">
	<div class="form-group">
		<label>Raça *</label>
		<?php echo $this->Form->input('raca_id', array('label'=>false, 'class'=>'form-control', 'options'=>$arrayRaca, 'empty'=>'Selecione', 'onChange'=>'carregaGenitores()', 'style'=>'text-transform: uppercase;')); ?>
	</div>
	<div id="genitores"></div>
	<div class="form-group">
		<label>Matriz *</label>
		<?php echo $this->Form->input('matriz_id', array('label'=>false, 'class'=>'form-control', 'options'=>$arrayMatriz, 'empty'=>'Selecione', 'style'=>'text-transform: uppercase;')); ?>
	</div>
	<div class="form-group">
		<label>Padreador *</label>
		<?php echo $this->Form->input('padreador_id', array('label'=>false, 'class'=>'form-control', 'options'=>$arrayPadreador, 'empty'=>'Selecione', 'style'=>'text-transform: uppercase;')); ?>
	</div>
	<div class="input-group date datetime" data-min-view="2">
		<?php
			echo
				$this->Form->input('data_nascimento', array('label'=>false,  'type'=>'text', 'required', 'onfocus'=>'loseFocus()', 'class'=>'form-control', 'placeholder'=>'Data de nascimento do filhote *', 'style'=>'text-transform: uppercase'));
		?>
		<span class="input-group-addon btn btn-primary"><?php echo $this->Html->tag('span', '', array('class'=>'glyphicon glyphicon-th', 'scape'=>false)); ?></span>
	</div>
	<div class="form-group">
		<label>Sexo *</label><br>
		<?php
			echo
				$this->Form->radio('flg_sexo', array('0'=>'&nbsp;&nbsp;Fêmea',
															 '1'=>'&nbsp;&nbsp;Macho'),
														array('legend'=>false,
															  'type'=>'radio',
															  'value'=>'',
															  'separator'=>'&nbsp;&nbsp;&nbsp;')
									); ?>
	</div>
	<div class="input-group">
		<span class="input-group-addon">R$</span>
		<?php echo $this->Form->input('valor', array('label'=>false, 'class'=>'form-control', 'placeholder'=>'Valor *', 'type'=>'number')); ?>
	</div>
	<div class="form-group">
		<label>Vacinado? *</label><br>
		<?php
			echo
				$this->Form->radio('flg_vacinado', array('1'=>'&nbsp;&nbsp;Sim',
														 '0'=>'&nbsp;&nbsp;Não'),
														array('legend'=>false,
															  'type'=>'radio',
															  'value'=>'',
															  'separator'=>'&nbsp;&nbsp;&nbsp;')
									); ?>
	</div>
	<div class="form-group">
		<label>Vermifugado? *</label><br>
		<?php
			echo
				$this->Form->radio('flg_vermifugado', array('1'=>'&nbsp;&nbsp;Sim',
															'0'=>'&nbsp;&nbsp;Não'),
														array('legend'=>false,
															  'type'=>'radio',
															  'value'=>'',
															  'separator'=>'&nbsp;&nbsp;&nbsp;')
									); ?>
	</div>
	<div class="checkbox">
		<?php echo $this->Form->button('Continuar >>', array('class'=>'btn btn-success btn-xs', 'type'=>'submit')); ?>
		<?php 
				echo $this->Html->link
					($this->Html->tag('', 'Cancelar'),
						array('action'=>'index'),
						array('class' =>'btn btn-warning btn-xs', 'escape' => false,
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
	
	function carregaGenitores(){
		var raca_id = document.getElementById('PupRacaId').value;
		alert('OK');
		$.ajax({
			type: 'post',
			url: '<?php echo Router::url(array('controller' => 'Pups', 'action' => 'genitor')); ?>',
			data: 'raca_id='+raca_id,
			success: function(data){
				$('#genitores').html(data);
			},
			error: function(data){
				atert('Ocorreu uma falha ao carregar os Genitores (Matriz | Padreador). Tente novamente.');
			}
		});
	}
	
	function loseFocus(){
		alert("Selecione a data no calendário ao lado.");
		$("#PupDataNascimento").blur();
	}
</script>