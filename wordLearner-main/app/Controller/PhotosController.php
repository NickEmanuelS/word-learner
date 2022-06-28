<?php
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
/**
 * Photos Controller
 *
 * @property Photo $Photo
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PhotosController extends AppController {

/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Js');

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			
			//Extensao do arquivo
			$extensao = explode('.', $this->data['Photo']['nome']['name']);
			$extensao = $extensao[1];
			
			if(
				$extensao != 'gif' &&
				$extensao != 'jpg' &&
				$extensao != 'jpeg' &&
				$extensao != 'png' &&
				$extensao != 'GIF' &&
				$extensao != 'JPG' &&
				$extensao != 'JPEG' &&
				$extensao != 'PNG') {
				
				$this->Session->setFlash(__('
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong><i class="fa fa-warning sign"></i> &nbsp;Favor verificar a extensão do arquivo. Somente são permitidas as extensões .gif, .jpg, .jpeg e .png.</strong>
						</div>
				'));
			}
				else {
						$this->Photo->create();
						if ($this->Photo->save($this->request->data)) {
							$this->Session->setFlash(__('
									<div class="alert alert-success" id="message">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										<strong><i class="fa fa-check sign"></i> &nbsp; Foto adicionada com sucesso.</strong>
									</div>
							'));
							return $this->redirect(array('controller'=>'products', 'action' => 'edit', $this->request->data['Photo']['product_id'], 'aba'=>'1'));
						} else {
							$this->Session->setFlash(__('
									<div class="alert alert-danger">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										<strong><i class="fa fa-warning sign"></i> &nbsp; Erro ao adicionar a foto.</strong>
									</div>
							'));
						}
				}
		}
	}
	
	public function delete($id = null, $produto = null) {

		$this->Photo->id = $id;
		$this->Photo->product_id = $produto;

		if (!$this->Photo->exists()) {
			throw new NotFoundException(__('Foto não encontrada'));
		}
		//Deleta no banco de dados
		$this->request->allowMethod('post', 'delete');
		
		//DELETANDO ARQUIVOS
		//Montando a query para obter o nome da foto
		$query = array('conditions' => array('Photo.' . $this->Photo->primaryKey => $id));
		
		//Recebe array com dados do objeto (Foto a ser deletada)
		$foto = $this->Photo->find('first', $query);
		
		//Cria instânica da pasta
		$dir = new Folder('img/produtos/');
		$dirThumbs = new Folder('img/produtos/thumbs/');
		
		//Localiza o arquivo da foto a ser deletada
		// Localização feita pelo nome do arquivo no diretório
		$files = $dir->find($foto['Photo']['nome']);
		$filesThumbs = $dirThumbs->find($foto['Photo']['nome']);

		if ($this->Photo->delete()) {
			
			//Após deletar a foto do banco com sucesso
			//Deleta o arquivo do diretório
			
			//Mesmo tendo apenas um arquivo, mantém o foreach
			//Por que este recurso do cake trabalha com array
			foreach ($files as $file) {
				$file = new File($dir->pwd() . DS . $file);
				$file->delete(); // Deletando o arquivo
			}
			
			foreach ($filesThumbs as $fileThumb) {
				$fileThumb = new File($dirThumbs->pwd() . DS . $fileThumb);
				$fileThumb->delete(); // Deletando o arquivo
			}

			$this->Session->setFlash(__('
										<div class="alert alert-success" id="message">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
											<strong><i class="fa fa-check sign"></i> &nbsp; Foto removida com sucesso.</strong>
										</div>
										'));

		} else {

			$this->Session->setFlash(__('
										<div class="alert alert-danger">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
											<strong><i class="fa fa-warning sign"></i> &nbsp; Erro ao remover a foto.</strong>
										</div>
										'));

		}

		return $this->redirect(array('controller'=>'Products', 'action' => 'edit', $this->Photo->product_id, 'aba'=>'1'));

	}
}