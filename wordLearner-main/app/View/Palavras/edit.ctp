<script>
function traduzTexto(text_from_to){
	var text_from_to = text_from_to;
	var text_en = document.getElementById('PalavraDscPalavra').value;
	var text_pt = document.getElementById('PalavraTraducaoPalavra').value;
	
	if(text_from_to == 'en_to_pt'){
		$.ajax({
			type: 'post',
			url: '<?php echo Router::url(array('controller' => 'palavras', 'action' => 'translate')); ?>',
			data: 'text_from_to='+text_from_to+'&text_en='+text_en+'&text_pt='+text_pt,
			success: function(data){
				$('#traducaoEnglishToPortuguese').html(data);
			},
			error: function(data){
				atert('Ocorreu uma falha na conexão com o Webservice. Tente novamente.');
			}
		});
	}
		else{
			$.ajax({
				type: 'post',
				url: '<?php echo Router::url(array('controller' => 'palavras', 'action' => 'translate')); ?>',
				data: 'text_from_to='+text_from_to+'&text_en='+text_en+'&text_pt='+text_pt,
				success: function(data){
					$('#traducaoPortugueseToEnglish').html(data);
				},
				error: function(data){
					atert('Ocorreu uma falha na conexão com o Webservice. Tente novamente.');
				}
			});
		}
}
</script>
<?php
	
	require_once('../class/db.class.php');
	$DB = new DB();

	$diaPalavra = $DB->getDiaPalavra($this->request->data['Palavra']['id']);
	$dia = date_create($diaPalavra[0]['dia']);
	
	$perfilVisitante = $this-> Session-> read('Auth');
	
	if($perfilVisitante['User']['id'] != $diaPalavra[0]['cod_usuario_dia']){
		echo '<span style="color: red; font-size: 26px;">Acesso negado!</span>
				<div style="position: relative; float: left;">
					'.$this->Html->image("acessdenied.jpg", array("width"=>"1300px")).'
				</div>';
		exit;
	}
?>

<div class="palavras form">
<?php
	echo $this->Form->create('Palavra');
?>
<div class="col-sm-12 col-md-12"><br><br>
<div class="block-flat" style="width: 50%">
<strong style="font-size: 26px;">Word update</strong><br>
<strong style="font-size: 11px;">Day: <?php echo date_format($dia,"d/m/Y"); ?></strong>
  <form role="form"> 
	<div class="form-group">
		<?php echo $this->Form->input('id', array('label'=>false, 'type'=>'hidden', 'value'=>$this->request->data['Palavra']['id'])); ?>
		<?php echo $this->Form->input('dsc_palavra', array('value'=>$this->request->data['Palavra']['dsc_palavra'], 'label'=>false, 'type'=>'text', 'autofocus', 'required', 'class'=>'form-control', 'placeholder'=>'Type the english word')); ?>
		<span onClick="traduzTexto('en_to_pt')" class="btn btn-primary btn-xs">Translate &nbsp;<i class="fa fa-exchange"></i></span>
		&nbsp;&nbsp;<span id="traducaoEnglishToPortuguese"></span>
	</div>
	<div class="form-group">
		<?php echo $this->Form->input('traducao_palavra', array('value'=>$this->request->data['Palavra']['traducao_palavra'], 'label'=>false,  'type'=>'text', 'required', 'class'=>'form-control', 'placeholder'=>'Digite a palavra em Português')); ?>
		<span onClick="traduzTexto('pt_to_en')" class="btn btn-primary btn-xs">Translate &nbsp;<i class="fa fa-exchange"></i></span>
		&nbsp;&nbsp;<span id="traducaoPortugueseToEnglish"></span>
	</div>
	<div class="form-group">
		<?php echo $this->Form->input('nota_observacao', array('value'=>$this->request->data['Palavra']['nota_observacao'], 'label'=>false, 'type'=>'textarea', 'class'=>'form-control', 'placeholder'=>'Some observation', 'maxlength'=>'500')); ?>
	</div>
	<div class="checkbox">
		<?php echo $this->Form->button('Save', array('class'=>'btn btn-success btn-xs', 'type'=>'submit')); ?>
		<?php 
				echo $this->Html->link
					($this->Html->tag('', 'Back to my taking note'),
						array('controller'=>'dias', 'action'=>'view', $this->request->data['Palavra']['dia_id']),
						array('class' =>'btn btn-warning btn-xs', 'escape' => false)
					);
				
				echo $this->Html->link
					($this->Html->tag('strong', 'New word'),
						array('controller'=>'palavras', 'action'=>'add', $this->request->data['Palavra']['dia_id']),
						array('class' =>'btn btn-default btn-xs', 'escape' => false, 'style'=>'color: red;')
					);
					
				echo $this->Html->link
					($this->Html->tag('strong', 'Add phrase'),
						array('controller'=>'frases', 'action'=>'add', $this->request->data['Palavra']['id']),
						array('class' =>'btn btn-default btn-xs', 'escape' => false, 'style'=>'color: red;')
					);
		?>
	</form>
  </div>
</div>				
</div>