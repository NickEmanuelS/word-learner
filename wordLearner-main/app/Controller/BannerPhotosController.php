<?php
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
/**
 * BannerPhotos Controller
 *
 * @property BannerPhoto $BannerPhoto
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class BannerPhotosController extends AppController {

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
			$extensao = explode('.', $this->data['BannerPhoto']['nome_img_banner']['name']);
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
						$this->BannerPhoto->create();
						if ($this->BannerPhoto->save($this->request->data)) {
							$this->Session->setFlash(__('
									<div class="alert alert-success" id="message">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										<strong><i class="fa fa-check sign"></i> &nbsp; Foto adicionada com sucesso.</strong>
									</div>
							'));
							return $this->redirect(array('controller'=>'banners', 'action' => 'edit', $this->request->data['BannerPhoto']['banner_id'], 'aba'=>'1'));
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
	
	public function delete($id = null, $banner_photo = null) {

		$this->BannerPhoto->id = $id;
		$this->BannerPhoto->banner_id = $banner_photo;

		if (!$this->BannerPhoto->exists()) {
			throw new NotFoundException(__('Foto não encontrada'));
		}

		//Deleta no banco de dados
		$this->request->allowMethod('post', 'delete');
		
		//DELETANDO ARQUIVOS
		//Montando a query para obter o nome da foto
		$query = array('conditions' => array('BannerPhoto.' . $this->BannerPhoto->primaryKey => $id));
		
		//Recebe array com dados do objeto (Foto a ser deletada)
		$foto = $this->BannerPhoto->find('first', $query);
		
		//Cria instânica da pasta
		$dir = new Folder('img/banners/');
		$dirThumbs = new Folder('img/banners/thumbs/');
		
		//Localiza o arquivo da foto a ser deletada
		// Localização feita pelo nome do arquivo no diretório
		$files = $dir->find($foto['BannerPhoto']['nome_img_banner']);
		$filesThumbs = $dirThumbs->find($foto['BannerPhoto']['nome_img_banner']);

		if ($this->BannerPhoto->delete()) {
			
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

		return $this->redirect(array('controller'=>'Banners', 'action' => 'edit', $this->BannerPhoto->banner_id, 'aba'=>'1'));

	}
	
}