<div class="pups form">

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

$aba = 0;
if(isset($this->request->params['named']['aba'])){
	$aba = ($this->request->params['named']['aba']);
}

if($aba == 0){
	$activeAba_0 = 'class="active"';
	$activeConteudo_0 = 'class="tab-pane active cont"';
	$activeAba_1 = '';
	$activeConteudo_1 = 'class="tab-pane cont"';
}
	else{
		$activeAba_0 = '';
		$activeConteudo_0 = 'class="tab-pane cont"';
		$activeAba_1 = 'class="active"';
		$activeConteudo_1 = 'class="tab-pane active cont"';
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

$listaMatriz = $db->getGenitor('0');
$arrayMatriz = '';
if(is_array($listaMatriz)){
	foreach($listaMatriz as $key){
		$arrayMatriz[$key['id']] = utf8_encode($key['nome_genitor']);
	}
}

$listaPadreador = $db->getGenitor('1');
$arrayPadreador = '';
if(is_array($listaPadreador)){
	foreach($listaPadreador as $key){
		$arrayPadreador[$key['id']] = utf8_encode($key['nome_genitor']);
	}
}

echo $this->Form->create('Pup');

//Setando ID do registro editado
echo $this->Form->input('id', array('hidden'));
					
?>
<br>
<div class="col-sm-8 col-md-8">
	<div class="tab-container">
		<ul class="nav nav-tabs">
		  <li <?php echo $activeAba_0; ?>><a href="#filhote" data-toggle="tab"><strong>Filhote</strong></a></li>
		  <li <?php echo $activeAba_1; ?>><a href="#fotos" data-toggle="tab"><strong>Foto</strong></a></li>
		</ul>
		<div class="tab-content">
		  <div <?php echo $activeConteudo_0; ?> id="filhote">
			<div class="block-flat">
			<strong style="font-size: 26px;">Atualização >> Filhote</strong><br>
			  <form role="form">
				<div class="form-group">
					<label>Raça *</label>
					<?php echo $this->Form->input('raca_id', array('value'=>$this->request->data['Pup']['raca_id'], 'label'=>false, 'class'=>'form-control', 'options'=>$arrayRaca, 'empty'=>'Selecione', 'style'=>'text-transform: uppercase;')); ?>
				</div>
				<div class="form-group">
					<label>Matriz *</label>
					<?php echo $this->Form->input('matriz_id', array('value'=>$this->request->data['Pup']['matriz_id'], 'label'=>false, 'class'=>'form-control', 'options'=>$arrayMatriz, 'empty'=>'Selecione', 'style'=>'text-transform: uppercase;')); ?>
				</div>
				<div class="form-group">
					<label>Padreador *</label>
					<?php echo $this->Form->input('padreador_id', array('value'=>$this->request->data['Pup']['padreador_id'], 'label'=>false, 'class'=>'form-control', 'options'=>$arrayPadreador, 'empty'=>'Selecione', 'style'=>'text-transform: uppercase;')); ?>
				</div>
				<div class="input-group date datetime" data-min-view="2">
					<?php
						echo
							$this->Form->input('data_nascimento', array('value'=>$this->request->data['Pup']['data_nascimento'], 'label'=>false,  'type'=>'text', 'required', 'onfocus'=>'loseFocus()', 'class'=>'form-control', 'placeholder'=>'Data de nascimento do filhote *', 'style'=>'text-transform: uppercase'));
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
																		  'value'=>$this->request->data['Pup']['flg_sexo'],
																		  'separator'=>'&nbsp;&nbsp;&nbsp;')
												); ?>
				</div>
				<div class="input-group">
					<span class="input-group-addon">R$</span>
					<?php echo $this->Form->input('valor', array('value'=>$this->request->data['Pup']['valor'], 'label'=>false, 'class'=>'form-control', 'placeholder'=>'Valor *', 'type'=>'number')); ?>
				</div>
				<div class="form-group">
					<label>Vacinado? *</label><br>
					<?php
						echo
							$this->Form->radio('flg_vacinado', array('1'=>'&nbsp;&nbsp;Sim',
																	 '0'=>'&nbsp;&nbsp;Não'),
																	array('legend'=>false,
																		  'type'=>'radio',
																		  'value'=>$this->request->data['Pup']['flg_vacinado'],
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
																		  'value'=>$this->request->data['Pup']['flg_vermifugado'],
																		  'separator'=>'&nbsp;&nbsp;&nbsp;')
												); ?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('flg_status', array('selected'=>$this->request->data['Pup']['flg_status'], 'label'=>'MOSTRAR NO SITE PARA VENDA? *', 'type'=>'checkbox', 'class'=>'switch', 'data-on-color'=>'success', 'data-off-color'=>'danger')); ?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->button('Salvar', array('class'=>'btn btn-success btn-xs', 'type'=>'submit')); ?>
					<?php 
							echo $this->Html->link
								($this->Html->tag('', 'Cancelar'),
									array('action'=>'index'),
									array('class' =>'btn btn-warning btn-xs', 'escape' => false,
										'confirm'=>'Deseja realmente cancelar a operação?'
									)
								);
								
							echo $this->Html->link
									($this->Html->tag('strong', 'Novo filhote'),
										array('controller'=>'Pup', 'action'=>'add'),
										array('class' =>'btn btn-default btn-xs', 'escape' => false, 'style'=>'color: red;')
									);
					?>
				</div>
				<span style="color: red;">(*) Campos obrigatórios</span>
			</div>
		  </div>
			<div <?php echo $activeConteudo_1; ?> id="fotos">
				<div class="checkbox">
					<?php 
							//PESQUISANDO FOTO DO banner
							$db = new DB();
							$photos = $db->pesquisaFOTOSBanner($this->request->data['Pup']['id']);
					
							if(empty($photos)){
								echo $this->Html->link
									($this->Html->tag('strong', 'Cadastrar foto'),
										array('controller'=>'BannerPhotos', 'action'=>'add', 'id'=>$this->request->data['Pup']['id'], 'nome_banner'=>$this->request->data['Pup']['id']),
										array('class' =>'btn btn-default btn-xs', 'escape' => false, 'style'=>'color: red; weight: bold;')
									);
							}
					?>
				</div>
				
				<?php	//Por um motivo misterioso o cakephp
						//não está gerando o form para o primeiro
						//postLink do foreach, o que ocasiona a
						//falha na deleção da primeirta imagem.
						//Para dar uma solução paleativa, o
						//primeiro postLink abaixo foi criado
						echo $this->Form->postLink((''));
				?>
			
				<?php
					if(empty($photos)){
						echo 'Nenhuma foto cadastrada';
					}
						else{
							echo '<div class="gallery-cont">';
							
							foreach($photos as $photo){
								$excluir = '<i class="fa fa-trash-o" style="cursor: pointer; font-size: 16px; color: red;" title="Remover foto"> <strong style="font-family: verdana; font-size: 10px;">Remover foto</strong></i>';
								
								echo '
										<div class="item">
										  <div class="photo">
											<div class="head">';
								
								echo $this->Form->postLink(($excluir), array('controller'=>'BannerPhotos', 'action' => 'delete', $photo['id'], $photo['banner_id']), array('confirm' => 'Deseja realmente remover esta foto?', 'escape'=>false, 'title'=>'Remover foto'));
									
								echo '
										</div>
										<div class="img">';
								
								$foto = $photo['nome_img_banner'];
								$foto = $this->Html->image("banners/$foto");
								
								echo
										$foto;
									
								echo '
										</div>
									   </div>
									  </div>';
							}
							
							echo '</div>';
						}
				?>
		  </div>
		</div>
	</div>			
</div>
</form>
<script type="text/javascript">
	jQuery(document).ready(function($) {
	  $(".datetime").datetimepicker({todayHighlight: true, format: 'dd/mm/yyyy', autoclose: true, language: 'pt-BR', todayBtn: 'linked'});
	});
	
	function loseFocus(){
		alert("Selecione a data no calendário ao lado.");
		$("#PupDataNascimento").blur();
	}
</script>