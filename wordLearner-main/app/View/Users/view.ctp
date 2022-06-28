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

<div class="users form">
<div class="col-sm-6 col-md-6">
	<br><strong style="font-size: 26px;">Dados do Cliente</strong><br><br>
<div class="block-flat">
  <form role="form">
	<div class="form-group" style="background-color: #DBF1F8; color: black; padding: 7px;">
	  <label style="font-size: 12px;">NOME: </label>
	  <?php echo '<span style="font-size: 14px; text-transform: uppercase;">'.h($user['User']['name']).'</span>'; ?>
	</div>
	<div class="form-group" style="background-color: #DBF1F8; color: black; padding: 7px;">
	  <label style="font-size: 12px;">EMAIL: </label>
	  <?php echo '<span style="font-size: 14px; text-transform: uppercase;">'.h($user['User']['email']).'</span>'; ?>
	</div>
	<div class="form-group" style="background-color: #DBF1F8; color: black; padding: 7px;">
	  <label style="font-size: 12px;">USUÁRIO: </label>
	  <?php echo '<span style="font-size: 14px; text-transform: uppercase;">'.h($user['User']['username']).'</span>'; ?>
	</div>
	<div class="form-group" style="background-color: #DBF1F8; color: black; padding: 7px;">
	  <label style="font-size: 12px;">TELEFONE: </label>
	  <?php echo '<span style="font-size: 14px; text-transform: uppercase;">'.h($user['User']['telefone']).'</span>'; ?>
	</div>
	<div class="form-group" style="background-color: #DBF1F8; color: black; padding: 7px;">
	  <label style="font-size: 12px;">ENDEREÇO: </label>
	  <?php echo '<span style="font-size: 14px; text-transform: uppercase;">'.h($user['User']['endereco']).'</span>'; ?>
	</div>
	<div class="form-group" style="background-color: #DBF1F8; color: black; padding: 7px;">
	  <label style="font-size: 12px;">BAIRRO: </label>
	  <?php echo '<span style="font-size: 14px; text-transform: uppercase;">'.h($user['User']['bairro']).'</span>'; ?>
	</div>
	<div class="form-group" style="background-color: #DBF1F8; color: black; padding: 7px;">
	  <label style="font-size: 12px;">CIDADE: </label>
	  <?php echo '<span style="font-size: 14px; text-transform: uppercase;">'.h($user['User']['cidade']).'</span>'; ?>
	</div>
	<div class="form-group" style="background-color: #DBF1F8; color: black; padding: 7px;">
	  <label style="font-size: 12px;">UF: </label>
	  <?php echo '<span style="font-size: 14px; text-transform: uppercase;">'.h($user['User']['uf']).'</span>'; ?>
	</div>
	<div class="form-group" style="background-color: #DBF1F8; color: black; padding: 7px;">
	  <label style="font-size: 12px;">CEP: </label>
	  <?php echo '<span style="font-size: 14px; text-transform: uppercase;">'.h($user['User']['cep']).'</span>'; ?>
	</div>
	<div class="checkbox">
		<?php 
			echo $this->Html->link
				($this->Html->tag('', '<i class="fa fa-reply"></i>&nbsp;Voltar'),
					array('controller'=>'users','action'=>'lista'),
					array('class' =>'btn btn-default', 'escape' => false
					)
				);
		?>
	</form>
  </div>
</div>
</div>
</div>