<?php
App::uses('AppModel', 'Model');
/**
 * Genitor Model
 *
 */
class Genitor extends AppModel {
	
	public function beforeSave($options = array()) {
		//Retirando barras "/" da string para erradicar erro ocorrido com o GET
		// quando a barra é inserida no nome do Raca
		$nomeRaca = $this->data['Genitor']['nome_genitor'];
		$nomeRaca = str_replace("/", "-", $nomeRaca);
		$nomeRaca = str_replace("\\", "-", $nomeRaca);
		$this->data['Genitor']['nome_genitor'] = $nomeRaca;
	}
	
    public $validate = array(
        'flg_tipo_genitor' => array(
			'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Campo obrigatório'
			)
        ),
		'raca_id' => array(
			'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Campo obrigatório'
			)
        ),
		'nome_genitor' => array(
			'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Campo obrigatório'
			)
        )
    );
}
