<?php
App::uses('AppModel', 'Model');
/**
 * Raca Model
 *
 */
class Raca extends AppModel {

	public function beforeSave($options = array()) {
		//Retirando barras "/" da string para erradicar erro ocorrido com o GET
		// quando a barra é inserida no nome do Raca
		$nomeRaca = $this->data['Raca']['nome_raca'];
		$nomeRaca = str_replace("/", "-", $nomeRaca);
		$nomeRaca = str_replace("\\", "-", $nomeRaca);
		$this->data['Raca']['nome_raca'] = $nomeRaca;
	}

    public $validate = array(
        'nome_raca' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Favor informar a Raça'
            )
        )
    );
}
