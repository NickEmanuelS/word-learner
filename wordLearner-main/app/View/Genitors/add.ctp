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

<div class="Genitors form">
<?php echo $this->Form->create('Genitor'); ?>
<br>
<div class="col-sm-12 col-md-12">
<div class="block-flat">
<strong style="font-size: 26px;">Cadastro >> Genitor</strong><br>
  <form role="form"> 
	<div class="form-group">
		<label>Tipo genitor *</label><br>
		<?php
			echo
				$this->Form->radio('flg_tipo_genitor', array('0'=>'&nbsp;&nbsp;Matriz',
															 '1'=>'&nbsp;&nbsp;Padreador'),
														array('legend'=>false,
															  'type'=>'radio',
															  'value'=>'',
															  'separator'=>'&nbsp;&nbsp;&nbsp;')
									); ?>
	</div>
	<div class="form-group">
		<label>Raça *</label>
		<?php echo $this->Form->input('raca_id', array('label'=>false, 'class'=>'form-control', 'options'=>$arrayRaca, 'empty'=>'Selecione', 'style'=>'text-transform: uppercase;')); ?>
	</div>
	<div class="form-group">
	  <?php echo $this->Form->input('nome_genitor', array('label'=>false, 'placeholder'=>'Nome do genitor *', 'type'=>'text', 'class'=>'form-control', 'maxlength'=>'40')); ?>
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
	</div>
	<span style="color: red;">(*) Campos obrigatórios</span>
</form>
</div>				
</div>
</div>
