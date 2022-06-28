<?php
App::uses('AppController', 'Controller');

/**
 * Searchs Controller
 *
 * @property Search $Search
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class SearchsController extends AppController {

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
		
	}
}
