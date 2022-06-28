<div class="racas form">

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

echo $this->Form->create('Raca');

//Setando ID do registro editado
echo $this->Form->input('id', array('hidden'));
					
?>
<br>
<div class="col-sm-12 col-md-12">
		<div class="block-flat" style="width: 50%">
		<strong style="font-size: 26px;">Atualização >> Raça</strong><br>
		  <form role="form">
			<div class="form-group">
				<label>Nome da raça</label>
				<?php echo $this->Form->input('nome_raca', array('value'=>$this->request->data['Raca']['nome_raca'], 'label'=>false,  'type'=>'text', 'placeholder'=>'Nome da raça', 'class'=>'form-control', 'autofocus', 'maxlength'=>'100')); ?>
			</div>
			<div class="form-group">
				<?php
					echo $this->Form->button('Salvar', array('class'=>'btn btn-success btn-xs', 'type'=>'submit'));
					echo $this->Html->link
								($this->Html->tag('', 'Cancelar'),
									array('action'=>'index'),
									array('class' =>'btn btn-warning btn-xs', 'escape' => false,
										'confirm'=>'Deseja realmente cancelar a operação?'
									)
								);
					echo $this->Html->link
								($this->Html->tag('strong', 'Nova raça'),
									array('controller'=>'racas', 'action'=>'add'),
									array('class' =>'btn btn-default btn-xs', 'escape' => false, 'style'=>'color: red;')
								);
				?>
			</div>
		</div>
	</div>			
</form>
</div>
</div>