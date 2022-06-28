<div class="frases form">
<?php
	echo $this->Form->create('Frase');
	
	require_once('../class/db.class.php');
	$DB = new DB();
	
	$perfilVisitante = $this-> Session-> read('Auth');
	
	$palavra_id = $DB->getFrase($this->request->data['Frase']['id']);
	$diaPalavra = $DB->getDiaPalavra($palavra_id[0]['palavra_id']);
	$palavra = $DB->getPalavra($palavra_id[0]['palavra_id']);
	
	if($perfilVisitante['User']['id'] != $diaPalavra[0]['cod_usuario_dia']){
		echo '<span style="color: red; font-size: 26px;">Acesso negado!</span>
				<div style="position: relative; float: left;">
					'.$this->Html->image("acessdenied.jpg", array("width"=>"1300px")).'
				</div>';
		exit;
	}
?>
<div class="col-sm-12 col-md-12"><br><br>
<div class="block-flat" style="width: 50%">
<strong style="font-size: 26px;">Phrase update</strong><br>
<strong style="font-size: 11px;">Word: <?php echo utf8_encode($palavra[0]['dsc_palavra']).' = '.utf8_encode($palavra[0]['traducao_palavra']); ?></strong>
  <form role="form"> 
	<div class="form-group">
		<?php echo $this->Form->input('id', array('label'=>false, 'type'=>'hidden', 'value'=>$this->request->data['Frase']['id'])); ?>
		<?php echo $this->Form->input('frase_palavra', array('value'=>$this->request->data['Frase']['frase_palavra'], 'label'=>'Type the english phrase', 'type'=>'text', 'autofocus', 'required', 'class'=>'form-control', 'placeholder'=>'Type the english phrase')); ?>
	</div>
	<div class="form-group">
		<?php echo $this->Form->input('traducao_frase_palavra', array('value'=>$this->request->data['Frase']['traducao_frase_palavra'], 'label'=>'Digite a frase em português',  'type'=>'text', 'required', 'class'=>'form-control', 'placeholder'=>'Digite a frase em português')); ?>
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
					($this->Html->tag('strong', 'New phrase'),
						array('controller'=>'frases', 'action'=>'add', $palavra_id[0]['palavra_id']),
						array('class' =>'btn btn-default btn-xs', 'escape' => false, 'style'=>'color: red;')
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