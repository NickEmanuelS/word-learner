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

$arrayUnidades = array (
							'alipio' => 'Alípio de Melo',
							'funcionarios' => 'Funcionários',
							'luxemburgo' => 'Luxemburgo',
							'todas' => 'Todas'
						);
						
$arrayPerfil = array (
						'Canil855358' => 'Gerente',
						'58Cliente535885' => 'Produção'
					);

?>

<div class="users form">
<?php echo $this->Form->create('User'); ?>
<div class="col-sm-6 col-md-6">
	<br><strong style="font-size: 26px;">Cadastro :: Usuário Interno</strong><br><br>
<div class="block-flat">
  <form role="form"> 
	<div class="form-group">
	  <?php echo $this->Form->input('name', array('label'=>false, 'placeholder'=>'nome *', 'type'=>'text', 'autofocus', 'class'=>'form-control', 'style'=>'text-transform: uppercase', 'maxlength'=>'45')); ?>
	</div>
	<div class="form-group">
	  <?php echo $this->Form->input('email', array('label'=>false, 'placeholder'=>'EMAIL *', 'type'=>'email', 'class'=>'form-control', 'maxlength'=>'90')); ?>
	</div>
	<div class="form-group">
	<?php echo $this->Form->input('username', array('label'=>false, 'placeholder'=>'USUÁRIO *', 'class'=>'form-control', 'maxlength'=>'45')); ?>
	</div>
	<div class="form-group">
	  <?php echo $this->Form->input('password', array('label'=>false, 'placeholder'=>'SENHA *', 'class'=>'form-control', 'type'=>'password', 'maxlength'=>'90')); ?>
	</div>
	<div class="form-group">
		<?php echo $this->Form->input('flg_tipo_usuario', array('label'=>false, 'class'=>'form-control', 'options'=>$arrayPerfil, 'empty'=>'Selecione o perfil do usuário *', 'style'=>'text-transform: uppercase;')); ?>
	</div>
	<div class="form-group">
		<?php echo $this->Form->input('flg_unidade_usuario', array('label'=>false, 'class'=>'form-control', 'options'=>$arrayUnidades, 'empty'=>'Selecione a unidade do usuário *', 'style'=>'text-transform: uppercase;')); ?>
	</div>
	<div class="form-group">
	<?php echo $this->Form->input('telefone', array('label'=>false, 'type'=>'text', 'placeholder'=>'Telefone com ddd *', 'class'=>'form-control', 'style'=>'text-transform: uppercase', 'maxlength'=>'20')); ?>
	</div>
	<span style="color: red;">(*) Campos obrigatórios</span>
</div>
</div>
<div class="col-sm-6 col-md-6">
	<br><strong style="font-size: 26px;">Endereço</strong><br><br>
<div class="block-flat">
	<div class="form-group">
	  <?php echo $this->Form->input('endereco', array('label'=>false, 'placeholder'=>'Endereço (logradouro e número)', 'type'=>'textarea', 'class'=>'form-control', 'style'=>'text-transform: uppercase', 'maxlength'=>'128')); ?>
	</div>
	<div class="form-group">
		<?php echo $this->Form->input('bairro', array('label'=>false, 'placeholder'=>'bairro', 'type'=>'text', 'class'=>'form-control', 'style'=>'text-transform: uppercase', 'maxlength'=>'90')); ?>
	</div>
	<div class="form-group">
		<?php echo $this->Form->input('cidade', array('label'=>false, 'placeholder'=>'cidade', 'type'=>'text', 'class'=>'form-control', 'style'=>'text-transform: uppercase', 'maxlength'=>'90')); ?>
	</div>
	<div class="form-group">
		<?php echo $this->Form->input('uf', array('label'=>false, 'placeholder'=>'UF', 'type'=>'text', 'class'=>'form-control', 'style'=>'text-transform: uppercase', 'maxlength'=>'2')); ?>
	</div>
	<div class="form-group">
		<?php echo $this->Form->input('cep', array('label'=>false, 'placeholder'=>'CEP: 00.000-000', 'type'=>'text', 'class'=>'form-control', 'style'=>'text-transform: uppercase', 'maxlength'=>'10')); ?>
	</div>
	
	<div class="checkbox">
		<?php echo $this->Form->button('Salvar', array('class'=>'btn btn-success', 'type'=>'submit')); ?>
		<?php 
				echo $this->Html->link
					($this->Html->tag('', 'Cancelar'),
						array('controller'=>'users','action'=>'listaInternos'),
						array('class' =>'btn btn-danger', 'escape' => false,
							'confirm'=>'Deseja realmente cancelar a operação?'
						)
					);
		?>
	</form>
  </div>
</div>
</div>
</div>