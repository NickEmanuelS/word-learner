<?php
App::uses('AppController', 'Controller');

/**
 * Frases Controller
 *
 * @property Frase $Frase
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class FrasesController extends AppController {

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

	public function add() {
		if ($this->request->is('post')) {
			$this->Frase->create();
			if ($this->Frase->save($this->request->data)) {
				$this->Session->setFlash(__('
						<div class="alert alert-success" id="message" style="position: absolute; z-index: 99999; min-width: 100%;">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong><i class="fa fa-check sign"></i> &nbsp; Frase cadastrada com sucesso.</strong>
						</div>
				'));
				return $this->redirect(array('controller'=>'Frases', 'action'=> 'edit', $this->Frase->getLastInsertId()));
			} else {
				$this->Session->setFlash(__('
						<div class="alert alert-danger" style="position: absolute; z-index: 99999; min-width: 100%;">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong><i class="fa fa-warning sign"></i> &nbsp; Erro ao cadastrar a Frase.</strong>
						</div>
				'));
			}
		}
	}
	
	public function edit($id = null) {
		if (!$this->Frase->exists($id)) {
			throw new NotFoundException(__('Registro não encontrado!'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Frase->save($this->request->data)) {
				$this->Session->setFlash(__('
						<div class="alert alert-success" id="message" style="position: absolute; z-index: 99999; min-width: 100%;">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong><i class="fa fa-check sign"></i> &nbsp; Frase alterada com sucesso.</strong>
						</div>
				'));
				return $this->redirect(array('action'=> 'edit', $id));
			} else {
				$this->Session->setFlash(__('
						<div class="alert alert-danger" style="position: absolute; z-index: 99999; min-width: 100%;">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong><i class="fa fa-warning sign"></i> &nbsp; Erro ao alterar a Frase de estudo.</strong>
						</div>
				'));
			}
		} else {
			$options = array('conditions' => array('Frase.' . $this->Frase->primaryKey => $id));
			$this->request->data = $this->Frase->find('first', $options);
		}
	}
	
	public function delete($id = null, $dia_id) {
		$this->Frase->id = $id;
		if (!$this->Frase->exists()) {
			throw new NotFoundException(__('Registro não encontrado!'));
		}
		
		$this->request->allowMethod('post', 'delete');
		if ($this->Frase->delete()) {
				$this->Session->setFlash(__('
							<div class="alert alert-success" id="message" style="position: absolute; z-index: 99999; min-width: 100%;">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong><i class="fa fa-check sign"></i> &nbsp; Frase excluída com sucesso.</strong>
							</div>
					'));
					return $this->redirect(array('controller' => 'dias', 'action'=> 'view', $dia_id));
			}
				else {
				$this->Session->setFlash(__('
						<div class="alert alert-danger" style="position: absolute; z-index: 99999; min-width: 100%;">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong><i class="fa fa-warning sign"></i> &nbsp; Erro ao excluir a frase.</strong>
						</div>
				'));
			}
		return $this->redirect(array('controller' => 'dias', 'action'=> 'view', $dia_id));
	}
	
	public function translate() {
		$this->request->allowMethod('ajax');
		$this->layout = 'ajax';
        
		$api_key = 'AIzaSyDcm54hGJt5g0Sc_8LK1wSaexBFotliEWs';
        
		$text_from_to = $this->request->data['text_from_to'];
        $text_en = $this->request->data['text_en'];
        $text_pt = $this->request->data['text_pt'];

		if($text_from_to == 'en_to_pt'){
			$text = str_replace(' ', '+', $text_en);
			
			$response = file_get_contents("https://translation.googleapis.com/language/translate/v2?q=$text&target=pt&format=text&source=en&key=$api_key");

			$json = json_decode($response);
			$array = $json->data->translations;
			
			$traducao = '';
			foreach($array as $key){
				// Transformando objeto dentro da posição 0 em outro array
				$arrayTraducao = (array) $key;
				$traducao = $traducao.$arrayTraducao['translatedText'].'<br>';
			}
				echo $traducao;
		}
			else{
				$text = str_replace(' ', '+', $text_pt);
			
				$response = file_get_contents("https://translation.googleapis.com/language/translate/v2?q=$text&target=en&format=text&source=pt&key=$api_key");

				$json = json_decode($response);
				$array = $json->data->translations;
				
				$traducao = '';
				foreach($array as $key){
					// Transformando objeto dentro da posição 0 em outro array
					$arrayTraducao = (array) $key;
					$traducao = $traducao.$arrayTraducao['translatedText'].'<br>';
				}
					echo $traducao;
			}
	}

}
