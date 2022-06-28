<div class="banners form">

<?php

//Verifica se é usuário não autorizado

$perfilVisitante = $this-> Session-> read('Auth');
if($perfilVisitante['User']['id'] != $Dia['Dia']['cod_usuario_dia']){
	echo '<span style="color: red; font-size: 26px;">Acesso negado!</span>
			<div style="position: relative; float: left;">
				'.$this->Html->image("acessdenied.jpg", array("width"=>"1300px")).'
			</div>';
	exit;
}

require_once('../class/db.class.php');
$DB = new DB();

$palavras = $DB->getPalavras($perfilVisitante['User']['id'], $Dia['Dia']['id']);
				
?>

<div class="col-sm-12 col-md-12"><br><br>
	<div class="block-flat">
	<strong style="font-size: 26px;">
		<?php
			echo $this->Html->link($this->Html->tag('', $Dia['Dia']['dia']),array('controller'=>'dias', 'action'=>'edit', $Dia['Dia']['id']),array('escape' => false, 'style'=>'font-size: 20px; font-weight: bold;')).' --- ';
			echo $this->Html->link($this->Html->tag('', 'add word'),array('controller'=>'palavras', 'action'=>'add', $Dia['Dia']['id']),array('class' =>'btn btn-default btn-xs', 'escape' => false, 'style'=>'color: blue;'));
			echo $this->Html->link($this->Html->tag('', 'add day'),array('controller'=>'dias', 'action'=>'add'),array('class' =>'btn btn-default btn-xs', 'escape' => false, 'style'=>'color: blue;'));
			echo $this->Html->link($this->Html->tag('', 'back'), array('action'=>'index'), array('class' =>'btn btn-warning btn-xs', 'escape' => false));
		?>
	</strong>
		<form role="form" style="margin-left: 2%;">
			<?php
				$idModal = 0;
				if(is_array($palavras)){
					echo '<br>';
					foreach($palavras as $palavra){
						echo $this->Form->postLink(__('<i class="fa fa-trash-o" style="color: #01de83; font-size: 18px;" title="Delete word"></i>'), array('controller'=>'palavras', 'action' => 'delete', $palavra['id'], $Dia['Dia']['id']), array('escape'=>false, 'confirm' => __('Do you really want to delete "%s?"', utf8_encode($palavra['dsc_palavra'])))).' ---- ';
						echo $this->Html->link($this->Html->tag('', utf8_encode($palavra['dsc_palavra']).' = '.utf8_encode($palavra['traducao_palavra'])),array('controller'=>'palavras', 'action'=>'edit', $palavra['id']),array('escape' => false, 'style'=>'font-size: 20px; font-weight: bold;'));
						
						if(!empty($palavra['nota_observacao'])){
							$idModal++;
							echo ' ---- <i class="fa fa-star" style="font-size: 18px; color: gold; cursor: pointer;" data-toggle="modal" data-target="#'.$idModal.'"></i>';
							
							echo '
							<!-- Modal Note -->
							<div id="'.$idModal.'" class="modal fade" role="dialog">
							  <div class="modal-dialog">
								<!-- Modal content-->
								<div class="modal-content">
								  <div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" onClick="reload();">&times;</button>
									<h4 class="modal-title"><i class="fa fa-star" style="color: gold;"></i>&nbsp;NOTE</h4>
								  </div>
								  <div class="modal-body" style="font-size: 18px;">
									<strong>Word:</strong> '.utf8_encode($palavra['dsc_palavra']).'<br>
									<strong>Translation:</strong> '.utf8_encode($palavra['traducao_palavra']).'<br><br>
									
									<strong>Note:</strong><br>'.utf8_encode($palavra['nota_observacao']).'
									<br>
								  </div>
								  <div class="modal-footer">
									<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
								  </div>
								</div>
							  </div>
							</div>';
						}
						
						$frases = $DB->getFrases($perfilVisitante['User']['id'], $palavra['id']);
						
						echo '<div style="margin-left: 4.5%; font-size: 18px;">';
						
						if(is_array($frases)){
							echo '<ul>';
							foreach($frases as $frase){
								echo '<li>';
								echo $this->Html->link($this->Html->tag('', utf8_encode($frase['frase_palavra'])),array('controller'=>'frases', 'action'=>'edit', $frase['id']),array('escape' => false));
								echo $this->Html->link($this->Html->tag('', '<div>- '.utf8_encode($frase['traducao_frase_palavra'])),array('controller'=>'frases', 'action'=>'edit', $frase['id']),array('escape' => false)).'&nbsp;&nbsp;'.$this->Html->link($this->Html->tag('', 'add phrase'),array('controller'=>'frases', 'action'=>'add', $palavra['id']),array('class' =>'btn btn-default btn-xs', 'escape' => false, 'style'=>'color: blue;'));
								echo $this->Form->postLink(__('delete phrase'), array('controller'=>'frases', 'action' => 'delete', $frase['id'], $Dia['Dia']['id']), array('class' =>'btn btn-default btn-xs', 'escape'=>false, 'style'=>'color: blue;', 'confirm' => __('Do you really want to delete "%s?"', utf8_encode($frase['frase_palavra'])))).'</div>';
								echo '</li><br>';
							}
							echo '</ul>';
						}
							else {
								echo '<ul><li>no phrase registered'.$this->Html->link($this->Html->tag('i class="fa fa-plus" style="color: blue;"></i', ''),array('controller'=>'frases', 'action'=>'add', $palavra['id']),array('class' =>'btn btn-default btn-xs', 'escape' => false, 'style'=>'color: blue;', 'title'=>'Add phrase')).'</li></ul>';
							}
							echo '</div>';
					}
				}
					else{
						echo 'No word registered';
					}
				
			?>
		</form>
	</div>
</div>
</div>			