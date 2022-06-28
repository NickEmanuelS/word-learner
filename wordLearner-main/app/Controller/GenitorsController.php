<?php
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

/**
 * Genitors Controller
 *
 * @property Genitor $Genitor
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class GenitorsController extends AppController {

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
				'Genitor.nome_genitor' => 'asc'
			)
		);
	
		$this->paginate = $filterNovo;
		$Genitors = $this->paginate('Genitor');
		$this->set('Genitors', $Genitors);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Genitor->create();
			if ($this->Genitor->save($this->request->data)) {
				$this->Session->setFlash(__('
						<div class="alert alert-success" id="message">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong><i class="fa fa-check sign"></i> &nbsp; Genitor cadastrado com sucesso.</strong>
						</div>
				'));
				return $this->redirect(array('controller'=>'Genitors', 'action'=> 'edit', $this->Genitor->getLastInsertId(), 'aba'=>'1'));
			}
				else {
						if(!empty($this->Genitor->validationErrors) && isset($this->Genitor->validationErrors)){
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
		if (!$this->Genitor->exists($id)) {
			throw new NotFoundException(__('Registro não encontrado!'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Genitor->save($this->request->data)) {
				$this->Session->setFlash(__('
						<div class="alert alert-success" id="message">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong><i class="fa fa-check sign"></i> &nbsp; Genitor alterado com sucesso.</strong>
						</div>
				'));
				return $this->redirect(array('action'=> 'edit', $id));
			}
				else {
						if(!empty($this->Genitor->validationErrors) && isset($this->Genitor->validationErrors)){
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
			$options = array('conditions' => array('Genitor.' . $this->Genitor->primaryKey => $id));
			$this->request->data = $this->Genitor->find('first', $options);
		}
	}
}
