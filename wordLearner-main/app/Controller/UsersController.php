<?php

// app/Controller/UsersController.php
class UsersController extends AppController {
	
    public function beforeFilter() {
         parent::beforeFilter();
         $this->Auth->allow('login', 'add');
    }
	
	public function login() {
		$this->layout = 'login';
		//if already logged-in, redirect
		if($this->Session->check('Auth.User')){
			$this->redirect(array('action' => 'index'));		
		}
		
		// if we get the post information, try to authenticate
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->redirect($this->Auth->redirectUrl());
			} else {
				$this->Session->setFlash(__('<div class="alert alert-danger" style="position: absolute; z-index: 99999; min-width: 100%;">
												<strong style="color: #ff0b11;">'.utf8_encode("Invalid user or password!").'</strong>
											</div>'));
			}
		} 
	}

public function logout() {
	$this->Session->setFlash(__('<strong style="color: white;">'.utf8_encode("Logoff successfully!").'</strong>'));
    $this->redirect($this->Auth->logout());
}

    public function lista() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }
	
	public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('
						<div class="alert alert-success" id="message" style="position: absolute; z-index: 99999; min-width: 100%;">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong><i class="fa fa-check sign"></i> &nbsp; '.utf8_encode("Created successfull!").'</strong>
						</div>
				'));
                $this->redirect(array('controller'=>'users', 'action' => 'lista'));
            }
				else {
						if(!empty($this->User->validationErrors) && isset($this->User->validationErrors)){
							$this->Session->setFlash(__('<div class="alert alert-warning">
														<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
														<strong><i class="fa fa-warning sign"></i> &nbsp; '.utf8_encode("Verifique os campos do formulário.").'</strong>
													</div>'));
						}
							else{
								$this->Session->setFlash(__('<div class="alert alert-danger" style="position: absolute; z-index: 99999; min-width: 100%;">
														<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
														<strong><i class="fa fa-warning sign"></i> &nbsp; '.utf8_encode("Ocorreu um erro inesperado durante a criação do registro.").'</strong>
													</div>'));
							}
					}
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__(utf8_encode('Registro não localizado')));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('
						<div class="alert alert-success" id="message" style="position: absolute; z-index: 99999; min-width: 100%;">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong><i class="fa fa-check sign"></i> &nbsp; '.utf8_encode("Update successfull!").'</strong>
						</div>
				'));
                $this->redirect(array('controller'=>'users', 'action' => 'edit', $id));
            }
				else {
						if(!empty($this->User->validationErrors) && isset($this->User->validationErrors)){
							$this->Session->setFlash(__('<div class="alert alert-warning">
														<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
														<strong><i class="fa fa-warning sign"></i> &nbsp; '.utf8_encode("Verifique os campos do formulário.").'</strong>
													</div>'));
						}
							else{
								$this->Session->setFlash(__('<div class="alert alert-danger" style="position: absolute; z-index: 99999; min-width: 100%;">
														<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
														<strong><i class="fa fa-warning sign"></i> &nbsp; '.utf8_encode("Ocorreu um erro inesperado durante a atualização do registro.").'</strong>
													</div>'));
							}
					}
					
        } else {
            $this->request->data = $this->User->findById($id);
            //unset($this->request->data['User']['password']);
        }
    }
	
}
?>