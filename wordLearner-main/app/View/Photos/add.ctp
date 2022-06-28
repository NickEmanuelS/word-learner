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
?>

<div class="photos form">
<?php
	echo $this->Form->create('Photo', array('type' => 'file'));
	$id = ($this->request->params['named']['id']);
	$nome = ($this->request->params['named']['nome']);
	echo $this->Form->input('product_id', array('type'=>'number', 'value'=>$id, 'hidden', 'label'=>false));
?>

<div class="col-sm-12 col-md-12">
	<br><strong style="font-size: 26px;">Cadastrar Foto</strong><br><br>
<div class="block-flat">
  <form role="form"> 
	<div class="form-group" style="font-size: 20px;">
		<label>Produto: </label><span style="text-transform: uppercase;"> <?= $nome; ?></span>
	</div>
	<div class="form-group">
		<?php echo $this->Form->file('nome', array('legend'=>false, 'escape'=>false, 'required')); ?>	
	</div>
<?php	
	echo $this->Form->button('Salvar', array('class'=>'btn btn-success', 'type'=>'submit'));
	
	echo $this->Html->link
		($this->Html->tag('', 'Cancelar'),
			array('controller'=>'products', 'action'=>'edit', $id),
			array('class' =>'btn btn-warning', 'escape' => false
			)
		);
?>
</div>				
</div>
</form>
</div>
