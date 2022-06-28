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

<div class="Racas form">
<?php echo $this->Form->create('Raca'); ?>
<div class="col-sm-12 col-md-12"><br>
<div class="block-flat" style="width: 50%">
<strong style="font-size: 26px;">Cadastro >> Raça</strong><br><br>
  <form role="form"> 
	<div class="form-group">
	<?php echo $this->Form->input('nome_raca', array('label'=>false, 'placeholder'=>'Nome da raça', 'class'=>'form-control', 'required', 'autofocus', 'maxlength'=>'100')); ?>
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