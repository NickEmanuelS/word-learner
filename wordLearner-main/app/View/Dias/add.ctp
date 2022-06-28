<div class="dias form">
<?php
	$perfilVisitante = $this-> Session-> read('Auth');
	$dataAtual = date("d/m/Y");			
?>
<?php echo $this->Form->create('Dia'); ?>
<div class="col-sm-12 col-md-12"><br><br>
<div class="block-flat" style="width: 50%">
<strong style="font-size: 26px;">New study day</strong><br><br>
  <form role="form"> 
	<?php echo $this->Form->input('cod_usuario_dia', array('label'=>false, 'type'=>'hidden', 'value'=>$perfilVisitante['User']['id'])); ?>
	<div class="input-group date datetime" data-min-view="2">
		<?php echo $this->Form->input('dia', array('label'=>false,  'type'=>'text', 'required', 'onfocus'=>'loseFocus()', 'class'=>'form-control', 'placeholder'=>'Study day date', 'value'=>$dataAtual)); ?>
		<span class="input-group-addon btn btn-primary"><?php echo $this->Html->tag('span', '', array('class'=>'glyphicon glyphicon-th', 'scape'=>false)); ?></span>
	</div>
	<div class="form-group">
		<?php echo $this->Form->button('Save', array('class'=>'btn btn-success btn-xs', 'type'=>'submit')); ?>
		<?php 
				echo $this->Html->link
					($this->Html->tag('', 'Back'),
						array('action'=>'index'),
						array('class' =>'btn btn-warning btn-xs', 'escape' => false)
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