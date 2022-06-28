<div class="dias form">

<?php

//Verifica se é usuário não autorizado

$perfilVisitante = $this-> Session-> read('Auth');
if($perfilVisitante['User']['id'] != $this->request->data['Dia']['cod_usuario_dia']){
	echo '<span style="color: red; font-size: 26px;">Acesso negado!</span>
			<div style="position: relative; float: left;">
				'.$this->Html->image("acessdenied.jpg", array("width"=>"1300px")).'
			</div>';
	exit;
}

echo $this->Form->create('Dia');

//Setando ID do registro editado
echo $this->Form->input('id', array('hidden'));
					
?>

<div class="col-sm-12 col-md-12"><br><br>
	<div class="block-flat" style="width: 50%">
	<strong style="font-size: 26px;">Study day update</strong><br><br>
		<form role="form">
			<label>Study day</label>
			<div class="input-group date datetime" data-min-view="2">
				<?php
					echo
						$this->Form->input('dia', array('value'=>$this->request->data['Dia']['dia'], 'label'=>false, 'type'=>'text', 'required', 'onfocus'=>'loseFocus()', 'class'=>'form-control', 'placeholder'=>'Study day date'));
				?>
				<span class="input-group-addon btn btn-primary"><?php echo $this->Html->tag('span', '', array('class'=>'glyphicon glyphicon-th', 'scape'=>false)); ?></span>
			</div>
			<div class="form-group">
				<?php
					echo $this->Form->button('Save', array('class'=>'btn btn-success btn-xs', 'type'=>'submit'));
					echo $this->Html->link
								($this->Html->tag('', 'Back'),
									array('action'=>'index'),
									array('class' =>'btn btn-warning btn-xs', 'escape' => false
									)
								);
					echo $this->Html->link
								($this->Html->tag('strong', 'New day'),
									array('controller'=>'dias', 'action'=>'add'),
									array('class' =>'btn btn-default btn-xs', 'escape' => false, 'style'=>'color: red;')
								);
					echo $this->Html->link
								($this->Html->tag('strong', 'Add word'),
									array('controller'=>'palavras', 'action'=>'add', $this->request->data['Dia']['id']),
									array('class' =>'btn btn-default btn-xs', 'escape' => false, 'style'=>'color: red;')
								);
				?>
			</div>
		</form>
	</div>
</div>
</div>			
<script type="text/javascript">
	jQuery(document).ready(function($) {
	  $(".datetime").datetimepicker({todayHighlight: true, format: 'dd/mm/yyyy', autoclose: true, language: 'en-UK', todayBtn: 'linked'});
	});
	
	function loseFocus(){
		alert("Choose date in the calendar");
		$("#DiaDia").blur();
	}
</script>