<script>
function traduzTexto(text_from_to){
	var text_from_to = text_from_to;
	var text_en = document.getElementById('FraseFrasePalavra').value;
	var text_pt = document.getElementById('FraseTraducaoFrasePalavra').value;
	alert(text_from_to);
	alert(text_en);
	alert(text_pt);
	if(text_from_to == 'en_to_pt'){
		$.ajax({
			type: 'post',
			url: '<?php echo Router::url(array('controller' => 'frases', 'action' => 'translate')); ?>',
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
				url: '<?php echo Router::url(array('controller' => 'frases', 'action' => 'translate')); ?>',
				data: 'text_from_to='+text_from_to+'&text_en='+text_en+'&text_pt='+text_pt,
				success: function(data){
					$('#traducaoPortugueseToEnglish').html(data);
				},
				error: function(data){
					atert('Ocorreu uma falha na conexão com o Webservice. Tente novamente.');
				}
			});
		}
</script>
<div class="Dias form">
<?php
	echo $this->Form->create('Frase');
	$palavra_id = $this->params['pass'][0];
	
	require_once('../class/db.class.php');
	$DB = new DB();
	
	$perfilVisitante = $this-> Session-> read('Auth');
	$diaPalavra = $DB->getDiaPalavra($palavra_id);
	$palavra = $DB->getPalavra($palavra_id);
?>
<div class="col-sm-12 col-md-12"><br><br>
<div class="block-flat" style="width: 50%">
<strong style="font-size: 26px;">New phrase</strong><br>
<strong style="font-size: 11px;">Word: <?php echo utf8_encode($palavra[0]['dsc_palavra']).' = '.utf8_encode($palavra[0]['traducao_palavra']); ?></strong>
  <form role="form"> 
	<div class="form-group">
		<?php echo $this->Form->input('palavra_id', array('label'=>false, 'type'=>'hidden', 'value'=>$palavra_id)); ?>
		<?php echo $this->Form->input('frase_palavra', array('label'=>false, 'type'=>'text', 'autofocus', 'required', 'class'=>'form-control', 'placeholder'=>'Type the english phrase')); ?>
		<span onClick="traduzTexto('en_to_pt')" class="btn btn-primary btn-xs">Translate &nbsp;<i class="fa fa-exchange"></i></span>
		&nbsp;&nbsp;<span id="traducaoEnglishToPortuguese"></span>
	</div>
	<div class="form-group">
		<?php echo $this->Form->input('traducao_frase_palavra', array('label'=>false,  'type'=>'text', 'required', 'class'=>'form-control', 'placeholder'=>'Digite a frase em português')); ?>
		<span onClick="traduzTexto('pt_to_en')" class="btn btn-primary btn-xs">Translate &nbsp;<i class="fa fa-exchange"></i></span>
		&nbsp;&nbsp;<span id="traducaoPortugueseToEnglish"></span>
	</div>
	<div class="checkbox">
		<?php echo $this->Form->button('Save', array('class'=>'btn btn-success btn-xs', 'type'=>'submit')); ?>
		<?php 
				echo $this->Html->link
					($this->Html->tag('', 'Back to my taking note'),
						array('controller'=>'dias', 'action'=>'view', $diaPalavra[0]['id']),
						array('class' =>'btn btn-warning btn-xs', 'escape' => false)
					);
					
				echo $this->Html->link
					($this->Html->tag('strong', 'Add word'),
						array('controller'=>'palavras', 'action'=>'add', $diaPalavra[0]['id']),
						array('class' =>'btn btn-default btn-xs', 'escape' => false, 'style'=>'color: red;')
					);
		?>
	</form>
  </div>
</div>				
</div>