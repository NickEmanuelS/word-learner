<?php
App::uses('AppModel', 'Model');
/**
 * Pup Model
 *
 */
class Pup extends AppModel {

	public function beforeSave($options = array()) {
		if (!empty($this->data['Pup']['data_nascimento'])) {
			$this->data['Pup']['data_nascimento'] = $this->dateFormatBeforeSave($this->data['Pup']['data_nascimento']);        
		}
	}
	
	public function afterFind($results, $primary = false) {
	
		foreach ($results as $key => $val) {
			if (isset($val['Pup']['data_nascimento'])) {
				$results[$key]['Pup']['data_nascimento'] = $this->dateFormatAfterFind($val['Pup']['data_nascimento']);
			}
		}
		return $results;
	}

    public $validate = array(
        'valor' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Campo obrigatório'
            )
        ),
        'data_nascimento' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Campo obrigatório'
            )
        ),
		'flg_sexo' => array(
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
		'matriz_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Campo obrigatório'
            )
        ),
		'padreador_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Campo obrigatório'
            )
        ),
		'flg_vacinado' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Campo obrigatório'
            )
        ),
		'flg_vermifugado' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Campo obrigatório'
            )
        )
    );

	public function dateFormatAfterFind($dateString) {
		return date('d/m/Y', strtotime($dateString));
		
	}

	 public function dateFormatBeforeSave($dateString) {
		$format = '/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/';
		if ($dateString != null && preg_match($format, $dateString, $partes)) {
			$dateString = $partes[3].'-'.$partes[2].'-'.$partes[1];
			return $dateString;
		}
	}

}
