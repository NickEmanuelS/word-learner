<div class="genitors form">

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

echo $this->Form->create('Genitor');

//Setando ID do registro editado
echo $this->Form->input('id', array('hidden'));
					
?>
<br>
<div class="col-sm-8 col-md-8">
	<div class="tab-container">
		<ul class="nav nav-tabs">
		  <li <?php echo $activeAba_0; ?>><a href="#genitor" data-toggle="tab"><strong>Genitor</strong></a></li>
		  <li <?php echo $activeAba_1; ?>><a href="#fotos" data-toggle="tab"><strong>Foto</strong></a></li>
		</ul>
		<div class="tab-content">
		  <div <?php echo $activeConteudo_0; ?> id="genitor">
			<div class="block-flat">
			<strong style="font-size: 26px;">Atualização >> Genitor</strong><br><br>
			  <form role="form">
				<div class="form-group">
					<label>Tipo genitor *</label><br>
					<?php
						echo
							$this->Form->radio('flg_tipo_genitor', array('0'=>'&nbsp;&nbsp;Matriz',
																		 '1'=>'&nbsp;&nbsp;Padreador'),
																	array('legend'=>false,
																		  'type'=>'radio',
																		  'value'=>$this->request->data['Genitor']['flg_tipo_genitor'],
																		  'separator'=>'&nbsp;&nbsp;&nbsp;')
												); ?>
				</div>
				<div class="form-group">
				  <label>Raça *</label>
				  <?php echo $this->Form->input('raca_id', array('label'=>false, 'class'=>'form-control', 'value'=>$this->request->data['Genitor']['raca_id'], 'options'=>$arrayRaca, 'empty'=>'Selecione', 'style'=>'text-transform: uppercase;')); ?>
				</div>
				<div class="form-group">
				  <label>Nome do genitor *</label>
				  <?php echo $this->Form->input('nome_genitor', array('label'=>false, 'value'=>$this->request->data['Genitor']['nome_genitor'], 'placeholder'=>'Nome do genitor *', 'type'=>'text', 'class'=>'form-control', 'maxlength'=>'40')); ?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('flg_status', array('selected'=>$this->request->data['Genitor']['flg_status'], 'label'=>'ATIVADO? *', 'type'=>'checkbox', 'class'=>'switch', 'data-on-color'=>'success')); ?>
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
									($this->Html->tag('strong', 'Novo genitor'),
										array('controller'=>'Genitors', 'action'=>'add'),
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
						//PESQUISANDO FOTO DO PRODUTO
						$db = new DB();
						$photos = $db->pesquisaFOTOS($this->request->data['Genitor']['id']);
				
						if(empty($photos)){
							echo $this->Html->link
								($this->Html->tag('strong', 'Cadastrar foto'),
									array('controller'=>'photos', 'action'=>'add', 'id'=>$this->request->data['Genitor']['id'], 'nome'=>$this->request->data['Genitor']['nome_genitor']), 
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
							
							echo $this->Form->postLink(($excluir), array('controller'=>'Photos', 'action' => 'delete', $photo['id'], $photo['product_id']), array('confirm' => 'Deseja realmente remover esta foto?', 'escape'=>false, 'title'=>'Remover foto'));
								
							echo '
									</div>
									<div class="img">';
							
							$foto = $photo['nome'];
							$foto = $this->Html->image("produtos/$foto");
							
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
</div>