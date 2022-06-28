<?php
App::uses('AppController', 'Controller');

/**
 * Racas Controller
 *
 * @property Raca $Raca
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class RacasController extends AppController {

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
				'Raca.nome_raca' => 'asc'
			)
		);
	
		$this->paginate = $filter;
		$Racas = $this->paginate('Raca');
		$this->set('Racas', $Racas);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Raca->create();
			if ($this->Raca->save($this->request->data)) {
				$this->Session->setFlash(__('
						<div class="alert alert-success" id="message">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong><i class="fa fa-check sign"></i> &nbsp; Raça cadastrada com sucesso.</strong>
						</div>
				'));
				return $this->redirect(array('controller'=>'Racas', 'action'=> 'edit', $this->Raca->getLastInsertId()));
			} else {
				$this->Session->setFlash(__('
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong><i class="fa fa-warning sign"></i> &nbsp; Erro ao cadastrar a Raça.</strong>
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
		if (!$this->Raca->exists($id)) {
			throw new NotFoundException(__('Registro não encontrado!'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Raca->save($this->request->data)) {
				$this->Session->setFlash(__('
						<div class="alert alert-success" id="message">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong><i class="fa fa-check sign"></i> &nbsp; Raça alterada com sucesso.</strong>
						</div>
				'));
				return $this->redirect(array('action'=> 'edit', $id));
			} else {
				$this->Session->setFlash(__('
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong><i class="fa fa-warning sign"></i> &nbsp; Erro ao alterar a Raça.</strong>
						</div>
				'));
			}
		} else {
			$options = array('conditions' => array('Raca.' . $this->Raca->primaryKey => $id));
			$this->request->data = $this->Raca->find('first', $options);
		}
	}
}
