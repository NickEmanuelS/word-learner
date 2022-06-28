<?php

if($_POST['id_usuario'] != $_SESSION['Auth']['User']['id']){
	echo '<span style="color: red; font-size: 26px;">Acesso negado!</span>
			<div style="position: relative; float: left;">
				'.$this->Html->image("acessdenied.jpg", array("width"=>"1300px")).'
			</div>';
	exit;
}

require_once('../class/db.class.php');
$DB = new DB();

$id_usuario = $_POST['id_usuario'];
$english_word = $_POST['english_word'];
$portuguese_word = $_POST['portuguese_word'];

$arrayPalavras = $DB->getPalavrasSearch($id_usuario, $english_word, $portuguese_word);

?>

<div class="col-sm-12 col-md-12"><br>
	
	<table cellpadding="0" cellspacing="0" style="background-color: white;">
	<thead>
		<tr style="background-color: #35365F; color: white;">
			<th style="width: 10%;"><strong>Study day</strong></th>
			<th style="width: 15%;"><strong>English word</strong></th>
			<th style="width: 15%;"><strong>Portuguese word</strong></th>
			<th style="width: 60%;"><strong>Note</strong></th>
		</tr>
	</thead>
	<tbody style="color: black">
	<?php
		if(!is_array($arrayPalavras)){
				echo "	<tr>
							<td colspan='4' style='font-size: 13px; color: #476077;'>No words like these expression</td>
						</td>";
			}
				else{
						foreach ($arrayPalavras as $key):
						if(empty($key['nota'])){
							$key['nota'] = 'no notes registered';
						}
					
					echo '
							<tr>
								<td><a href="dias/view/'.$key['id_dia_estudo'].'"><i class="fa fa-book" style="font-size: 18px;"></i> '.$key['dia'].'</a></td>
								<td><a href="palavras/edit/'.$key['id_palavra'].'">'.utf8_encode($key['palavra']).'</a></td>
								<td>'.utf8_encode($key['traducao']).'</td>
								<td>'.utf8_encode($key['nota']).'</td>
							</tr>';
					endforeach;
				}
	?>
	</tbody>
	</table>
	<br>
	<a href="javascript:history.back()"><button class="btn btn-danger btn-sm" style="border-radius: 2px;">back to the previous page</button></a>
</div>

<script>
	window.onload = function() {
		var data = new Date();

		//obtem as horas, minutos e segundos
		horas = data.getHours();
		minutos = data.getMinutes();
		segundos = data.getSeconds();

		//converte as horas, minutos e segundos para string
		str_horas = new String(horas);
		str_minutos = new String(minutos);
		str_segundos = new String(segundos);

		//se tiver menos que 2 digitos, acrescenta o 0
		if (str_horas.length < 2)
		  str_horas = 0 + str_horas;
		if (str_minutos.length < 2)
		  str_minutos = 0 + str_minutos;
		if (str_segundos.length < 2)
		  str_segundos = 0 + str_segundos;

		//cria a string que sera exibida na div
		data = 'searched at ' + str_horas + ':' + str_minutos + ':' + str_segundos;
		$('#timeSearched').val(data);
	}
</script>