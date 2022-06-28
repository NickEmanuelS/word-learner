<?php
App::uses('AppController', 'Controller');
/**
 * Promotions Controller
 *
 * @property Promotion $Promotion
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PromotionsController extends AppController {

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
		$filter = array(
			'limit' => 17,
			'order' => array(
				'Promotion.product_id' => 'asc'
			)
		);
	
		$this->paginate = $filter;
		$Promotions = $this->paginate('Promotion');
		$this->set('Promotions', $Promotions);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Promotion->create();
			if ($this->Promotion->save($this->request->data)) {
				$this->Session->setFlash(__('
						<div class="alert alert-success" id="message">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong><i class="fa fa-check sign"></i> &nbsp; Promoção cadastrada com sucesso.</strong>
						</div>
				'));
				return $this->redirect(array('controller'=>'Promotions', 'action'=> 'edit', $this->Promotion->getLastInsertId()));
			} else {
				$this->Session->setFlash(__('
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong><i class="fa fa-warning sign"></i> &nbsp; Erro ao cadastrar o promoção.</strong>
						</div>
				'));
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
		if (!$this->Promotion->exists($id)) {
			throw new NotFoundException(__('Registro não encontrado!'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Promotion->save($this->request->data)) {
				$this->Session->setFlash(__('
						<div class="alert alert-success" id="message">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong><i class="fa fa-check sign"></i> &nbsp; Promoção alterada com sucesso.</strong>
						</div>
				'));
				return $this->redirect(array('action'=> 'edit', $id));
			} else {
				$this->Session->setFlash(__('
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong><i class="fa fa-warning sign"></i> &nbsp; Erro ao alterar a promoção.</strong>
						</div>
				'));
			}
		} else {
			$options = array('conditions' => array('Promotion.' . $this->Promotion->primaryKey => $id));
			$this->request->data = $this->Promotion->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Promotion->id = $id;
		if (!$this->Promotion->exists()) {
			throw new NotFoundException(__('Registro não encontrado!'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Promotion->delete()) {
			$this->Session->setFlash(__('
						<div class="alert alert-success" id="message">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong><i class="fa fa-check sign"></i> &nbsp; Promoção excluída com sucesso.</strong>
						</div>
				'));
				return $this->redirect(array('action'=> 'index'));
			} else {
				$this->Session->setFlash(__('
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong><i class="fa fa-warning sign"></i> &nbsp; Erro ao excluir a promoção.</strong>
						</div>
				'));
			}
		return $this->redirect(array('PromotionsController', 'action'=> 'index'));
	}
}
