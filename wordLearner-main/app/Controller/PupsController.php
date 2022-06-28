<?php
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

require_once('../class/db.class.php');

/**
 * Pups Controller
 *
 * @property Pup $Pup
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PupsController extends AppController {

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
				'Pup.nome_Pup' => 'asc'
			)
		);
	
		$this->paginate = $filter;
		$Pups = $this->paginate('Pup');
		$this->set('Pups', $Pups);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Pup->create();
			if ($this->Pup->save($this->request->data)) {
				$this->Session->setFlash(__('
						<div class="alert alert-success" id="message">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong><i class="fa fa-check sign"></i> &nbsp; Pup cadastrado com sucesso.</strong>
						</div>
				'));
				return $this->redirect(array('controller'=>'Pups', 'action'=> 'edit', $this->Pup->getLastInsertId(), 'aba'=>'1'));
			} else {
				$this->Session->setFlash(__('
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong><i class="fa fa-warning sign"></i> &nbsp; Erro ao cadastrar o Pup.</strong>
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
		if (!$this->Pup->exists($id)) {
			throw new NotFoundException(__('Registro não encontrado!'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Pup->save($this->request->data)) {
				$this->Session->setFlash(__('
						<div class="alert alert-success" id="message">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong><i class="fa fa-check sign"></i> &nbsp; Pup alterado com sucesso.</strong>
						</div>
				'));
				return $this->redirect(array('action'=> 'edit', $id));
			} else {
				$this->Session->setFlash(__('
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong><i class="fa fa-warning sign"></i> &nbsp; Erro ao alterar o Pup.</strong>
						</div>
				'));
			}
		} else {
			$options = array('conditions' => array('Pup.' . $this->Pup->primaryKey => $id));
			$this->request->data = $this->Pup->find('first', $options);
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
		$this->Pup->id = $id;
		if (!$this->Pup->exists()) {
			throw new NotFoundException(__('Registro não encontrado!'));
		}
		//Deleta no banco de dados
		$this->request->allowMethod('post', 'delete');
		
		if(!empty($arrayFotosNome)){
			$arrayFotosNome = explode(',', $arrayFotosNome);
		}
		
		//DELETANDO ARQUIVOS		
		//Cria instânica da pasta
		$dir = new Folder('img/Pups/');
		$dirThumbs = new Folder('img/Pups/thumbs/');
		
		if ($this->Pup->delete()) {
				//Após deletar o Pup no banco de dados
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
								<strong><i class="fa fa-check sign"></i> &nbsp; Pup excluído com sucesso.</strong>
							</div>
					'));
					return $this->redirect(array('action'=> 'index'));
			}
				else {
				$this->Session->setFlash(__('
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong><i class="fa fa-warning sign"></i> &nbsp; Erro ao excluir o Pup.</strong>
						</div>
				'));
			}
		return $this->redirect(array('PupsController', 'action'=> 'index'));
	}
	
	public function genitor() {
		$this->request->allowMethod('ajax');
		$this->layout = 'ajax';

		$raca_id = $this->request->data['raca_id'];
		$db = new DB();
		
		if ($this->request->is('post')) {
			$matriz = $db->getGenitorRacaTipo('0', $raca_id, '1');
			$padreador = $db->getGenitorRacaTipo('1', $raca_id, '1');
		}
			elseif ($this->request->is(array('post', 'put'))) {
				$matriz = $db->getGenitorRacaTipo('0', $raca_id);
				$padreador = $db->getGenitorRacaTipo('1', $raca_id);
			}
			
		$arrayMatriz = '';
		if(is_array($matriz)){
			foreach($matriz as $key){
				$arrayMatriz[$key['id']] = utf8_encode($key['nome_genitor']);
			}
		}

		$arrayPadreador = '';
		if(is_array($padreador)){
			foreach($padreador as $key){
				$arrayPadreador[$key['id']] = utf8_encode($key['nome_genitor']);
			}
		}
			
		echo "<div class='form-group'>";
		echo "<label>Matriz *</label>";
				echo $this->Form->input('matriz_id', array('label'=>false, 'class'=>'form-control', 'options'=>$arrayMatriz, 'empty'=>'Selecione', 'style'=>'text-transform: uppercase;'));
		echo "</div>";
		echo "<div class='form-group'>";
		echo "<label>Padreador *</label>";
				echo $this->Form->input('padreador_id', array('label'=>false, 'class'=>'form-control', 'options'=>$arrayPadreador, 'empty'=>'Selecione', 'style'=>'text-transform: uppercase;'));
		echo "</div>";
	}
	
}
