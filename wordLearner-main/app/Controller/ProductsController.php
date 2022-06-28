<?php
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

/**
 * Products Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ProductsController extends AppController {

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
 * index method
 *
 * @return void
 */
	
	public function index() {
		$filterNovo = array(
			'limit' => 50,
			'order' => array(
				'Product.id' => 'desc'
			)
		);
	
		$this->paginate = $filterNovo;
		$productSends = $this->paginate('Product');
		$this->set('productSends', $productSends);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Product->create();
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash(__('
						<div class="alert alert-success" id="message">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong><i class="fa fa-check sign"></i> &nbsp; Produto cadastrado com sucesso.</strong>
						</div>
				'));
				return $this->redirect(array('controller'=>'products', 'action'=> 'edit', $this->Product->getLastInsertId(), 'aba'=>'1'));
			}
				else {
						if(!empty($this->Product->validationErrors) && isset($this->Product->validationErrors)){
							$this->Session->setFlash(__('<div class="alert alert-warning">
														<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
														<strong><i class="fa fa-warning sign"></i> &nbsp; '.utf8_encode("Verifique os campos do formulário.").'</strong>
													</div>'));
						}
							else{
								$this->Session->setFlash(__('<div class="alert alert-danger">
														<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
														<strong><i class="fa fa-warning sign"></i> &nbsp; '.utf8_encode("Ocorreu um erro inesperado durante a criação do registro.").'</strong>
													</div>'));
							}
					}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Registro não encontrado!'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash(__('
						<div class="alert alert-success" id="message">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong><i class="fa fa-check sign"></i> &nbsp; Produto alterado com sucesso.</strong>
						</div>
				'));
				return $this->redirect(array('action'=> 'edit', $id));
			}
				else {
						if(!empty($this->Product->validationErrors) && isset($this->Product->validationErrors)){
							$this->Session->setFlash(__('<div class="alert alert-warning">
														<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
														<strong><i class="fa fa-warning sign"></i> &nbsp; '.utf8_encode("Verifique os campos do formulário.").'</strong>
													</div>'));
						}
							else{
								$this->Session->setFlash(__('<div class="alert alert-danger">
														<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
														<strong><i class="fa fa-warning sign"></i> &nbsp; '.utf8_encode("Ocorreu um erro inesperado durante a atualização do registro.").'</strong>
													</div>'));
							}
					}	
		} else {
			$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
			$this->request->data = $this->Product->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null, $arrayFotosNome = null) {
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Registro não encontrado!'));
		}
		//Deleta no banco de dados
		$this->request->allowMethod('post', 'delete');
		
		if(!empty($arrayFotosNome)){
			$arrayFotosNome = explode(',', $arrayFotosNome);
		}
		
		//DELETANDO ARQUIVOS		
		//Cria instânica da pasta
		$dir = new Folder('img/produtos/');
		$dirThumbs = new Folder('img/produtos/thumbs/');
		
		if ($this->Product->delete()) {
				//Após deletar o produto no banco de dados
				//Deleta as fotos relacionadas à ele
				//Os relacionamentos de banco foram deletados por delete cascade
				if(!empty($arrayFotosNome)){
					foreach($arrayFotosNome as $key){
						//Localiza o arquivo da foto a ser deletada
						// Localização feita pelo nome do arquivo no diretório
						$files = $dir->find($key);
						$filesThumbs = $dirThumbs->find($key);
						
						//Mesmo que tenha apenas um arquivo, mantém o foreach
						//Por que este recurso do cake trabalha com array
						foreach ($files as $file) {
							$file = new File($dir->pwd() . DS . $file);
							$file->delete(); // Deletando o arquivo
						}
						
						foreach ($filesThumbs as $fileThumb) {
							$fileThumb = new File($dirThumbs->pwd() . DS . $fileThumb);
							$fileThumb->delete(); // Deletando o arquivo
						}
					}
				}
				$this->Session->setFlash(__('
							<div class="alert alert-success" id="message">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong><i class="fa fa-check sign"></i> &nbsp; Produto excluído com sucesso.</strong>
							</div>
					'));
					return $this->redirect(array('action'=> 'index'));
			}
				else {
				$this->Session->setFlash(__('
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong><i class="fa fa-warning sign"></i> &nbsp; Erro ao excluir o poroduto.</strong>
						</div>
				'));
			}
		return $this->redirect(array('ProductsController', 'action'=> 'index'));
	}
}
