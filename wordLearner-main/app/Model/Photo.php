<?php
App::uses('AppModel', 'Model');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
/**
 * Photo Model
 *
 */
class Photo extends AppModel {
	public function beforeSave($options = array()){
		if(!empty($this->data['Photo']['nome']['name'])) {
			
			//Pega a extensão do arquivo
			$extensao = $this->getExtensao();
				
			if(
				$extensao == 'gif' ||
				$extensao == 'jpg' ||
				$extensao == 'jpeg' ||
				$extensao == 'png' ||
				$extensao == 'GIF' ||
				$extensao == 'JPG' ||
				$extensao == 'JPEG' ||
				$extensao == 'PNG')
			{
				//Gera um name unico para a imagem em funcao do tempo
				$novo_name = time() . '.' . $extensao;
			
				//Seta o novo name no array do arquivo
				$this->data['Photo']['nome']['name'] = $novo_name;
				
				//Carregando classe de manipulação de imagens
				require_once('classWideImage/WideImage.php');
				
				$caminhoTemporario = $this->data['Photo']['nome']['tmp_name'];

				//Cria instânica do objeto "Pasta" onde a imagem será salva
				$dir = new Folder('img/produtos/');
				
				//Converte o objeto em array
				$dirArray = (array) $dir;
				
				//Carregando imagem para o PHP
				$image = wideImage::load($caminhoTemporario);
				
				$image = $image->resize(300, 300, 'outside'); //Redimensiona a imagem para 300 de largura e 300 de altura, mantendo sua proporção no máximo possível
								
				$image = $image->crop('center', 'center', 300, 300); //Corta a imagem do centro, forçando sua altura e largura
				
				$image->saveToFile($dirArray['path'].'/'.$this->data['Photo']['nome']['name']);
				
				//Transforma o array em uma string no final para que o
				//Controller consiga salvar o nome da imagem no banco de dados
				$this->data['Photo']['nome'] = $this->data['Photo']['nome']['name'];
				
			}
		}
	}
		
	/**
	 * Organiza o upload.
	 * @access public
	 * @param Array $imagem
	 * @param String $data
	*/ 

	public function getExtensao(){

		$extensao = explode('.', $this->data['Photo']['nome']['name']);
		return $extensao[1];

	}
}