<?php
App::uses('AppController', 'Controller');

/**
 * Dias Controller
 *
 * @property Dia $Dia
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class DiasController extends AppController {

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
		$perfilVisitante = $this-> Session-> read('Auth');
		$filter = array(
			'limit' => 11,
			'conditions' => array('Dia.cod_usuario_dia' => $perfilVisitante['User']['id']),
			'order' => array(
				'Dia.dia' => 'asc'
			)
		);
	
		$this->paginate = $filter;
		$Dias = $this->paginate('Dia');
		$this->set('Dias', $Dias);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Dia->create();
			if ($this->Dia->save($this->request->data)) {
				$this->Session->setFlash(__('
						<div class="alert alert-success" id="message" style="position: absolute; z-index: 99999; min-width: 100%;">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong><i class="fa fa-check sign"></i> &nbsp; Dia de estudo cadastrado com sucesso.</strong>
						</div>
				'));
				return $this->redirect(array('controller'=>'Dias', 'action'=> 'edit', $this->Dia->getLastInsertId()));
			} else {
				$this->Session->setFlash(__('
						<div class="alert alert-danger" style="position: absolute; z-index: 99999; min-width: 100%;">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong><i class="fa fa-warning sign"></i> &nbsp; Erro ao cadastrar o Dia de estudo.</strong>
						</div>
				'));
			}
		}
	}
	
	public function view($id = null) {
        if (!$this->Dia->exists($id)) {
            throw new NotFoundException(__('Registro inválido.'));
        }
        $this->set('Dia', $this->Dia->findById($id));
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Dia->exists($id)) {
			throw new NotFoundException(__('Registro não encontrado!'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Dia->save($this->request->data)) {
				$this->Session->setFlash(__('
						<div class="alert alert-success" id="message" style="position: absolute; z-index: 99999; min-width: 100%;">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong><i class="fa fa-check sign"></i> &nbsp; Dia de estudo alterado com sucesso.</strong>
						</div>
				'));
				return $this->redirect(array('action'=> 'edit', $id));
			} else {
				$this->Session->setFlash(__('
						<div class="alert alert-danger" style="position: absolute; z-index: 99999; min-width: 100%;">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong><i class="fa fa-warning sign"></i> &nbsp; Erro ao alterar o Dia de estudo.</strong>
						</div>
				'));
			}
		} else {
			$options = array('conditions' => array('Dia.' . $this->Dia->primaryKey => $id));
			$this->request->data = $this->Dia->find('first', $options);
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
		$this->Dia->id = $id;
		if (!$this->Dia->exists()) {
			throw new NotFoundException(__('Registro não encontrado!'));
		}
		
		$this->request->allowMethod('post', 'delete');
		if ($this->Dia->delete()) {
				$this->Session->setFlash(__('
							<div class="alert alert-success" id="message" style="position: absolute; z-index: 99999; min-width: 100%;">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong><i class="fa fa-check sign"></i> &nbsp; Dia de estudo excluído com sucesso.</strong>
							</div>
					'));
					return $this->redirect(array('action'=> 'index'));
			}
				else {
				$this->Session->setFlash(__('
						<div class="alert alert-danger" style="position: absolute; z-index: 99999; min-width: 100%;">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong><i class="fa fa-warning sign"></i> &nbsp; Erro ao excluir o Dia de estudo.</strong>
						</div>
				'));
			}
		return $this->redirect(array('DiasController', 'action'=> 'index'));
	}
}
