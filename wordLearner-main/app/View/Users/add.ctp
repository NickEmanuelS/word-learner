<?php

$perfilVisitante = $this-> Session-> read('Auth');
if($perfilVisitante['User']['flg_tipo_usuario'] != 'adm'){
	echo '<span style="color: red; font-size: 26px;">Acesso negado!</span>
			<div style="position: relative; float: left;">
				'.$this->Html->image("acessdenied.jpg", array("width"=>"1300px")).'
			</div>';
	exit;
}

?>

<script>
$(document).ready(function(){
    $("#username").focusout(function(){
	
		$.get("valida.php", {
			  },
				  function(dados){
					alert (dados);
				  }
			);
		
    });
	
});
</script>

<div class="users form">
<?php echo $this->Form->create('User'); ?>
<div class="col-sm-6 col-md-6">
	<br><strong style="font-size: 26px;">New user</strong><br><br>
<div class="block-flat">
  <form role="form"> 
	<div class="form-group">
	  <?php echo $this->Form->input('name', array('label'=>false, 'required', 'placeholder'=>'Name', 'type'=>'text', 'autofocus', 'class'=>'form-control', 'maxlength'=>'45')); ?>
	</div>
	<div class="form-group">
	  <?php echo $this->Form->input('email', array('label'=>false, 'required', 'placeholder'=>'Email', 'type'=>'email', 'class'=>'form-control', 'maxlength'=>'90')); ?>
	</div>
	<div id="validacao">
		<div class="form-group">
		<?php echo $this->Form->input('username', array('label'=>false, 'required', 'id'=>'username', 'placeholder'=>'User', 'class'=>'form-control', 'maxlength'=>'45')); ?>
		</div>
	</div>
	<div class="form-group">
	  <?php echo $this->Form->input('password', array('label'=>false, 'required', 'placeholder'=>'Password', 'class'=>'form-control', 'type'=>'password', 'maxlength'=>'90')); ?>
	</div>
	<div class="form-group">
	<?php echo $this->Form->input('telefone', array('label'=>false, 'type'=>'text', 'placeholder'=>'(DDD) Phone', 'class'=>'form-control', 'maxlength'=>'20')); ?>
	</div>
	<div class="checkbox">
		<?php echo $this->Form->button('Save', array('class'=>'btn btn-success btn-xs', 'type'=>'submit')); ?>
		<?php 
				echo $this->Html->link
					($this->Html->tag('', 'Cancel'),
						array('controller'=>'users','action'=>'lista'),
						array('class' =>'btn btn-danger btn-xs', 'escape' => false,
							'confirm'=>'Do you really want to cancel this operation?'
						)
					);
		?>
	</div>
</div>
</div>
</div>