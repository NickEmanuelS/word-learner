<?php

$perfilVisitante = $this-> Session-> read('Auth');

require_once('../class/db.class.php');
$DB = new DB();

?>

<div class="col-sm-12 col-md-12"><br>
	<table cellpadding="0" cellspacing="0" style="background-color: white;">
	<thead>
		<tr style="background-color: #35365F; color: white;">
			<th style="width: 70%;"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('Dia.dia', 'Study day', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
			<th style="width: 10%;"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('Dia.dia', 'Words', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
			<th style="width: 10%;"><strong><?php echo '<i class="fa fa-sort-alpha-asc"></i>&nbsp;'. $this->Paginator->sort('Dia.dia', 'Phrase', array('style'=>'color: white', 'weight: bold')); ?></strong></th>
		</tr>
	</thead>
	<tbody style="color: black">
	<?php
		$qtdTotalDias = 0;
		$qtdTotalPalavras = 0;
		$qtdTotalFrases = 0;
		foreach($Dias as $key){
			$qtdTotalDias++;
			
			$dia_id = $key['Dia']['id'];
			$totalPalavras = $DB->totalPalavras($dia_id);
			$totalFrases = $DB->totalFrases($dia_id);
			
			$qtdTotalPalavras = $qtdTotalPalavras + $totalPalavras[0]['total_palavras'];
			$qtdTotalFrases = $qtdTotalFrases + $totalFrases[0]['total_frases'];
		}
	?>
	<tr style="background-color: #01de83;">
		<td><?php echo $qtdTotalDias.' day(s)'; ?>&nbsp;</td>
		<td><?php echo $qtdTotalPalavras.' word(s)'; ?>&nbsp;</td>
		<td><?php echo $qtdTotalFrases.' phrase(s)'; ?>&nbsp;</td>
	</tr>
	<?php foreach ($Dias as $Dia): ?>
	<?php
		$dia_id = $Dia['Dia']['id'];
		$totalPalavras = $DB->totalPalavras($dia_id);
		$totalFrases = $DB->totalFrases($dia_id);
	?>
	<tr>
		<td><?php echo $this->Html->link(__($Dia['Dia']['dia'].'&nbsp;&nbsp;<i class="fa fa-book" style="font-size: 18px;"></i>'), array('action' => 'view', $Dia['Dia']['id']), array('escape'=>false)); ?>&nbsp;</td>
		<td><?php echo h($totalPalavras[0]['total_palavras'].' word(s)'); ?>&nbsp;</td>
		<td><?php echo h($totalFrases[0]['total_frases'].' phrase(s)'); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<div style="color: black; padding: 10px; background-color: white; font-size: 13px;">
		<?php
		echo $this->Paginator->counter(array(
			'format' => __('Page <strong>{:page}</strong> of {:pages} | Total records {:count} | Showing from <strong>{:start} to {:end}</strong>')
		));
		?>
		<span style="position: relative; left: 55%;">
			<?php
				echo $this->Paginator->prev(__('<button class="btn btn-primary"><<</button> &nbsp;&nbsp;'), array('escape'=>false), null, array('class' => 'prev disabled'));
				echo $this->Paginator->numbers(array('separator' => '<span style="color: black;"> | </span>'), array('escape'=>false), array('class'=>'btn btn-danger'));
				echo $this->Paginator->next(__('&nbsp;&nbsp;<button class="btn btn-primary">>></button>'), array('escape'=>false), null, array('class' => 'next disabled'));
			?>
		</span>
	</div>
</div>