<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail','Network/Email');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

/**
 * TbPedidos Controller
 *
 * @property TbPedido $TbPedido
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class TbPedidosController extends AppController {

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
		switch($_SESSION['Auth']['User']['flg_unidade_usuario']){
			case 'alipio':
			$unidadeRetirada = "`TbPedido`.`unidade_retirada` IN ('alipio', 'Indefinida')";
			break;
			
			case 'funcionarios':
			$unidadeRetirada = "`TbPedido`.`unidade_retirada` IN ('funcionarios', 'Indefinida')";
			break;
			
			case 'luxemburgo':
			$unidadeRetirada = "`TbPedido`.`unidade_retirada` IN ('luxemburgo', 'Indefinida')";
			break;
			
			case 'todas':
			$unidadeRetirada = "`TbPedido`.`unidade_retirada` <> ''";
			break;
			
			default:
			$unidadeRetirada = "`TbPedido`.`unidade_retirada` <> ''";
			break;
		}
		$nomeCliente = "`TbPedido`.`nome_cliente` <> ''";
		$filter0 = array(
			'limit' => 50,
			'conditions' => array('TbPedido.status_pedido' => '0', $nomeCliente, $unidadeRetirada), //Não finalizado no site
			'order' => array(
				'TbPedido.numero_pedido' => 'asc'
			)
		);
		$this->paginate = $filter0;
		$TbPedidos0 = $this->paginate('TbPedido');
		$this->set('TbPedidos0', $TbPedidos0);
		
		$filter1 = array(
			'limit' => 50,
			'conditions' => array('TbPedido.status_pedido' => '1', $unidadeRetirada), //Aguardando confirmação do pagamento
			'order' => array(
				'TbPedido.numero_pedido' => 'asc'
			)
		);
		$this->paginate = $filter1;
		$TbPedidos1 = $this->paginate('TbPedido');
		$this->set('TbPedidos1', $TbPedidos1);
		
		$filter2 = array(
			'limit' => 50,
			'conditions' => array('TbPedido.status_pedido' => '2', $unidadeRetirada), //Aguardando produção
			'order' => array(
				'TbPedido.numero_pedido' => 'asc'
			)
		);
		$this->paginate = $filter2;
		$TbPedidos2 = $this->paginate('TbPedido');
		$this->set('TbPedidos2', $TbPedidos2);
		
		$filter3 = array(
			'limit' => 50,
			'conditions' => array('TbPedido.status_pedido' => '3', $unidadeRetirada), //Em produção
			'order' => array(
				'TbPedido.numero_pedido' => 'asc'
			)
		);
		$this->paginate = $filter3;
		$TbPedidos3 = $this->paginate('TbPedido');
		$this->set('TbPedidos3', $TbPedidos3);
		
		$filter4 = array(
			'limit' => 50,
			'conditions' => array('TbPedido.status_pedido' => '4', $unidadeRetirada), //Produção concluída
			'order' => array(
				'TbPedido.numero_pedido' => 'asc'
			)
		);
		$this->paginate = $filter4;
		$TbPedidos4 = $this->paginate('TbPedido');
		$this->set('TbPedidos4', $TbPedidos4);
		
		$filter5 = array(
			'limit' => 50,
			'conditions' => array('TbPedido.status_pedido' => '5', $unidadeRetirada), //Disponível para retirada
			'order' => array(
				'TbPedido.numero_pedido' => 'asc'
			)
		);
		$this->paginate = $filter5;
		$TbPedidos5 = $this->paginate('TbPedido');
		$this->set('TbPedidos5', $TbPedidos5);
		
		$filter6 = array(
			'limit' => 50,
			'conditions' => array('TbPedido.status_pedido' => '6', $unidadeRetirada), //Entregue
			'order' => array(
				'TbPedido.numero_pedido' => 'desc'
			)
		);
		$this->paginate = $filter6;
		$TbPedidos6 = $this->paginate('TbPedido');
		$this->set('TbPedidos6', $TbPedidos6);
		
		$filter7 = array(
			'limit' => 50,
			'conditions' => array('TbPedido.status_pedido' => '7', $unidadeRetirada), //Cancelado
			'order' => array(
				'TbPedido.numero_pedido' => 'desc'
			)
		);
		$this->paginate = $filter7;
		$TbPedidos7 = $this->paginate('TbPedido');
		$this->set('TbPedidos7', $TbPedidos7);

	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->TbPedido->exists($id)) {
			throw new NotFoundException(__('Registro não encontrado!'));
		}
		if ($this->request->is(array('post', 'put'))) {
			
			//Cria log de alteração de status
			$token_cart = $this->request->data['TbPedido']['id'];
			$status_novo = $this->request->data['TbPedido']['status_pedido'];
			$id_usuario_logado = $_SESSION['Auth']['User']['id'];
				
			require_once('../class/db.class.php');
			$db = new DB();
			
			$status_antigo = $db->getPedido($token_cart);

			//Verifica se o status está sendo alterado
			if($status_antigo[0]['status_pedido'] != $status_novo){
				//Chama função para criar log de alteração do status
				$db->geraLogStatus($token_cart, $status_antigo[0]['status_pedido'], $status_novo, $id_usuario_logado);
			}
				
			if ($this->TbPedido->save($this->request->data)) {
				if($status_novo != $status_antigo[0]['status_pedido'] && $status_novo == '5'){
					//Se status do pedido estiver sendo alterado para "Disponível para retirada na unidade"
					$nomeCliente = utf8_encode($status_antigo[0]['nome_cliente']);
					$emailCliente = utf8_encode($status_antigo[0]['email_cliente']);
					$numeroPedido = $status_antigo[0]['numero_pedido'];
					
					switch($status_antigo[0]['unidade_retirada']){
						case 'alipio':
						$unidadeRetirada = 'Alípio de Melo';
						break;
						
						case 'funcionarios':
						$unidadeRetirada = 'Funcionários';
						break;
						
						case 'luxemburgo':
						$unidadeRetirada = 'Luxemburgo';
						break;
						
						default:
						$unidadeRetirada = 'Luxemburgo';
						break;
					}

					$message = '<div><p><strong>Olá '.utf8_decode($nomeCliente).',</strong></p></div>
								<div>Seu pedido número IRAI'.$numeroPedido.' está disponível para retirada na unidade '.$unidadeRetirada.'.</div>
								<div>Para mais detalhes acesse: <a href="http://fotoirai.com.br/meusPedidos.php">fotoirai.com.br/meusPedidos.php</a> e informe seu CPF e número deste pedido.</div>

								<p>
									<a href="http://fotoirai.com.br" style="text-decoration: none; color: #d42a32; font-size: 18px;">Foto Iraí</a><br>
									<span style="color: gray; font-size: 13px;">Este é um e-mail automático, não é necessário respondê-lo.</span>
								</p>';
									
					$assunto = '[FOTO IRAI] - Seu pedido IRAI'.$numeroPedido.' está disponível para retirada';
					$assunto = utf8_encode($assunto);
					
					$Email = new CakeEmail();
					$Email->config('smtp')
						  ->to($emailCliente)
						  ->subject($assunto);
					$Email->send($message);
				}
				
				$this->Session->setFlash(__('
						<div class="alert alert-success" id="message">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong><i class="fa fa-check sign"></i> &nbsp; Produto alterado com sucesso.</strong>
						</div>
				'));
				return $this->redirect(array('action'=> 'edit', $id));
			}
				else {
						if(!empty($this->TbPedido->validationErrors) && isset($this->TbPedido->validationErrors)){
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
			$options = array('conditions' => array('TbPedido.' . $this->TbPedido->primaryKey => $id));
			$this->request->data = $this->TbPedido->find('first', $options);
		}
	}
}
